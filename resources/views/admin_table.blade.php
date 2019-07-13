@extends("recursos/templates/template_table")

@php
    // $stmt-withPath('?order_by='.$_GET[])
@endphp

@section("titulo_objeto")
    Productoshjnnmjhn
@endsection


@section("table_headers")
    <!-- Invertir el orden actual para pasarlo como parametro por get cuando se haga click en los links siguientes -->
      <?php if ($order_how=="ASC") $new_order="DESC";
            else                   $new_order="ASC"; ?>

    <!-- Header Id:::: -->
    <th style="width: 2.00%;"><a href=<?="articulos.php?order_by=id&order_how=$new_order&limit=$limit&page=$page"?>>Id</a></th>
    <th style="width: 2.00%;"><a href="{{productos}}/">Id</a></th>

    <!-- Header Descripcion Corta:::: -->
    <th style="width: 13.5%;"><a href=<?="articulos.php?order_by=short_desc&order_how=$new_order&limit=$limit&page=$page"?>>Descripción Corta</a></th>
    <!-- Header Descripción Larga -->
    <th style="width: 13.5%;"><a href=<?="articulos.php?order_by=long_desc&order_how=$new_order&limit=$limit&page=$page"?>>Descripción Larga</a></th>
    <!-- Header Precio -->
    <th style="width: 4.00%;"><a href=<?="articulos.php?order_by=price&order_how=$new_order&limit=$limit&page=$page"?>>Precio</a></th>
    <!-- Header Imagen -->
    <th style="width: 2.50%;"><a href=<?="articulos.php?order_by=thumbnail&order_how=$new_order&limit=$limit&page=$page"?>>Imagen</a></th>
    <!-- Header Stock -->
    <th style="width: 2.00%;"><a href=<?="articulos.php?order_by=stock&order_how=$new_order&limit=$limit&page=$page"?>>Stock</a></th>
    <!-- Header Descuento -->
    <th style="width: 2.50%;"><a href=<?="articulos.php?order_by=discount_off&order_how=$new_order&limit=$limit&page=$page"?>>Descuento</a></th>
    <!-- Header Tamaño -->
    <th style="width: 5.00%;"><a href=<?="articulos.php?order_by=size_id&order_how=$new_order&limit=$limit&page=$page"?>>Tamaño</a></th>
    <!-- Header Color -->
    <th style="width: 5.00%;"><a href=<?="articulos.php?order_by=color_id&order_how=$new_order&limit=$limit&page=$page"?>>Color</a></th>
    <!-- Header Categoría -->
    <th style="width: 5.00%;"><a href=<?="articulos.php?order_by=category_id&order_how=$new_order&limit=$limit&page=$page"?>>Categoría</a></th>
    <!-- Header Sub-Categoría -->
    <th style="width: 5.00%;"><a href=<?="articulos.php?order_by=category_id&order_how=$new_order&limit=$limit&page=$page"?>>Sub-Categoría</a></th>
    <!-- Header Creado -->
    <th style="width: 6.50%;"><a href=<?="articulos.php?order_by=date_upload&order_how=$new_order&limit=$limit&page=$page"?>>Fecha Alta</a></th>
    <!-- Header Actualizado -->
    <th style="width: 6.50%;"><a href=<?="articulos.php?order_by=date_update&order_how=$new_order&limit=$limit&page=$page"?>>Fecha Update</a></th>
    <!-- Header Borrado -->
    <th style="width: 6.50%;"><a href=<?="articulos.php?order_by=date_update&order_how=$new_order&limit=$limit&page=$page"?>>Fecha Update</a></th>
@endsection




