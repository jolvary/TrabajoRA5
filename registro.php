<?php

include('config.php');
session_start();

if (isset($_POST['registro'])) {

    $usuario = $_POST['usuario'];
    $password = $_POST['contraseña'];
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    $sql = ("SELECT * FROM usuarios WHERE NomUsu='$usuario'");
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<p>Este nombre de usuario ya ha sido registrado en el sistema.<p>';
    }

    if ($result->num_rows == 0) {
        $sql = ("INSERT INTO usuarios(NomUsu,contraseña) VALUES ('$usuario','$password_hash')");
        $result = $conn->query($sql);

        if ($result) {
            echo '<p class="success">Te has registrado correctamente.</p>';
        } else {
            echo '<p class="error">Algo salió mal.</p>';
        }
    }
}

?>

<form method="post" action="" name="signup-form">
    <div class="form-element">
        <label>Usuario</label>
        <input type="text" name="usuario" pattern="[a-zA-Z0-9]+" required />
    </div>
    <div class="form-element">
        <label>Contraseña</label>
        <input type="password" name="contraseña" required />
    </div>
    <button type="submit" name="registro" value="register">Registrarse</button>
</form>
<button onclick="location.href='./inicio.php'">Iniciar sesión</button>
