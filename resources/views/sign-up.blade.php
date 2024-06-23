@extends('base')

@section('title') Регистрация @endsection

@section('content')

    <form action="{{ route('users.store') }}" method="post" class="form">
        @csrf
        <h1 class="form_title">Регистрация</h1>
        <div class="form_body">
            <label>
                Имя
                <input type="text" name="name">
            </label>
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
