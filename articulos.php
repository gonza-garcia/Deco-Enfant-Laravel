<?php

    require_once "./recursos/pdo.php";
    require_once "./recursos/funciones.php";

    $product_columns = ["id"             => "Id",
                        "title"          => "Título",
                        "short_desc"     => "Descripción Corta",
                        "long_desc"      => "Descripción Larga",
                        "price"          => "Precio",
                        "thumbnail"      => "Imagen",
                        "color_id"       => "Color",
                        "size_id"        => "Tamaño",
                        "stock"          => "Stock",
                        "date_upload"    => "Fecha Alta",
                        "date_update"    => "Fecha Update",
                        "discount_off"   => "Descuento %",
                        "category_id"    => "Categoría",
    ];
    $limit_options=[5, 10, 20, 50, 100, 200, 500];
    $order_how_options=["ASC", "DESC"];

    $stmt = $db->prepare("SELECT COUNT(*) FROM products");
    $stmt->execute();

    $order_by = "id";     //valores que va a tomar la tabla por defecto
    $order_how = "ASC";
    $limit = 20;
    $page = 1;
    $offset = 0;
    $total_rows = $stmt->fetch(PDO::FETCH_ASSOC);
    $pages_qty = ceil($total_rows / $limit);


    if ((isset($_GET["order_by"]) && array_key_exists($_GET["order_by"],$product_columns))
        && (isset($_GET["order_how"]) && existeEnArray($_GET["order_how"],$order_how_options))
        && (isset($_GET["limit"]) && existeEnArray($_GET["limit"],$limit_options))
        && (isset($_GET["page"]) && is_numeric($_GET["page"])))
    {
        $order_by = $_GET["order_by"];
        $order_how = $_GET["order_how"];
        $limit = $_GET["limit"];
        $page = round($_GET["page"]);

        // setea offset de acuerdo al valor de page y limit
        if ($page<=1)
            $offset = 0;
        elseif ($page >= $pages_qty)
            $offset = $limit * ($pages_qty - 1);
        else
            $offset = $limit * ($page - 1);
    }

    // Traer todas las filas
    $stmt = $db->prepare("SELECT * FROM products ORDER BY $order_by $order_how LIMIT $limit OFFSET $offset");
    $stmt->execute();
    $all_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);



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
                            <label>Ordenar por</label>
                            <select class="form-control" name="order_by">
                                <?php foreach ($product_columns as $key => $col) : ?>
                                    <option value=<?=$key?> <?php if ($key==$order_by) echo 'selected';?>>
                                        <a href= <?="articulos.php?order_by=$key&order_how=$order_how&limit=$limit"?>>
                                            <?=$col?>
                                        </a>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="filter-group">
                            <label>Orden</label>
                            <select class="form-control">
                                <option value="ASC">
                                    <a href= <?="articulos.php?order_by=$order_by&order_how=ASC&limit=$limit"?>>
                                        Ascendente
                                    </a>
                                </option>
                                <option value="DESC">
                                    <a href= <?="articulos.php?order_by=$order_by&order_how=DESC&limit=$limit"?>>
                                        Descendente
                                    </a>
                                </option>
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
                        <th style="width: 16.5%;"> Descripción Corta</th>
                        <th style="width: 16.5%;"> Descripción Larga</th>
                        <th style="width: 4.00%;"> Precio</th>
                        <th style="width: 2.50%;"> Imagen</th>
                        <th style="width: 5.00%;"> Color</th>
                        <th style="width: 5.00%;"> Tamaño</th>
                        <th style="width: 2.00%;"> Stock</th>
                        <th style="width: 6.50%;"> Fecha Alta</th>
                        <th style="width: 6.50%;"> Fecha Update</th>
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

                                    <!-- td Fecha De Alta -->
                          <td> <?php
                                  $date = DateTime::createFromFormat('Y-m-d H:i:s', $row["date_upload"]);
                                  echo $date->format('d-m-Y');
                               ?>
                          </td>

                                    <!-- td Fecha De Update -->
                          <td> <?php
                                  $date = DateTime::createFromFormat('Y-m-d H:i:s', $row["date_update"]);
                                  echo $date->format('d-m-Y');
                               ?>
                          </td>

                          <td> <?=$row["discount_off"]?>     </td>

                                    <!-- td Categoría -->
                          <td> <?php
                                  $stmt = $db->prepare("SELECT name FROM categories WHERE id=:id");
                                  $stmt->bindValue(":id", $row["category_id"]);
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
                      <?php foreach ($limit_options as $value) : ?>
                        <option value=<?=$value?> <?php if ($value==$limit) echo 'selected';?>>
                            <a href=<?="./articulos.php?order_by=$order_by&order_how=$order_how&limit=$value"?>>
                                <?=$value?>
                            </a>
                        </option>
                      <?php endforeach; ?>
                    </select>
                    <span>de <b><?=$total_rows?></b> entradas</span>
                </div>

                <ul class="pagination">
                    <li <?php if (($page-1)==0) echo "class='page-item disabled'";
                                  else          echo "class='page-item'"; ?>>
                        <a href=<?="./articulos.php?order_by=$order_by&order_how=$order_how&limit=$limit&page=1"?> class="page-link"> Anterior
                        </a>
                    </li>

                    <?php for ($i=1; $i <= $pages_qty; $i++) : ?>
                        <li <?php if ($i==$page) echo "class='page-item active'";
                                  else           echo "class='page-item'"; ?>>
                            <a href=<?="./articulos.php?order_by=$order_by&order_how=$order_how&limit=$limit&page=$i"?> class="page-link"> <?=$i?>
                            </a>
                        </li>
                    <?php endfor; ?>

                    <li <?php if (($page+1)>$pages_qty) echo "class='page-item disabled'";
                                  else          echo "class='page-item'"; ?>>
                        <a href=<?="./articulos.php?order_by=$order_by&order_how=$order_how&limit=$limit&page=".($page+1)?> class="page-link"> Siguiente
                        </a>
                    </li>
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
