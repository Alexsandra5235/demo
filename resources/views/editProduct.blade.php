@php
    use Illuminate\Support\Facades\Session;
    $template = Session::has('user') ? 'templateAuth' : 'template';
@endphp

@extends($template)

@section('title')
    Изменение товара
@endsection

@section('main_content')
    <div class="mask d-flex align-items-center h-100 gradient-custom-3">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="card" style="border-radius: 15px;">
                    <div class="card-body p-5">
                        <h2 class="text-uppercase text-center mb-5">Изменение товара</h2>

                        <form method="post" action="/product/{{$product->id}}/edit" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div data-mdb-input-init class="form-outline mb-4">
                                @if ($errors->has('title'))
                                    <div class="text-danger">{{ $errors->first('title') }}</div>
                                @endif
                                <input type="text" name="title" id="title" class="form-control" placeholder="Введите название товара"
                                       value="{{$product->title}}"/>
                            </div>

                            <div data-mdb-input-init class="form-outline mb-4">
                                @if ($errors->has('description'))
                                    <div class="text-danger">{{ $errors->first('description') }}</div>
                                @endif
                                <input type="text" name="description" id="description" class="form-control" placeholder="Введите описание товара"
                                       value="{{$product->description}}"/>
                            </div>

                            <div data-mdb-input-init class="form-outline mb-4">
                                @if ($errors->has('price'))
                                    <div class="text-danger">{{ $errors->first('price') }}</div>
                                @endif
                                <input type="text" name="price" id="price" class="form-control" placeholder="Введите цену товара"
                                       value="{{$product->price}}"/>
                            </div>

                            <div class="d-flex justify-content-center">
                                <input type="submit" class="btn btn-success btn-block btn-lg text-body w-100" value="Изменить товар">
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
