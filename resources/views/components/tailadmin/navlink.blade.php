@props(['href', 'icon' => null, 'active' => request()->fullUrlIs(url($href))])

<li class="mb-1 group {{ $active ? 'active' : '' }}">
    <a href="{{ $href }}"
        {{ $attributes->merge([
            'class' =>
                'flex items-center py-2 px-4 text-gray-300 hover:bg-gray-950 hover:text-gray-100 rounded-md ' .
                ($active ? 'bg-gray-800 text-white' : 'group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100'),
        ]) }}>
        @if ($icon)
            <i class="mr-3 text-lg {{ $icon }}"></i>
        @endif
        <span class="text-sm">{{ $slot }}</span>
    </a>
</li>
