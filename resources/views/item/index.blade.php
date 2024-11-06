<x-app>
    <x-slot name="title">
        商品一覧画面
    </x-slot>
    @section('contents')
    <x-navigation></x-navigation>

    <div class="container">
        <div class="d-flex justify-content-center m-4 p-4">
            <h1 class="fs-2 fw-bold">商品一覧(管理者限定閲覧)</h1>
        </div>
        <div class="table table-responsive">
            @if(session('successMessage'))
                <div class="mt-4 alert alert-success" role="alert">
                    {{ session('successMessage' )}}
                </div>
            @endif
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
            <!-- 新規作成ボタン -->
                <div>
                    <a href="{{ route('item.create') }}"><button style="margin-top:10px; margin-bottom:20px;" class="btn btn-primary" type=“button”>新規作成</button></a>
                </div>
                <thead>
                    <tr>
                        <th scope="col">商品名</th>
                        <th scope="col">カテゴリー</th>
                        <th scope="col">商品説明</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    <thead>
                        <tr class="align-middle">
                            <td>
                                <p class="m-0">{{ $item->name }}</p>
                            </td>
                            <td>
                                <p class="m-0">{{ $item->type }}</p>
                            </td>
                            <td>
                                <p class="m-0">{{ $item->detail }}</p>
                            </td>
                            <td >
                                <p class="m-0 align-middle">
                                    <a class="link-primary" href="{{ route('item.show', $item) }}"><button type="button" class="btn btn-outline-info">詳細</button></a>
                                </p>
                            </td>
                        </tr>
                    </thead>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
        
            </div>
            <div class="d-flex justify-content-center mb-4">
                
            </div>
        </div>
</div>
@endsection
</x-app>
