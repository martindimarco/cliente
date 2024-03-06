<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- import local root css -->
  <link rel="stylesheet" href="./css/style.css" />

  <!-- import local root driverPopover.css -->
  <link rel="stylesheet" href="./css/driverPopover.css">

  <!-- import google icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

  <!-- import google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Saira+Extra+Condensed:wght@100&family=Teko:wght@300&display=swap" rel="stylesheet">

  <!-- import bootstrap css-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

  <!-- import chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="shortcut icon" href="./assets/img/teraLogo.ico" type="image/x-icon" />

  <!-- import driverPopover js -->
  <script src="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.js.iife.js"></script>
  <!-- import driverPopover css -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.css" />

  <!-- import dataTable -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
  <script defer src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
  <script defer src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>



  <title>Facturas</title>
</head>

<body>

  <?php include('./partials/nav.php');      ?>

  <div class="container-fluid">
    <div class="collapse mt-2" id="filtrosDeBusqueda">
      <div class="row g-0 justify-content-sm-end align-items-center">
        <!-- direcciones -->
        <div class="col-4 col-sm-4 col-md-4 col-lg-3" style="margin-right: 5px;">
          <select class="form-select form-select-sm" aria-label="Small select example" name="direcciones">
            <option selected style="font-weight: bold">
              Todas las direcciones
            </option>
            <option value="1">Fabrica Vieja 6 30b</option>
          </select>
        </div>
        <!-- DATE RANGE JS -->
        <div class="col-3 col-sm-4 col-md-4 col-lg-3" style="margin-right: 5px;">
          <input type="text" name="dates" class="form-control form-control-sm">
        </div>
        <!-- SEARCH BUTTON -->
        <div class="col-3 col-sm-1 col-md-1 col-lg-1 d-flex justify-content-sm-start justify-content-sm-end justify-content-md-end justify-content-lg-end">
          <button class="btn btn-primary btn-sm" style="width: 100px;" type="button">buscar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- FIN ELEMENTO COLAPSADO  ------------ -->

  <div class="container-fluid mt-2">
    <div class="row justify-content-sm-start justify-content-lg-between">

      <!-- AREA "ULTIMA CONEXION" -->
      <div class="col-12 col-lg-4 order-lg-1 order-3 align-middle" id="zonaUC">
        <strong>Ultima conexion:</strong><span class="lastConnection"></span>
      </div>
      <div class="col-12 col-lg-8 order-lg-2 order-2 tamañoSelect" style="margin-bottom: 3px;">
        <!-- ZONA DERECHA, SELECT CONTRATOS  -->
        <!-- SELECT DE CONTRATOS -->
        <!-- <select class="form-select form-select-sm m-0 p-1" aria-label="Small select example" id="selectContratosIndex">
          <option value="Contratos" selected style="font-weight: bold">
            Contratos
          </option>
        </select> -->
         <?php   include('./partials/select.php');  ?>
      </div>
    </div>
    <!-- CONTENEDOR GENERAL. g-2 DIVIDE EL CENTRO -->
    <div class="row g-1">
      <!-- LADO IZQ -->
      <div class="col-12 col-lg-4 order-lg-1 order-2">
        <div class="row">
          <!-- LADO IZQ ZONA ARRIBA -->
          <div class="col-lg-12">
            <div class="card" id="graficaIndex">
              <div class="card-body my-0 mx-1 p-0">
                <!-- ZONA DEL CHART.JS -->
                <canvas id="myChart"></canvas>
              </div>
            </div>
            <!--INFORMACION de mis facturas -->
            <!-- informacionFactura, tiene un sticky en css -->
            <!-- LADO IZQ ZONA ABAJO -->
            <div class="col-lg-12">
              <div class="card mt-2 shadow-sm informacionFactura" id="informacionFactura">
                <div class="card-body mx-2 p-1">
                  <div class="table m-0 mt-2">
                    <strong id="brand_addressTable"></strong>
                    <div class="table-responsive">
                      <table class="table table-sm table-light table-striped">
                        <tbody class="table-group-divider">
                          <tr>
                            <td class="align-middle">CUPS</td>
                            <td id="cups_addressTable">
                            </td>
                            <td class="text-end px-2"><span id="copyIconIndex" onclick="copyCups()" class="material-symbols-outlined align-middle">
                                content_copy
                              </span></td>
                          </tr>
                          <tr>
                            <td>Dirección</td>
                            <td id="address_addressTable"></td>
                            <td></td>
                          </tr>
                          <tr>
                            <td>Provincia</td>
                            <td id="location1_addressTable"></td>
                            <td></td>
                          </tr>
                          <tr>
                            <td>Municipio</td>
                            <td id="location2_addressTable"></td>
                            <td></td>
                          </tr>
                          <tr>
                            <td>Código Postal</td>
                            <td id="cp_addressTable"></td>
                            <td></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- ZONA DE LECTURAS DE FACTURAS -->
      <!-- LADO DERECHO -->
      <div class="col-12 col-lg-8 order-lg-2 order-1">
        <div class="card" id="zonaFacturas">
          <dir class="tbodyDiv tbodyDivIndex p-1 m-0" style="width: 99%;">
            <table class="table table-sm table-striped align-middle table-light" id="t1">
              <thead class="table-dark"">
                <tr class=" text-center">
                <!-- class headerT se usa en css para hacer la cabecera de la tabla stiky -->
                <th class="headerT">Fecha</th>
                <th class="headerT">Factura</th>
                <th class="headerT">Desde</th>
                <th class="headerT">Hasta</th>
                <th class="headerT">Consumo kWh</th>
                <th class="headerT">Total €</th>
                <th class="headerT">Descargar</th>
                </tr>
              </thead>
              <!-- <tbody id="tbodyIndex">
                <tr class="text-center">
                  <td class="tablaIndexFecha align-middle">02/08/21</td>
                  <td class="tablaIndexN_factura align-middle">AR-08-05965</td>
                  <td class="tablaIndexDesde align-middle">01/06/21</td>
                  <td class="tablaIndexHasta align-middle">06/07/21</td>
                  <td class="tablaIndexConsumo align-middle">0 kWh</td>
                  <td class="tablaIndexTotal align-middle">22.02 €</td>
                  <td class="tablaIndexDescargar align-middle">
                    <a href="#">
                      <span class="material-symbols-outlined">download </span>
                    </a>
                  </td>
                </tr>
              </tbody> -->
            </table>
          </dir>
        </div>
      </div>
    </div>
  </div>



  <!-- import bootstrap js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

  <!-- jquery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

  <!-- scr local root driver.js -->
  <script src="./js/chart/indexChart.js"></script>
  <script src="./js/tourIndex.js"></script>

  <!-- general script -->
  <script src="./js/generalScript.js"></script>
  <script src="./js/facturas.js"></script>

  <!-- dataTable script -->
  <script src="./js/dataTable/indexData.js"></script>