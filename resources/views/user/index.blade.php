<x-app>
    <x-slot name="title">
        ユーザー一覧画面
    </x-slot>
    @section('contents')
    <x-navigation></x-navigation>

    <div class="container">
        <div class="d-flex justify-content-center m-4 p-4">
            <h1 class="fs-2 fw-bold">ユーザー一覧</h1>
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
        <!-- 検索機能 -->
        <div class="mb-3">
            <form method="get" action="{{ route('user.search') }}" class="row" >
                @csrf
                <div class="col-3">
                    <input class="form-control" type="text" name="keyword" value="{{ $keyword ?? '' }}" placeholder="名前で検索">
                </div>
                <div class="col-3">
                    <button type="submit" class="col-auto btn btn-secondary">検索</button>
                </div>
            </form>
        </div>
        <div class="table table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">名前</th>
                        <th scope="col">メールアドレス</th>
                        <th scope="col">登録日時</th>
                        <th scope="col">ステータス</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <thead>
                        <tr class="align-middle">
                            <td>
                                <p class="m-0">{{ $user->id }}</p>
                            </td>
                            <td>
                                <p class="m-0">{{ $user->name }}</p>
                            </td>
                            <td>
                                <p class="m-0">{{ $user->email }}</p>
                            </td>
                            <td>
                                <p class="m-0">{{ $user->created_at }}</p>
                            </td>
                            <td>
                                <p class="m-0">
                                    @if($user->role == 0)
                                    <div>一般</div>
                                    @elseif($user->role == 1)
                                    <div>管理者</div>
                                    @endif
                                </p>
                            </td>
                            <td >
                                <p class="m-0 align-middle">
                                    <a class="link-primary" href="{{ route('user.edit',$user) }}"><button type="button" class="btn btn-outline-info">詳細</button></a>
                                </p>
                            </td>
                            <td>
                                <form method="POST" action="{{ route('user.delete', $user->id) }}">
                                @csrf
                                @method('delete')
                                    <button type="submit"class="btn btn-danger btn-dell" onclick="return confirm('本当に削除しますか？')">削除</button>
                                </form>
                                
                            </td>
                        </tr>
                    </thead>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $users->links('vendor.pagination.bootstrap-4') }}
            </div>
            <div class="d-flex justify-content-center mb-4">
                {{ '全'.$users->total().'件' }}
            </div>
        </div>
</div>
@endsection
</x-app>
