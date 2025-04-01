@php
    use Illuminate\Support\Facades\Session;
    $template = Session::has('user') ? 'templateAuth' : 'template';
@endphp

@extends($template)

@section('title')
    Добавление товара
@endsection

@section('main_content')
    <div class="mask d-flex align-items-center h-100 gradient-custom-3">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="card" style="border-radius: 15px;">
                    <div class="card-body p-5">
                        <h2 class="text-uppercase text-center mb-5">Добавление товара</h2>

                        <form method="post" action="/product/add" enctype="multipart/form-data">
                            @csrf

                            <div data-mdb-input-init class="form-outline mb-4">
                                @if ($errors->has('title'))
                                    <div class="text-danger">{{ $errors->first('title') }}</div>
                                @endif
                                <input type="text" name="title" id="title" class="form-control" placeholder="Введите название товара"
                                    value="{{ old('title') }}"/>
                            </div>

                            <div data-mdb-input-init class="form-outline mb-4">
                                @if ($errors->has('description'))
                                    <div class="text-danger">{{ $errors->first('description') }}</div>
                                @endif
                                <input type="text" name="description" id="description" class="form-control" placeholder="Введите описание товара"
                                    value="{{old('description')}}"/>
                            </div>

                            <div data-mdb-input-init class="form-outline mb-4">
                                @if ($errors->has('price'))
                                    <div class="text-danger">{{ $errors->first('price') }}</div>
                                @endif
                                <input type="text" name="price" id="price" class="form-control" placeholder="Введите цену товара"
                                    value="{{old('price')}}"/>
                            </div>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <label for="images" class="form-label">Выберите фотографии товара:</label>
                                <input class="form-control" type="file" name="images[]" id="images" multiple />
                            </div>

                            <div class="d-flex justify-content-center">
                                <input type="submit" class="btn btn-success btn-block btn-lg text-body w-100" value=" Добавить товар">
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
