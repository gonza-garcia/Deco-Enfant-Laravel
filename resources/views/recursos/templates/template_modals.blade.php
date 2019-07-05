<!-- :::::::::::::::::::::::::::::::: ADD Modal HTML ::::::::::::::::::::::::::::::::::::-->
<!-- ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
<div id="add_modal_form" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">


        </div>
    </div>
</div>


<!-- :::::::::::::::::::::::::::::::: EDIT Modal HTML :::::::::::::::::::::::::::::::::::-->
<!-- ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
<div class="container">
    <div id="edit_modal_form" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST" enctype="multipart/form-data">
                    <!-- :::::::::::::::::EDIT MODAL HEADER:::::::::::::::::: -->
                    <div class="modal-header">
                        <h4 class="modal-title">Editar @yield('titulo')</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>

                    <!-- :::::::::::::::::EDIT MODAL BODY:::::::::::::::::::: -->
                    <div class="modal-body">
                        @yield('edit_modal_body')
                    </div>

                    <!-- :::::::::::::::::ADD MODAL FOOTER::::::::::::::::::: -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info" name="caller_form" value="edit_modal_form">Guardar Cambios</button>
                        <button type="reset" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>


<!-- :::::::::::::::::::::::::::::::: DELETE Modal HTML :::::::::::::::::::::::::::::::::-->
<!-- ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
<div id="delete_modal_form" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST" enctype="multipart/form-data">
                <!-- ::::::::::::::::DELETE MODAL HEADER::::::::::::::::: -->
                <div class="modal-header">
                    <h4 class="modal-title">Eliminar @yield('titulo')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>

                <!-- ::::::::::::::::DELETE MODAL BODY::::::::::::::::::: -->
                <div class="modal-body">
                    <p>¿Estás seguro de querer eliminar estos registros?</p>
                    <p class="text-warning"><small>Esta operación no se puede deshacer.</small></p>
                </div>

                <!-- ::::::::::::::::DELETE MODAL FOOTER::::::::::::::::: -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info" name="caller_form" value="delete_modal_form">Eliminar</button>
                    <button type="reset" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>

            </form>

        </div>
    </div>
</div>
