@extends('layouts.default')
@section('content')
@if($msg=='reg_succ')
    Успешная регистрация! Проверьте указанную Вами почту для завершения регистрации. Registration successful! Check your inbox to validate your email 💀.
@elseif($msg=='auth_fail')
    Неверный логин и/или пароль. Login failed 💀
@elseif($msg=='login_required')
    Необходимо войти для продолжения💀
@elseif($msg=='sign_up_is_done_with_auth_errors')
    Ошибка регистрации. Sign up failed 💀💀💀
@elseif($msg=='email_verificate_fail')
    Ошибка верификации почты, попробуйте позже! Email verification failed💀. Pleasy try again later
@elseif($msg=='email_verificate_succ')
    Успешное подтверждение почты! Email verification succeeded 👍
@elseif($msg=='access_denied')
    У вас нет необходимых прав доступа 💀
@elseif($msg=='auth_timeout')
    Слишком много попыток авторизации💀💀💀💀💀💀
    @elseif($msg=='auth_wrong_product')
    Нельзя редактировать чужие продукты!💀💀💀💀💀💀
@elseif($msg=='low_quantity_in_warehouse')
    Товар закончился на складе! 💀💀💀💀💀💀
@elseif($msg=='purchase_success')
    Заказ оформлен! Ожидайте звонка от менеджера 👍
@endif
@stop