    <!-- :::::::::::::::::::::::ADD Modal HTML ::::::::::::::::::::::::::::::::-->
    <!-- ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
    <div id="add_modal_form" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST" enctype="multipart/form-data">
                    <!-- ::::::::::::::::::::MODAL HEADER:::::::::::::::::::::: -->
                    <div class="modal-header">
                        <h4 class="modal-title">Agregar Artículo</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <!-- ::::::::::::::::::::MODAL BODY:::::::::::::::::::::: -->
                    <div class="modal-body">
                                        <!-- Id (No editable) -->
                        <div class="form-group">
                            <label class="mb-0 text-right justify-content-end" for="id">
                                Id: </label>
                            <label class="form-control w-100 text-right" id="id">
                                Valor automático </label>
                        </div>
                                        <!-- Título -->
                        <div class="form-group">
                            <label class="mb-0 text-right justify-content-end" for="title">Título: </label>
                            <input class="form-control w-100 text-right" id="title" type="text" name="title">
                        </div>
                                        <!-- Descripción Corta -->
                        <div class="form-group">
                            <label class="mb-0 text-right justify-content-end" for="short_desc">Descripción Corta: </label>
                            <input class="form-control w-100 text-right" id="short_desc" type="text" name="short_desc">
                        </div>
                                        <!-- Descripción Larga -->
                        <div class="form-group">
                            <label class="mb-0 text-right justify-content-end" for="long_desc">Descripción Larga: </label>
                            <input class="form-control w-100 text-right" id="long_desc" type="text" name="long_desc">
                        </div>
                                        <!-- Precio -->
                        <div class="form-group">
                            <label class="mb-0 text-right justify-content-end" for="price">Precio: </label>
                            <input class="form-control w-100 text-right" id="price" type="numeric" name="price">
                        </div>
                                        <!-- Imagen -->
                        <div class="form-group">
                            <label class="mb-0 text-right justify-content-end" for="images">Imagen: </label>
                            <input class="form-control w-100 text-right" id="browse" type="file" name="images" onchange="previewFiles()" multiple><br>
                            <div id="preview"></div>
                        </div>
                                        <!-- Color_id -->
                        <div class="form-group">
                            <label class="mb-0 text-right justify-content-end" for="color_id">Color: </label>
                            <input class="form-control w-100 text-right" id="color_id" type="numeric" name="color_id">
                        </div>
                                        <!-- Size_Id -->
                        <div class="form-group">
                            <label class="mb-0 text-right justify-content-end" for="size_id">Tamaño: </label>
                            <input class="form-control w-100 text-right" id="size_id" type="numeric" name="size_id">
                        </div>
                                        <!-- Stock -->
                        <div class="form-group">
                            <label class="mb-0 text-right justify-content-end" for="stock">Stock: </label>
                            <input class="form-control w-100 text-right" id="stock" type="numeric" name="stock">
                        </div>
                                        <!-- Date Upload -->
                        <div class="form-group">
                            <label class="mb-0 text-right justify-content-end" for="date_upload">Fecha Alta: </label>
                            <input class="form-control w-100 text-right" id="date_upload" type="numeric" name="date_upload">
                        </div>
                                        <!-- Date Update -->
                        <div class="form-group">
                            <label class="mb-0 text-right justify-content-end" for="date_update">Fecha Update: </label>
                            <input class="form-control w-100 text-right" id="date_update" type="numeric" name="date_update">
                        </div>
                                        <!-- Discount Off -->
                        <div class="form-group">
                            <label class="mb-0 text-right justify-content-end" for="discount_off">Descuento %: </label>
                            <input class="form-control w-100 text-right" id="discount_off" type="numeric" name="discount_off">
                        </div>
                                        <!-- Category Id -->
                        <div class="form-group">
                            <label class="mb-0 text-right justify-content-end" for="category_id">Categoría: </label>
                            <input class="form-control w-100 text-right" id="category_id" type="numeric" name="category_id">
                        </div>
                    </div>
                    <!-- ::::::::::::::::::::MODAL FOOTER:::::::::::::::::::::: -->
                    <div class="form-group modal-footer">
                        <button type="submit" class="btn btn-info" name="caller_form" value="add_modal_form">Agregar</button>
                        <button type="reset" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    </div>

                </form>

            </div>
        </div>
    </div>


    <!-- :::::::::::::::::::::::EDIT Modal HTML ::::::::::::::::::::::::::::::::-->
    <!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
    <div class="container">
    <div id="edit_modal_form" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST" enctype="multipart/form-data">

                    <div class="modal-header">
                        <h4 class="modal-title">Editar <?=$titulo?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>

                    <div class="modal-body">
                      <?php foreach ($columnas_modelo as $key => $col): ?>
                          <?php if (($col["input_type"] == "password") || ($col["input_type"] == "image")) continue; ?>

                          <?php if ($col["is_editable"] == false):?>
                            <div class="form-group">
                                <label class="mb-0 text-right justify-content-end" for=<?=$key?>> <?=$col["label_title"]?> </label>
                                <label class="form-control w-75 text-right"><?=$objetoSeleccionado[$key]?></label>
                            </div>
                            <?php continue; ?>
                          <?php endif; ?>

                          <div class="form-group">
                              <label class="mb-0 text-right" for=<?=$key?>> <?=$col["label_title"]?> </label>

                              <?php if ($col["foreign_table"] == ""):?>
                                  <input id=<?=$key?> type=<?=$col["input_type"]?> class="form-control w-75 text-right" name=<?=$key?>>
                              <?php else: ?>
                                  <?php $tbl = $col["foreign_table"];
                                        // $stmt = $dataBase->prepare("SELECT * FROM $tbl");
                                        // $stmt->execute();
                                        // $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        $list = [["id" => "b01","name" => "hal"],["id" => "bols_001","name" => "holaal"],["id" => "","name" => "Selected"],["id" => "cvbc","name" => "holalal"]];
                                      ?>

                                  <?php if ($col["input_type"] == "select"): ?>
                                      <select class="form-control w-75" id=<?=$key?> name=<?=$key?>>
                                          <?php foreach ($list as $fila): ?>
                                            <option value='<?=$fila["id"]?>' <?php if ($fila["id"]==$objetoSeleccionado["id"]) echo "selected";?>> <?=$fila["name"]?></option>
                                          <?php endforeach; ?>
                                      </select>
                                  <?php elseif ($col["input_type"] == "radio"):?>
                                      <?php foreach ($list as $fila): ?>
                                        <input id=<?=$key?> type="radio" name=<?=$key?> value='<?=$fila["id"]?>' <?php if ($fila["id"]==$objetoSeleccionado["id"]) echo "checked";?>> <?=$fila["name"]?>
                                      <?php endforeach; ?>
                                  <?php endif; ?>

                              <?php endif; ?>
                          </div>
                      <?php endforeach; ?>
                    </div>

                    <div class="modal-footer">
                        <!-- <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                        <input type="submit" class="btn btn-info" value="Guardar"> -->

                        <!-- Botón Enviar -->

                            <button type="submit" class="btn btn-info" name="caller_form" value="edit_modal_form">Guardar Cambios</button>
                            <button type="reset" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
    </div>


    <!-- :::::::::::::::::::::::DELETE Modal HTML ::::::::::::::::::::::::::::::::-->
    <!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
    <div id="delete_modal_form" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST" enctype="multipart/form-data">

                    <div class="modal-header">
                        <h4 class="modal-title">Eliminar <?=$titulo?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>

                    <div class="modal-body">
                        <p>¿Estás seguro de querer eliminar estos registros?</p>
                        <p class="text-warning"><small>Esta operación no se puede deshacer.</small></p>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info" name="caller_form" value="delete_modal_form">Eliminar</button>
                        <button type="reset" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
