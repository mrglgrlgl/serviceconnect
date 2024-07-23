@props(['active'])

@php
$user = Auth::user();
if ($user) {
    $borderColor = $user->role == '3' ? 'border-custom-lightest-blue' : 'border-custom-light-blue';
    $hoverBorderColor = $user->role == '3' ? 'hover:border-custom-lightestblue-accent' : 'hover:border-custom-light-blue';
    $hoverTextColor = $user->role == '3' ? 'hover:text-cyan-600' : 'hover:border-custom-light-blue';
    $textColor = $user->role == '3' ? 'text-custom-lightest-blue' : 'text-custom-light-blue';
} else {
    // Default styles for guests
    $borderColor = 'border-gray-500';
    $hoverBorderColor = 'hover:border-gray-400';
    $textColor = 'text-gray-900';
    $hoverTextColor = 'hover:text-gray-600';
}

$classes = ($active ?? false)
            ? "inline-flex items-center px-2 pt-1 border-b-4 $borderColor $hoverTextColor text-lg font-medium leading-5 $textColor focus:outline-none transition duration-150 ease-in-out relative after:absolute after:content-[''] after:w-full after:h-0.5 after:bg-current after:left-0 after:-bottom-1 hover:after:scale-x-100 after:scale-x-0 after:transition after:duration-300"
            : "inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-lg font-medium leading-5 text-gray-800 $hoverBorderColor $hoverTextColor $textColor focus:outline-none focus:text-gray-500 transition duration-150 ease-in-out relative after:absolute after:content-[''] after:w-full after:h-0.5 after:bg-current after:left-0 after:-bottom-1 hover:after:scale-x-100 after:scale-x-0 after:transition after:duration-300";
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>