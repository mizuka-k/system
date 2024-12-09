<x-app>
    <x-slot name="title">
        パスワードリセット
    </x-slot>
    @section('contents')
    <main class="container">
        <h2 class="mt-4">パスワード再設定</h2>
        @if(session('successMessage'))
        <div class="alert alert-success" role="alert">
            session('successMessage')
        </div>
        @endif
        <p>ご利用中のメールアドレスを入力してください</p>
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div>
                <label>メールアドレス</label>
                <input class="m-4" type="text" name="email" value="{{ old('email') }}">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="d-flex justify-content-start">
                <button class="btn btn-primary mt-2" type="submit">再設定メールを送信</button>
            </div>
            <div class="d-flex justify-content-start">
                <a class="text-secondary mt-2" href="{{ route('login') }}">戻る</a>
            </div>
        </form>
    </main>
@endsection
</x-app>