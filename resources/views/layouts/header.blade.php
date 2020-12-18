<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand mb-0 h1 mx-4" href="{{ route('web.home.index') }}">
            {{ config('app.name', 'PrivBin') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link btn btn-sm btn-dark" aria-current="page" href="{{ route('web.home.index') }}">
                        {{ __('privbin.new') }}
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                @if (isset($expire) && $expire == true)
                    <li class="nav-item dropdown dropdown-hover">
                        <a class="nav-link btn btn-sm btn-dark expires-text" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ __('privbin.expires') }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark mt-3 expires-selector" aria-labelledby="navbarDropdown">
                            @foreach(\App\Enums\Expire::asArray() as $expire)
                                <li>
                                    <a class="dropdown-item expires-item" data-selected data-value="{{ $expire }}" href="#">
                                        {{ __('privbin.expire_after_'.$expire) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
