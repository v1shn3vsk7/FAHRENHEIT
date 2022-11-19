@extends('layouts.default')
@section('content')

    <head>
        <link rel="stylesheet" type="text/css" href="/css/warehouse.css">
    </head>


    <table class="stocks-table">
        <tr>
            <th>ID</th>
            <th>Название Товара</th>
            <th>Количество</th>
        </tr>
        <div class="stocks-wrap">
        @foreach ($stocks as $index => $stock)
            <tr>
                <td>{{ $products[$index]->id }}</td>
                <td>{{ $products[$index]->name }}</td>

                <td>
                    <input class="govno{{$stock->id}}"  type="number" value="{{ $stock->quantity }}"
                            min="0">
                            <button class="btn-delete" id="{{$stock->id}}" onclick="sus(this)">Изменить</button>
                </td>


            </tr>
        @endforeach
    </div>
    </table>

    <script>
    function sus(target) {
        const xhr = new XMLHttpRequest();
       //const x = document.querySelectorAll("govno#"+target.id);
        //val = getElementById(target.id);
        var x = document.getElementsByClassName("govno"+target.id);
        alert('Количество товара на складе обновлено до '+x[0].value+' штук 👍');
        xhr.open("GET", "/update_stock/"+target.id+"?value="+x[0].value);
        xhr.send();
         
        $('#stocks-wrap').load(document.URL + ' #stocks-wrap');
    }
</script>

@stop
