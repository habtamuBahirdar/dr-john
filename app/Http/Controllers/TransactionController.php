<?php
namespace App\Http\Controllers;

use App\Models\Payment; // Assuming transactions are stored in the `payments` table
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of all transactions.
     */
public function index(Request $request)
{
    // Fetch query parameters
    $search = $request->input('search');
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    // Build the query
    $query = Payment::with('appointment.patient')->orderBy('created_at', 'desc');

    // Apply search filter
    if ($search) {
        $query->where('tx_ref', 'like', "%{$search}%")
              ->orWhere('id', $search);
    }

    // Apply date filter
    if ($startDate) {
        $query->whereDate('created_at', '>=', $startDate);
    }
    if ($endDate) {
        $query->whereDate('created_at', '<=', $endDate);
    }

    // Paginate the results
    $transactions = $query->paginate(10);

    return view('admin.transactions.index', compact('transactions', 'search', 'startDate', 'endDate'));
}
}