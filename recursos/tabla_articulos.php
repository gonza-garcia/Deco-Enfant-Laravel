<?php

    require_once "pdo.php";
    require_once "funciones.php";

    // Traer todas las filas
    $stmt = $db->prepare("SELECT * FROM products");
    $stmt->execute();
    $all_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>


<!-- Tabla de Artículos -->
<div class="container">
    <div class="table-wrapper">

        <div class="table-title">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Administrar <b>Artículos</b></h2>
                </div>
                <div class="col-sm-6">
                    <a href="#add_modal_form" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Agregar</span></a>
                    <a href="#delete_modal_form" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Eliminar</span></a>
                </div>
            </div>
        </div>

        <div class="table-filter">
            <div class="row">
                <div class="col-sm-3">

                </div>

                <div class="col-sm-9">
                    <div class="filter-group">
                      <div class="search-box">
                          <i class="material-icons">&#xE8B6;</i>
                          <input type="text" class="form-control" placeholder="Buscar&hellip;">
                      </div>
                    </div>
                    <div class="filter-group">
                        <label>Location</label>
                        <select class="form-control">
                            <option>All</option>
                            <option>Berlin</option>
                            <option>London</option>
                            <option>Madrid</option>
                            <option>New York</option>
                            <option>Paris</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label>Status</label>
                        <select class="form-control">
                            <option>Any</option>
                            <option>Delivered</option>
                            <option>Shipped</option>
                            <option>Pending</option>
                            <option>Cancelled</option>
                        </select>
                    </div>
                    <span class="filter-icon"><i class="fa fa-filter"></i></span>
                </div>
            </div>
        </div>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>
                      <span class="custom-checkbox">
                          <input type="checkbox" id="selectAll">
                          <label for="selectAll"></label>
                      </span>
                    </th>

                    <th>Id</th>
                    <th>Título</th>
                    <th>Descripción Corta</th>
                    <th>Descripción Larga</th>
                    <th>Precio</th>
                    <th>Imagen</th>
                    <th>Color</th>
                    <th>Tamaño</th>
                    <th>Stock</th>
                    <th>Vendidos</th>
                    <th>Fecha De Alta</th>
                    <th>Fecha De Update</th>
                    <th>Sale</th>
                    <th>Precio Con Descuento</th>
                    <th>Descuento %</th>
                    <th>Categoría</th>

                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($all_rows as $row) :?>
                  <tr>

                                <!-- td Checkbox -->
                      <td>
                          <span class="custom-checkbox">
                              <input type="checkbox" id="checkbox1" name="options[]" value="1">
                              <label for="checkbox1"></label>
                          </span>
                      </td>

                      <td> <?=$row["id"]?>              </td>
                      <td> <?=$row["title"]?>           </td>
                      <td> <?=$row["short_desc"]?>      </td>
                      <td> <?=$row["long_desc"]?>       </td>
                      <td> <?=$row["price"]?>           </td>

                                <!-- td Imagen -->
                      <td> <a href=<?=$row["thumbnail"]?> class="view" title=<?=$row["thumbnail"]?> data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
                      </td>

                                <!-- td Color -->
                      <td> <?php
                              $stmt = $db->prepare("SELECT name FROM colors WHERE id=:id");
                              $stmt->bindValue(":id", $row["color_id"]);
                              $stmt->execute();
                              $color=$stmt->fetch(PDO::FETCH_ASSOC);
                              echo $color["name"];
                            ?>
                      </td>
                                <!-- td Tamaño -->
                      <td> <?php
                              $stmt = $db->prepare("SELECT name FROM sizes WHERE id=:id");
                              $stmt->bindValue(":id", $row["size_id"]);
                              $stmt->execute();
                              $size=$stmt->fetch(PDO::FETCH_ASSOC);
                              echo $size["name"];
                            ?>
                      </td>

                      <td> <?=$row["stock"]?>           </td>
                      <td> <?=$row["sold"]?>            </td>
                      <td> <?=$row["dateUpload"]?>      </td>
                      <td> <?=$row["dateUpdate"]?>      </td>
                      <td> <?=$row["sale"]?>            </td>
                      <td> <?=$row["discount_price"]?>  </td>
                      <td> <?=$row["discountOff"]?>     </td>

                                <!-- td Categoría -->
                      <td> <?php
                              $stmt = $db->prepare("SELECT name FROM categories WHERE id=:id");
                              $stmt->bindValue(":id", $row["categoria_id"]);
                              $stmt->execute();
                              $cat=$stmt->fetch(PDO::FETCH_ASSOC);
                              echo $cat["name"];
                            ?>
                      </td>

                                <!-- td Acciones -->
                      <td>
                          <a href="#edit_modal_form" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Editar">&#xE254;</i></a>
                          <a href="#delete_modal_form" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Eliminar">&#xE872;</i></a>
                      </td>
                  </tr>
                <?php endforeach; ?>

            </tbody>

        </table>

        <div class="clearfix">
            <div class="show-entries">
                <span>Mostrando</span>
                <select class="p-0">
                    <option>5</option>
                    <option>10</option>
                    <option>15</option>
                    <option>20</option>
                </select>
                <span>de <b><?=count($all_rows)?></b> entradas</span>
            </div>

            <ul class="pagination">
                <li class="page-item disabled"><a href="#">Anterior</a></li>
                <li class="page-item active"><a href="#" class="page-link">1</a></li>
                <li class="page-item"><a href="#" class="page-link">2</a></li>
                <li class="page-item"><a href="#" class="page-link">3</a></li>
                <li class="page-item"><a href="#" class="page-link">4</a></li>
                <li class="page-item"><a href="#" class="page-link">5</a></li>
                <li class="page-item"><a href="#" class="page-link">Siguiente</a></li>
            </ul>
        </div>
    </div>

    <!-- end table-wrapper -->
</div>



<!-- FOOTER -------------------------------------------------------->
<?php include("recursos/footer.php") ?>


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
                    <!-- <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                    <input type="submit" class="btn btn-danger" value="Borrar"> -->
                    <button type="submit" class="btn btn-info" name="caller_form" value="delete_modal_form">Eliminar</button>
                    <button type="reset" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>

            </form>

        </div>
    </div>
</div>
