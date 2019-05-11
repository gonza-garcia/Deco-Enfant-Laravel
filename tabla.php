<?php
  require_once("recursos/funciones.php");

  if (isset($_GET["tabla"]))
  {
      if (($_GET["tabla"] == "usuarios") ||
          ($_GET["tabla"] == "articulos"))
      {
          $objetos = buscarObjeto("recursos/db.json", $_GET["tabla"]);
          $titulo = ucfirst(substr($_GET["tabla"], 0, -1));
          $columnas = obtenerModelo($_GET["tabla"]);
          $cantidad_total = count($objetos);
      }
      else
      {
        header("Location:index.php");
        exit;
      }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dèco Enfant</title>

    <!-- Fuentes Custom---------------------------------------------->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Sacramento&amp;subset=latin-ext" rel="stylesheet">


    <!-- Bootstrap CDN, Google Fonts, Font Awesome------------------->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Lato|Montserrat:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- REVISARRR ESTE ICONO -->
    <a href="https://icons8.com/icon/80664/paper-plane"></a>


    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="./css/styleTabla.css">



    <script type="text/javascript">
        $(document).ready(function(){
        	// Activate tooltip
        	$('[data-toggle="tooltip"]').tooltip();

        	// Select/Deselect checkboxes
        	var checkbox = $('table tbody input[type="checkbox"]');
        	$("#selectAll").click(function(){
        		if(this.checked){
        			checkbox.each(function(){
        				this.checked = true;
        			});
        		} else{
        			checkbox.each(function(){
        				this.checked = false;
        			});
        		}
        	});
        	checkbox.click(function(){
        		if(!this.checked){
        			$("#selectAll").prop("checked", false);
        		}
        	});
        });
    </script>
</head>

<body>

  <!-- HEADER y NAVBAR DE MENUS---------------------------->
  <?php include("recursos/header.php") ?>

    <div class="container">
        <div class="table-wrapper">

            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						            <h2>Administrar <b><?=$titulo.'s'?></b></h2>
					          </div>
    					      <div class="col-sm-6">
    						        <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Agregar</span></a>
    						        <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Eliminar</span></a>
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
                        <?php foreach ($columnas as $col) :?>
                          <th><?=$col[0]?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>

                <tbody>
                  <?php foreach ($objetos as $objeto) :?>
                    <tr>
						            <td>
					                  <span class="custom-checkbox">
								                <input type="checkbox" id="checkbox1" name="options[]" value="1">
								                <label for="checkbox1"></label>
							              </span>
						            </td>

                          <?php foreach ($objeto as $key => $value): ?>
                            <?php if ($key === "pass") continue; ?>
                            <td><?=$value?></td>
                          <?php endforeach; ?>

                        <td>
                            <a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Editar">&#xE254;</i></a>
                            <a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Eliminar">&#xE872;</i></a>
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
                    <span>de <b><?=$cantidad_total?></b> entradas</span>
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

        <!-- </div>   end table-wrapper -->
    </div>


	<!-- Add Modal HTML -->
	<div id="addEmployeeModal" class="modal fade">
  		<div class="modal-dialog">
    			<div class="modal-content">
      				<form>
        					<div class="modal-header">
        						  <h4 class="modal-title">Agregar <?=$titulo?></h4>
        						  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        					</div>

        					<div class="modal-body">
                      <?php foreach ($columnas as $key => $col): ?>
                        <?php if ($key === "pass") continue; ?>
                        <div class="form-group">
            							  <label for=<?=$key?>> <?=$col[0]?> </label>
                            <input id=<?=$key?> type=<?=$col[1]?> class="form-control" name=<?=$key?>>
          						  </div>
                      <?php endforeach; ?>
        					</div>

        					<div class="modal-footer">
        						  <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
        						  <input type="submit" class="btn btn-success" value="Agregar">
        					</div>
      				</form>
    			</div>
  		</div>
	</div>

	<!-- Edit Modal HTML -->
	<div id="editEmployeeModal" class="modal fade">
  		<div class="modal-dialog">
    			<div class="modal-content">
      				<form>
        					<div class="modal-header">
          						<h4 class="modal-title">Editar <?=$titulo?></h4>
          						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        					</div>

        					<div class="modal-body">
                    <?php foreach ($columnas as $key => $col): ?>
                      <?php if ($key === "pass") continue; ?>
                      <?php if ($col[2] == true):?>
                        <div class="form-group">
                            <label for=<?=$key?>> <?=$col[0]?> </label>
                            <input id=<?=$key?> type=<?=$col[1]?> class="form-control" name=<?=$key?>>
                        </div>
                      <?php else : ?>
                        <div class="form-group">
                            <label for=<?=$key?>> <?=$col[0]?> </label>
                            <label> No editable </label>
                        </div>
                      <?php endif; ?>
                    <?php endforeach; ?>
        					</div>

        					<div class="modal-footer">
          						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
          						<input type="submit" class="btn btn-info" value="Guardar">
        					</div>
      				</form>
    			</div>
  		</div>
	</div>

	<!-- Delete Modal HTML -->
	<div id="deleteEmployeeModal" class="modal fade">
  		<div class="modal-dialog">
    			<div class="modal-content">
      				<form>

        					<div class="modal-header">
          						<h4 class="modal-title">Eliminar <?=$titulo?></h4>
          						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        					</div>

        					<div class="modal-body">
          						<p>¿Estás seguro de querer eliminar estos registros?</p>
          						<p class="text-warning"><small>Esta operación no se puede deshacer.</small></p>
        					</div>

        					<div class="modal-footer">
          						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
          						<input type="submit" class="btn btn-danger" value="Borrar">
        					</div>
      				</form>
    			</div>
  		</div>
	</div>

  <!-- FOOTER -------------------------------------------------------->
  <?php include("recursos/footer.php") ?>

  <!-- SCRIPTS DE JAVA DE BOOTSTRAP---------------------------------->
  <?php include("recursos/scriptsJava.php") ?>


</body>
</html>
