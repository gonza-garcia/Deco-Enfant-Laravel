<form id='edit_users_form' action='/usuario/edit/' method="POST" enctype="multipart/form-data">
  @csrf
    <!-- ::::::::::::::::::::::FORM HEADER::::::::::::::::::::: -->
    <div class="modal-header">
        <h4 class="modal-title">Editar Usuario</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    </div>

    <!-- ::::::::::::::::::::::FORM BODY::::::::::::::::::::::: -->
    <div class="modal-body">
                    <!-- Id (No editable) -->
        <div class="form-group">
            <label class='mb-0 text-right justify-content-end' for='id'>Id</label>
            <label class="campo_no_editable form-control w-100 text-right"></label>
        </div>

                    <!-- User_name -->
        <div class="form-group">
            <label class='mb-0 text-right justify-content-end' for='username'>Nombre de usuario</label>
            <input type='text' name='username' value="" class='campo_editable form-control w-100 text-right'>
        </div>

                    <!-- First_name -->
        <div class="form-group">
            <label class='mb-0 text-right justify-content-end' for='first_name'>Nombre</label>
            <input type='text' name='first_name' value="" class='campo_editable form-control w-100 text-right'>
        </div>

                    <!-- Last_name -->
        <div class="form-group">
            <label class='mb-0 text-right justify-content-end' for='last_name'>Apellido</label>
            <input type='text' name='last_name' value="" class='campo_editable form-control w-100 text-right'>
        </div>

                    <!-- Email (No editable) -->
        <div class="form-group">
            <label class='mb-0 text-right justify-content-end' for='email'>Email</label>
            <label class="campo_no_editable form-control w-100 text-right"></label>
        </div>

                    <!-- Password -->
        <div class="form-group">
            <label class='mb-0 text-right justify-content-end' for='name'>Apellido</label>
            <input type='text' name='last_name' value="" class='campo_editable form-control w-100 text-right'>
        </div>

                <!-- Phone -->
        <div class="form-group">
            <label class='mb-0 text-right justify-content-end' for='phone'>Teléfono</label>
            <input type='text' name='phone' value="" class='campo_editable form-control w-100 text-right'>
        </div>

        <!-- Date_of_birth -->
        <div class="form-group">
            <label class='mb-0 text-right justify-content-end' for='date_of_birth'>Fecha De Nacimiento</label>
            <input type='text' name='date_of_birth' value="" class='campo_editable form-control w-100 text-right'>
        </div>

                <!-- Province_id (Foránea) -->
        <div class="form-group">
            <label class='mb-0 text-right justify-content-end' for='province_id'>Provincia</label>
            <select class="campo_editable form-control w-100" id='province_id' name='province_id' value="">
                @foreach ($all_provinces as $prov)
                    <option value={{$prov->id}}
                        @if ($prov->id == $product->province_id) {{'selected'}} @endif>
                        {{$prov->name}}
                    </option>
                @endforeach
            </select>
        </div>

                    <!-- Sex_id (Foránea) -->
        <div class="form-group">
            <label class='mb-0 text-right justify-content-end' for='sex_id'>Sexo</label>
            <select class="campo_editable form-control w-100" id='sex_id' name='sex_id' value="">
                @foreach ($all_sexes as $sex)
                    <option value={{$sex->id}}
                        @if ($sex->id == $product->sex_id) {{'selected'}} @endif>
                        {{$sex->name}}
                    </option>
                @endforeach
            </select>
        </div>

                    <!-- Role_id (Foránea) -->
        <div class="form-group">
            <label class='mb-0 text-right justify-content-end' for='role_id'>Rol</label>
            <select class="campo_editable form-control w-100" id='role_id' name='role_id' value="">
                @foreach ($all_roles as $rol)
                    <option value={{$rol->id}}
                        @if ($rol->id == $product->role_id) {{'selected'}} @endif>
                        {{$rol->name}}
                    </option>
                @endforeach
            </select>
        </div>
                <!-- User_status_id (Foránea) -->
        <div class="form-group">
            <label class='mb-0 text-right justify-content-end' for='user_status_id'>Estado</label>
            <select class="campo_editable form-control w-100" id='user_status_id' name='user_status_id' value="">
                @foreach ($all_users_statuses as $status)
                    <option value={{$status->id}}
                        @if ($status->id == $product->user_status_id) {{'selected'}} @endif>
                        {{$status->name}}
                    </option>
                @endforeach
            </select>
        </div>


    </div>

    <!-- :::::::::::::::::::::FORM FOOTER:::::::::::::::::::::: -->
    <div class="form-group modal-footer">
        <button type="submit" class="btn btn-info" name="caller_form" value="edit_user_form">Editar</button>
        <button type="reset" class="btn btn-default" data-dismiss="modal">Cancelar</button>
    </div>
</form>
