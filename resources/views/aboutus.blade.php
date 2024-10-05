@extends('layouts.guest')

@section('content')

<section class="container mx-auto py-12 px-12 bg-white">
    <h1 class="text-4xl font-bold text-center mb-8">ABOUT US</h1>
    
    <!-- Image Placeholders -->
    <div class="flex justify-center gap-8 mb-12">
        <div class="w-1/2">
            <div class="h-64 rounded-lg flex items-center justify-center">
                <img class="w-60 h-60 mb-4" 
                     src="{{ asset('images/logo.png') }}" 
                     alt="Company Logo" />
            </div> <!-- First Image Placeholder -->
        </div>
        <div class="w-1/2">
            <div class="h-64 rounded-lg flex items-center justify-center">
                <img class="w-60 h-60 mb-4" 
                     src="{{ asset('images/critcon.png') }}" 
                     alt="Critical Conundrum Logo" />
            </div> <!-- Second Image Placeholder -->
        </div>
    </div>

    <!-- Expanded Description -->
<div class="text-center max-w-4xl mx-auto mb-12 pt-8 pb-8">
    <p class="text-lg text-gray-700 mb-4">
        ServiceConnect is a project developed by Critical Conundrum. This application aims to bridge the gap between clients seeking various services and skilled providers offering these services. Whether clients need carpentry, plumbing, electrical work, food services, bus driving, stone cutting, hairdressing, or beauty therapy, ServiceConnect serves as a reliable platform.
    </p>
    
    <p class="text-lg text-gray-700 mb-4">
        The initiative not only facilitates easy access to a wide range of services but also empowers local providers by giving them a platform to showcase their skills and connect with potential clients. By prioritizing user experience and fostering a community of trusted professionals, ServiceConnect ensures that users can find reliable service providers quickly and efficiently.
    </p>

    <p class="text-lg text-gray-700">
        With a focus on quality and customer satisfaction, ServiceConnect is committed to helping clients get the services they need when they need them. This project aims to revolutionize the way services are accessed and provided in the community.
    </p>
</div>


    <!-- The Team Section -->
    <h2 class="text-3xl font-semibold text-center mb-8 pt-8">The Service Connect Team</h2>

    <div class="flex justify-center space-x-8 mb-12"> <!-- Adjusted gap here -->
        <!-- Team Member 1 -->
        <div class="text-center">
            <img class="w-60 h-60 bg-gray-300 rounded-full mx-auto mb-4" 
                 src="{{ asset('images/Andrea.jpg') }}" 
                 alt="Andrea" />
            <p class="text-lg font-semibold">Andrea</p>
            <p class="text-gray-600">Front-end Developer</p>
        </div>

        <!-- Team Member 2 -->
        <div class="text-center">
            <img class="w-60 h-60 bg-gray-300 rounded-full mx-auto mb-4" 
                 src="{{ asset('images/Jerel.jpg') }}" 
                 alt="Jerel" />
            <p class="text-lg font-semibold">Jerel</p>
            <p class="text-gray-600">Project Manager</p>
        </div>

        <!-- Team Member 3 -->
        <div class="text-center">
            <img class="w-60 h-60 bg-gray-300 rounded-full mx-auto mb-4" 
                 src="{{ asset('images/Andre.jpeg') }}" 
                 alt="Andre" />
            <p class="text-lg font-semibold">Andre</p>
            <p class="text-gray-600">Back-end Developer</p>
        </div>
    </div>

</section>
@endsection
