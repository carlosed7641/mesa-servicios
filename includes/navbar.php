<nav class="navbar navbar-expand-lg navbar-light gradiente" style="padding: 20px;">
    <a class="navbar-brand" href="/mesa-servicios/index.php" style="color: white;">MESA DE SERVICIOS</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <ul class="navbar-nav mr-auto">

        <!--Si hay sesión iniciada imprime el nombre de usuario en el navbar-->
        <?php if(isset($_SESSION)) { ?>
         <p class="nav-link" style="color: white; font-weight: bold;"><?php echo "Usuario: ".utf8_decode($_SESSION['username']); ?></p>
        <?php } ?>

       <li class="nav-item">
          <a class="nav-link" href="/mesa-servicios/index.php#about" style="color: white;">Nosotros</a>
        </li>
        <!--Si no hay sesión iniciada ofrece la opción de iniciar sesión-->
        <?php if(!isset($_SESSION)) { ?>
        <li class="nav-item">
          <a class="nav-link" href="/mesa-servicios/login.php" style="color: white;">Iniciar sesión</a>
        </li>     
        <!--Si de lo contrario hay sesión iniciada ofrece la opción de cerrar sesión-->
        <?php } else { ?>
        <li class="nav-item">
          <a class="nav-link" href="/mesa-servicios/salir.php" style="color: white;">Cerrar sesión</a>
        </li>
        <?php } ?>

 
        

      </ul>
      </form>
    </div>
</nav>