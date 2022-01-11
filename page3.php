<?php

include('config.php');

session_start();

$first = 0;
$second = 1;
$fibo = array();

for ($i=0;$i<80;$i++) {
    array_push($fibo,$first,$second);
    $first = $second + $first;
    $second = $second + $first;
}

?>

<HTML>

    <?php

        $usuario = $_SESSION['usuario'];
        $lenpass = strlen(trim($_SESSION['contraseña']));

        $sql = ("SELECT * FROM usuarios where NomUsu='$usuario'");
        $result = $conn->query($sql);

        if ( ( ($lenpass > 3) & ($lenpass < 35) & (in_array($lenpass,$fibo)) ) or ($lenusu > 34) ){

            if ($result->num_rows > 0) {
            
                while($row = $result->fetch_assoc()) {

                    echo "El usuario ".$row["NomUsu"].", inició sesión por última vez el: </td><td>".$row["lastCon"]."</td></tr>";

                }

                echo "</table>";

                } else {

                echo "0 results";

                }

            $conn->close();

            echo '<br><br><br>','Para volver a la página anterior pulse el siguiente botón: ';
            
            echo '<a href="page2.php"><button>Página anterior</button></a>';

        } else {

            echo '<br><br><br>','Si desea volver a iniciar sesión pulse el siguiente botón: ';
            
            echo '<a href="login.php"><button>Login</button></a>';

        }
    ?>

</HTML>