<?php

    require_once "./recursos/pdo.php";
    // require_once "./recursos/funciones.php";
    require_once "init.php";

    global $dbMysql;

    $product_columns = ["id"             => "Id",
                        "name"          => "Título",
                        "short_desc"     => "Descripción Corta",
                        "long_desc"      => "Descripción Larga",
                        "price"          => "Precio",
                        "thumbnail"      => "Imagen",
                        "color_id"       => "Color",
                        "size_id"        => "Tamaño",
                        "stock"          => "Stock",
                        "date_upload"     => "Fecha Alta",
                        "date_update"     => "Fecha Update",
                        "discount_off"    => "Descuento %",
                        "category_id"   => "Categoría",
  ];

    $order_by = "id";
    $order_how = "ASC";
    $limit = 20;

    if ($_GET)
    {
        switch ($GET) {
          case 'value':
            // code...
            break;

          default:
            // code...
            break;
        }

    }

    // Traer todas las filas
    $stmt = $db->prepare("SELECT * FROM products ORDER BY $order_by $order_how LIMIT $limit");
    $stmt->execute();
    $all_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // $all_rows = $dbMysql->buscarTodosArticulos();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>Dèco Enfant</title>

    <?php include("./recursos/head.php") ?>

</head>

<body>

    <!-- HEADER y NAVBAR DE MENUS------------------------------>
    <?php include("./recursos/header.php") ?>

    <!-- Tabla de Artículos -->
    <div class="container table-container">
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
                            <form action="./articulos.php" method="GET" enctype="multipart/form-data">
                                <label>Ordenar por</label>
                                <input name=<?="limit=$limit"?> class="d-none" type="text">
                                <select class="form-control" name="order_by">
                                    <?php foreach ($columns as $key => $col) : ?>
                                        <option value=<?=$key?>><?=$col?></option>
                                    <?php endforeach; ?>
                                </select>
                                <input type="radio" name="order_how" value="ASC">Ascendente
                                <input type="radio" name="order_how" value="DESC">Descendente
                                <button type="submit" class="btn btn-info" name="caller_form" value="order_form">Ordenar</button>
                            </form>
                        </div>

                        <div class="filter-group">
                            <label>Orden</label>
                            <select class="form-control">
                                <option>Ascendente</option>
                                <option>Descendente</option>
                            </select>
                        </div>
                        <span class="filter-icon"><i class="fa fa-filter"></i></span>
                    </div>
                </div>
            </div>

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th style="width: 2.50%;">
                            <span class="custom-checkbox">
                                <input type="checkbox" id="selectAll">
                                <label for="selectAll"></label>
                            </span>
                        </th>



                        <th style="width: 2.00%;"> Id</th>
                        <th style="width: 7.00%;"> Título</th>
                        <th style="width: 13.0%;"> Descripción Corta</th>
                        <th style="width: 13.0%;"> Descripción Larga</th>
                        <th style="width: 4.00%;"> Precio</th>
                        <th style="width: 2.50%;"> Imagen</th>
                        <th style="width: 5.00%;"> Color</th>
                        <th style="width: 5.00%;"> Tamaño</th>
                        <th style="width: 2.00%;"> Stock</th>
                        <th style="width: 2.00%;"> Vendidos</th>
                        <th style="width: 6.50%;"> Fecha Alta</th>
                        <th style="width: 6.50%;"> Fecha Update</th>
                        <th style="width: 2.50%;"> Sale</th>
                        <th style="width: 3.00%;"> Precio Con Descuento</th>
                        <th style="width: 2.50%;"> Descuento %</th>
                        <th style="width: 5.00%;"> Categoría</th>

                        <th style="width: 5.00%;">Acciones</th>
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

                          <td> <b><?=$row["id"]?></b>       </td>
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
                          <td id="acciones">
    							            <a href="#" class="view" title="Ver" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
                              <a href="#edit_modal_form" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Editar">&#xE254;</i></a>
                              <a href="#delete_modal_form" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Eliminar">&#xE872;</i></a>
                          </td>
                      </tr>
                    <?php endforeach; ?>

                </tbody>

            </table>

            <div class="table-footer">
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

    </div>         <!-- end table-wrapper -->


    <!-- FOOTER ----------------------------------------------->
    <?php include("./recursos/footer.php") ?>

    <!-- MODALS------------------------------------------------>
    <?php include("./recursos/modals_articulos.php") ?>

    <!-- SCRIPTS DE JAVA & BOOTSTRAP-------------------------->
    <?php include("./recursos/scriptsJava.php") ?>


</body>

</html>
