@extends('layouts.default')
@section('content')

<div style="text-align: center;">
    <form method="POST" action="/seller_signup_request" enctype="multipart/form-data" style="border:1px solid #ccc">
        <div class="regus">
            <h1>Регистрация</h1>
            <p>Заполните форму для регистрации аккаунта продавца.</p>
            <hr>
            @csrf
            <label for="companyName"><b>Название организации</b></label><br>
            <input type="text" placeholder="Организация:" name="companyName" value="{{@old('companyName')}}" required>
            <br>
            <label for="INN"><b>ИНН</b></label><br>
            <input type="number" min="1000000000" max="999999999999" placeholder="ИНН:" name="INN" value="{{@old('INN')}}" required>
            <br>
            <input type="checkbox" required name="terms" style="margin-bottom:15px">
                Соглашаюсь, что приведенные мною данные действительны
            </label>
            
            <div>
                <button type="submit" class="signupbtn">Зарегистрироваться</button>
            </div>
        </div>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </form>
</div>

@stop