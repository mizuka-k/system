<x-app>
    <x-slot name="title">
        商品一覧画面
    </x-slot>
    @section('contents')
    <x-navigation></x-navigation>

    <div class="container">
        <div class="d-flex justify-content-center m-4 p-4">
            <h1 class="fs-2 fw-bold">商品一覧</h1>
        </div>
        <div class="table table-responsive">
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
                                <p class="m-0">{{ $item->type }}</p>
                            </td>
                            <td>
                                <p class="m-0">{{ $item->detail }}</p>
                            </td>
                            <td >
                                <p class="m-0 align-middle">
                                    <a class="link-primary" href=""><button type="button" class="btn btn-outline-info">詳細</button></a>
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
