<form action="" method="POST" enctype="multipart/form-data">
    <!-- :::::::::::::::::ADD MODAL HEADER::::::::::::::::::: -->
    <div class="modal-header">
        <h4 class="modal-title">Agregar Producto</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    </div>

    <!-- :::::::::::::::::ADD MODAL BODY:::::::::::::::::::: -->
    <div class="modal-body">
                        <!-- Id (No editable) -->
        <div class="form-group">
            <label class="mb-0 text-right justify-content-end" for="id">
                Id: </label>
            <label class="form-control w-100 text-right" id="id">
                Valor automático </label>
        </div>

                        <!-- Name -->
        <div class="form-group">
            <label class="mb-0 text-right justify-content-end" for="name">Título: </label>
            <input class="form-control w-100 text-right" id="name" type="text" name="name">
        </div>

                        <!-- Short_desc -->
        <div class="form-group">
            <label class="mb-0 text-right justify-content-end" for="short_desc">Descripción Corta: </label>
            <input class="form-control w-100 text-right" id="short_desc" type="text" name="short_desc">
        </div>

                        <!-- Long_desc -->
        <div class="form-group">
            <label class="mb-0 text-right justify-content-end" for="long_desc">Descripción Larga: </label>
            <input class="form-control w-100 text-right" id="long_desc" type="text" name="long_desc">
        </div>

                        <!-- Images -->
        <div class="form-group">
            <label class="mb-0 text-right justify-content-end" for="images">Imagen: </label>
            <input class="form-control w-100 text-right" id="browse" type="file" name="images" onchange="previewFiles()" multiple><br>
            <div id="preview"></div>
        </div>

                        <!-- Stock -->
        <div class="form-group">
            <label class="mb-0 text-right justify-content-end" for="stock">Stock: </label>
            <input class="form-control w-100 text-right" id="stock" type="numeric" name="stock">
        </div>

                        <!-- Precio -->
        <div class="form-group">
            <label class="mb-0 text-right justify-content-end" for="price">Precio: </label>
            <input class="form-control w-100 text-right" id="price" type="numeric" name="price">
        </div>

                        <!-- Discount -->
        <div class="form-group">
            <label class="mb-0 text-right justify-content-end" for="discount">Descuento: </label>
            <input class="form-control w-100 text-right" id="discount" type="numeric" name="discount">
        </div>

                        <!-- Color_id (Foránea)-->
        <div class="form-group">
            <label class='mb-0 text-right justify-content-end' for='color_id'>Color: </label>
            <select class="form-control w-75" id='color_id' name='color_id'>
                @foreach ($all_colors as $color)
                    <option value={{$color->id}}>
                        {{$color->name}}
                    </option>
                @endforeach
            </select>
            <button>Nuevo</button>
        </div>

                        <!-- Size_Id (Foránea)-->
        <div class="form-group">
            <label class="mb-0 text-right justify-content-end" for="size_id">Tamaño: </label>
            <select class="form-control w-75" id='size_id' name='size_id'>
                @foreach ($all_sizes as $size)
                    <option value={{$size->id}}>
                        {{$size->name}}
                    </option>
                @endforeach
            </select>
            <button>Nuevo</button>
        </div>

                        <!-- Category_id (Foránea) -->
        <div class="form-group">
            <label class="mb-0 text-right justify-content-end" for="category_id">Categoría: </label>
            <select class="form-control w-75" id='category_id' name='category_id'>
                @foreach ($all_categories as $cat)
                    <option value={{$cat->id}}>
                        {{$cat->name}}
                    </option>
                @endforeach
            </select>
            <button>Nuevo</button>
        </div>

                        <!-- Sub-Category_id (No existe en la db como una tabla aparte, es creada de la misma tabla de Categorias)-->
        <div class="form-group">
            <label class="mb-0 text-right justify-content-end" for="sub_category_id">Sub-Categoría: </label>
            <select class="form-control w-75" id='sub_category_id' name='sub_category_id'>
                @foreach ($all_sub_categories as $sub_cat)
                    <option value={{$sub_cat->id}}>
                        {{$sub_cat->name}}
                    </option>
                @endforeach
            </select>
            <button>Nuevo</button>
        </div>
    </div>

                <!-- Created_at -->
    <div class="form-group">

    </div>

                <!-- Updated_at -->
    <div class="form-group">

    </div>

    <!-- :::::::::::::::::ADD MODAL FOOTER::::::::::::::::::: -->
    <div class="form-group modal-footer">
        <button type="submit" class="btn btn-info" name="caller_form" value="add_product_form">Agregar</button>
        <button type="reset" class="btn btn-default" data-dismiss="modal">Cancelar</button>
    </div>
</form>
