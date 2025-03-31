@extends('template')

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
                                        <input type="text" id="name" name="name" class="form-control" />
                                        <label class="form-label" for="name">Ваше имя</label>
                                    </div>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input type="email" id="email" name="email" class="form-control" />
                                        <label class="form-label" for="email">Ваша почта</label>
                                    </div>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input type="text" id="phone" name="phone" class="form-control" />
                                        <label class="form-label" for="phone">Ваш номер телефона</label>
                                    </div>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input type="password" id="password" name="password" class="form-control" />
                                        <label class="form-label" for="password">Пароль</label>
                                    </div>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input type="password" id="repeat_password" name="repeat_password" class="form-control" />
                                        <label class="form-label" for="repeat_password">Повторите пароль</label>
                                    </div>


                                    <div class="d-flex justify-content-center">
                                        <input type="submit" class="btn btn-success btn-block btn-lg text-body" value="Готово">
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
