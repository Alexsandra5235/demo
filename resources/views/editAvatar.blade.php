@php
    use Illuminate\Support\Facades\Session;
    $template = Session::has('user') ? 'templateAuth' : 'template';
@endphp

@extends($template)

@section('title')
    Обновлание фотографии
@endsection

@section('main_content')

@endsection
