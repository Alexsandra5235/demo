@php
    use Illuminate\Support\Facades\Session;$template = Session::has('user') ? 'templateAuth' : 'template';
@endphp

@extends($template)

@section('title')
    Мой профиль
@endsection

@section('main_content')
    <div class="container">
        <div class="row flex-lg-nowrap">
            <div class="col">
                <div class="row">
                    <div class="col mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="e-profile">
                                    <div class="row">
                                        <div class="col-12 col-sm-auto mb-3">
                                            <div class="mx-auto" style="width: 140px;">
                                                <img src="{{ asset('storage/' . $profile->avatar->avatar_path) }}" alt="avatar"
                                                     class="rounded-circle img-fluid" width="150px" height="150px">
                                            </div>
                                        </div>
                                        <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                                            <div class="text-center text-sm-left mb-2 mb-sm-0">
                                                <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap">{{$profile->name}}</h4>
                                                <div class="mt-2">
                                                    <div class="bd-example input-group mt-2" style="width: 100%">
                                                        <a href="#" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable">
                                                            <i class="fa fa-fw fa-camera"></i>
                                                            <span>Изменить фотографию</span>
                                                        </a>
                                                    </div>

                                                    <!-- Вертикально центрированное модальное окно -->
                                                    <div class="modal fade" id="exampleModalScrollable" tabindex="-1" aria-labelledby="exampleModalScrollableTitle" style="display: none;" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalScrollableTitle">Обновление фотографии профиля</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                                                                </div>
                                                                <form action="/profile/{{$profile->id}}/edit/avatar" method="post" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('put')
                                                                    <div class="modal-body">
                                                                        <div data-mdb-input-init class="form-outline mb-4">
                                                                            <label for="images" class="form-label">Выберите фотографии профиля:</label>
                                                                            <input class="form-control" type="file" name="images" id="images" multiple />
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                                                        <input type="submit" class="btn btn-primary" value="Сохранить изменения">
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center text-sm-right">
                                                <div class="text-muted"><small>Зарегистрировался {{$profile->created_at}}</small></div>
                                            </div>
                                        </div>
                                    </div>
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Настройки</button>
                                            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Мои объявления</button>
                                        </div>
                                    </nav>
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                                            <div class="tab-content pt-3">
                                                <div class="tab-pane active">
                                                    <form class="form" action="/profile/{{$profile->id}}/edit" method="post">

                                                        @csrf
                                                        @method('put')

                                                        <div class="form-group">
                                                            <label for="name" class="form-label">Ваше имя</label>
                                                            <input class="form-control" type="text" name="name" id="name" value="{{$profile->name}}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email" class="form-label">Ваша почта</label>
                                                            <input class="form-control" type="text" name="email" id="email" value="{{$profile->email}}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="phone" class="form-label">Ваш номер телефона</label>
                                                            <input class="form-control" type="text" name="phone" id="phone" value="{{$profile->phone}}">
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-12 col-sm-6 mb-3">
                                                                <div class="my-3"><b>Изменение пароля</b></div>
                                                                <div class="form-group">
                                                                    <label class="form-label" for="current_passwd">Текущий пароль</label>
                                                                    <input class="form-control" type="password" name="current_passwd" id="current_passwd">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="password" class="form-label">Новый пароль</label>
                                                                    <input class="form-control" type="password" name="password" id="password">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="repeat_passwd" class="form-label">Повторите пароль</label>
                                                                    <input class="form-control" type="password" name="repeat_passwd" id="repeat_passwd">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col d-flex justify-content-end mb-3">
                                                                <button class="btn btn-primary" type="submit">Сохранить изменения</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <div class="col d-flex justify-content-end">
                                                        <form action="/profile/{{$profile->id}}/delete" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="btn btn-danger" type="submit">Удалить аккаунт</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                                                @if ($products->isEmpty())
                                                    <h3>Пока что здесь нет товаров!</h3>
                                                @else
                                                    @foreach($products as $item)
                                                        <div class="col">
                                                            <div class="card shadow-sm">
                                                                @if ($item->photos->isNotEmpty())
                                                                    <img src="{{ asset('storage/' . $item->photos[0]->path) }}" class="card-img-top"
                                                                         alt="Product Image" style="width:100%; height:225px;">
                                                                @else
                                                                    <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
                                                                         xmlns="http://www.w3.org/2000/svg" role="img"
                                                                         aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice"
                                                                         focusable="false">
                                                                        <title>Placeholder</title>
                                                                        <rect width="100%" height="100%" fill="#55595c"></rect>
                                                                        <text x="50%" y="50%" fill="#eceeef" dy=".3em">Нет изображения</text>
                                                                    </svg>
                                                                @endif
                                                                <div class="card-body">
                                                                    <h5 class="card-title">{{$item->title}}</h5>
                                                                    <p class="card-text">{{$item->price}} рублей</p>
                                                                    <p class="card-text">{{$item->description}}</p>
                                                                    <a class="card-text" href="/profile/{{$item->profile->id}}/info">
                                                                        {{$item->profile->name}}
                                                                    </a>
                                                                    <div class="d-flex justify-content-between align-items-center my-2">
                                                                        <div class="btn-group d-flex">

                                                                            @if(Session::has('user') && Session::get('user')->id == $item->profile->id)
                                                                                <a href="/product/{{$item->id}}/edit"
                                                                                   class="btn btn-sm btn-outline-secondary">
                                                                                    Редактировать
                                                                                </a>
                                                                                <form action="/product/{{$item->id}}/delete" method="post">
                                                                                    @csrf
                                                                                    @method('delete')
                                                                                    <button type="submit" class="btn btn-sm btn-outline-secondary">Удалить
                                                                                    </button>
                                                                                </form>
                                                                            @endif

                                                                        </div>
                                                                        <small class="text-body-secondary">{{$item->created_at}}</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
