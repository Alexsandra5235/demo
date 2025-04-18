@php
    use Illuminate\Support\Facades\Session;$template = Session::has('user') ? 'templateAuth' : 'template';
@endphp

@extends($template)

@section('title')
    Регистрация
@endsection

@section('main_content')
    <section>
        <div class="mask d-flex align-items-center h-100">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <h2 class="text-uppercase text-center mb-5">Регистрация</h2>

                                <form method="post" action="/register">
                                    @csrf

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        @if ($errors->has('name'))
                                            <div class="text-danger">{{ $errors->first('name') }}</div>
                                        @endif
                                        <input type="text" id="name" name="name" class="form-control"
                                            value="{{old('name')}}"/>
                                        <label class="form-label" for="name">Ваше имя</label>

                                    </div>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        @if ($errors->has('email'))
                                            <div class="text-danger">{{ $errors->first('email') }}</div>
                                        @endif
                                        <input type="text" id="email" name="email" class="form-control"
                                            value="{{old('email')}}"/>
                                        <label class="form-label" for="email">Ваша почта</label>

                                    </div>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        @if ($errors->has('phone'))
                                            <div class="text-danger">{{ $errors->first('phone') }}</div>
                                        @endif
                                        <input type="text" id="phone" name="phone" class="form-control"
                                            value="{{old('phone')}}"/>
                                        <label class="form-label" for="phone">Ваш номер телефона</label>

                                    </div>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        @if ($errors->has('password'))
                                            <div class="text-danger">{{ $errors->first('password') }}</div>
                                        @endif
                                        <input type="password" id="password" name="password" class="form-control" />
                                        <label class="form-label" for="password">Пароль</label>

                                    </div>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        @if ($errors->has('repeat_password'))
                                            <div class="text-danger">{{ $errors->first('repeat_password') }}</div>
                                        @endif
                                        <input type="password" id="repeat_password" name="repeat_password" class="form-control"/>
                                        <label class="form-label" for="repeat_password">Повторите пароль</label>

                                    </div>


                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-success btn-block btn-lg text-body">Готово</button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