@section("table_rows")

    @foreach ($all_products as $product)
        <tr>
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
            <td> <a href={{$product->thumbnail}} class="view" title={{$product->thumbnail}} data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a></td>

  <!-- Celda Color -->
            <td> {{(DB::select("SELECT name FROM colors WHERE id=:color_id", ['color_id' => $product->color_id]))[0]->name}} </td>

  <!-- Celda Tamaño -->
            <td> {{(DB::select("SELECT name FROM sizes WHERE id=:size_id", ['size_id' => $product->size_id]))[0]->name}} </td>

  <!-- Celda Stock -->
            <td> {{$product->stock}} </td>

  <!-- Celda Fecha De Alta -->
            <td> {{(DateTime::createFromFormat('Y-m-d H:i:s', $product->created_at))->format('d-m-Y')}} </td>

  <!-- Celda Fecha de Update -->
            <td> {{(DateTime::createFromFormat('Y-m-d H:i:s', $product->updated_at))->format('d-m-Y')}} </td>

  <!-- Celda Descuento % -->
            <td> {{$product->discount}} </td>

  <!-- Celda Categoría -->
            <td> {{(DB::select("SELECT x.name FROM categories as x INNER JOIN (SELECT * FROM categories WHERE id = :cat_id) as y WHERE x.id=y.id_parent", ['cat_id' => $product->subcategory_id]))[0]->name}} </td>

  <!-- Celda Sub_Categoría -->
            <td> {{(DB::select("SELECT name FROM categories WHERE id=:cat_id", ['cat_id' => $product->subcategory_id]))[0]->name}} </td>

  <!-- Celda Acciones -->
            <td id="acciones">
  	            <a href="#" class="view" title="Ver" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
                <a href="#edit_modal_form" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Editar">&#xE254;</i></a>
                <a href="#delete_modal_form" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Eliminar">&#xE872;</i></a>
            </td>
        </tr>
    @endforeach

@endsection




@section("order_by_select_options")
    <option value="id" <?php if ($order_by=="id") echo 'selected';?>><a href= <?="articulos.php?order_by=id&order_how=$order_how&limit=$limit&page=$page"?>>Id</a></option>
    <option value="name" <?php if ($order_by=="name") echo 'selected';?>><a href= <?="articulos.php?order_by=name&order_how=$order_how&limit=$limit&page=$page"?>>Título</a></option>
    <option value="short_desc" <?php if ($order_by=="short_desc") echo 'selected';?>><a href= <?="articulos.php?order_by=short_desc&order_how=$order_how&limit=$limit&page=$page"?>>Descripción Corta</a></option>
    <option value="long_desc" <?php if ($order_by=="long_desc") echo 'selected';?>><a href= <?="articulos.php?order_by=long_desc&order_how=$order_how&limit=$limit&page=$page"?>>Descripción Larga</a></option>
    <option value="price" <?php if ($order_by=="price") echo 'selected';?>><a href= <?="articulos.php?order_by=price&order_how=$order_how&limit=$limit&page=$page"?>>Precio</a></option>
    <option value="thumbnail" <?php if ($order_by=="thumbnail") echo 'selected';?>><a href= <?="articulos.php?order_by=thumbnail&order_how=$order_how&limit=$limit&page=$page"?>>Imagen</a></option>
    <option value="color_id" <?php if ($order_by=="color_id") echo 'selected';?>><a href= <?="articulos.php?order_by=color_id&order_how=$order_how&limit=$limit&page=$page"?>>Color</a></option>
    <option value="size_id" <?php if ($order_by=="size_id") echo 'selected';?>><a href= <?="articulos.php?order_by=size_id&order_how=$order_how&limit=$limit&page=$page"?>>Tamaño</a></option>
    <option value="date_upload" <?php if ($order_by=="date_upload") echo 'selected';?>><a href= <?="articulos.php?order_by=date_upload&order_how=$order_how&limit=$limit&page=$page"?>>Fecha Alta</a></option>
    <option value="date_update" <?php if ($order_by=="date_update") echo 'selected';?>><a href= <?="articulos.php?order_by=date_update&order_how=$order_how&limit=$limit&page=$page"?>>Fecha Update</a>/option>
    <option value="discount_off" <?php if ($order_by=="discount_off") echo 'selected';?>><a href= <?="articulos.php?order_by=discount_off&order_how=$order_how&limit=$limit&page=$page"?>>Descuento</a>/option>
    <option value="category_id" <?php if ($order_by=="category_id") echo 'selected';?>><a href= <?="articulos.php?order_by=category_id&order_how=$order_how&limit=$limit&page=$page"?>>Categoría</a></option>
    <option value="subcategory_id" <?php if ($order_by=="subcategory_id") echo 'selected';?>><a href= <?="articulos.php?order_by=subcategory_id&order_how=$order_how&limit=$limit&page=$page"?>>Sub-Categoría</a></option>
@endsection






@section("modals")

    @include("modals_products");

@endsection {{-- modals --}}
