@props(['category'])

@php
    $icon = '';
    switch (strtolower($category)) {
        case 'carpentry':
            $icon = 'handyman';
            break;
        case 'plumbing':
            $icon = 'plumbing';
            break;
        case 'welding':
            $icon = 'hardware';
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
            $icon = 'airport_shuttle';
            break;
        case 'stone cutting and masonry':
            $icon = 'content_cut';
            break;
        case 'hairdressing':
            $icon = 'spa';
            break;
        case 'beauty therapy':
            $icon = 'spa';
            break;
        default:
            $icon = 'category';
    }

    $user = Auth::user();
    $textColor = 'text-custom-light-blue';
    if ($user && $user->role == '3') {
        $textColor = 'text-custom-lightest-blue';
    }
@endphp

<div class="category-icon flex items-center space-x-2">
    <span class="material-icons {{ $textColor }} text-4xl">{{ $icon }}</span>
    <span class="font-semibold text-xl text-custom-header">{{ ucfirst($category) }}</span>
</div>
