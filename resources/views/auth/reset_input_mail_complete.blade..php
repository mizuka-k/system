<x-app>
    <x-slot name="title">
        メール送信完了
    </x-slot>
    @section('contents')
    <main class="container">
        <h2 class="mt-4">メール送信完了</h2>
        <p>パスワード再設定用のメールを送信しました</p>
        <p>メールに記載されているリンクからパスワードの再設定を行ってください</p>
            <div class="d-flex justify-content-start">
                <a class="text-secondary mt-2" href="{{ route('login') }}">ログイン画面へ戻る</a>
            </div>
    </main>
@endsection
</x-app>