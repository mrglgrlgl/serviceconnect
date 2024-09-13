@extends('layouts.guest')

@section('content')
    <!-- Header -->
    <header class= "py-4">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-semibold">Contact Us</h1>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <section class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-4">Get in Touch</h2>
            <p class="text-gray-600 mb-6">
                If you're interested in signing up as an agency, please contact our administrator using the information below.
            </p>
            
            <div class="mb-6">
                <h3 class="text-xl font-semibold mb-2">Contact Information</h3>
                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        <span class="material-icons text-gray-500">email</span>
                        <p class="text-gray-700">Email: <a href="mailto:admin@example.com" class="text-blue-600 hover:underline">admin@example.com</a></p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span class="material-icons text-blue-500">phone</span>
                        <p class="text-gray-700">Phone: <a href="tel:+1234567890" class="text-blue-600 hover:underline">+123 456 7890</a></p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span class="material-icons text-red-500">location_on</span>
                        <p class="text-gray-700">Location: 123 Business St, Suite 100, Cityville, ST 12345</p>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-xl font-semibold mb-2">Office Hours</h3>
                <p class="text-gray-700">
                    Monday - Friday: 9:00 AM - 5:00 PM<br>
                    Saturday: 10:00 AM - 3:00 PM<br>
                    Sunday: Closed
                </p>
            </div>
        </section>
    </main>

    {{-- <footer class="bg-blue-600 text-white py-4">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} Your Company. All rights reserved.</p>
        </div>
    </footer> --}}
@endsection
