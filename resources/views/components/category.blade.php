@props(['category'])

@php
    $icon = '';
    switch (strtolower($category)) {
        case 'carpentry':
            $icon = 'handyman'; // Correct icon name for carpentry
            break;
        case 'plumbing':
            $icon = 'plumbing';
            break;
        case 'welding':
            $icon = 'hardware'; // Adjusted icon name
            break;
        case 'building and related':
            $icon = 'construction';
            break;
        case 'electrical':
            $icon = 'bolt';
            break;
        case 'food service':
            $icon = 'restaurant';
            break;
        case 'bus driving':
            $icon = 'airport_shuttle'; // Adjusted icon name
            break;
        case 'stone cutting and masonry':
            $icon = 'content_cut'; // Adjusted icon name
            break;
        case 'hairdressing':
            $icon = 'spa';
            break;
        case 'beauty therapy':
            $icon = 'spa';
            break;
        default:
            $icon = 'category'; // Default icon if the category does not match any case
    }
@endphp

<div class="category-icon flex items-center space-x-2">
    <span class="material-icons text-custom-light-blue text-4xl">{{ $icon }}</span>
    <span class="font-semibold text-xl text-custom-header">{{ ucfirst($category) }}</span>
</div>