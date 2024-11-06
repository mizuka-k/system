<x-app>
    <x-slot name="title">
        ユーザー情報編集画面
    </x-slot>
    @section('contents')
    <div class="container">
        <div class="wrapper">
            <div class="mt-4 mb-4 pt-4">
                <h3 class="text-center pt-4 mt-4">ユーザー情報編集</h3>
            </div>
            @if(session('alertMessage'))
                <div class="alert alert-danger" role="alert">
                    {{ session('alertMessage')}}
                </div>
            @endif
            <div class="row">
                <form class="col-5 mx-auto p-3" method="POST" action="{{ route('profileUpdate', $auth->id) }}">
                    @csrf
                    @method('patch')
                    <input type="hidden" name="page" value="{{ $page }}">

                    @if($page == 'name')
                    <!-- 名前 -->
                    <div class="w-75 m-auto">
                        <div class="mb-1">
                            <label for="name" class="col-form-label">名前</label>
                            <input class="form-control p-1 rounded bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                            type="text" 
                            id="name" 
                            name="name" 
                            value="{{ $auth->name }}">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    @endif

                    @if($page == 'email')
                    <!-- メールアドレス -->
                    <div class="w-75 m-auto">
                        <div class="mb-1">
                            <label for="email" class="col-form-label">メールアドレス</label>
                            <input class="form-control p-1 rounded bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                            type="text" 
                            id="email" 
                            name="email" 
                            value="{{ $auth->email }}">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                        @endif

                        @if($page == 'password')
                    <!-- パスワード -->
                    <div class="mb-1">
                        <div>
                            <label for="current_password" class="col-form-label">現在のパスワード</label>
                            <input class="form-control p-1 rounded bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                            type="password" 
                            id="current_password" 
                            name="current_password">
                        </div>
                        <div>
                            <label for="password" class="col-form-label">新しいパスワード</label>
                            <input class="form-control p-1 rounded bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                            type="password" 
                            id="password" 
                            name="password">
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="password" class="col-form-label">新しいパスワード確認</label>
                            <input class="form-control p-1 rounded bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                            type="password" 
                            id="password_confirmation" 
                            name="password_confirmation">
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        @endif
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="mt-4 btn btn-primary">編集する</button>
                            </div>
                            <div class="d-flex justify-content-center mt-2">
                                <a href="{{ route ('profile','$auth->id') }}"><button class="btn btn-secondary" type="button">戻る</button></a>
                            </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    @endsection
</x-app>