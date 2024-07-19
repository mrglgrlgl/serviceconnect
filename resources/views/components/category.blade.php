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
        case 'building_related':
            $icon = 'construction';
            break;
        case 'electrical':
            $icon = 'bolt';
            break;
        case 'food_service':
            $icon = 'restaurant';
            break;
        case 'stone_cutting_masonry':
            $icon = 'foundation'; // Adjusted icon name
            break;
        case 'hairdressing':
            $icon = 'content_cut'; // Adjusted icon name
            break;
        case 'beauty_therapy':
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