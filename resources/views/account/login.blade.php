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
            @if($errors->any())
            <!-- <div class="alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li class="text-danger">{{ $error }}</li>
                    @endforeach
                </ul>
            </div> -->
            @endif 
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
                        <input class="form-control p-1 rounded bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                                type="password" 
                                name="password">
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
            </div>
        </div>
    </div>
    @endsection
</x-app>