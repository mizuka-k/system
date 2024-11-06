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
        <div class="table table-responsive">
            <table class="table align-middle">
                <!-- 検索機能 -->
                <form action="{{ route('user.search') }}" method="GET">
                    @csrf
                    <input type="text" name="word">
                    <input type="submit" value="検索">
                </form>
                <form action="{{ route('user.index') }}">
                    <button class="btn btn-light m-2" type="submit" name="sort" value="@if(!isset($sort) || $sort !== '1') 1 @elseif ($sort === '1') 2 @endif">登録日順</button>
                    <button class="btn btn-light" type="submit" name="sort" value="3">あいうえお順</button>
                </form>

                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">名前</th>
                        <th scope="col">メールアドレス</th>
                        <th scope="col">登録日時</th>
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
                            <td >
                                <p class="m-0 align-middle">
                                    <a class="link-primary" href=""><button type="button" class="btn btn-outline-info">詳細</button></a>
                                </p>
                            </td>
                            <td>
                                <form action="">
                                    <input type="submit"class="btn btn-danger btn-dell" value="削除">
                                </form>
                            </td>
                        </tr>
                    </thead>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $users->links('vendor.pagination.bootstrap-4') }}
                <!-- {{ $users->links('vendor.pagination.topics') }} -->
            </div>
            <div class="d-flex justify-content-center mb-4">
                {{ '全'.$users->total().'件' }}
            </div>
        </div>
</div>
@endsection
</x-app>
