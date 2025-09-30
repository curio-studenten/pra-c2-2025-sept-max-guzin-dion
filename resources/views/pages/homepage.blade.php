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

<?php
$size = count($brands);
$columns = 4;
$chunk_size = ceil($size / $columns);
?>

<div class="container">
    <div style="display: flex; flex-direction: row;">
        @foreach($brands->chunk($chunk_size) as $chunk)
            @foreach($chunk as $brand)
                <?php
                $current_first_letter = strtoupper(substr($brand->name, 0, 1));
                if (!isset($header_first_letter) || $current_first_letter != $header_first_letter) {
                    echo '<a href="#">' . $current_first_letter . '</a>';
                }
                $header_first_letter = $current_first_letter;
                ?>
            @endforeach
        @endforeach
    </div>

    <div class="grid grid-cols-4 grid-rows-2">
        @foreach($brands->chunk($chunk_size) as $chunk)
            <div class="flex flex-column">        
                @foreach($chunk as $brand)
                    <?php
                    $current_first_letter = strtoupper(substr($brand->name, 0, 1));
                    if (!isset($header_first_letter) || $current_first_letter != $header_first_letter) {
                        echo '</ul><h2>' . $current_first_letter . '</h2><ul>';
                    }
                    $header_first_letter = $current_first_letter;
                    ?>
                    <a href="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/">
                        <li>{{ $brand->name }}</li>
                    </a>
                @endforeach
            </div>
            <?php unset($header_first_letter); ?>
        @endforeach
    </div>
</div>

<p>
    <a href="{{ route('categories') }}" style="font-weight:bold; font-size:18px;">
        {{ __('categories.overview') }}
    </a>

</p>

</x-layouts.app>

<script>
let button = document.getElementById('toggleLanguage');
button.addEventListener('click', function() {
    let newLang = button.innerText.toLowerCase() === 'nl' ? 'en' : 'nl';
    window.location.href = '/language/' + newLang;
});
</script>
