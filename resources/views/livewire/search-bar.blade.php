<div>
    <div class="apple-search-wrap">

        {{-- Language Globe --}}
        <div class="apple-search-locale">
            <div class="dropdown">
                <button class="apple-locale-btn" id="localeDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Language">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/>
                        <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
                    </svg>
                </button>
                <div class="dropdown-menu apple-locale-menu" aria-labelledby="localeDropdown">
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <a class="apple-locale-item" rel="alternate" hreflang="{{ $localeCode }}"
                           href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {{ $properties['native'] }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Search field --}}
        <div class="apple-search-field">
            {{-- Search icon inside input --}}
            <svg class="apple-search-icon" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
            </svg>
            <input
                id="apple-search-input"
                type="text"
                wire:keydown.enter="searchGo"
                wire:model.debounce.300ms="searchContent"
                wire:keydown.debounce.300ms="search"
                placeholder="Search products…"
                autocomplete="off"
            />
            {{-- Clear button, shown when there's text --}}
            @if($searchContent)
            <button class="apple-search-clear" wire:click="$set('searchContent', '')" title="Clear">
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                </svg>
            </button>
            @endif
        </div>

        {{-- Results dropdown --}}
        @if ($products)
        <div class="apple-search-results">
            @foreach ($products as $result)
            <a href="{{ route('product.details', $result->name) }}" class="apple-search-result-item">
                {{-- Search icon prefix (Spotlight style) --}}
                <svg class="apple-result-icon" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <span class="apple-result-name">{{ $result->name }}</span>
                <span class="apple-result-meta">
                    <span class="apple-result-category">{{ $result->category_name }}</span>
                    <span class="apple-result-price">{{ $result->price }} {{ $store['site_currency']->payload ?? 'DA' }}</span>
                </span>
            </a>
            @endforeach
        </div>
        @endif

    </div>
</div>