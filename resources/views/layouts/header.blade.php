<button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar"
    data-class="c-sidebar-show">
    <i class="bi bi-list" style="font-size: 2rem;"></i>
</button>

<button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar"
    data-class="c-sidebar-lg-show" responsive="true">
    <i class="bi bi-list" style="font-size: 2rem;"></i>
</button>

<ul class="c-header-nav ml-auto">

</ul>
<ul class="c-header-nav ml-auto mr-4">
    @can('create_pos_sales')
    <li class="c-header-nav-item mr-3">
        <a class="btn btn-primary btn-pill {{ request()->routeIs('app.pos.index') ? 'disabled' : '' }}"
            href="{{ route('branch.selector') }}">
            <i class="bi bi-cart mr-1"></i> {{ __('messages.pos') }}
        </a>
    </li>
@endcan
    <div class="dropdown">
        <button class="btn btn-light dropdown-toggle" type="button" id="languageDropdown" data-toggle="dropdown" aria-expanded="false">
            <img src="{{ asset(config('app.available_locales')[app()->getLocale()]['flag']) }}"
                 class="flag-icon"
                 width="24"
                 height="16">
        </button>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
            @foreach(config('app.available_locales') as $locale => $language)
                <li>
                    <a class="dropdown-item d-flex align-items-center {{ app()->getLocale() == $locale ? 'active' : '' }}"
                       href="{{ route('language.switch', $locale) }}">
                        <img src="{{ asset($language['flag']) }}"
                             alt="{{ $language['name'] }}"
                             class="flag-icon me-2 mr-1"
                             width="24"
                             height="16">
                          {{ $language['name'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>


    @can('show_notifications')
        <li class="c-header-nav-item dropdown d-md-down-none mr-2">
            <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                aria-expanded="false">
                <i class="bi bi-bell" style="font-size: 20px;"></i>
                <span class="badge badge-pill badge-danger">
                    @php
                        $low_quantity_products = \Modules\Product\Entities\Product::with('productStock')
                            ->whereHas('productStock', function ($query) {
                                $query->where('quantity', '<', 5);
                            })
                            ->get();
                        echo $low_quantity_products->count();
                    @endphp
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg pt-0">
                <div class="dropdown-header bg-light">
                    <strong>{{ $low_quantity_products->count() }} Notifications</strong>
                </div>
                <div style="max-height: 300px; overflow-y: auto;">
                    @forelse($low_quantity_products as $product)
                        <a class="dropdown-item" href="{{ route('products.show', $product->id) }}">
                            <i class="bi bi-hash mr-1 text-primary"></i> Product: "{{ $product->product_name }}" Stock is
                            low! (Current: {{ $product->productStock->quantity }})
                        </a>
                    @empty
                        <a class="dropdown-item" href="#">
                            <i class="bi bi-app-indicator mr-2 text-danger"></i> No notifications available.
                        </a>
                    @endforelse
                </div>
            </div>
        </li>
    @endcan

    <li class="c-header-nav-item dropdown">
        <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
            aria-expanded="false">
            <div class="c-avatar mr-2">
                @if (auth()->user()->hasMedia('avatars'))
                    <img class="c-avatar rounded-circle" src="{{ auth()->user()->getFirstMediaUrl('avatars') }}"
                        alt="Profile Image">
                @else
                    <img class="c-avatar rounded-circle" src="{{ asset('images/fallback_profile_image.png') }}"
                        alt="No Image">
                @endif
            </div>
            <div class="d-flex flex-column">
                <span class="font-weight-bold">{{ auth()->user()->name }}</span>
                <span class="font-italic">Online <i class="bi bi-circle-fill text-success"
                        style="font-size: 11px;"></i></span>
            </div>
        </a>
        <div class="dropdown-menu dropdown-menu-right pt-0">
            <div class="dropdown-header bg-light py-2"><strong>Account</strong></div>
            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                <i class="mfe-2  bi bi-person" style="font-size: 1.2rem;"></i> Profile
            </a>
            <a class="dropdown-item" href="#"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="mfe-2  bi bi-box-arrow-left" style="font-size: 1.2rem;"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </li>
</ul>
