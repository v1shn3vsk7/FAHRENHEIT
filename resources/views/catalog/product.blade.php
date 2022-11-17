@extends('layouts.default')
@section('content')
<div class="sus" onclick="setTarget(document.getElementById('id_{{$product->id}}'))"></div>
<table align="center" width="800px" border="1" cellpadding="1">
    <thead>
        <tr>
            <th rowspan="2" width="200px">
                <img height="200px" width="200px" src="/{{$product->image}}">
            </th>
            <th colspan="2" style="font-size: 25px;">
                {{$product->name}}
            </th>
        </tr>
        <tr>
            <th width="600px" style="text-align: left;">
                {{$product->short_desc}}
            </th>
            <th style="text-align: left;">
                <h2>Цена: ${{$product->price}}</h2><br>
                В наличии<br>
                <!-- <div class="but-wrap">
                <a href="/add_to_cart/{{$product->id}}">
                <button class="addToCart" onclick="sus(this)">В корзину</button>
                </a> -->
                <div class="but-wrap">
                    <button class="addToCart" id="{{$product->id}}" onclick="sus(this)">В корзину</button>
                </div>
                </div>
            </th>
        </tr>
    </thead>
</table>
<table align="center" border="1" cellpadding="1" width="800px">
    <tr>
        <td colspan="3"><a href="#har">Характеристики</a>
            <a href="#opus">Описание</a>
        </td>
    </tr>
    <tr class="iteeems">
        <td id="opus">{{$product->desc}}</td>
        <td id="har">
            <div class="page-product-params">
                <dl>
                    @foreach($properties as $property)
                    <dt><span>{{$property->property}}</span></dt>
                    <dd><span>{{$property->value}}</span></dd>
                    @endforeach
                </dl>

            </div>
        </td>
    </tr>
</table>

<script>
    $('.addToCart').click(function(e) {
        var butWrap = $(this).parents('.but-wrap');
        butWrap.append('<div class="animtocart"></div>');
        $('.animtocart').css({
            'position': 'absolute',
            'background': '#FF0000',
            'width': '25px',
            'height': '25px',
            'border-radius': '100px',
            'z-index': '9999999999',
            'left': e.pageX - 25,
            'top': e.pageY - 25,
        });
        var cart = $('.cart').offset();
        $('.animtocart').animate({
            top: cart.top + 'px',
            left: cart.left + 257 + 'px',
            width: 0,
            height: 0
        }, 1300, function() {
            $(this).remove();
        });
    });
</script>


<script>
    function sus(target) {
        const xhr = new XMLHttpRequest();
        //open a get request with the remote server URL
        xhr.open("GET", "/add_to_cart/" + target.id);
        //send the Http request
        xhr.send();
    }
</script>
<script>
    var target;


    // When the user clicks anywhere outside of the modal, close i

    function setTarget(tar) {
        target = tar;
    }
</script>
@stop