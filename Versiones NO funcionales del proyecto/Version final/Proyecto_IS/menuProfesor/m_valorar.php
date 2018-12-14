<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#">BEGINNING'S SCHOOL</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li><a href="../../PrincipalProfesor.php">Menu Principal</a></li>
            </ul>
            
            <ul class="nav pull-right">
                <li class="divider-vertical"></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  	<span style="color:#FFF">Bienvenido - <?php echo $_SESSION['user_name']; ?></span> <b class="caret"></b>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a href="../../cambiar_infoProfesor.php"><i class="icon-user"></i> Actualizar Información</a></li>
                    <li><a href="../../cambiar_contraProfesor.php"><i class="icon-refresh"></i> Cambiar Contraseña</a></li>
                    <li class="divider"></li>
                    <li><a href="../../php_cerrar.php"><i class="icon-off"></i> Salir</a></li>
                  </ul>
            	</li>
          	</ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div><!-- /container -->