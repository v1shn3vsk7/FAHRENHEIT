        <table align="center" width="1000px" style="margin-top:-6rem; background-color: rgb(152, 221, 230); color: rgb(0, 0, 0);">
            <tbody>
                <tr>
                    <td style="text-align: center;" width="200px">
                        <a href="/"><img src="/img/logo.png"></a>
                    </td>
                    <td style="text-align: left;" width="500px">
                        <b style="font-size: 30px;">FAHRENHEIT ONLINE</b>
                    </td>
                    <td width="300">
                        <div class="mogus">
                            @auth
                            <span>
                                Hello, {{auth()->user()->login}}!<br>
                                <a href="/profile">Profile</a> | 
                                <a href="/logout">Logout</a>

                            </span>
                            <div class="cart">
                            <a href="/shopping_cart">
                            <img class="shopping-cart" width="25" height="25" src="/img/shopping-cart.png" alt="">
                            </a>
                            </div>
                            

                            @else
                            <form method="POST" enctype="multipart/form-data" action="/login">
                                <div><label for="login">Логин : </label><input name="login" id="login"></div>
                                <div><label for="password">Пароль : </label><input name="password" id="password" type="password"></div>
                                <div><button type="submit">Войти</button>
                                @csrf
                                <a href="/signup">
                                        Регистрация
                                    </a>
                                    <a href="/feedback">
                                        <img height="25" width="25" src="/img/feedback.png">
                                    </a>
                                </div>
                            </form>
                            @endauth
                    </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <table align="center" width="1000px" style="background-color: rgb(78, 198, 219); color: rgb(0, 0, 0);">
            <tr>
                <td style="text-align: center;" width="250px">
                    <a href="/razdel/1">Доставка и оплата</a>
                </td>
                <td style="text-align: center;" width="250px">
                    <a href="/razdel/2">О компании</a>
                </td>
                <td style="text-align: center;" width="250px">
                    <a href="/razdel/3">Гарантии</a>
                </td>
                <td style="text-align: center;" width="250px">
                    <a href="/razdel/4">Контакты</a>
                </td>
            </tr>
        </table>