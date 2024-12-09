<x-app>
    <x-slot name="title">
        ユーザー一覧画面
    </x-slot>
    @section('contents')

	@if(session('successMessage'))
		<div class="alert alert-success" role="alert">
			{{ session('successMessage') }}
		</div>
	@endif
<div class="container">
	<div class="p-4">
			<p>
				登録したメールアドレスにメールを送信しました。<br>
				URLをクリックしてメールアドレスの認証をしてください。
			</p>
			<p>
				確認メールを紛失した場合は、確認メールを再送するボタンを押してください。
			</p>
			<form method="post" action="{{ route('verification.send') }}">
				@method('post')
				@csrf
				<div class="m-4">
					<button class="btn btn-primary" type="submit">確認メールを再送する</button>
				</div>
			</form>
			
			<div class="m-4">
				<a class="text-secondary" href="/">ログイン画面に戻る</a>
			</div>

	</div>
</div>
@endsection
</x-app>
