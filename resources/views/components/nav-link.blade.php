@props(['active'])

@php
$user = Auth::user();
if ($user) {
    $borderColor = $user->role == '3' ? 'border-custom-lightest-blue' : 'border-custom-yellow';
    $hoverBorderColor = $user->role == '3' ? 'hover:border-custom-lightestblue-accent' : 'hover:border-custom-yellow';
} else {
    // Default styles for guests
    $borderColor = 'border-gray-300';
    $hoverBorderColor = 'hover:border-gray-400';
    $textColor = 'text-gray-300';
    $hoverTextColor = 'hover:text-gray-400';
}


$classes = ($active ?? false)
            ? "inline-flex items-center px-2 pt-1 border-b-4 $borderColor text-lg font-medium leading-5 text-white focus:outline-none transition duration-150 ease-in-out"
            : "inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-lg font-medium leading-5 text-gray-300 hover:text-white $hoverBorderColor focus:outline-none focus:text-gray-300 transition duration-150 ease-in-out";
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>