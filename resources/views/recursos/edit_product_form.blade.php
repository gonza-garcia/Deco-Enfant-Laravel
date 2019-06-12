<form action="" method="POST" enctype="multipart/form-data">
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
            <label class="form-control w-75 text-right">{{$producto->id}}</label>
        </div>

                    <!-- Name -->
        <div class="form-group">
            <label class='mb-0 text-right justify-content-end' for='name'>Nombre</label>
            <input id='name' type='text' name='name' class='form-control w-75 text-right'>
        </div>

                    <!-- Short_desc -->
        <div class="form-group">

        </div>

                    <!-- Long_desc -->
        <div class="form-group">

        </div>

                    <!-- Images -->
        <div class="form-group">

        </div>

                    <!-- Stock -->
        <div class="form-group">

        </div>

                    <!-- Price -->
        <div class="form-group">

        </div>

                    <!-- Discount -->
        <div class="form-group">

        </div>

                    <!-- Color_id  (Foránea)-->
        <div class="form-group">
            <label class='mb-0 text-right justify-content-end' for='color_id'>Color</label>
            <select class="form-control w-75" id='color_id' name='color_id'>
                @foreach ($all_colors as $color)
                    <option value={{$color->id}}
                        @if ($color->id == $producto->color_id) {{'selected'}} @endif>
                        {{$color->name}}
                    </option>
                @endforeach
            </select>
            <button>Nuevo</button>
        </div>

                    <!-- Size_id  (Foránea)-->
        <div class="form-group">
            <label class='mb-0 text-right justify-content-end' for='color_id'>Color</label>
            <select class="form-control w-75" id='color_id' name='color_id'>
                @foreach ($all_colors as $color)
                    <option value={{$color->id}}
                        @if ($color->id == $producto->color_id) {{'selected'}} @endif>
                        {{$color->name}}
                    </option>
                @endforeach
            </select>
            <button>Nuevo</button>
        </div>

                    <!-- Category_id (Foránea) -->
        <div class="form-group">

        </div>

                    <!-- Sub-Category_id (No existe en la db como una tabla aparte, es creada de la misma tabla de Categorias)-->
        <div class="form-group">

        </div>

                    <!-- Created_at -->
        <div class="form-group">

        </div>

                    <!-- Updated_at -->
        <div class="form-group">

        </div>

    </div>

    <!-- :::::::::::::::::::::FORM FOOTER:::::::::::::::::::::: -->
    <div class="form-group modal-footer">
        <button type="submit" class="btn btn-info" name="caller_form" value="edit_product_form">Editar</button>
        <button type="reset" class="btn btn-default" data-dismiss="modal">Cancelar</button>
    </div>
</form>
