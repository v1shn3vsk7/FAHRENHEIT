@extends('layouts.default')
@section('content')
<h2>Водонагреватели</h2>


@foreach($products as $product)
<div class="product_card">
    <div class="sus" onclick="setTarget(document.getElementById('id_{{$product->id}}'))"></div>
    {{$product->alias}}<br>
    <img width="150px" height="150px" src="{{$product->image}}"><br>
    Цена: ${{$product->price}}<br>

    <!--<a href="/add_to_cart/{{$product->id}}">
        <button>В корзину</button>
    </a> !-->
    <div class="but-wrap">
    <button class="addToCart" id="{{$product->id}}" onclick="sus(this)">В корзину</button>
    </div>

    <div id="id_{{$product->id}}" class="modal">
        <div class="modal-content">
            <table align="center" width="600px" border="1" cellpadding="1">
                <tr>
                    <th rowspan="2" width="200px">
                        <img width="150px" height="150px" src="{{$product->image}}" />
                    </th>
                    <th colspan="2" style="font-size: 25px;">
                        {{$product->name}}
                    </th>
                </tr>
                <tr>
                    <td width="600px" style="text-align: left;">
                        {{$product->short_desc}}
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center;" colspan="2">
                        ${{$product->price}}<br />
                        В наличии
                        <a href="/product/{{$product->id}}#har">
                            <buttton>Подробнее</button>
                        </a>
                        
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endforeach

<script>
    $('.addToCart').click(function(e){
  var butWrap = $(this).parents('.but-wrap');
  butWrap.append('<div class="animtocart"></div>');
  $('.animtocart').css({
    'position' : 'absolute',
    'background' : '#FF0000',
    'width' :  '25px',
    'height' : '25px',
    'border-radius' : '100px',
    'z-index' : '9999999999',
    'left' : e.pageX-25,
    'top' : e.pageY-25,
  });
  var cart = $('.cart').offset();
  $('.animtocart').animate({ top: cart.top + 'px', left: cart.left + 270 + 'px', width: 0, height: 0 }, 1300, function(){
    $(this).remove();
  });
  $('.cart').css="margin-bottom: 20px"; 
});
</script>


<script>
    function sus(target) {
        const xhr = new XMLHttpRequest();
        //open a get request with the remote server URL
        xhr.open("GET", "/add_to_cart/"+target.id);
        //send the Http request
        xhr.send();
        /* alert('Товар добавлен в корзину 👍'); */
    }
</script>
<script>
    var target;
    var setRecently = true;


    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (setRecently) {
            setRecently = false;
            return;
        }
        if (event.target == target)
            target.style.display = 'none';

    }

    function setTarget(tar) {
        tar.style.display = 'block';
        target = tar;
        setRecently = true;
    }
</script>
@stop