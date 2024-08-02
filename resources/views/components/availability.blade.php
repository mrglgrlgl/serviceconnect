<!-- resources/views/components/availability.blade.php -->
<div class="md:border-gray-300 md:rounded-2xl md:p-4 ml-auto">
    <div class="flex flex-wrap gap-2">
        @php
            $daysAbbreviations = ['M' => 'Monday', 'T' => 'Tuesday', 'W' => 'Wednesday', 'Th' => 'Thursday', 'F' => 'Friday', 'S' => 'Saturday', 'Sn' => 'Sunday'];
            $availabilityDays = explode(',', optional($providerDetails)->availability_days);
            $userRole = auth()->user()->role ?? null; // Get the logged-in user's role
            $borderColor = $userRole == 2 ? 'border-custom-light-blue' : 'border-custom-lightest-blue';
            $bgColor = $userRole == 2 ? 'bg-custom-light-blue' : 'bg-custom-lightest-blue';
            $textColor = $userRole == 2 ? 'text-custom-light-blue' : 'text-custom-lightest-blue';
        @endphp
        @foreach ($daysAbbreviations as $abbr => $fullDay)
            <div class="day-label flex items-center justify-center w-7 h-7 border-2 rounded-full text-md font-semibold mt-2 
                {{ in_array($fullDay, $availabilityDays) ? $bgColor . ' text-white' : 'bg-gray-100' }} {{ $borderColor }} {{ $textColor }}">
                {{ $abbr }}
            </div>
        @endforeach
    </div>
</div>
