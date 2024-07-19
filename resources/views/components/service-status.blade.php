<!-- resources/views/components/service-request.blade.php -->
@props(['status' => ''])

<div id="status" class="text-sm mt-1 md:ml-12">
    @php
        $statusColorClasses = [
            'open' => 'text-green-600',      // Green color for 'open'
            'pending' => 'text-blue-600',    // Blue color for 'pending'
            'archived' => 'text-gray-600',   // Gray color for 'archived'
            'completed' => 'text-black'      // Black color for 'completed'
        ];

        $statusText = strtoupper($status);
        $statusClass = $statusColorClasses[$status] ?? 'text-gray-600'; // Default to gray if status not defined
    @endphp

    <span class="text-gray-600">Status:</span> 
    <span class="{{ $statusClass }} font-semibold">{{ $statusText }}</span>
</div>