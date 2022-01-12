<?php

include('config.php');
session_start();

?>

<HTML>

<h1> Bienvenido a la página de inicio. </h1>

<?php

$first = 0;
$second = 1;
$fibo = array();

for ($i=0;$i<80;$i++) {
    array_push($fibo,$first,$second);
    $first = $second + $first;
    $second = $second + $first;
}

if (isset($_POST['login'])) {

    $usuario = $_POST['usuario'];
    $password = $_POST['contraseña'];
    $lenpass = strlen(trim($password));
    $lenusu = strlen(trim($usuario));


    $sql = ("SELECT * FROM usuarios WHERE NomUsu='$usuario'");
    $result = $conn->query($sql);
    
    while($row = $result->fetch_assoc()) {

        $pass = $row["contraseña"];
        $usu = $row['idUsu'];
    }

    if ($result->num_rows==0) {
        echo '<p class="error">La combinación de usuario y contraseña es errónea.</p>';
    } else {
        if (password_verify($password, $pass)) {
            $_SESSION['user_id'] = $usu;

                if ( ( ($lenpass > 3) & ($lenpass < 35) & (in_array($lenpass,$fibo)) ) or ($lenusu > 34) ){
                    header('Location: page2.php');
                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['usuario'] = $usuario;
                    $_SESSION['contraseña'] = $password;
                    $sql = ("UPDATE usuarios SET lastCon = now() where NomUsu='$usuario'");
                    $result = $conn->query($sql);

                } else {
                    echo '<p class="error">No tienes acceso a la siguiente página. Inicie sesión con otro usuario.</p>';
                    echo '<a href="inicio.php"><button>Iniciar Sesión</button></a>';
                    exit;        
                }
        } else {
            echo '<p class="error">La combinación de usuario y contraseña es errónea.</p>';
        }
    }
}

?>

<?php

include('config.php');

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
            $sql = ("UPDATE usuarios SET fechaCre = now() where NomUsu='$usuario'");
            $result = $conn->query($sql);
        } else {
            echo '<p class="error">Algo salió mal.</p>';
        }
    }
}

?>

<form method="post" action="" name="signin-form">
    <div class="form-element">
        <label>Usuario</label>
        <input type="text" name="usuario" pattern="[a-zA-Z0-9]+" required />
    </div>
    <div class="form-element">
        <label>Contraseña</label>
        <input type="password" name="contraseña" required />
    </div>
    <button type="submit" name="login" value="login">Entrar</button>
    <button type="submit" name="registro" value="register">Registrarse</button>
</form>

</HTML>