{{-- Add @if set liwat para sa waay reviews --}}
<div class="grid grid-cols-1 gap-4 md:grid-cols-3 mx-auto pb-6 md:pt-2 justify-start items-start">

    {{-- Provider Overview --}}
    <div class="w-full md:col-span-1 rounded-t-lg md:rounded-r-none">
        <div class="text-2xl font-bold text-custom-light-blue">{{ __('Reviews') }}</div>
        {{-- Insert star ratings --}}
        {{-- Insert number of reviews. butang star system --}}
        <div class="text-custom-yellow text-3xl font-bold">5.0</div>
    </div>

    {{-- Provider Availability --}}
    {{-- Insert 1-5 ratings here --}}
    <div class="w-full md:col-span-2 bg-white flex flex-col items-start md:items-end">
        <div class="w-full md:w-3/5">
            <div class="md:pt-4">
                {{ __('Ratings 1-5') }}
            </div>
        </div>
    </div>
</div>

<div class="flex flex-col md:flex-row justify-between space-y-4 md:space-y-0">
    <div class="w-full md:w-3/5">
        <x-text-input class="h-10 w-full"/>
    </div>

    <div class="w-full md:pl-8 h-10">
        <x-selection class="w-full"/>
    </div>
</div>