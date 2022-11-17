@extends('layouts.default')
@section('content')
@has_permission('warehouse.view')
<a href="/warehouse">Склад</a>
@endif
@has_permission('product.view')
<a href="/product_list">Мои товары</a>
@else
<a href="/seller_signup">Стать продавцом</a>
@endif
<div style="text-align: center;">
    <form method="POST" action="/profile_update" enctype="multipart/form-data" style="border:1px solid #ccc">
        <div class="regus">
            <p>Ваши данные</p>
            <hr>
            <label class="label" for="file">

                <img class="avatar" width="140px" height="140px" id="output" src="{{auth()->guard()->user()->img}}"><br>
                <input accept="image/png" type="file" id="file" name="img" onchange="loadFile(event)">
            </label>
            @csrf
            <label for="email"><b>Электронная почта</b></label><br>
            <input value="{{auth()->guard()->user()->email}}" readonly type="email" placeholder="Почта" name="email" required>
            <br>
            <label for="login"><b>Логин</b></label><br>
            <input value="{{auth()->guard()->user()->login}}" readonly type="text" minlength="5" placeholder="Логин" name="login">
            <br>
            <label for="psw"><b>Старый пароль</b></label><br>
            <input value="" type="password" minlength="10" placeholder="Старый пароль" name="password-old" required>
            <br>
            <label for="psw"><b>Новый пароль</b></label><br>
            <input value="" type="password" minlength="10" placeholder="Новый пароль" name="password">
            <br>
            <label for="psw-repeat"><b>Повторите новый пароль</b></label><br>
            <input value="" type="password" minlength="10" placeholder="Повторите новый пароль" name="psw-repeat">
            <br>
            <label for="birth-date"><b>Дата рождения</b></label><br>
            <input value="{{auth()->guard()->user()->birthdate}}" type="date" name="birthdate" required>
            <br>
            <label><b>Телефон</b></label><br>
            <input value="{{auth()->guard()->user()->phone}}" id="phone-mask" readonly type="text" minlength="15" name="phone" placeholder="+7" required /><br>
            <label for="city"><b>Введите город</b></label><br>
            <input value="{{auth()->guard()->user()->city}}" type="search" list="city" placeholder="Введите город" name="city" required>
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
            @if(auth()->guard()->user()->spam)
                <input type="checkbox" checked value="1" name="spam" style="margin-bottom:15px">
            @else
                <input type="checkbox" name="spam" value="1" style="margin-bottom:15px">
            @endif
            Получать рассылку
            </label>
            <script>
                var phoneMask = IMask(
                    document.getElementById('phone-mask'), {
                        mask: '+{7}(000)000-00-00'
                    });
            </script>
            <script>
            var loadFile = function (event) {
                var image = document.getElementById("output");
                image.src = URL.createObjectURL(event.target.files[0]);
            };

        </script>
            <div>
                <button type="submit" class="signupbtn">Обновить данные</button>
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