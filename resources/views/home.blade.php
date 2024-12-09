<x-app>
<x-slot name="title">
    ログイン画面
</x-slot>
@section('contents')
<x-navigation></x-navigation>
<div class="container">
    
    <div class="w-80 mx-auto">
        <div class="center-block ">    
            <h1 class="p-4 m-4 text-center">商品管理システム</h1>
            @if(session('successMessage'))
                <div class="mt-4 alert alert-success" role="alert">
                    {{ session('successMessage' )}}
                </div>
            @endif
                <div id="carouselExampleAutoplaying" class="carousel slide w-100 p-3" data-bs-ride="carousel" >
                    <div class="carousel-inner" style="width: 900px; height: 600px;">
                        <div class="carousel-item active">
                        <img src="{{ asset('images/fruits.jpeg') }}" class="d-block w-100 h-80" alt="アスパラの画像">
                        </div>
                        <div class="carousel-item">
                        <img src="{{ asset('images/asupara.jpg') }}" class="d-block w-100 h-80" alt="...">
                        </div>
                        <div class="carousel-item">
                        <img src="{{ asset('images/meat.jpeg') }}" class="d-block w-100 h-80" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

                    <div class="m-4 row">
                        <div class="col px-5">
                            <h5 class="text-center pt-4">New Item</h5>
                            <ul class="list-group list-group-flush">
                                @foreach ($items as $item)
                                <li class="list-group-item"><a class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"href="/search/show/{{ $item->id }}" >[{{ $item->name.':'.$item->created_at }}] が追加されました</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
        </div>
    </div>
</div>
@endsection
</x-app>
