<x-app>
    <x-slot name="title">
        パスワード変更完了
    </x-slot>
    @section('contents')
    <main>
        <h2>パスワード変更完了</h2>
        <div>
            <p>パスワードの変更が完了しました。</p>
            <p>新しいパスワードにて再ログインしてください</p>
        </div>
        <div>
            <a href="{{ route('login') }}">ログイン画面へ戻る</a>
        </div>
    </main>
    @endsection
</x-app>