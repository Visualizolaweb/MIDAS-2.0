<div id="header">
  <ul class="nav navbar-nav nav-main-xs">
      <li><a href="#menu" class="icon-toolsbar" id="menu-mobile" style="font-size: 19px; color: #1B1E24;"><i class="fa fa-bars"></i></a></li>
  </ul>
    <div class="logo-area clearfix"><a href="dashboard.php" class="logo"></a></div>

    <div class="tools-bar">

      <ul class="nav navbar-nav navbar-right tooltip-area">
          <!-- <li class="hidden-xs hidden-sm">
              <a href="#" class="">Ayuda</a>
          </li> -->

          <li>
              <a data-toggle="modal" href="#md-notification" class="avatar-header" title="Ver nuevas notificaciones" data-container="body" data-placement="bottom">
                  			<img alt="" src="assets/img/avatar/<?php echo $_usu_foto; ?>" class="img-circle">

             <!-- <span class="badge">4</span> -->
              </a>
          </li>

          <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
                  <em><strong>Bienvenido</strong>, <?php echo $_usu_nombre.' '.$_usu_apellido_1; ?> </em> <i class="dropdown-icon fa fa-angle-down"></i>
              </a>

              <ul class="dropdown-menu pull-right icon-right arrow">

                  <?php Gestion_Menu::View_menu("header",$_usu_per_codigo);?>

                  <li class="divider"></li>
                  <li><a href="../../controller/destruyosession.controller.php"><i class="fa fa-sign-out"></i> Cerrar Sesión </a></li>
              </ul>
          </li>

          <li class="visible-lg">
              <a href="#" class="h-seperate fullscreen" data-toggle="tooltip" title="Full Screen" data-container="body"  data-placement="left">
                <i class="fa fa-expand"></i>
              </a>
          </li>
      </ul>
    </div>
</div>
