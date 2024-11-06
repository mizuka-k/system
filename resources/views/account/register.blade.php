<x-app>
<x-slot name="title">
    会員登録画面
</x-slot>
@section('contents')
<div class="container">
        <div class="wrapper">
            <div class="mt-4 mb-4 pt-4">
                <h1 class="text-center pt-4 mt-4">商品管理システム</h1>
            </div>
            @if(session('alertMessage'))
                <div class="alert alert-danger" role="alert">
                    {{ session('alertMessage')}}
                </div>
            @endif
            <div class="row">
                <form class="col-5 mx-auto p-3" method="POST" action="{{ route('accountStore' )}}">
                    @csrf
                    <!-- 名前 -->
                    <div class="mb-1">
                        <label for="name" class="col-form-label">名前</label><span class="ms-2 badge text-bg-danger">必須</span>
                        <input class="form-control p-1 rounded bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name')}}">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
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
                        <input class="form-control p-1 rounded bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                        type="password" 
                        id="password" 
                        name="password">
                        <small id="passwordHelp" class="form-text text-muted">パスワードは6字以上で入力してください。</small>
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- パスワード確認 -->
                    <div>
                        <label for="password_confirmation" class="col-form-label">パスワード(確認)</label><span class="ms-2 badge text-bg-danger">必須</span>
                        <input class="form-control p-1 rounded bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" type="password"  
                        name="password_confirmation">
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="mt-4 btn btn-primary">登録する</button>
                    </div>
                </form>
                <div class="d-flex justify-content-center">
                    <a class="mt-2 text-secondary" href="{{ route('login') }}">ログイン</a>
                </div>
            </div>
        </div>
    </div>
@endsection
</x-app>