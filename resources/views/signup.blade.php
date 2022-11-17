@extends('layouts.default')
@section('content')
<div style="text-align: center;">
    <form method="POST" action="/signup_request" enctype="multipart/form-data" style="border:1px solid #ccc">
        <div class="regus">
            <h1>Регистрация</h1>
            <p>Заполните форму для завершения регистрации.</p>
            <hr>
            @csrf
            <label for="email"><b>Электронная почта</b></label><br>
            <input type="email" placeholder="Почта" name="email" value="{{@old('email')}}" required>
            <br>
            <label for="login"><b>Логин</b></label><br>
            <input type="text" minlength="5" placeholder="Логин" name="login" value="{{@old('login')}}" required>
            <br>
            <label for="password"><b>Пароль</b></label><br>
            <input type="password" minlength="10" placeholder="Пароль" name="password" value="{{@old('password')}}" required>
            <br>
            <label for="psw-repeat"><b>Повторите пароль</b></label><br>
            <input type="password" minlength="10" placeholder="Повторите Пароль" name="psw-repeat" value="{{@old('psw-repeat')}}" required>
            <br>
            <label for="birthdate"><b>Дата рождения</b></label><br>
            <input type="date" placeholder="Повторите Пароль" name="birthdate" value="{{@old('birthdate')}}" required>
            <br>
            <label><b>Телефон</b></label><br>
            <input id="phone-mask" type="text" minlength="15" name="phone" placeholder="+7" value="{{@old('phone')}}" required /><br>
            <label for="city"><b>Введите город</b></label><br>
            <input type="search" list="city" placeholder="Введите город" name="city" value="{{@old('city')}}" required>
            <datalist id="city">
                <option value="Москва" />
                <option value="Ярославль" />
                <option value="Тверь" />
                <option value="Сергиев Посад" />
                <option value="Керчь" />
                <option value="Подольск" />
                <option value="Архангельск" />
                <option value="Слива" />
                <option value="Сусдаль" />
                <option value="Калуга" />
                <option value="Брянск" />
                <option value="Дмитров" />
                <option value="Екатеринбург" />
                <option value="Новосибирск" />
                <option value="Воронеж" />
                <option value="Орёл" />
            </datalist>
            <label><br>
                <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px">
                Запомнить меня
            </label>
            <label>
                <input type="checkbox" checked="checked" name="spam" style="margin-bottom:15px" value="1">
                Получать рассылку
            </label>
            <label><br>
                <input type="checkbox" required name="terms" style="margin-bottom:15px">
                Соглашаюсь с условиями пользовательского соглашения
            </label>
            <script>
                var phoneMask = IMask(
                    document.getElementById('phone-mask'), {
                        mask: '+{7}(000)000-00-00'
                    });
            </script>

            <div>
                <button type="submit" onclick="return checkPassword(this)" class="signupbtn">Зарегистрироваться</button>
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

<script>
    function checkPassword(form) {
        password1 = document.querySelector("input[name ='psw']").value;
        password2 = document.querySelector("input[name ='psw-repeat']").value;

        if (password1 == '')
            alert("Пожалуйста, введите пароль 🤡");
        else if (password2 == '')
            alert("Пожалуйста, подтвердите ваш пароль 🤡");

        else if (password1 != password2) {
            alert("Пароли не совпадают 💀")
            return false;
        } else {
            alert("Пароли совпадают 👍")
            return true;
        }

    }
</script>
@stop