@php
    use Illuminate\Support\Facades\Session;$template = Session::has('user') ? 'templateAuth' : 'template';
@endphp

@extends($template)

@section('title')
    Просмотр профиля
@endsection

@section('main_content')
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-12 col-xl-4">

                <div class="card" style="border-radius: 15px;">
                    <div class="card-body text-center">
                        <div class="mt-3 mb-4">
                            <img src="{{asset('storage/' . $profile->avatar->avatar_path)}}"
                                 class="rounded-circle img-fluid" style="width: 100px;"  alt="avatar"/>
                        </div>
                        <h4 class="mb-2">{{$profile->name}}</h4>
                        <div class="mb-4 pb-2">
                            <h5>{{$profile->email}}</h5>
                            <h6>{{$profile->phone}}</h6>
                        </div>
                        <a href="/profile/{{$profile->id}}/products" class="btn btn-primary btn-rounded btn-lg">
                            Просмотр объявлений пользователя
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
