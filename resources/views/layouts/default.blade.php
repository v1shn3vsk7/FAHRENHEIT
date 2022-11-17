<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.head')
</head>

<body>
    <main>
        @include('includes.balls')
        @include('includes.header')
        <table class="sliva" align="center" width="1000px">
            <tr>
                <td style="text-align: left;" width="200px">
                    <!-- <a href="/vodogrei">Водонагреватели</a><br>
                    <a href="/kotelki">Котельное оборудование</a><br>
                    <a href="/kotelki">Радиаторы</a><br>
                    <a href="/kotelki">Трубы</a> -->
                    <a href="/catalog">Каталог</a>
                </td>
                <td style="text-align: left;" width="800px">
                    <h2>Фаренгейт интернет-магазин - инженерной сантехники, систем отопления и водоснабжения</h2>
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                    <div>
                        @yield('content')
                    </div>
                </td>
            </tr>
        </table>
    </main>
    @include('includes.footer')
</body>