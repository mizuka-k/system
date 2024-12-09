<x-app>
    <x-slot name='title'>
        商品詳細画面
    </x-slot>
    @section('contents')
    <x-navigation></x-navigation>
    <div class="container w-75">
        <div class="p-4 bg-body-tertiary m-4">
            <h3 class="pt-4 m-4 text-center">商品詳細</h3>

            <div class="table-responsive" style="height:auto">
                <table class="table align-middle">
                    <tbody>
                        <tr class="align-middle">
                            <th class="text-secondary" style="width:30%">商品ID</th>
                            <td style="width:50%">
                                <p class="m-0 ">{{ $item->id }}</p>
                        </tr>
                        <tr class="align-middle">
                            <th class="text-secondary" style="width:30%">カテゴリー</th>
                            <td class="" style="width:50%">
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
                        </tr>
                        <tr class="align-middle">
                            <th class="text-secondary" style="width:30%">商品名</th>
                            <td class="" style="width:50%">
                                <p class="m-0">{{ $item->name }}</p>
                            </td>
                        </tr>
                        <tr class="align-middle">
                            <th class="text-secondary" style="width:30%">価格</th>
                            <td class="" style="width:50%">
                                <p class="m-0">{{ $item->price }}</p>
                            </td>
                        </tr>
                        <tr class="align-middle">
                            <th class="text-secondary">商品説明</th>
                            <td class="">
                                <p class="m-0">{{ $item->detail }}</p>
                            </td>
                        </tr>
                        <tr class="align-middle">
                            <th class="text-secondary">登録日時</th>
                            <td class="">
                                <p class="m-0">{{ $item->created_at->format('Y-m-d H:i') }}</p>
                            </td>
                        </tr>
                    </tbody>
                    @if($item->image)
                        <div class="text-center">
                            (画像ファイル：{{ $item->image }})
                        </div>
                        <img src="{{ asset('storage/images/'.$item->image) }}" class="rounded mx-auto d-block" style="height:300px" alt="商品画像">
                    @endif
                </table>
                <div class="d-flex justify-content-center">
                    <a href="{{ route('search.index') }}"><button type="button" class="btn btn-outline-secondary mt-2">戻る</button></a>
                </div>
            </div>
        </div> 
    </div>

    @endsection
</x-app>