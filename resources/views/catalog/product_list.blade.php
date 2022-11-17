@extends('layouts.default')
@section('content')

<a href='/product_add'>Новый товар</a>
<br>


<div id="products-wrap">


@foreach($products as $product)
<div class="product_card">
    {{$product->alias}}<br>
    <img width="150px" height="150px" src="{{$product->image}}"><br>
    Цена: ${{$product->price}}<br>
    <a href='/product_edit/{{$product->id}}'>
        <button>Редактировать</button> 
    </a>
    <form method="POST" action="/delete_product/{{$product->id}}">
        @csrf
        <button style="color: red; width: 64%">Удалить</button>
    </form>
    {{-- <button style="color: red; width: 64%" id="{{$product->id}}" onclick=delete_from_products(this)>Удалить</button> --}}
    
</div>
@endforeach

</div>
{{-- <script>
    function delete_from_products(target) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "/delete_product/"+target.id);
        xhr.send();
        $('#products-wrap').load(document.URL + ' #products-wrap');
    }
</script> --}}


@stop