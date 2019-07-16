@extends("recursos/templates/template_table")

@php
    // $stmt-withPath('?order_by='.$_GET[])
@endphp

@section("titulo_objeto")
    Producto
@endsection


@section("table_headers")
    <!-- Invertir el orden actual para pasarlo como parametro por get cuando se haga click en los links siguientes -->
      <?php if ($order_how=="ASC") $new_order="DESC";
            else                   $new_order="ASC"; ?>

    @foreach ($columns as $key => $column)
        @if (($key == 'updated_at') || ($key=='deleted_at'))
            @continue

        @elseif ($key=='category_id')
            <th style="width: {{$column['width']}};">
                <a href="#">
                    {{$column['name']}}
                </a>
            </th>
            @continue
        @endif

        <th style="width: {{$column['width']}};">
            <a href="/productos/admin?table=products&order_by={{$key}}&order_how={{$new_order}}&limit={{$limit}}&page={{$page}}">
                {{$column['name']}}
            </a>
        </th>
    @endforeach

@endsection




@section("table_rows")

    @foreach ($all_products as $product)
        <tr id="{{$product->id}}">
  <!-- Celda Checkboxes -->
            <td>
                <span class="custom-checkbox">
                    <input type="checkbox" id="checkbox1" name="options[]" value="1">
                    <label for="checkbox1"></label>
                </span>
            </td>

  <!-- Celda Id -->
            <td> <b>{{$product->id}}</b> </td>
  <!-- Celda Título -->
            <td> {{$product->name}} </td>
  <!-- Celda Descripción Corta -->
            <td> {{$product->short_desc}} </td>
  <!-- Celda Descripción Larga -->
            <td> {{$product->long_desc}} </td>
  <!-- Celda Precio -->
            <td> {{$product->price}} </td>
  <!-- Celda Imagen -->
            <td> <a href="{{ url($product->thumbnail)}}" class="view" title={{$product->thumbnail}} data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a></td>
  <!-- Celda Stock -->
            <td> {{$product->stock}} </td>
  <!-- Celda Descuento % -->
            <td> {{$product->discount}} </td>
  <!-- Celda Color -->
            <td> {{$product->color->name}} </td>
  <!-- Celda Tamaño -->
            <td> {{$product->size->name}} </td>
  <!-- Celda Categoría -->
            <td> {{$product->subcategory->category->name}} </td>
  <!-- Celda Sub_Categoría -->
            <td> {{$product->subcategory->name}} </td>
  <!-- Celda Creado -->
            <td> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $product->created_at)->format('d-m-Y')}} </td>

  <!-- Celda Acciones -->
            <td id="acciones">
  	            {{-- <a href="#" class="view" title="Ver" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a> --}}
                <a id="edit" value="{{$product->id}}" href="#edit_modal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Editar">&#xE254;</i></a>
                <a href="#delete_modal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Eliminar">&#xE872;</i></a>
            </td>
        </tr>
    @endforeach

@endsection



@section("order_by_select_options")

    @foreach ($columns as $key => $column)
        <option value="{{$key}}" <?php if ($order_by==$key) echo 'selected';?>>
            {{$column['name']}}
        </option>
    @endforeach

@endsection


@section('pagination')
  {{$all_products->links()}}
@endsection



@section("add_modal_content")
    @include('recursos/formularios/add_products_form')
@endsection

@section("edit_modal_content")
    @include('recursos/formularios/edit_products_form')
@endsection

@section("delete_modal_content")
    @include('recursos/formularios/delete_form')
@endsection
