@extends('layouts.default')
@section('content')
@if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    <form method="POST" action="/edit_product_request/{{ $product->id }}" enctype="multipart/form-data"
        style="border:1px solid #ccc">
        <div style="text-align: center;" class="regus">
            <label for="image">Изображение товара
                <br><img class="avatar" width="140px" height="140px" id="output" src="/{{ $product->image }}"><br>
                <input type="file" accept="image/png" id="image" name="image" onchange="loadFile(event)">
            </label><br>
            @csrf
            <label for="name">Полное название товара</label><br>
            <input type="text" value="{{ $product->name }}" name="name" placeholder="Название товара"><br>
            <label for="alias">Короткое название товара</label><br>
            <input type="text" value="{{ $product->alias }}" name="alias" placeholder="Короткое название товара"><br>
            <label for="short_desc">Короткое описание товара</label><br>
            <input type="text" value="{{ $product->short_desc }}" name="short_desc"
                placeholder="Короткое описание товара"><br>
            <label for="desc">Описание товара</label><br>
            <textarea name="desc" placeholder="Описание товара">{{ $product->desc }}</textarea><br>
            <label for="price">Цена за единицу товара</label><br>
            <input type="number" value="{{ $product->price }}" name="price" placeholder="Цена"><br>
        </div>

        <div class="product-properties">
            <div id="new_chq">
                <label>Свойства товара</label><br>
                @php
                    $properties = $product->properties->all();
                @endphp
                @for ($i = 0; $i < count($properties); $i++)
                    <input class="propus" placeholder="Свойство" type="text" name="prop_{{ $i + 1 }}"
                        id="prop_{{ $i + 1 }}" value="{{ $properties[$i]->property }}">
                    <input placeholder="Значение" type="text" name="value_{{ $i + 1 }}"
                        id="value_{{ $i + 1 }}" value="{{ $properties[$i]->value }}">
                @endfor
            </div>
            <input name="amogus" type="hidden" value="{{ count($properties) }}" id="total_chq">
        </div>

        <div style="text-align: center" class="regus">
            <button type="submit" class="signupbtn">Обновить товар</button>
        </div>


    </form>
    <div style="text-align: center"><button class="btn-add">Добавить свойство</button>
    <button class="btn-remove">Удалить свойство</button></div>
    
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
