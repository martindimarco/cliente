<?php
// separo la uri para hacer dinamico el titulo del nav
$uri = $_SERVER["REQUEST_URI"];
$partesNoAmigables = explode('/', $uri);
array_shift($partesNoAmigables);

$partesAmigables = explode('.', $partesNoAmigables[1]);
$comodin = $partesAmigables[0];

?>


<div class="container-fluid">
  <div class="row">
    <div class="col-2">
      <!-- logoCliente, zona para poner los banner de los mismos -->
      <img src="./assets/img/aire.png" alt="Logo Aire" width="100" class="mt-1" />
    </div>
    <!-- iconos de user, help and logout NOTA: lleva un !important en css -->
    <div class="col-10 mt-1">
      <div class="d-flex justify-content-end">
        <a class="btAccount btnDelNav" href="#" target="_self"><span class="material-symbols-outlined h3 mt-1 " id="tuto" onclick="iniciarTour()">
            smart_display
          </span></a>
        <a class="btAccount btnDelNav" href="facturas.php" target="_self"><span class="material-symbols-outlined h3 mt-1
        <?php  if ($comodin == "facturas") { echo "activo"; } ?>" 
        id="facturas">draft_orders</span></a>
        
        <a class="btAccount btnDelNav" href="user.php" target="_self"><span class="material-symbols-outlined h3 mt-1
        <?php  if ($comodin == "user") { echo "activo"; } ?>"
         id="datos">Account_Circle</span></a>
        
         <a class="btAccount btnDelNav" href="bolsillo.php" target="_self"><span class="material-symbols-outlined h3 mt-1 bolsilloBtn 
        <?php  if ($comodin == "bolsillo") { echo "activo"; } ?>"
         id="bolsillo">beenhere</span></a>
        <a class="btAccount btnDelNav" href="./assets/pdf/manual.pdf" target="_blank"><span class="material-symbols-outlined h3 mt-1" id="manual">developer_guide
          </span></a>
        <a class="btExit btnDelNav" href="./php/destroySession.php" target="_self"><span class="material-symbols-outlined h3 mt-1">move_item</span></a>

        <!-- START HAMBURGUER BUTTON ///////////////////////////////////////////////////////////////////////////////////////////////// -->
        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" id="btnBurger" style="background-color: transparent; border: none;">
          <span class="material-symbols-outlined" style="color: rgb(49, 49, 49); font-size: 34px;">
            menu
          </span>
        </button>
        <!-- END HAMBURGUER BUTTON ///////////////////////////////////////////////////////////////////////////////////////////////// -->
      </div>
    </div>

    <!-- START HAMBURGUER CONTENT ///////////////////////////////////////////////////////////////////////////////////////////////// -->
    <div class="offcanvas offcanvas-end offcanvas-size" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
      <div class="offcanvas-header">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body offcanvas-bd-size">
        <h3 class="text-white">Menu</h3>
        <div class="col-10 mt-1">
          <div class="container justify-content-end">
            <div class="row">
              <a class="btAccountBurguer menuBurgerTexto" href="#" target="_self">
                <spam class="tamañoBotonesBurgerNav" id="tuto" onclick="iniciarTour()">Tutorial</spam>
              </a>
              <a class="btAccountBurguer menuBurgerTexto" href="facturas.html" target="_self">
                <spam class="tamañoBotonesBurgerNav" id="facturas">Mis Facturas</spam>
              </a>
              <a class="btAccountBurguer menuBurgerTexto" href="user.html" target="_self">
                <spam class="tamañoBotonesBurgerNav" id="datos">Mis Contratos</spam>
              </a>
              <a class="btAccountBurguer menuBurgerTexto" href="bolsillo.html" target="_self">
                <spam class="tamañoBotonesBurgerNav" id="bolsillo ">Bolsillo Solar</spam>
              </a>
              <a class="btAccountBurguer menuBurgerTexto" href="./assets/pdf/manual.pdf" target="_blank">
                <spam class="tamañoBotonesBurgerNav" id="manual">Documentacion</spam>
              </a>
              <hr class="mt-3" style="border-color: white;">
              <a class="btExitBurguer menuBurgerTexto" href="login.html" target="_self">
                <spam class="tamañoBotonesBurgerNav">Salir</spam>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END HAMBURGUER CONTENT ///////////////////////////////////////////////////////////////////////////////////////////////// -->
  </div>
</div>
<nav class="navbar navbar-expand-lg navbar-light bg-dark justify-content-between">
  <div class="d-flex align-items-center p-1">
    <div>
      <strong class="bolsilloNav m-1" id="b1"><?php

                                              switch ($comodin) {
                                                case 'facturas':
                                                  echo "Mis Facturas";
                                                  break;
                                                case 'user':
                                                  echo "Datos Personales y de Contratación";
                                                  break;
                                                case 'bolsillo':
                                                  echo "Bolsillo Solar";
                                                  break;

                                                default:
                                                  echo "";
                                                  break;
                                              }
                                              ?></strong>
    </div>
  </div>
</nav>