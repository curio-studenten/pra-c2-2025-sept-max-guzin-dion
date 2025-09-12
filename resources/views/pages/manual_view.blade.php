<x-layouts.app>

    <x-slot:head>
        <meta name="robots" content="index, nofollow">
    </x-slot:head>

    <x-slot:breadcrumb>
        <li><a href="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/" alt="Manuals for '{{$brand->name}}'" title="Manuals for '{{$brand->name}}'">{{ $brand->name }}</a></li>
        <li><a href="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/{{ $manual->id }}/" alt="View manual for '{{$brand->name}} {{ $manual->name }}'" title="View manual for '{{$brand->name}} {{ $manual->name }}'">{{ $manual->name }}</a></li>
    </x-slot:breadcrumb>

    <h1>{{ $brand->name }} - {{ $manual->name }}</h1>
    
    <div class="manual-info">
        <p><strong>File size:</strong> {{ $manual->filesize_human_readable }}</p>
        <p><strong>Views:</strong> <span id="visitor-count">{{ $manual->visitor_count }}</span></p>
    </div>

    @if ($manual->locally_available)
        <iframe src="{{ $manual->url }}" width="780" height="600" frameborder="0" marginheight="0" marginwidth="0">
        Iframes are not supported<br />
        <a href="{{ $manual->url }}" target="_blank" alt="Download your manual here" title="Download your manual here" class="manual-download-link" data-manual-id="{{ $manual->id }}">Click here to download the manual</a>
        </iframe>
    @else
        <a href="{{ $manual->url }}" target="_blank" alt="Download your manual here" title="Download your manual here" class="manual-download-link" data-manual-id="{{ $manual->id }}">Click here to download the manual</a>
    @endif

    <script>
        // Optional: Track additional clicks on the download link
        document.addEventListener('DOMContentLoaded', function() {
            const downloadLinks = document.querySelectorAll('.manual-download-link');
            
            downloadLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    const manualId = this.getAttribute('data-manual-id');
                    
                    // Send AJAX request to increment count
                    fetch(`/api/manual/${manualId}/increment-count`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Update the visitor count display
                            const countElement = document.getElementById('visitor-count');
                            if (countElement) {
                                countElement.textContent = data.visitors_count;
                            }
                        }
                    })
                    .catch(error => console.log('Error updating count:', error));
                });
            });
        });
    </script>

</x-layouts.app>
