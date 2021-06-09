<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ESCUELA DE MANEJO GRUPO #4</title>
    <?php include_once "header.php"; ?>
</head>
<body>
    <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        include_once "conexion.php";
        // $consulta = "SELECT count(*) as cntUser,id  FROM usuarios WHERE usuario=:usuario and password=:contra ";
        // $sentencia = $conexion->prepare($consulta, [
        //     PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL,
        // ]);
        // $sentencia->execute();

        if( isset( $_POST['but_submit'] ) ){
            $username = $_POST['usuario'];
            $password = $_POST['contra'];
            $message = "";

            if( $username != "" && $password != "" ) {
                // $stmt = $conexion->prepare("SELECT count(*) as cntUser,usuario_id FROM usuarios WHERE usuario=:usuario and password=:contra ");
                $stmt = $conexion->prepare("SELECT count(*) as cntUser, usuario_id, usuario FROM usuarios WHERE usuario=:username and password=:password GROUP BY usuario_id, usuario");
                $stmt->bindValue(':username', $username, PDO::PARAM_STR);
                $stmt->bindValue(':password', $password, PDO::PARAM_STR);
                $stmt->execute();
                $record = $stmt->fetch();

                $count = $record['cntUser'];

                if($count > 0){
                    // die("aqui llegó");
                    session_start();
                    $userid = $record['usuario_id'];
                    $userp = $record['usuario'];
                    // echo $userid;
                    $_SESSION['userid'] = $userid;
                    $_SESSION['usr'] = $userp;
                    // echo $_SESSION['userid'];
                    header('Location: main.php');
                    die();
                }else{
                    // die("aqui llegó no pasó la validación");
                    // echo "Invalid username and password";
                    $message="Usuario o password incorrectos";
                    header('Location: index.php');
                    // echo "Invalid username and password";
                    exit();
                }
            }
        }


        // $sent = $conexion->query("select usuario, password from usuarios");
        // $usuarios = $sent->fetchAll(PDO::FETCH_OBJ);

        // if( isset($_POST['usuario']) ){
        //     if ( !empty($_POST['contra']) ){
        //         echo "hola";
        //     }
        // }

        // foreach($usuarios as $usuario){
            // echo $usuario->usuario_id;
            // echo $usuario->usuario;
        // }
    ?>
    <div class="container-fluid fondo">
        <div class="row m-0 vh-100 justify-content-center align-items-center" >
            <div class="col-lg-4 col-md-6 col-sm-12 text-center text-white">
                <form class="text-white" method="post" >
                    <div class="mb-3">
                        <i class="fs-2 fas fa-user-circle"></i>
                        <label for="usuario" class="form-label">Usuario</label>
                        <input type="text" class="form-control" id="usuario" name="usuario">
                    </div>
                    <div class="mb-3">
                        <i class="fs-2 fas fa-key"></i>
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="contra">
                    </div>
                    <button type="submit" class="btn btn-dark btn-lg" name="but_submit"><i class="fas fa-sign-in-alt"></i>Login</button>
                </form>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>