<x-app>
<x-slot name="title">
    商品登録画面
</x-slot>
@section('contents')
<x-navigation></x-navigation>
<div class="container">
        <div class="wrapper">
            <div class="mt-4 mb-4 pt-4">
                <h1 class="text-center pt-4 mt-4">商品登録</h1>
            </div>
            </div>
            @if(session('alertMessage'))
                <div class="alert alert-danger" role="alert">
                    {{ session('alertMessage')}}
                </div>
            @endif
            <div class="form-group">
                <form class="col-5 mx-auto p-3" method="POST" action="{{ route('item.store') }}" enctype="multipart/form-data">
                    @csrf
                    <!-- カテゴリー -->
                    <div>
                        <div>
                            <label for="type" class="col-form-label">カテゴリー</label><span class="ms-2 badge text-bg-danger">必須</span>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="type" id="fruits" value="1" {{ old('fruits') == '1' ? 'checked' : '' }} checked>
                            <label class="form-check-label" for="fruits">果物</label>
                        </div>
                        <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type" id="vegetable" value="2" {{ old('vegetable') == '2' ? 'checked' : '' }} >
                            <label class="form-check-label" for="vegetable">野菜</label>
                        </div>
                        <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type" id="meat" value="3" {{ old('meat') == '3' ? 'checked' : '' }} >
                            <label class="form-check-label" for="meat">精肉</label>
                        </div>
                        <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type" id="fish" value="4" {{ old('fish') == '4' ? 'checked' : '' }} >
                            <label class="form-check-label" for="fish">鮮魚</label>
                        </div>
                        <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type" id="others" value="5" {{ old('others') == '5' ? 'checked' : '' }} >
                            <label class="form-check-label" for="others">その他</label>
                        </div>
                    </div>
                    @error('type')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <!-- 商品名 -->
                    <div class="mb-1">
                        <label for="name" class="col-form-label">商品名</label><span class="ms-2 badge text-bg-danger">必須</span>
                        <input class="form-control p-1 rounded bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name')}}">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    

                    <!-- 価格 -->
                    <div class="mb-1">
                        <label for="password" class="col-form-label">価格</label><span class="ms-2 badge text-bg-danger">必須</span>
                        <input class="form-control p-1 rounded bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                        type="text" 
                        id="price" 
                        name="price"
                        id="price"
                        value="{{ old('price')}}">
                        @error('price')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- 商品説明 テキストボックスにする-->
                    <div>
                        <label for="detail" class="col-form-label">商品説明</label><span class="ms-2 badge text-bg-danger">必須</span>
                        <textarea class="form-control" rows="10" type="text" name="detail">{{ old('detail') }}</textarea>
                        @error('detail')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- 画像 -->
                    <div>
                        <label for="image" class="col-form-label">画像</label>
                        <input class="form-control p-1 rounded bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                        type="file"  
                        name="image"
                        id="image">
                        </input>
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="mt-4 btn btn-primary">登録する</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
</x-app>