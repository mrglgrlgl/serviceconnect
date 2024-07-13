@props(['category'])

@php
    $icon = '';
    switch (strtolower($category)) {
        case 'carpentry':
            $icon = 'construction';
            break;
        case 'plumbing':
            $icon = 'plumbing';
            break;
        case 'cooking':
            $icon = 'restaurant';
            break;
        default:
            $icon = 'category'; // Default icon if the category does not match any case
    }
@endphp

<div class="category-icon flex items-center space-x-2">
    <span class="material-icons text-custom-light-blue text-5xl">{{ $icon }}</span>
    <span class="font-semibold text-xl text-custom-header">{{ ucfirst($category) }}</span>
</div>