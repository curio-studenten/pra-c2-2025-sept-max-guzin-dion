<x-layouts.app>

<!-- Taalwissel knop -->
<div style="margin-bottom:20px;">
    <button id="toggleLanguage" style="padding:8px 16px; background-color:#4CAF50; color:white; border:none; border-radius:4px; cursor:pointer;">
        {{ session('locale', app()->getLocale()) == 'nl' ? 'NL' : 'EN' }}
    </button>
</div>

<h1>{{ $brand->name }}</h1>

@php
    // Top 5 populaire handleidingen
    $topManuals = $manuals->sortByDesc(fn($m) => $m->visitor_count)->take(5);
    $otherManuals = $manuals->diff($topManuals);
@endphp

<!-- Top 5 populaire handleidingen -->
<h2>Top 5 Populairste Handleidingen</h2>
<div style="display:grid; grid-template-columns: repeat(2, 1fr); gap:10px; margin-bottom:20px;">
    @foreach($topManuals as $manual)
        <div style="border:1px solid #4CAF50; padding:10px; border-radius:4px; background:#e8f5e9;">
            <a href="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/{{ $manual->id }}/">
                {{ $manual->name }}
            </a>
            <br>
            <span style="color:red; font-weight:bold;">{{ $manual->visitor_count }} bezoekers</span>
        </div>
    @endforeach
</div>

<hr style="border-top:2px solid #ccc; margin:20px 0;">

<!-- Alle overige handleidingen van dit merk -->
<h2>Alle Handleidingen</h2>
<div style="display:grid; grid-template-columns: repeat(3, 1fr); gap:15px;">
    @foreach($otherManuals as $manual)
        <div style="border:1px solid #ddd; padding:10px; border-radius:4px; background:#fafafa;">
            <a href="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/{{ $manual->id }}/">
                {{ $manual->name }}
            </a>
            <br>
            <span style="color:red; font-weight:bold;">{{ $manual->visitor_count }} bezoekers</span>
        </div>
    @endforeach
</div>

</x-layouts.app>

<script>
let button = document.getElementById('toggleLanguage');
button.addEventListener('click', function() {
    let newLang = button.innerText.toLowerCase() === 'nl' ? 'en' : 'nl';
    window.location.href = '/language/' + newLang;
});
</script>
