<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">Team221</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
            </li>
            @can('admin')
            <li class="nav-item">
            <a class="nav-link" href="{{ route('user.index') }}">ユーザー一覧</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="{{ route('item.create') }}">商品登録</a>
            </li>
            @endcan
            <li class="nav-item">
            <a class="nav-link" href="{{ route('search.index') }}">商品一覧</a>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{ Auth::user()->name.'様' }}
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('profile',auth()->user()->id) }}">マイページ</a></li>
                <li><a class="dropdown-item" href="{{ route('logout') }}">ログアウト</a></li>
            </ul>
            </li>
        </ul>
        </div>
        </div>
    </nav>