<x-app>
<x-slot name="title">
    ログイン画面
</x-slot>
@section('contents')
<x-navigation></x-navigation>
<div class="container">
    
    <div class="w-80 mx-auto">
        <div class="text-center">    
            <h1 class="p-4 m-4 text-center">商品管理システム</h1>
            @if(session('successMessage'))
                <div class="mt-4 alert alert-success" role="alert">
                    {{ session('successMessage' )}}
                </div>
            @endif
            @can('admin')
            <div class="d-flex justify-content-end me-4">
                <a class="link-info" href="">編集画面</a>
            </div>
            @endcan
        </div>
    </div>
</div>
@endsection
</x-app>
