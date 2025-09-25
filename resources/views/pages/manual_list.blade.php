<x-layouts.app>

    <x-slot:head>
        <meta name="robots" content="index, nofollow">
    </x-slot:head>
    

    <x-slot:breadcrumb>
        <li><a href="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/" alt="Manuals for '{{$brand->name}}'" title="Manuals for '{{$brand->name}}'">{{ $brand->name }}</a></li>
    </x-slot:breadcrumb>


    <h1>{{ $brand->name }}</h1>

    <p>{{ __('introduction_texts.type_list', ['brand'=>$brand->name]) }}</p>


        @foreach ($manuals as $manual)
            @php
                $manualUrl = '/' . $brand->id . '/' . $brand->getNameUrlEncodedAttribute() . '/' . $manual->id . '/';
            @endphp
            <a href="{{ $manualUrl }}" alt="{{ $manual->name }}" title="{{ $manual->name }}" style="background-color: coral; color: white; padding: 6px; border-radius: 20px;">{{ $manual->name }}</a>
            ({{$manual->filesize_human_readable}})
            <!-- Debug: URL = {{ $manualUrl }} -->
            <br />
            <br />
        @endforeach

</x-layouts.app>
