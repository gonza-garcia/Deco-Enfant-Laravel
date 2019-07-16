<form id='edit_products_form' action='/producto/edit/' method="POST" enctype="multipart/form-data">
  @csrf
    <!-- ::::::::::::::::::::::FORM HEADER::::::::::::::::::::: -->
    <div class="modal-header">
        <h4 class="modal-title">Editar Producto</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    </div>

    <!-- ::::::::::::::::::::::FORM BODY::::::::::::::::::::::: -->
    <div class="modal-body">
                    <!-- Id (No editable) -->
        <div class="form-group">
            <label class='mb-0 text-right justify-content-end' for='id'>Id</label>
            <label class="campo_no_editable form-control w-100 text-right"></label>
        </div>

                    <!-- Name -->
        <div class="form-group">
            <label class='mb-0 text-right justify-content-end' for='name'>Nombre</label>
            <input type='text' name='name' value="" class='campo_editable form-control w-100 text-right'>
        </div>

                    <!-- Short_desc -->
        <div class="form-group">
            <label class='mb-0 text-right justify-content-end' for='short_desc'>Descripción Corta</label>
            <input type='text' name='short_desc' value="" class='campo_editable form-control w-100 text-right'>
        </div>

                    <!-- Long_desc -->
        <div class="form-group">
            <label class='mb-0 text-right justify-content-end' for='long_desc'>Descripción Larga</label>
            <input type='text' name='long_desc' value="" class='campo_editable form-control w-100 text-right'>
        </div>

                    <!-- Price -->
        <div class="form-group">
            <label class='mb-0 text-right justify-content-end' for='price'>Precio</label>
            <input type='text' name='price' value="" class='campo_editable form-control w-100 text-right'>
        </div>

                    <!-- Thumbnail -->
        <div class="form-group">
          <label class="mb-0 text-right justify-content-end" for="images">Imagen: </label>
          <input class="form-control w-100 text-right" id="browseForEdit" type="file" name="thumbnail" value="" onchange="previewFileForEdit()" multiple><br>
          <div><img id='previewForEdit' class="img-fluid" src="" height="200" alt="Image preview..."></div>
        </div>

                    <!-- Stock -->
        <div class="form-group">
            <label class='mb-0 text-right justify-content-end' for='stock'>Stock</label>
            <input type='text' name='stock' value="" class='campo_editable form-control w-100 text-right'>
        </div>

                    <!-- Discount -->
        <div class="form-group">
            <label class='mb-0 text-right justify-content-end' for='discount'>Descuento</label>
            <input type='text' name='discount' value="" class='campo_editable form-control w-100 text-right'>
        </div>

                <!-- Color_id  (Foránea)-->
        <div class="form-group">
            <label class='mb-0 text-right justify-content-end' for='color_id'>Color</label>
            <select class="campo_editable form-control w-100" id='color_id' name='color_id' value="">
                @foreach ($all_colors as $color)
                    <option value={{$color->id}}
                        @if ($color->id == $product->color_id) {{'selected'}} @endif>
                        {{$color->name}}
                    </option>
                @endforeach
            </select>
        </div>

                    <!-- Size_id  (Foránea)-->
        <div class="form-group">
            <label class='mb-0 text-right justify-content-end' for='size_id'>Color</label>
            <select class="campo_editable form-control w-100" id='size_id' name='size_id' value="" >
                @foreach ($all_sizes as $size)
                    <option value={{$size->id}}
                        @if ($size->id == $product->size_id) {{'selected'}} @endif>
                        {{$size->name}}
                    </option>
                @endforeach
            </select>
        </div>

                    <!-- Subcategoría-->
        <div class="form-group">
            <label class='mb-0 text-right justify-content-end' for='subcategory_id'>Subcategoría</label>
            <select class="campo_editable form-control w-100" id='subcategory_id' name='subcategory_id' value="" >
                @foreach ($all_subcategories as $subcat)
                    <option value={{$subcat->id}}
                        @if ($subcat->id == $product->subcategory_id) {{'selected'}} @endif>
                        {{$subcat->name}}
                    </option>
                @endforeach
            </select>
        </div>


    </div>

    <!-- :::::::::::::::::::::FORM FOOTER:::::::::::::::::::::: -->
    <div class="form-group modal-footer">
        <button type="submit" class="btn btn-info" name="caller_form" value="edit_product_form">Editar</button>
        <button type="reset" class="btn btn-default" data-dismiss="modal">Cancelar</button>
    </div>
</form>
