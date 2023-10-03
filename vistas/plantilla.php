<?php
  session_start()
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Inventory Plus | BeltaPlusSize</title>

  <!--  =================================================
        PLUGIN DE CSS
    =================================================- -->
  <link rel="icon" href="vistas/img/plantilla/icono-negro.png">

    <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap/dist/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="vistas/bower_components/font-awesome/css/font-awesome.min.css">

  <!-- Ionicons -->
  <link rel="stylesheet" href="vistas/bower_components/ionicons/css/ionicons.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/AdminLTE.css">
  
  <!-- AdminLTE Skins -->
  <link rel="stylesheet" href="vistas/dist/css/skins/_all-skins.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

   <!-- DataTables -->
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">



    <!--  =================================================
        PLUGIN DE JAVASCRIPT
    =================================================- -->

    <!-- jQuery / Ventanas Modales -->
  <script src="vistas/bower_components/jquery/dist/jquery.min.js"></script>

  <!-- Bootstrap 3.3.7 JS / Modales --->
  <script src="vistas/bower_components/bootstrap/js/bootstrap.min.js"></script> 

  <!-- AdminLTE App -->
  <script src="vistas/dist/js/adminlte.min.js"></script>

  <!-- DataTables -->
  <script src="vistas/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>

    <!-- SweetAlert 2 -->
  <script src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script>
   <!-- By default SweetAlert2 doesn't support IE. To enable IE 11 support, include Promise polyfill:-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

</head>

<!--  =================================================
      CUERPO DEL DOCUMENTO
  =================================================- -->
<body class="hold-transition skin-blue sidebar-mini login-page">
<!-- Site wrapper -->
  
  <?php 

   if (isset($_SESSION['iniciosession']) && ($_SESSION['iniciosession'] == 'ok')){

    echo "<div class='wrapper'>";

    //--========= Navbar Head ==================
      include "vistas/modulos/head.php";

    //--======== Menu lateral ===============
      include "vistas/modulos/menu.php";

    // Manejo de URL amigables (.htaaccess)
      if(isset($_GET['ruta'])){
        
        if($_GET['ruta']==='inicio' || 
           $_GET['ruta']==='usuarios'  || 
           $_GET['ruta']==='categorias' || 
           $_GET['ruta']==='productos' || 
           $_GET['ruta']==='clientes' ||
           $_GET['ruta']==='inventario' ||
           $_GET['ruta']==='salir')
        {       //Lista Blanca ruta = valor href="" del Menu
          
          include("vistas/modulos/".$_GET['ruta'].".php");
          echo "ruta";
        }else{
          include("vistas/modulos/404.php");
        }
      }else{
        include("vistas/modulos/inicio.php");
      }

    //--======== Modulo Footer ===============
      include "vistas/modulos/footer.php";
  
    echo "</div>";  //  <!-- ./ cierre de wrapper -->

   }else{
      //echo "<br><div class='alert alert-danger'>Error.! No pudo iniciar sesion en el sistema.</div>";
      include "vistas/modulos/login.php";   // No ha iniciado Sesion

   } // Cierre IF SESSION

  ?>


<!-- 
<script src="vistas/dist/js/demo.js"></script>
AdminLTE for demo purposes -->

<script src="vistas/js/plantilla.js"></script>
<script src="vistas/js/usuarios.js"></script>
</body>
</html>
