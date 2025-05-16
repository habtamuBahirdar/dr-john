<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductOrder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $products = Product::whereIn('id', array_keys($cart))->get();
        return view('cart.index', compact('cart', 'products'));
    }

    public function add(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        $cart[$id] = ($cart[$id] ?? 0) + 1;
        session(['cart' => $cart]);
        return back()->with('success', 'Product added to cart!');
    }

    public function update(Request $request, $id)
    {
        $cart = session('cart', []);
        if (isset($cart[$id])) {
            if ($request->action === 'plus') {
                $cart[$id]++;
            } elseif ($request->action === 'minus' && $cart[$id] > 1) {
                $cart[$id]--;
            }
            session(['cart' => $cart]);
        }
        return back();
    }

    public function checkout(Request $request)
    {
        $cart = session('cart', []);
        $products = Product::whereIn('id', array_keys($cart))->get();

        if (empty($cart) || $products->isEmpty()) {
            return back()->with('error', 'Your cart is empty.');
        }

        // Save buyer info in session for use after payment
        session([
            'buyer_name' => $request->input('buyer_name'),
            'buyer_phone' => $request->input('buyer_phone'),
            'buyer_email' => $request->input('buyer_email'),
        ]);

        $grandTotal = 0;
        foreach ($products as $product) {
            $grandTotal += $cart[$product->id] * $product->price;
        }

        $chapaBaseUrl = rtrim(env('CHAPA_BASE_URL', 'https://api.chapa.co/v1'), '/');
        $data = [
            'amount' => $grandTotal,
            'currency' => $products->first()->currency ?? 'ETB',
            'email' => $request->input('buyer_email', 'guest@example.com'),
            'first_name' => $request->input('buyer_name', 'Guest'),
            'tx_ref' => uniqid('chapa_'),
            'callback_url' => route('cart.payment.callback'),
            'return_url' => route('cart.index'),
            'customization[title]' => 'Deshet Medical Center Payment',
            'customization[description]' => 'Cart Payment',
        ];

        $response = Http::withToken(env('CHAPA_SECRET_KEY'))
            ->post($chapaBaseUrl . '/transaction/initialize', $data);

        $result = $response->json();
        Log::info('Chapa response:', $result);

        if (isset($result['data']['checkout_url'])) {
            return redirect($result['data']['checkout_url']);
        } else {
            return back()->with('error', 'Payment initialization failed: ' . ($result['message'] ?? 'Unknown error'));
        }
    }

    public function paymentCallback(Request $request)
    {
        $tx_ref = $request->query('tx_ref');

        // Verify payment with Chapa
        $chapaBaseUrl = rtrim(env('CHAPA_BASE_URL', 'https://api.chapa.co/v1'), '/');
        $verifyUrl = $chapaBaseUrl . '/transaction/verify/' . $tx_ref;
        $response = Http::withToken(env('CHAPA_SECRET_KEY'))->get($verifyUrl);
        $result = $response->json();

        if (isset($result['data']) && $result['data']['status'] === 'success') {
            // Save order
            ProductOrder::create([
                'buyer_name' => session('buyer_name'),
                'buyer_phone' => session('buyer_phone'),
                'buyer_email' => session('buyer_email'),
                'products' => json_encode(session('cart', [])),
                'total_amount' => $result['data']['amount'],
                'currency' => $result['data']['currency'],
                'payment_reference' => $result['data']['tx_ref'],
                'payment_status' => 'completed',
            ]);

            // Clear cart and buyer info
            session()->forget(['cart', 'buyer_name', 'buyer_phone', 'buyer_email']);

            return redirect()->route('cart.index')->with('success', 'Payment successful! Order placed.');
        } else {
            return redirect()->route('cart.index')->with('error', 'Payment verification failed.');
        }
    }
}