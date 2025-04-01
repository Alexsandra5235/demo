@php
    use Illuminate\Support\Facades\Session;$template = Session::has('user') ? 'templateAuth' : 'template';
@endphp

@extends($template)

@section('title')
    Вход
@endsection

@section('main_content')
    <section class="my-3">
        <div class="container h-100">
            <div class="row d-flex align-items-center justify-content-center h-100">
                <div class="col-md-8 col-lg-7 col-xl-6">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
                         class="img-fluid" alt="Phone image">
                </div>
                <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                    <h3>Вход</h3>
                    <form action="/sign" method="post">
                        @csrf
                        <!-- Email input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            @if ($errors->has('email'))
                                <div class="text-danger">{{ $errors->first('email') }}</div>
                            @endif
                            <input type="text" id="email" name="email" class="form-control form-control-lg" value="{{ old('email') }}"/>
                            <label class="form-label" for="email">Почта</label>

                        </div>

                        <!-- Password input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            @if ($errors->has('password'))
                                <div class="text-danger">{{ $errors->first('password') }}</div>
                            @endif
                            <input type="password" id="password" name="password" class="form-control form-control-lg" />
                            <label class="form-label" for="password">Пароль</label>

                        </div>

                        <div class="d-flex justify-content-around align-items-center mb-4">
                            <!-- Checkbox -->
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
                                <label class="form-check-label" for="form1Example3"> Запомнить меня </label>
                            </div>
                            <a href="#!">Забыли пароль?</a>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" style="width: 100%" class="btn btn-primary btn-lg btn-block">Вход</button>

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
