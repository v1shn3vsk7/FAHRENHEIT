@extends('layouts.default')
@section('content')
<div style="text-align: center;">
    <form style="border:1px solid #ccc">
        <div class="regus">
            <h1>Форма обратной связи</h1>
            <p>Заполните форму для отправки.</p>
            <hr>

            <label for="email"><b>Электронная почта</b></label><br>
            <input type="email" placeholder="Почта" name="email" required>
            <br>
            <label for="title"><b>Заголовок сообщения</b></label><br>
            <input type="text" minlength="5" placeholder="Заголовок" name="title" required>
            <br>
            <label for="cat"><b>Выберите категорию</b></label><br>
            <input type="search" list="cats" placeholder="Категория" name="cat" required>
            <datalist id="cats">
                <option value="проблемы с входом/регистрацией" />
                <option value="проблемы с сайтом" />
                <option value="пожелание" />
                <option value="благодарность" />
                <option value="сливомысли" />
                <option value="другое" />
            </datalist>
            <label><br>
                <label for="psw"><b>Текст сообщения</b></label><br>
                <textarea style="resize: none;" name="txt"></textarea>
                <br>
                <label class="file-upload">
                    <input type="file"><b>Если необходимо, прикрепите файл</b>
                </label><br>

                <label><br>
                    <input type="checkbox" required name="terms" style="margin-bottom:15px">
                    Соглашаюсь с условиями пользовательского соглашения
                </label>

                <div>
                    <button type="submit" onclick="sus()" class="signupbtn">Отправить</button>
                </div>
        </div>

    </form>
</div>
<script>
    function sus() {
        alert("Спасибо за обращение! 👍 Ваше мнение очень важно для нас! 🤡 Мы обработаем Ваш запрос в ближайшее время💩")
    }
</script>
@stop