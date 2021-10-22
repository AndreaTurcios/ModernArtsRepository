<?php 
    //Incluye las clases de plantillas
    include_once('template/resourcesPage.php');
    //Imprimir el header se envia el nombre de la pagina actual=titulo
    if(isset($_GET['action'])){
        page::headerTemplate('Login');
    }else{
        header('Location: views/public/inicio.php');
    }
?>
<main>
    <form class="box" method="post" id="loginForm">
        <h1>Iniciar sesión</h1>
        <input type="hidden" name="tipo" value="<?php print($_GET['action'])?>">
        <input type="text" name="user" placeholder="Usuario" required>
        <input type="password"  name="password"  placeholder="Contraseña" required>

        <button>ingresar</button>

        <a href="views/public/registrar.php" class="boton">Registrarme</a>
    </form>
</main>
<?php
    //Imprimir el pie, se envia el nombre de la pagina actual=controlador
    page::scriptTemplate();
?>