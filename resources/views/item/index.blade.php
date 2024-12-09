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
        <div>
        <!-- 検索機能 -->
        <div class="mb-3">
            <form method="get" action="{{ route('item.index') }}" class="row" >
                @csrf
                <div class="col-3">
                    <select name="type" class="form-select col-auto" >
                        <option value="">種別</option>
                        <option value="1"{{ request('type') == '1' ? 'selected' : '' }}>果物</option>
                        <option value="2"{{ request('type') == '2' ? 'selected' : '' }}>野菜</option>
                        <option value="3"{{ request('type') == '3' ? 'selected' : '' }}>精肉</option>
                        <option value="4"{{ request('type') == '4' ? 'selected' : '' }}>鮮魚</option>
                        <option value="5"{{ request('type') == '5' ? 'selected' : '' }}>その他</option>
                    </select>
                </div>
                <div class="col-3">
                    <input class="form-control" type="text" name="keyword" value="{{ $keyword ?? '' }}" placeholder="キーワードで検索">
                </div>
                <div class="col-3">
                    <button type="submit" class="col-auto btn btn-secondary">検索</button>
                </div>
            </form>

        </div>
        <!-- 新規作成ボタン -->
        <div class="d-flex justify-content-end me-4">
            <a href="{{ route('item.create') }}"><button class="btn btn-primary mb-2 mt-2" type=“button”>新規作成</button></a>
        </div>
        </div>
        <div class="table table-responsive">
            @if(session('successMessage'))
                <div class="mt-4 alert alert-success" role="alert">
                    {{ session('successMessage' )}}
                </div>
            @endif

            <table class="table align-middle">

                <thead>
                    <tr>
                        <th scope="col">商品名</th>
                        <th scope="col">カテゴリー</th>
                        <th scope="col">商品説明</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                    <thead>
                        <tr class="align-middle">
                            <td>
                                <p class="m-0">{{ $item->name }}</p>
                            </td>
                            <td>
                            <p class="m-0">@if($item->type == 1)
                                <div>果物</div>
                                @elseif($item->type == 2)
                                <div>野菜</div>
                                @elseif($item->type == 3)
                                <div>精肉</div>
                                @elseif($item->type == 4)
                                <div>鮮魚</div>
                                @elseif($item->type == 5)
                                <div>その他</div>
                                @endif
                            </p>
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
                @if($itemCount == 0)
                    <p class="text-center py-4">データがありません。</p>
                @endif
            </div>
        </div>
        <div class="d-flex justify-content-center">
            {{ $items->links('vendor.pagination.bootstrap-4') }}
        </div>
        <div class="d-flex justify-content-center mb-4">
            {{ '全'.$items->total().'件' }}
        </div>
</div>
@endsection
</x-app>
