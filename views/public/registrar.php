<!DOCTYPE html>
<html>
<head>
    <title>ModernArts</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../resources/css/public/registro.css">
</head>

<body>
    <div class="todo box">
        <div class="formulario">
            <form id="send-form" method="post">
                <h1>Registro</h1>
                <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response"/>
                <input type="text" name="name" placeholder="Nombre" required>
                <input type="text" name="apellido" placeholder="Apellido" required>
                <input type="text" name="usuario" placeholder="Usuario" required>
                <input type="text" name="gmail" placeholder="Gmail" required>
                <input type="password" name="clave"  placeholder="Contraseña" id="pass1" onchange="passwordE();" required>
                <input type="password"  name="confclave" placeholder="Confirmar contraseña" id="pass2" onchange="passwordE();" required>
                <button id="regis">Registrarme</button>
                <a href="../../?action=" class="boton">Ya tengo una cuenta</a>
            </form>
        </div>
        <div class="imagen">
            <div class="capa"></div>
        </div>
    </div>
    <!-- Punto 13 reCaptcha -->
    <script src="https://www.google.com/recaptcha/api.js?render=6LfpUGccAAAAAFHZ7KrEokJ9dUDy5bR_q_LFY7MU"></script>
    <script type="text/javascript" src="../../resources/js/sweetalert.min.js"></script>
    <script type="text/javascript" src="../../controllers/public/global.js"></script>
    <script type="text/javascript" src="../../controllers/public/registro.js"></script>
    <script type="text/javascript" src="../../template/components.js"></script>
</body>
</html>