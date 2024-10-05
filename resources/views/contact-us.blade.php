@extends('layouts.guest')

@section('content')
<!-- Header -->


<!-- Main Content -->
<main class="container mx-auto px-4 py-8">
        <div class="container mx-auto">
        <h1 class="text-3xl font-semibold bg-gradient-to-r from-sky-900 to-cyan-600 text-white p-4 rounded-l-lg rounded-r-lg">
            Contact Us
        </h1>
    </div>
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
                    <p class="text-gray-700 font-semibold">Email: <a href="mailto:admin@example.com" class="text-blue-600 hover:underline">admin@example.com</a></p>
                </div>
                <div class="flex items-center space-x-3">
                    <span class="material-icons text-blue-500">phone</span>
                    <p class="text-gray-700 font-semibold">Phone: <a href="tel:+1234567890" class="text-blue-600 hover:underline">+123 456 7890</a></p>
                </div>
                <div class="flex items-center space-x-3">
                    <span class="material-icons text-red-500">location_on</span>
                    <p class="text-gray-700 font-semibold">Location: 123 Business St, Suite 100, Cityville, ST 12345</p>
                </div>
            </div>
        </div>

        <div class="mb-6">
            <h3 class="text-xl font-semibold mb-2">Office Hours</h3>
            <p class="text-gray-700">
                <strong>Monday - Friday:</strong> 9:00 AM - 5:00 PM<br>
                <strong>Saturday:</strong> 10:00 AM - 3:00 PM<br>
                <strong>Sunday:</strong> Closed
            </p>
        </div>

        <!-- Back Button -->
        <div class="mt-6">
            <button type="button" onclick="window.history.back()" class="bg-gray-300 text-gray-700 h-12 w-full rounded-md font-semibold shadow-md hover:bg-gray-400 transition duration-300 transform transition-transform duration-300 hover:scale-105 hover:shadow-xl">
                Back
            </button>
        </div>
    </section>
</main>
@endsection
