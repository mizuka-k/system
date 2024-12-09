<x-app>
<x-slot name="title">
    ログイン画面
</x-slot>
@section('contents')
<div class="container d-flex justify-content-center">
        <div class="wrapper w-75 mb-4">
            <div class="m-4 pt-4 ">
                <h1 class="text-center">商品管理システム</h1>
            </div>
            @if(session('alertMessage'))
                <div class="mt-4 alert alert-danger" role="alert">
                    {{ session('alertMessage')}}
                </div>
            @elseif(session('successMessage'))
                <div class="mt-4 alert alert-success" role="alert">
                    {{ session('successMessage' )}}
                </div>
            @endif

            <div class="row">
                <form class="col-5 mx-auto p-3" method="POST" action="{{ route('authenticate') }}">
                    @csrf
                    <!-- メールアドレス -->
                    <div>
                        <label for="email" class="col-form-label">メールアドレス</label>
                        <input class="form-control p-1 rounded bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                type="text" 
                                name="email" 
                                value="{{old('email')}}">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <!-- パスワード -->
                    <div>
                        <label for="password" class="col-form-label">パスワード</label>
                        <div class="position-relative p-1 rounded bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <input class="form-control p-1 rounded bg-gray-50 border border-0 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                                    type="password" 
                                    name="password"
                                    id="password">
                            <i id="eye1" class="fa-regular fa-eye toggle-eye position-absolute translate-middle top-50 end-0"></i>
                        </div>

                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="mt-3 btn btn-primary">ログイン</button>
                    </div>
                </form>
                <div class="d-flex justify-content-center">
                    <a class="mt-2 text-secondary" href="{{ route('register') }}">会員登録がまだの方はこちら</a>
                </div>
                <div class="d-flex justify-content-center mt-2">
                    <a class="mt-2 text-secondary" href="{{ route('password.request') }}">パスワードをお忘れの方はこちら</a>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/password.js') }}"></script>
    @endsection
</x-app>