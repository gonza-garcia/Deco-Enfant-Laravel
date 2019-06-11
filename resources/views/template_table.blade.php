@extends("template_main")


@section("titulo")
    Dèco Enfant - @yield("titulo_objeto")
@endsection


@section("principal")
    <div class="container table-container">
        <div class="table-wrapper">

    <!-- ::::::::::::::::::::::::::FILA DE TITULO::::::::::::::::::::::::::::: -->
    <!-- ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: -->
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Administrar <b>@yield("titulo_objeto")</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="#add_modal_form" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Agregar</span></a>
                        <a href="#delete_modal_form" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Eliminar</span></a>
                    </div>
                </div>
            </div>

    <!-- :::::::::::::::::::::::::FILA DE FILTROS:::::::::::::::::::::::::::: -->
    <!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: -->
            <div class="table-filter">
                <div class="row">
                    <div class="col-sm-3">

                    </div>
    <!-- ::::::::::::::::::::::::::::"BUSQUEDA":::::::::::::::::::::::::::: -->
                    <div class="col-sm-9">
                        <div class="filter-group">
                          <div class="search-box">
                              <i class="material-icons">&#xE8B6;</i>
                              <input type="text" class="form-control" placeholder="Buscar&hellip;">
                          </div>
                        </div>

    <!-- ::::::::::::::::::::::::::::"ORDER HOW":::::::::::::::::::::::::::: -->
                        <div class="filter-group">
                            <label>Orden</label>
                            <select class="form-control">
                                <option value="ASC" <?php if ($order_how=="ASC") echo 'selected'; ?>>
                                    <a href= <?="articulos.php?order_by=$order_by&order_how=ASC&limit=$limit"?>>
                                        Ascendente
                                    </a>
                                </option>
                                <option value="DESC" <?php if ($order_how=="DESC") echo 'selected'; ?>>
                                    <a href= <?="articulos.php?order_by=$order_by&order_how=DESC&limit=$limit"?>>
                                        Descendente
                                    </a>
                                </option>
                            </select>
                        </div>

    <!-- :::::::::::::::::::::::::::::"ORDER BY":::::::::::::::::::::::::::: -->
                        <div class="filter-group">
                            <label>Ordenar por</label>
                            <select class="form-control" name="order_by">
                              <!-- Traer las <option> para el select segun el objeto (products, users, etc):::: -->
                                @yield("order_by_select_options")
                            </select>
                        </div>
                        <span class="filter-icon"><i class="fa fa-filter"></i></span>
                    </div>
                </div>
            </div>

    <!-- :::::::::::::::::::::::::HEADERS DE TABLA:::::::::::::::::::::::::::: -->
    <!-- ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: -->
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
            <!-- Header Checkboxes:::: -->
                        <th style="width: 2.50%;">
                            <span class="custom-checkbox">
                                <input type="checkbox" id="selectAll">
                                <label for="selectAll"></label>
                            </span>
                        </th>
            <!-- Traer los headers segun el objeto (products, users, etc):::: -->
                        @yield("table_headers")

            <!-- Header Acciones -->
                        <th style="width: 5.00%;">Acciones</th>
                    </tr>
                </thead>


    <!-- ::::::::::::::::::::::::::FILAS DE TABLA:::::::::::::::::::::::::::::: -->
    <!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: -->
                <tbody>
            <!-- Traer todas las filas segun el objeto (products, users, etc):::: -->
                    @yield("table_rows")
                    
                </tbody>
            </table>

    <!-- :::::::::::::::::::::::::::PIE DE TABLA:::::::::::::::::::::::::::: -->
    <!-- ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: -->
            <div class="table-footer">
    <!-- ::::::::::::::::::::::::::::::MOSTRANDO:::::::::::::::::::::::::::: -->
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
                    <span>de <b><?=$total_rows["cantidad"]?></b> entradas</span>
                </div>

    <!-- :::::::::::::::::::::::::::PAGINACIÓN:::::::::::::::::::::::::::::: -->
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
    <!-- :::::::::::::::::::::::::::FIN DE TABLA:::::::::::::::::::::::::::::: -->
    </div>
@endsection


@section("modals")
    @yield("template_modals");
@endsection
