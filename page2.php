<?php

session_start();

?>

<HTML>

    <?php

        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            
            echo $_SESSION['usuario'], "<br>\n\n";
            $password = $_SESSION['contraseña'];

            $lenpass = strlen(trim($password));
            $newpass = $password;
                        
            for ($i=0;$i<$lenpass;$i++) {
              
                if ( $i % 2 != 0) {

                    echo str_repeat('¿', $i),"<br>\n";

                } else {

                    echo str_repeat('?', $i),"<br>\n";

                }
                    
            }

            for($i = 1; $i < $lenpass; $i += 2) {
                
                $newpass[$i] = '#';
                
            }

            for($i = 4; $i < $lenpass; $i += 5) {
                
                $newpass[$i] = '*';
                
            }            

            echo $newpass;

            echo '<br><br><br>','Para ves más información sobre la cuenta pulse sobre el siguiente botón: ';
            
            echo '<a href="page3.php"><button>Más Información</button></a>';

            echo '<br><br><br>','Si desea volver a iniciar sesión pulse el siguiente botón: ';
            
            echo '<a href="inicio.php"><button>Login</button></a>';

        }
        else {
            echo "Vuelva a iniciar sesión para acceder a esta página.";

            echo '<a href="inicio.php"><button>Iniciar Sesión</button></a>';
        }

    ?>



</HTML>