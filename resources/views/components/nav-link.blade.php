@props(['href', 'icon', 'active' => false])

<a href="{{ $href }}" class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg hover:bg-lightest-blue hover:text-gray-800 hover:bg-gray-300 {{ $active ? 'bg-blue-200 text-blue-800' : '' }}">
    <span class="material-icons">{{ $icon }}</span>
    <span class="mx-2 text-sm font-medium">{{ $slot }}</span>
</a>

{{-- @php
$user = Auth::user();
if ($user) {
    $borderColor = $user->role == '3'e ? 'border-custom-lightest-blue' : 'border-custom-light-blue';
    $hoverBorderColor = $user->role == '3' ? 'hover:border-custom-lightestblue-accent' : 'hover:border-custom-light-blue';
    $hoverTextColor = $user->role == '3' ? 'hover:text-cyan-600' : 'hover:text-custom-light-blue';
    $textColor = $user->role == '3' ? 'text-custom-lightest-blue' : 'text-custom-light-blue';
} else {
    // Default styles for guests
    $borderColor = 'border-gray-500';
    $hoverBorderColor = 'hover:border-gray-400';
    $textColor = 'text-gray-900';
    $hoverTextColor = 'hover:text-gray-600';
}

$classes = ($active ?? false)
            ? "inline-flex items-center pb-3 mb-2 border-b-4 $borderColor $hoverTextColor font-medium leading-5 $textColor focus:outline-none transition duration-150 ease-in-out relative after:absolute after:content-[''] after:w-full after:h-0.5 after:bg-current after:left-0 after:-bottom-0.5 hover:after:scale-x-100 after:scale-x-0 after:transition after:duration-300"
            : "inline-flex items-center pb-3 mb-2 border-b-2 border-transparent  font-medium leading-5 text-gray-800 $hoverBorderColor $hoverTextColor $textColor focus:outline-none focus:text-gray-500 transition duration-150 ease-in-out relative after:absolute after:content-[''] after:w-full after:h-0.5 after:bg-current after:left-0 after:-bottom-0.5 hover:after:scale-x-100 after:scale-x-0 after:transition after:duration-300";
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a> --}}
