@extends('layouts.default')
@section('content')
<h2>Водонагреватели</h2>
<table cellspacing="10">
    <tr>
        <td style="background-color: rgb(202, 228, 238);" align="center">
            <div class="sus" onclick="document.getElementById('id01').style.display='block'"></div>
            ТЭН Hajdu<br>
            <img width="150" height="150" src="img/kotelok1.webp"><br>
            Цена: 100$<br>
            <button style="width:auto;">В корзину</button>

            <div id="id01" class="modal">
                <div class="modal-content">
                    <table align="center" width="600px" border="1" cellpadding="1">
                        <tr>
                            <th rowspan="2" width="200px">
                                <img src="img/kotelok1.webp" />
                            </th>
                            <th colspan="2" style="font-size: 25px;">
                                ТЭН Hajdu 9 кВт для STA800-1000 (нижний) фланцевый 380В
                            </th>
                        </tr>
                        <tr>
                            <td width="600px" style="text-align: left;">
                                Артикул: 2419991059<br />
                                Бренд: Hajdu<br />
                                Вес, кг: 5<br />
                                Ширина, мм: 180<br />
                                Высота, мм: 620<br />
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center;" colspan="2">
                                Цена: 100$<br />
                                В наличии
                                <a href="shtoto.html#har"><button>Подробнее</button></a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </td>
        <td style="background-color: rgb(202, 228, 238);" align="center">
            <div class="sus" onclick="document.getElementById('id02').style.display='block'"></div>
            Eldom Thermo 150л<br>
            <img width="150" height="150" src="img/kotelok2.webp"><br>
            Цена: 98$<br>
            <button style="width:auto;">В корзину</button>

            <div id="id02" class="modal">
                <div class="modal-content">

                    <table align="center" width="600px" border="1" cellpadding="1">

                        <tr>
                            <th rowspan="2" width="200px">
                                <img src="img/kotelok2.webp" />
                            </th>
                            <th colspan="2" style="font-size: 25px;">
                                Накопительный комбинированный водонагреватель Eldom Thermo 150л (с
                                одним теплообменником)
                            </th>
                        </tr>
                        <tr>
                            <td width="600px" style="text-align: left;">
                                Артикул: WV15046TRG<br>
                                Бренд: Eldom<br>
                                Вес, кг: 47.5<br>
                                Управление: механическое<br>
                                Тип монтажа: вертикальный<br>
                            </td>

                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: center;">
                                Цена: 98$<br />
                                В наличии
                                <a href="shtoto.html#har"><button>Подробнее</button></a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

        </td>
        <td style="background-color: rgb(202, 228, 238);" align="center">
            <div class="sus" onclick="document.getElementById('id03').style.display='block'"></div>
            Hajdu ID40A E<br>
            <img width="150" height="150" src="img/kotelok2.webp"><br>
            Цена: 98$<br>
            <button style="width:auto;">В корзину</button>

            <div id="id03" class="modal">
                <div class="modal-content">
                    <table align="center" width="600px" border="1" cellpadding="1">
                        <thead>
                            <tr>
                                <th rowspan="2" width="200px">
                                    <img height="150" width="150" src="img/kotelok3.webp">
                                </th>
                                <th colspan="2" style="font-size: 25px;">
                                    Накопительный косвенный водонагреватель Hajdu ID40A E
                                </th>
                            </tr>
                            <tr>
                                <th width="600px" style="text-align: left;">
                                    Артикул: 2112113900<br>
                                    Бренд: Hajdu<br>
                                    Вес, кг: 62<br>
                                    Управление: механическое<br>
                                    Тип монтажа: вертикальный<br>
                                </th>

                            </tr>
                            <tr>
                                <th colspan="2" style="text-align: center;">
                                    Цена: 98$<br>
                                    В наличии
                                    <a href="shtoto.html#har"><button>Подробнее</button></a>
                                </th>
                            </tr>
                        </thead>

                    </table>
                </div>

            </div>
        </td>
    </tr>
</table>
<script>
    // Get the modal
    var modal = document.getElementById('id01');
    var modal2 = document.getElementById('id02');
    var modal3 = document.getElementById('id03');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
        if (event.target == modal2) {
            modal2.style.display = "none";
        }
        if (event.target == modal3) {
            modal3.style.display = "none";
        }
    }
</script>
@stop