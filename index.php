<?php
//Se incluye la plantilla del encabezado para la página web
include('template/resourcesPage.php');
page::headerTemplate('Login');
?>

<main>
    <form class="box" method="post" id="loginForm">
        <h1>Iniciar sesión</h1>
        <input type="hidden" name="tipo" value="<?php print($_GET['action'])?>">
        <input type="text" name="user" placeholder="Usuario" required>
        <!-- Este es el punto 1 de la rúbrica (ocultar contraseña), se logra gracias al input type password el cual se presenta como un control de 
        editor de texto sin formato de una línea en el que el texto está oculto para que no se pueda leer -->
        <input type="password"  name="password"  placeholder="Contraseña" required>
        <button>Ingresar</button>

        <a href="views/public/registrar.php" class="boton">Registrarme</a>
    </form>
</main>

<?php
    //Imprimir el pie, se envia el nombre de la pagina actual=controlador
    page::scriptTemplate('usuarios.js');
?>