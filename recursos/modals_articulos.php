<!-- Add Modal HTML -->
<div id="add_modal_form" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST" enctype="multipart/form-data">

                <div class="modal-header">
                    <h4 class="modal-title">Agregar <?=$titulo?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>

                <div class="modal-body">
                  <?php foreach ($columnas_modelo as $key => $col): ?>
                      <div class="form-group">
                          <label for=<?=$key?>> <?=$col["label_title"]?> </label>

                        <?php if ($col["foreign_table"] == ""):?>
                            <input id=<?=$key?> type=<?=$col["input_type"]?> class="form-control" name=<?=$key?>>
                        <?php else: ?>
                            <?php $tbl = $col["foreign_table"];
                                  // $stmt = $dataBase->prepare("SELECT * FROM $tbl");
                                  // $stmt->execute();
                                  // $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                  $list = [["id" => "b01","name" => "hal"],["id" => "bols_001","name" => "holaal"],["id" => "","name" => "Selected"],["id" => "cvbc","name" => "holalal"]];
                                ?>

                            <?php if ($col["input_type"] == "select"): ?>
                                <select id=<?=$key?> name=<?=$key?>>
                                    <?php foreach ($list as $fila): ?>
                                      <option value='<?=$fila["id"]?>'> <?=$fila["name"]?></option>
                                    <?php endforeach; ?>
                                </select>
                            <?php elseif ($col["input_type"] == "radio"):?>
                                <?php foreach ($list as $fila): ?>
                                  <input id=<?=$key?> type="radio" name=<?=$key?> value='<?=$fila["id"]?>'> <?=$fila["name"]?>
                                <?php endforeach; ?>
                            <?php endif; ?>

                        <?php endif; ?>
                      </div>
                  <?php endforeach; ?>
                </div>

                <div class="form-group modal-footer">
                    <!-- <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                    <input type="submit" class="btn btn-success" value="Agregar"> -->
                    <button type="submit" class="btn btn-info" name="caller_form" value="add_modal_form">Agregar</button>
                    <button type="reset" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>

            </form>

        </div>
    </div>
</div>

<div class="container">
<!-- Edit Modal HTML -->
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

<!-- Delete Modal HTML -->
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
