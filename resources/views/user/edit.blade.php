<x-app>
<x-slot name="title">
    ユーザー情報編集画面
</x-slot>
@section('contents')
<x-navigation></x-navigation>

<div class="container row">
    <div class="wrapper">
        <h2 class="text-center section-title pt-4 mt-4">ユーザー情報編集</h2>
        @if(session('alertMessage'))
            <div class="alert alert-danger" role="alert">
                {{ session('alertMessage')}}
            </div>
        @endif
        <div class="row">
            <form  class="col-5 mx-auto p-3" method="POST" action="{{ route('user.update',$user) }}" onSubmit="return checkSubmit()">
            @csrf
            @method('patch')
                <div class="form-list">
                    <label for="id">ユーザーID</label>
                    <input class="form-control border border-0" type="text" name="id" value="{{ $user->id }}" readonly>
                </div>
                <div class="form-list">
                    <label for="name">名前</label>
                        <input 
                            type="text"
                            id="name"
                            name="name"
                            value="{{ $user->name }}"
                            class="form-control">
                </div>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="form-list">
                    <label for="email">メールアドレス</label>
                    <input 
                        type="text"
                        id="email"
                        name="email"
                        value="{{ $user->email }}"
                        class="form-control">
                </div>
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="form-check-inline ">
                <div class="d-flex flex-row ">
                    <label for="role" class="col-form-label">現在のステータス：</label>
                        @if($user->role == 0)
                        <div class="m-2">一般</div>
                        @elseif($user->role == 1)
                        <div class="m-2">管理者</div>
                        @endif        
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="general" name="role" value="0" {{ old ('general', $user->role) == '0' ? 'checked' : '' }}>
                    <label class="form-check-label" for="general">管理者権限を外す</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="admin" name="role" value="1" {{ old ('admin', $user->role) == '1' ? 'checked' : '' }}>
                    <label class="form-check-label" for="admin">管理者権限を付与する</label>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    <button type="submit" class="btn btn-primary">編集</button>
                </div>
            </form>
            <div class="d-flex justify-content-center mt-2">
                <a href="{{ route('user.index',$user) }}"><button type="button" class="btn btn-secondary">戻る</button></a>
            </div>
            </div>
        </div>
</div>
<script src="{{ asset('js/delete.js') }}"></script>
@endsection
</x-app>