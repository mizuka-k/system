<x-app>
    <x-slot name='title'>
        マイページ
    </x-slot>
    @section('contents')
    <x-navigation></x-navigation>
    <div class="container w-75">
        <div class="p-4 bg-body-tertiary m-4">
            <h3 class="pt-4 m-4 text-center">マイページ</h3>
            
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
                                <th class="text-secondary" style="width:30%">ユーザーID</th>
                                <td style="width:50%">
                                    <p class="m-0 ">{{ $auth->id }}</p>
                                </td>
                            </tr>
                        </thead>
                        <thead>
                            <tr class="align-middle">
                                <th class="text-secondary" style="width:30%">名前</th>
                                <td class="" style="width:50%">
                                    <p class="m-0">{{ $auth->name }}</p>
                                </td>
                            </tr>
                        </thead>
                        <thead>
                            <tr class="align-middle">
                                <th class="text-secondary" style="width:30%">メールアドレス</th>
                                <td class="" style="width:50%">
                                    <p class="m-0">{{ $auth->email }}</p>
                                </td>
                            </tr>
                        </thead>
                        <thead>
                            <tr scope="row" class="align-middle ">
                                <th class="text-secondary" >パスワード</th>
                                <td >
                                    <p class="m-0">******</p>
                                </td>
                            </tr>
                        </thead>
                    </tbody>
                    
                </table>
                <div class="d-flex justify-content-center">
                    <a class="link-primary" href="{{ route('showEdit',auth()->user()) }}"><button type="submit" class="btn btn-outline-info">編集</button></a>
                </div>
            </div>
        </div> 
    </div>
</body>
</html>
    @endsection
</x-app>