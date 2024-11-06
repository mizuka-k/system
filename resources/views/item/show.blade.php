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
            <div class="table-responsive" style="height:300px">
                <table class="table align-middle">
                    <tbody>
                        <thead class="">
                            <tr class="">
                                <th class="text-secondary" style="width:30%">商品ID</th>
                                <td style="width:50%">
                                    <p class="m-0 ">{{ $item->id }}</p>
                                </td>
                                <td style="width:20%">
                                    <p class= "m-0 align-middle"></p>
                                </td>
                            </tr>
                        </thead>
                        <thead>
                            <tr class="align-middle">
                                <th class="text-secondary" style="width:30%">カテゴリー</th>
                                <td class="" style="width:50%">
                                    <p class="m-0">{{ $item->type }}</p>
                                </td>

                                <td class="" style="width:50%">
                                    <p class="m-0 aline-middle">
                                        <a class="link-primary" href=""><button type="button" class="btn btn-outline-info">編集</button></a>
                                    </p>
                                </td>
                            </tr>
                        </thead>
                        <thead>
                            <tr class="align-middle">
                                <th class="text-secondary" style="width:30%">商品名</th>
                                <td class="" style="width:50%">
                                    <p class="m-0">{{ $item->name }}</p>
                                </td>

                                <td style="width:20%">
                                    <p class="m-0 align-middle">
                                        <a class="link-primary" href=""><button type="button" class="btn btn-outline-info">編集</button></a>
                                    </p>
                                </td>
                            </tr>
                        </thead>
                        <thead>
                            <tr class="align-middle">
                                <th class="text-secondary" style="width:30%">価格</th>
                                <td class="" style="width:50%">
                                    <p class="m-0">{{ $item->price }}</p>
                                </td>

                                <td class="" style="width:50%">
                                    <p class="m-0 aline-middle">
                                        <a class="link-primary" href=""><button type="button" class="btn btn-outline-info">編集</button></a>
                                    </p>
                                </td>
                            </tr>
                        </thead>
                        <thead>
                            <tr class="align-middle">
                                <th class="text-secondary">商品説明</th>
                                <td class="">
                                    <p class="m-0">{{ $item->detail }}</p>
                                </td>
                                
                                <td>
                                    <p class="m-0">
                                    <a class="link-primary" href=""><button type="button" class="btn btn-outline-info">編集</button></a>
                                    </p>
                                </td>
                            </tr>
                        </thead>
                    </tbody>
                </table>
            </div>
        </div> 
    </div>
    @endsection
</x-app>