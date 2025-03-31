@php
    use Illuminate\Support\Facades\Session;$template = Session::has('user') ? 'templateAuth' : 'template';
@endphp

@extends($template)

@section('title')
    Главная страница
@endsection

@section('main_content')

    @if ($users->isNotEmpty())
        <div class="container">
            <form action="/search" method="get">
                <div class="input-group">
                    <select name="user" id="user" class="form-control">
                        @foreach($users as $item)
                            <option @if (request('user') == $item->id) selected @endif
                            value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                    <input type="submit" class="btn btn-primary" value="Поиск по продавцу">
                    <a href="/products" class="btn btn-secondary">Отчистить поиск</a>
                </div>
            </form>
        </div>
    @endif


    <div class="album py-5 bg-body-tertiary">
        <div class="container">

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
                                    <p class="card-text">{{$item->city}}</p>
                                    <p class="card-text">{{$item->user->name}}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group d-flex">
                                            <form action="/product/{{$item->id}}/delete" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-sm btn-outline-secondary">Удалить
                                                </button>
                                            </form>
                                            <a href="/product/{{$item->id}}/edit"
                                               class="btn btn-sm btn-outline-secondary">Редактировать</a>
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
@endsection
