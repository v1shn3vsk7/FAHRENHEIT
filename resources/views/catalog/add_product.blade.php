@extends('layouts.default')
@section('content')
<form method="POST" action="/product_add_request" enctype="multipart/form-data" style="border:1px solid #ccc">
    <div style="text-align: center;" class="regus">
        <label for="image">Изображение товара
            <br><img class="avatar" width="140px" height="140px" id="output" src="/products/def/default.png"><br>
            <input accept="image/png" type="file" id="image" name="image" onchange="loadFile(event)">
        </label><br>
        @csrf
        <label for="name">Полное название товара</label><br>
        <input type="text" name="name" placeholder="Название товара"><br>
        <label for="alias">Короткое название товара</label><br>
        <input type="text" name="alias" placeholder="Короткое название товара"><br>
        <label for="short_desc">Короткое описание товара</label><br>
        <input type="text" name="short_desc" placeholder="Короткое описание товара"><br>
        <label for="desc">Описание товара</label><br>
        <textarea name="desc" placeholder="Описание товара"></textarea><br>
        <label for="price">Цена за единицу товара</label><br>
        <input type="number" name="price" placeholder="Цена"><br>
        <div class="product-properties">
            <div id="new_chq">
                <label>Свойства товара</label><br>
               
            </div>
            <input name="amogus" type="hidden" value="1" id="total_chq">
        </div>
        <div>
            

            <button type="submit" class="signupbtn">Добавить товар</button>
        </div>
    </div>
</form>
<button class="btn-add">Add</button>
    <button class="btn-remove">remove</button>
<script>
    var loadFile = function(event) {
        var image = document.getElementById("output");
        image.src = URL.createObjectURL(event.target.files[0]);
    };
</script>

<script>
    var availableTags = {{ Js::from($all_properties) }};


    $(function() {
        $(".propus").autocomplete({
            source: availableTags
        });
    });

    $('.btn-add').on('click', add);
    $('.btn-remove').on('click', remove);

    function add() {
        $(".propus").autocomplete("destroy");
        var new_chq_no = parseInt($('#total_chq').val()) + 1;
        var new_input = "<input class='propus' placeholder='Свойство' type='text' name='prop_" + new_chq_no +
            "'  id='prop_" + new_chq_no + "'>";

        var new_value_input = "<input placeholder='Значение' type='text' name='value_" + new_chq_no + "'  id='value_" +
            new_chq_no + "'>";



        $('#new_chq').append(new_input);
        $('#new_chq').append(new_value_input);

        $(".propus").autocomplete({
            source: availableTags
        });


        $('#total_chq').val(new_chq_no);


    }

    function remove() {
        var last_chq_no = $('#total_chq').val();

        if (last_chq_no > 0) {
            $('#prop_' + last_chq_no).remove();
            $('#value_' + last_chq_no).remove();
            $('#total_chq').val(last_chq_no - 1);
        }
    }
</script>

@stop