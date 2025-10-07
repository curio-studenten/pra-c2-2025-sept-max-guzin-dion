<x-layouts.app>

<!-- Taalwissel knop -->
<div style="margin-bottom:20px;">
    <button id="toggleLanguage" style="padding:8px 16px; background-color:#4CAF50; color:white; border:none; border-radius:4px; cursor:pointer;">
        {{ session('locale', app()->getLocale()) == 'nl' ? 'NL' : 'EN' }}
    </button>
</div>

<x-slot:introduction_text>
    <p>{{ __('introduction_texts.homepage_line_1') }}</p>
    <p>{{ __('introduction_texts.homepage_line_2') }}</p>
    <p>{{ __('introduction_texts.homepage_line_3') }}</p>
</x-slot:introduction_text>

<h1>{{ __('misc.all_brands') }}</h1>

@php
    $topManuals = $manuals->take(10);
    $otherManuals = $manuals->slice(10);

    $size = count($brands);
    $columns = 4;
    $chunk_size = ceil($size / $columns);
@endphp

<div class="container">

    <!-- MERKEN ALFABETISCH GRID (boven handleidingen) -->
    <h2>Alle merken</h2>
    <div class="grid grid-cols-4 gap-4 mb-8">
        @foreach($brands->chunk($chunk_size) as $chunk)
            <div class="flex flex-col">
                @php $header_first_letter = null; @endphp
                @foreach($chunk as $brand)
                    @php $current_first_letter = strtoupper(substr($brand->name, 0, 1)); @endphp
                    @if($header_first_letter !== $current_first_letter)
                        @if($header_first_letter) </ul> @endif
                        <h3>{{ $current_first_letter }}</h3>
                        <ul style="list-style:none; padding-left:0;">
                    @endif
                    <li>
                        <a href="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/">{{ $brand->name }}</a>
                    </li>
                    @php $header_first_letter = $current_first_letter; @endphp
                @endforeach
                </ul>
            </div>
        @endforeach
    </div>

    <!-- TOP 10 POPULAIRE HANDLEIDINGEN -->
    <h2>Top 10 populairste handleidingen</h2>
    <div style="display:grid; grid-template-columns: repeat(2, 1fr); gap:10px; margin-bottom:20px;">
        @foreach($topManuals as $manual)
            <div style="border:1px solid #4CAF50; padding:10px; border-radius:4px; background:#e8f5e9;">
                <strong>{{ $manual->brand ? $manual->brand->name : 'Onbekend merk' }}</strong><br>
                {{ $manual->type }}<br>
                <span style="color:red; font-weight:bold;">{{ $manual->visitor_count }} bezoekers</span>
            </div>
        @endforeach
    </div>

    <hr style="margin:30px 0; border-top:2px solid #ccc;">

    <!-- ALLE HANDLEIDINGEN IN GRID -->
    <h2>Alle handleidingen</h2>
    <div style="display:grid; grid-template-columns: repeat(4, 1fr); gap:15px;">
        @foreach($otherManuals as $manual)
            <div style="border:1px solid #ddd; padding:10px; border-radius:4px; background:#fafafa;">
                <strong>{{ $manual->brand ? $manual->brand->name : 'Onbekend merk' }}</strong><br>
                {{ $manual->type }}<br>
                <span style="color:red; font-weight:bold;">{{ $manual->visitor_count }} bezoekers</span>
            </div>
        @endforeach
    </div>

    <p class="mt-4">
        <a href="{{ route('categories') }}" style="font-weight:bold; font-size:18px;">
            {{ __('categories.overview') }}
        </a>
    </p>
</div>

</x-layouts.app>

<script>
let button = document.getElementById('toggleLanguage');
button.addEventListener('click', function() {
    let newLang = button.innerText.toLowerCase() === 'nl' ? 'en' : 'nl';
    window.location.href = '/language/' + newLang;
});
</script>
