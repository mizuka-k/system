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
                <form class="col-4 mx-auto p-3" method="POST" action="{{ route('profileUpdate', $auth->id) }}">
                    @csrf
                    @method('patch')
                    <!-- 名前 -->
                    <div class="m-auto">
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
                    <!-- メールアドレス -->
                    <div class="m-auto">
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
                    <!-- パスワード -->
                    <div class="mb-1">
                        <div>
                            <label for="current_password" class="col-form-label">現在のパスワード</label>
                            <div class="position-relative p-1 rounded bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <input class="form-control p-1 rounded bg-gray-50 border border-0 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                                        type="password" 
                                        id="password"
                                        name="current_password"
                                        placeholder="******">
                                <i id="eye1" class="fa-regular fa-eye toggle-eye position-absolute translate-middle top-50 end-0"></i>
                            </div>
                        </div>
                        <div>
                            <label for="password" class="col-form-label">新しいパスワード</label>
                            <div class="position-relative p-1 rounded bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <input class="form-control p-1 rounded bg-gray-50 border border-0 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                                        type="password" 
                                        id="password2" 
                                        name="password"
                                        placeholder="******">
                                <i id="eye2" class="fa-regular fa-eye toggle-eye position-absolute translate-middle top-50 end-0"></i>
                            </div>
                        </div>
                        @error('password')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div>
                            <label for="password" class="col-form-label">新しいパスワード(確認)</label>
                            <div class="position-relative p-1 rounded bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <input class="form-control p-1 rounded bg-gray-50 border border-0 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                                        type="password"
                                        id="password3"
                                        name="password_confirmation"
                                        placeholder="******">
                                <i id="eye3" class="fa-regular fa-eye toggle-eye position-absolute translate-middle top-50 end-0"></i>
                            </div>
                        </div>
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="mt-4 btn btn-primary">編集する</button>
                        </div>
                        <div class="d-flex justify-content-center mt-2">
                            <a href="{{ route('profile','$auth->id') }}"><button class="btn btn-secondary" type="button">戻る</button></a>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script> -->
    <script src="{{ asset('js/password.js') }}"></script>
    @endsection
</x-app>