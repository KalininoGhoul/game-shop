@extends('base')

@section('title') Авторизация @endsection

@section('content')

    <form action="{{ route('auth.login') }}" method="post" class="form">
        @csrf
        <h1 class="form_title">Авторизация</h1>
        <div class="form_body">
            <label>
                Email
                <input type="email" name="email">
            </label>
            <label>
                Пароль
                <input type="password" name="password">
            </label>
            <button class="btn">Отправить</button>
        </div>
    </form>

@endsection
