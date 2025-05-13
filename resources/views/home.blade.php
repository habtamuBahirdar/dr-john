<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Deshet Indigenous Medical Center - Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <script defer>
        function toggleSidebar() {
            const sidebar = document.getElementById('mobileSidebar');
            sidebar.classList.toggle('translate-x-full');
        }
    </script>
</head>

<body class="bg-gradient-to-br from-blue-50 to-green-50 min-h-screen">

    {{-- NAVBAR --}}
    <header class="bg-white shadow-md fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <img src="{{ asset('images/logo.png') }}" alt="Clinic Logo" class="h-10 w-10" />
                <div class="text-xl font-bold text-blue-700">Deshet Indigenous Medical Center</div>
            </div>
            <div class="hidden md:flex items-center space-x-6">
                <a href="#" class="text-blue-700 hover:underline transition">Home</a>
                <a href="#about" class="text-blue-700 hover:underline transition">About</a>
                <a href="#blog" class="text-blue-700 hover:underline transition">Blog</a>
                <a href="#reviews" class="text-blue-700 hover:underline transition">Reviews</a>
                <a href="#contact" class="text-blue-700 hover:underline transition">Contact</a>
                <a href="/login"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Login</a>
            </div>
            <button onclick="toggleSidebar()" class="md:hidden text-blue-700 text-2xl">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>

    {{-- MOBILE SIDEBAR --}}
    <div id="mobileSidebar"
        class="fixed top-0 right-0 w-64 h-full bg-white shadow-lg transform translate-x-full transition-transform duration-300 z-50">
        <div class="p-4">
            <button onclick="toggleSidebar()" class="text-red-600 text-2xl float-right">&times;</button>
            <h2 class="text-lg font-bold text-blue-700 mt-6">Menu</h2>
            <nav class="mt-4 space-y-2">
                <a href="#" class="block text-blue-600 hover:underline">Home</a>
                <a href="#about" class="block text-blue-600 hover:underline">About</a>
                <a href="#blog" class="block text-blue-600 hover:underline">Blog</a>
                <a href="#reviews" class="block text-blue-600 hover:underline">Reviews</a>
                <a href="#contact" class="block text-blue-600 hover:underline">Contact</a>
                <a href="/login" class="block text-white bg-blue-600 px-4 py-2 rounded hover:bg-blue-700">Login</a>
            </nav>
        </div>
    </div>

    {{-- MAIN CONTENT --}}
    <main class="pt-24 px-4 md:px-0 max-w-5xl mx-auto">
        <section class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-extrabold text-blue-700 mb-4 animate-fade-in-down">Welcome to Our
                Clinic Scheduling System</h1>
            <p class="text-gray-700 text-lg mb-6 animate-fade-in">Book your appointments, manage schedules, and get
                notified online!</p>
            <a href="/register"
                class="inline-block bg-green-500 text-white px-8 py-3 rounded-lg text-lg font-semibold shadow hover:bg-green-600 transition animate-bounce">Get
                Started</a>
        </section>

        {{-- About Section --}}
        <section id="about"
            class="bg-white rounded-xl shadow p-8 mb-12 flex flex-col md:flex-row items-center gap-8 animate-fade-in">
            <img src="{{ asset('images/doctor.png') }}" alt="Clinic"
                class="w-40 h-40 object-cover rounded-full border-4 border-blue-200 shadow-lg">
            <div class="text-left">
                <h2 class="text-2xl font-bold text-blue-700 mb-2">About Us</h2>
                <p class="text-gray-600 mb-2">
                    Deshet Indigenous Medical Center blends Ethiopian traditional medicine with modern care, offering trusted, holistic health services in Bahir Dar and beyond.
                </p>
                <ul class="list-disc ml-5 text-gray-700">
                    <li>Experienced medical professionals</li>
                    <li>Modern facilities & indigenous care</li>
                    <li>Easy online appointment management</li>
                </ul>
            </div>
        </section>

        {{-- Blog Section --}}
        <section id="blog" class="mb-12">
            <h2 class="text-2xl font-bold text-blue-700 mb-6 text-center">Latest Blog Posts</h2>
            <div class="grid md:grid-cols-3 gap-6">
                <div class="bg-white rounded-lg shadow p-5 hover:shadow-lg transition group">
                    <img src="https://images.unsplash.com/photo-1710752213640-aa9ed91a8646?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        alt="Coffee Health Tips"
                        class="rounded-lg mb-3 w-full h-40 object-cover group-hover:scale-105 transition">
                    <h3 class="font-semibold text-lg text-blue-800 mb-2">5 Coffee Tips for Better Health</h3>
                    <ul class="text-gray-600 mb-2 list-disc ml-4 text-left text-sm">
                        <li>Enjoy coffee in moderation to avoid jitters.</li>
                        <li>Skip added sugars and flavored syrups.</li>
                        <li>Choose filtered coffee to reduce cholesterol impact.</li>
                        <li>Avoid drinking coffee late in the day for better sleep.</li>
                        <li>Pair coffee with a balanced breakfast for sustained energy.</li>
                    </ul>
                    <a href="#" class="text-green-600 hover:underline">Read More</a>
                </div>
                <div class="bg-white rounded-lg shadow p-5 hover:shadow-lg transition group">
                    <img src="https://deshet.com.et/wp-content/uploads/2025/03/Amaranth-1.png"
                        alt="Blog 2"
                        class="rounded-lg mb-3 w-full h-50 object-cover group-hover:scale-105 transition">
                    <h3 class="font-semibold text-lg text-blue-800 mb-2">Understanding Indigenous Medicine</h3>
                    <p class="text-gray-600 mb-2">Learn about the value and practices of indigenous medicine in modern
                        care.</p>
                    <a href="#" class="text-green-600 hover:underline">Read More</a>
                </div>
                <div class="bg-white rounded-lg shadow p-5 hover:shadow-lg transition group">
                    <img src="https://www.healthviewx.com/wp-content/uploads/2021/12/Healthcare-e-visits-online-digital-Evaluation-Management-EM-services.png"
                        alt="Blog 3"
                        class="rounded-lg mb-3 w-full h-50 object-cover group-hover:scale-105 transition">
                    <h3 class="font-semibold text-lg text-blue-800 mb-2">How to Book an Appointment Online</h3>
                    <p class="text-gray-600 mb-2">A step-by-step guide to using our online scheduling system.</p>
                    <a href="#" class="text-green-600 hover:underline">Read More</a>
                </div>
            </div>
        </section>

        {{-- Customer Reviews --}}
        <section id="reviews" class="mb-12">
            <h2 class="text-2xl font-bold text-blue-700 mb-6 text-center">What Our Patients Say</h2>
            <div class="grid md:grid-cols-3 gap-6">
                <div class="bg-white rounded-lg shadow p-5 flex flex-col items-center">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star-half-alt text-yellow-400"></i>
                    </div>
                    <p class="text-gray-700 italic mb-2">"The service was good and the staff were helpful."</p>
                    <div class="flex items-center gap-2">
                        <img src="https://randomuser.me/api/portraits/men/30.jpg" class="w-10 h-10 rounded-full"
                            alt="User 1">
                        <span class="font-semibold text-blue-700">Amanuel G.</span>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow p-5 flex flex-col items-center">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                    <p class="text-gray-700 italic mb-2">"I love the blend of traditional and modern care. The doctors
                        really listen."</p>
                    <div class="flex items-center gap-2">
                        <img src="https://randomuser.me/api/portraits/women/89.jpg" class="w-10 h-10 rounded-full"
                            alt="User 2">
                        <span class="font-semibold text-blue-700">Sosina M.</span>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow p-5 flex flex-col items-center">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="far fa-star text-yellow-400"></i>
                    </div>
                    <p class="text-gray-700 italic mb-2">"Great experience! The online system is fast and convenient."
                    </p>
                    <div class="flex items-center gap-2">
                        <img src="https://randomuser.me/api/portraits/women/68.jpg" class="w-10 h-10 rounded-full"
                            alt="User 3">
                        <span class="font-semibold text-blue-700">Helen M.</span>
                    </div>
                </div>
            </div>
            {{-- Add Review Form --}}
            <div class="mt-10 max-w-xl mx-auto bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-bold text-blue-700 mb-2">Leave a Review</h3>
                <form id="reviewForm" class="space-y-3">
                    <input type="text" id="reviewName" class="w-full border rounded px-3 py-2"
                        placeholder="Your Name" required>
                    <textarea id="reviewComment" class="w-full border rounded px-3 py-2" placeholder="Your Comment" required></textarea>
                    <div class="flex items-center gap-2">
                        <span class="font-semibold text-gray-700">Your Rating:</span>
                        <div id="starRating" class="flex gap-1 text-2xl cursor-pointer">
                            <i class="far fa-star" data-value="1"></i>
                            <i class="far fa-star" data-value="2"></i>
                            <i class="far fa-star" data-value="3"></i>
                            <i class="far fa-star" data-value="4"></i>
                            <i class="far fa-star" data-value="5"></i>
                        </div>
                        <input type="hidden" id="reviewStars" value="0">
                    </div>
                    <button type="submit"
                        class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition">Submit</button>
                </form>
                <div id="reviewSuccess" class="hidden text-green-600 mt-2">Thank you for your feedback!</div>
            </div>
        </section>

        {{-- Contact Section --}}
        <section id="contact" class="bg-white rounded-xl shadow p-8 mb-12 animate-fade-in">
            <h2 class="text-2xl font-bold text-blue-700 mb-4">Contact Us</h2>
            <form class="space-y-4 max-w-lg mx-auto">
                <div class="flex gap-4">
                    <input type="text" class="w-1/2 border rounded px-3 py-2" placeholder="Your Name" required>
                    <input type="email" class="w-1/2 border rounded px-3 py-2" placeholder="Your Email" required>
                </div>
                <textarea class="w-full border rounded px-3 py-2" rows="4" placeholder="Your Message" required></textarea>
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">Send Message</button>
            </form>
        </section>
    </main>

    {{-- Footer --}}
    <footer class="bg-blue-900 text-white py-6 text-center">
        &copy; {{ date('Y') }} Deshet Indigenous Medical Center. All rights reserved.
    </footer>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('mobileSidebar');
            sidebar.classList.toggle('translate-x-full');
        }

        // Auto-close sidebar when resizing to desktop
        window.addEventListener('resize', () => {
            const sidebar = document.getElementById('mobileSidebar');
            if (window.innerWidth >= 768) {
                sidebar.classList.add('translate-x-full');
            }
        });

        // Interactive Star Rating for Reviews
        const stars = document.querySelectorAll('#starRating i');
        let selectedRating = 0;
        stars.forEach(star => {
            star.addEventListener('mouseover', function() {
                const val = parseInt(this.getAttribute('data-value'));
                highlightStars(val);
            });
            star.addEventListener('mouseout', function() {
                highlightStars(selectedRating);
            });
            star.addEventListener('click', function() {
                selectedRating = parseInt(this.getAttribute('data-value'));
                document.getElementById('reviewStars').value = selectedRating;
                highlightStars(selectedRating);
            });
        });

        function highlightStars(rating) {
            stars.forEach(star => {
                if (parseInt(star.getAttribute('data-value')) <= rating) {
                    star.classList.remove('far');
                    star.classList.add('fas', 'text-yellow-400');
                } else {
                    star.classList.remove('fas', 'text-yellow-400');
                    star.classList.add('far');
                }
            });
        }

        // Fake Review Submission
        document.getElementById('reviewForm').addEventListener('submit', function(e) {
            e.preventDefault();
            if (selectedRating === 0) {
                alert('Please select a rating.');
                return;
            }
            document.getElementById('reviewSuccess').classList.remove('hidden');
            this.reset();
            highlightStars(0);
            selectedRating = 0;
            setTimeout(() => {
                document.getElementById('reviewSuccess').classList.add('hidden');
            }, 3000);
        });
    </script>
    <style>
        .animate-fade-in-down {
            animation: fadeInDown 1s;
        }

        .animate-fade-in {
            animation: fadeIn 1.2s;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .animate-bounce {
            animation: bounce 2s infinite;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }
    </style>
</body>

</html>
