<x-app>
    <x-slot name='title'>
        商品詳細画面
    </x-slot>
    @section('contents')
    <x-navigation></x-navigation>
    <div class="container w-75">
        <div class="p-4 bg-body-tertiary m-4">
            <h3 class="pt-4 m-4 text-center">商品詳細</h3>
            
            @if(session('alertMessage'))
                <div class="alert alert-danger" role="alert">
                    {{ session('alertMessage')}}
                </div>
            @elseif(session('successMessage'))
                <div class="alert alert-success" role="alert">
                    {{ session('successMessage' )}}
                </div>
            @endif
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
                    <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#editModal" data-title="{{ $item->title }}" data-url="{{ route('item.update',$item) }}">編集</button>
                    <form method="post" action="{{ route('item.delete',$item) }}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger mt-2 ms-2" onClick="return confirm('本当に削除しますか？');">削除</button>
                    </form>
                </div>
                <div class="d-flex justify-content-center">
                    <a href="{{ route('item.index') }}"><button type="button" class="btn btn-outline-secondary mt-2">戻る</button></a>
                </div>
            </div>
        </div> 
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">商品情報編集</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <form id="itemEdit" class="col-5 mx-auto p-3" method="POST" action="{{ route('item.update',$item) }}" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <!-- カテゴリー -->
                            <div>
                                <div>
                                    <label for="type" class="col-form-label">カテゴリー</label><span class="ms-2 badge text-bg-danger">必須</span>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="fruits" name="type" value="1" {{ old ('fruits', $item->type) == '1' ? 'checked' : '' }} >
                                    <label class="form-check-label" for="fruits">果物</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="vegetable" name="type" value="2" {{ old ('vegetable', $item->type) == '2' ? 'checked' : '' }} >
                                    <label class="form-check-label" for="vegetable">野菜</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="meat" name="type" value="3" {{ old ('meat', $item->type) == '3' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="meat">精肉</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="fish" name="type" value="4" {{ old ('fish', $item->type) == '4' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="fish">鮮魚</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="others" name="type" value="5" {{ old ('others', $item->type) == '5' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="others">その他</label>
                                </div>
                            </div>
                            

                            <!-- 商品名 -->
                            <div class="mb-1">
                                <label for="name" class="col-form-label">商品名</label><span class="ms-2 badge text-bg-danger">必須</span>
                                <input class="form-control p-1 rounded bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                                type="text" 
                                id="name" 
                                name="name" 
                                value="{{ old('name', $item->name) }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            

                            <!-- 価格 -->
                            <div class="mb-1">
                                <label for="password" class="col-form-label">価格</label><span class="ms-2 badge text-bg-danger">必須</span>
                                <input class="form-control p-1 rounded bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                                type="text" 
                                name="price"
                                value="{{ old('price', $item->price) }}"
                                >
                                @error('price')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- 商品説明 テキストボックスにする-->
                            <div>
                                <label for="detail" class="col-form-label">商品説明</label><span class="ms-2 badge text-bg-danger">必須</span>
                                <textarea class="form-control" rows="10" type="text" name="detail">{{ old('detail',$item->detail) }}</textarea>
                                @error('detail')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- 画像 -->
                            <div>
                            @if($item->image)
                            <div>
                                (画像ファイル：{{$item->image}})
                            </div>
                            <img src="{{ asset('storage/images/'.$item->image)}}" class="mx-auto" style="height:300px;">
                            @endif
                                <label for="image" class="col-form-label">画像(1MBまで)</label>
                                <input class="form-control p-1 rounded bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                                type="file"  
                                name="image"
                                id="image">
                                </input>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
                    <button form="itemEdit" type="submit" class="btn btn-primary">編集する</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    const myModal = document.getElementById('myModal')
    const myInput = document.getElementById('myInput')

    myModal.addEventListener('shown.bs.modal', () => {
        myInput.focus()
    })

    window.onload = function() {
        $('#SampleModal').on('shown.bs.modal', function (event) {
            var button = $(event.relatedTarget);//モーダルを呼び出すときに使われたボタンを取得
            var title = button.data('title');//data-titleの値を取得
            var url = button.data('url');//data-urlの値を取得
            var modal = $(this);//モーダルを取得

            //Ajaxの処理はここに
            //modal-bodyのpタグにtextメソッド内を表示
            // modal.find('.modal-body p').eq(0).text("本当に"+title+"を削除しますか?");
            //formタグのaction属性にurlのデータ渡す
            modal.find('form').attr('action',url);
        });
    }
    </script>
    @endsection
</x-app>