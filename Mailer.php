<?php
    require 'src/Exception.php';
    require 'src/PHPMailer.php';
    require 'src/SMTP.php';
    require 'conextion2.php';
    session_start();
    session_unset();
    session_destroy();
    session_start();

    $mail = new PHPMailer\PHPMailer\PHPMailer(true);

    try {

    $nombreUsuario=null;
    $nombre=null;
    $msg=null;
    $correo = $_POST["para"];
    
    $sql='SELECT nombre_usuario, nombre FROM usuarios WHERE correo_electronico ="'.$correo.'"';
    $request=$mysqli->query($sql)or die($mysqli->error);
    //$mensaje = $_POST["mensaje"];
    $usuario = $request->fetch_array(MYSQLI_ASSOC);
    if($request->num_rows>0){
        $nombreUsuario=$usuario['nombre_usuario'];
        $nombre=$usuario['nombre'];
        
        //Server settings
        $mail->SMTPDebug = 0;                                       // Enable verbose debug output
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 587;                                    // TCP port to connect to
    
        
        //https://support.google.com/mail/answer/185833?hl=es-419 POR ACA INGRESAN PARA CREAR LA CLAVE DE LA APP
        $mail->Username   = 'uniajc2021@gmail.com';                     // SMTP username
        $mail->Password   = 'zetveazcmumphhrd';                               // SMTP password
  
        //DESDEEE -->
        $mail->setFrom('uniajc2021@gmail.com', 'MyStudentManager'); 
        
        //La siguiente linea, se repite N cantidad de veces como destinarios tenga
        $mail->addAddress($correo, $correo);     // Add a recipient
           
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = utf8_decode("Recuperación nombre de usuario");
        $mail->Body    = 'Hola '.$nombre.',<br>
        <br>
                          El presente mensaje es enviado por medio de la aplicación MyStudentManager<br>
                          <br>
                          Se informa que se ha solicitado su nombre de usuario.<br>
                          <br>
                          Tu nombre de usuario es: '.$nombreUsuario;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->send();

        $data["res"] = 'El correo a sido enviado';
        header('location:login.php');
    }else{
        $msg="<script>alert('Este correo electronico no se encuentra registrado');</script>";
        header('location:recupUsuario.php');
        // echo $msg;
       $_SESSION["msg"]=$msg; 
    }
    

    } catch (Exception $e) {
        $data["res"] = 'Error';
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        //echo"<script>alert('Ocurrio un error: {$mail->ErrorInfo}');</script>";
        header('location:recupUsuario.php');
       
    }

    echo json_encode($data);
    //header('location:login.php');
?>