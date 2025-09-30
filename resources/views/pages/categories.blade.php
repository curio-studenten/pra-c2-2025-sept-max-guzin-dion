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

    <h1>{{ __('category.overview') }}</h1>

    @foreach($categories as $category)
        <h2>{{ $category->name }}</h2>
        <ul>
            @foreach($category->brands as $brand)
                <li>{{ $brand->name }}
                    @if($brand->models->count())
                        <ul>
                            @foreach($brand->models as $model)
                                <li>{{ $model->name }}</li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    @endforeach

</x-layouts.app>

<script>
    let button = document.getElementById('toggleLanguage');
    button.addEventListener('click', function() {
        let newLang = button.innerText.toLowerCase() === 'nl' ? 'en' : 'nl';
        window.location.href = '/language/' + newLang;
    });
</script>
