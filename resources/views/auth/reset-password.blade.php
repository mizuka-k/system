<x-app>

<x-slot name="title">
パスワード再設定画面
</x-slot>
@section('contents')

<div class="container">
        <div class="wrapper">
            <div class="mt-4 mb-4 pt-4">
                <h1 class="text-center pt-4 mt-4">パスワード再設定</h1>
            </div>
            @if(session('alertMessage'))
                <div class="alert alert-danger" role="alert">
                    {{ session('alertMessage')}}
                </div>
            @endif
            <div class="row">
                <form class="col-5 mx-auto p-3" method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name=token value="{{ $token }}">
                    @error('token')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <!-- メールアドレス -->
                    <div>
                        <label for="email" class="col-form-label">メールアドレス</label><span class="ms-2 badge text-bg-danger">必須</span>
                        <input class="form-control p-1 rounded bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                        type="text" 
                        id="email" 
                        name="email" 
                        value="{{ old('email')}}">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- パスワード -->
                    <div class="mb-1">
                        <label for="password" class="col-form-label">パスワード</label><span class="ms-2 badge text-bg-danger">必須</span>
                        <div class="pass_box position-relative p-1 rounded bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <input class="form-control p-1 border border-0 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                            type="password" 
                            name="password"
                            id="password">
                            <i id="eye1" class="fa-regular fa-eye toggle-eye position-absolute translate-middle top-50 end-0"></i>
                        </div>
                        <small id="passwordHelp" class="ms-2 form-text text-muted">パスワードは6字以上で入力してください。</small>
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- パスワード確認 -->
                    <div>
                        <label for="password_confirmation" class="col-form-label">パスワード(確認)</label><span class="ms-2 badge text-bg-danger">必須</span>
                        <div class="position-relative p-1 rounded bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <input class="form-control p-1  border border-0 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                            type="password"
                            name="password_confirmation"
                            id="password2">
                            <i id="eye2" class="fa-regular fa-eye toggle-eye position-absolute translate-middle top-50 end-0"></i>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="mt-4 btn btn-primary">パスワードを更新する</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/password.js') }}"></script>
@endsection

</x-app>
