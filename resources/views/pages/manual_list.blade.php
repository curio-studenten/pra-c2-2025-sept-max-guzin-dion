<x-layouts.app>
    <div class="container" style="padding:20px;">
        <h1 style="color:#2E7D32;">Handleidingen van {{ $brand->name }}</h1>

        @if($manuals->isEmpty())
            <p>Er zijn nog geen handleidingen voor dit merk.</p>
        @else
            <h2 style="margin-top:20px;">Alle handleidingen</h2>
            <div style="display:grid; grid-template-columns: repeat(3, 1fr); gap:15px;">
                @foreach($manuals as $manual)
                    <div style="border:1px solid #ccc; padding:10px; border-radius:6px; background:#f9f9f9;">
                        <h3 style="margin-bottom:5px;">{{ $manual->type }}</h3>
                        <p>
                            <strong>Bezoekers:</strong>
                            {{ $manual->visitor_count ?? 0 }}
                        </p>
                        <a href="/{{ $brand->id }}/{{ urlencode($brand->name) }}/{{ $manual->id }}/" 
                           style="display:inline-block; background:#4CAF50; color:white; padding:6px 12px; border-radius:4px; text-decoration:none;">
                            Bekijk handleiding
                        </a>
                    </div>
                @endforeach
            </div>
        @endif

        <div style="margin-top:30px;">
            <a href="/" style="color:#2E7D32; text-decoration:none;">← Terug naar home</a>
        </div>
    </div>
</x-layouts.app>
