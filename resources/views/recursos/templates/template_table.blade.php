@extends("recursos/template_main")


@section("titulo")
    Dèco Enfant - @yield("titulo_objeto")
@endsection


@section('custom_css')
    <link rel="stylesheet" href="/css/style_tabla.css">
    <link rel="stylesheet" href="/css/style_modals.css">
@endsection

@section('custom_scripts')
  <script src="{{asset('js/table_scripts.js')}}"></script>
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
                        <a href="#add_modal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Agregar</span></a>
                        <a href="#delete_modal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Eliminar</span></a>
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
                                <option value="ASC" @if ($order_how=="ASC") {{'selected'}}@endif>
                                        Ascendente
                                </option>
                                <option value="DESC" @if ($order_how=="DESC") {{'selected'}}@endif>
                                        Descendente
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
                        @foreach ($limit_options as $value)
                            <option value={{$value}} @if ($value==$limit) {{'selected'}} @endif>
                                    {{$value}}
                            </option>
                        @endforeach
                    </select>
                    <span>de <b>{{$total_rows}}</b> entradas</span>
                </div>

    <!-- :::::::::::::::::::::::::::PAGINACIÓN:::::::::::::::::::::::::::::: -->
                <ul class="pagination">
                    @yield('pagination')
                </ul>
            </div>
        </div>
    <!-- :::::::::::::::::::::::::::FIN DE TABLA:::::::::::::::::::::::::::::: -->
    </div>
@endsection


@section("modals")

  <!-- :::::::::::::::::::::::::::::::: ADD Modal HTML ::::::::::::::::::::::::::::::::::::-->
  <!-- ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
  <div id="add_modal" class="modal fade">
      <div class="modal-dialog">
          <div class="modal-content">

              @yield('add_modal_content')

          </div>
      </div>
  </div>

  <!-- :::::::::::::::::::::::::::::::: EDIT Modal HTML :::::::::::::::::::::::::::::::::::-->
  <!-- ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
  <div class="container">
      <div id="edit_modal" class="modal fade">
          <div class="modal-dialog">
              <div class="modal-content">

              @yield('edit_modal_content')

              </div>
          </div>
      </div>
  </div>

  <!-- :::::::::::::::::::::::::::::::: DELETE Modal HTML :::::::::::::::::::::::::::::::::-->
  <!-- ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
  <div id="delete_modal" class="modal fade">
      <div class="modal-dialog">
          <div class="modal-content">

              @yield('delete_modal_content')

          </div>
      </div>
  </div>

@endsection
