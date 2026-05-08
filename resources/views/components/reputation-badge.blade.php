@props(['user'])

{{-- Reusable reputation badge. Pass in any $user and it will display their tier + point total.
    < 6 pts = New Contributor, 7–15 = Seasoned Vet, >15 = Trusted Advisor
     Usage: <x-reputation-badge :user="$answer->user" /> --}}

@php
    $colour = $user->reputationBadgeColour();
    $colours = [
        'green' => 'bg-green-100 text-green-800 border border-green-300',
        'blue'  => 'bg-blue-100 text-blue-800 border border-blue-300',
        'gray'  => 'bg-gray-100 text-gray-600 border border-gray-300',
    ];
    $icons = [
        'green' => '🏅',
        'blue'  => '⭐',
        'gray'  => '🌱',
    ];
@endphp

<span class="inline-flex items-center gap-1 rounded-full px-2.5 py-0.5 text-xs font-medium
             {{ $colours[$colour] }}">
    {{ $icons[$colour] }}
    {{ $user->reputationTier() }}
    <span class="opacity-60 font-normal">({{ $user->reputation_points }} pts)</span>
</span>
