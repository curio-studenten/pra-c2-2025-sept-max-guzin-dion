<x-layouts.app>

    <x-slot:introduction_text>
        <p><img src="img/afbl_logo.png" align="right" width="100" height="100">{{ __('introduction_texts.homepage_line_1') }}</p>
        <p>{{ __('introduction_texts.homepage_line_2') }}</p>
        <p>{{ __('introduction_texts.homepage_line_3') }}</p>
    </x-slot:introduction_text>

    <!-- Top 10 Brands -->
    <h2 class="text-center mt-4">Top 10 Brands by Visitors</h2>
    <div class="container mb-5">
        <ul class="list-disc list-inside">
            @foreach($topBrands as $brand)
                <li>
                    <a href="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/">
                        {{ $brand->name_manual }} ({{ $brand->visitors_count }} visitors)
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Existing Alphabetical Grid -->
    <h1>
        <x-slot:title>
            {{ __('misc.all_brands') }}
        </x-slot:title>
    </h1>

    <?php
    $size = count($brands);
    $columns = 4;
    $chunk_size = ceil($size / $columns);
    ?>

    <style>
        .grid{
            background-color: #e9ecef;
        }
    </style>

    <div class="container">
        <div class="grid">
            <div class="grid grid-cols-4 grid-rows-2">
                @foreach($brands->chunk($chunk_size) as $chunk)
                    <div class="flex flex-column">        
                        @foreach($chunk as $brand)
                            <?php
                            $current_first_letter = strtoupper(substr($brand->name_manual, 0, 1));

                            if (!isset($header_first_letter) || (isset($header_first_letter) && $current_first_letter != $header_first_letter)) {
                                echo '</ul>
                                <h2>' . $current_first_letter . '</h2>
                                <ul>';
                            }
                            $header_first_letter = $current_first_letter;
                            ?>

                            <a href="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/">
                                <li>{{ $brand->name_manual }}</li>
                            </a>
                        @endforeach
                    </div>
                    <?php unset($header_first_letter); ?>
                @endforeach
            </div>
        </div>
    </div>

</x-layouts.app>
