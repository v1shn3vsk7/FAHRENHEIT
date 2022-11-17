@extends('layouts.default')
@section('content')

<?php
$productCost = 0;
$totalQuantity = 0;
$productId;
?>

<div id="item-wrap">
@foreach($items as $item)
<div class="item">
<div class="sus" onclick="setTarget(document.getElementById('id_{{$item->productt->id}}'))"></div>
  <img src="/{{$item->productt->image}}" alt="">
  <div class="content">
    <?php $productId = $item->productt->id ?>
    <h3>{{$item->productt->name}}</h3>
    <h4>${{$item->productt->price}}</h4>
    <p>Количество: {{$item->quantity}}</p>
    <!-- <a href="/delete_from_cart/{{$productId}}">Удалить</a> -->
    <button class="btn-delete" id="{{$item->productt->id}}" onclick="deleteFromCart(this)">Удалить</button>
    <?php
    $productCost += $item->productt->price * $item->quantity;
    $totalQuantity += $item->quantity;
    ?>
  </div>
</div>
<hr>
@endforeach

<div class="total">
  <h1>Ваша корзина:</h1>
  
  <p>Товары ({{$totalQuantity}}) ${{$productCost}}</p>
  <p>Доставка ${{50 * $totalQuantity}}</p>
  <hr>
  <div class="buy">
  <h1>Общая стоимость ${{$productCost + 50 * $totalQuantity}}</h1>
  @if ($totalQuantity)
  <form action="/place_order">
  <input type="submit" class="bn632-hover bn22" value="Оформить">
</form>
@endif
  </div>
  

</div>
</div>


<script>
    function placeOrder(target) {
      const xhr = new XMLHttpRequest();
        //open a get request with the remote server URL
        xhr.open("GET", "/place_order");
        //send the Http request
        xhr.send();
        alert("Спасибо за покупку 👍 Менеджер перезвонит Вам в ближайшее время!");
        $('#item-wrap').load(document.URL + ' #item-wrap');
    }

    function deleteFromCart(target) {
        const xhr = new XMLHttpRequest();
        //open a get request with the remote server URL
        xhr.open("GET", "/delete_from_cart/" + target.id);
        //send the Http request
        xhr.send();
        $('#item-wrap').load(document.URL + ' #item-wrap');
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