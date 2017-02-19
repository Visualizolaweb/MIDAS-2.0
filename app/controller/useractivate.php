<?php
require_once("../model/dbconn.model.php");
require_once("../model/class/usuarios.class.php");

  $user = base64_decode($_GET["ui"]);
  $ac   = base64_decode($_GET["ac"]);
  $email= base64_decode($_GET["em"]);

  if($ac == "si"){
    $usu_estado = "Activo";
  }else{
    $usu_estado = "Inactivo";
  }

  try{
    Gestion_Usuarios::UpdateState($usu_estado,$user);
    require_once('../PHPMailer/class.phpmailer.php');
    include("../PHPMailer/class.smtp.php");

    $mail = new PHPMailer();

    $mail->IsSMTP();
    $mail->Host = "midas.bes.com.co";
    $mail->SMTPDebug = 0;


    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    $mail->Username   = "appmidas.bes@gmail.com";
    $mail->Password   = "90L1vfsj";

    $mail->SetFrom("appmidas.bes@gmail.com", "MIDAS");
    $mail->AddReplyTo("asistente.bes@gmail.com","Asistente BeSMART");

    $mail->Subject = "Su cuenta en MIDAS se ha activado.";
    $mail->AltBody = "Para visualizar este mensaje, por favor use un servidor de correo compatible con HTML";
    $mail->MsgHTML("
    <img src='http://midas.bes.com.co/app/views/default/assets/img/logo_2x.png' style='float:left' width='65'>
    <div style='padding: 12px; background-color: #90d127; color: #fff; margin-left:70px'>

      <h1>SU CUENTA EN MIDAS SE HA ACTIVADO CON EXITO</h1>
    </div>
    <br>
    <p style='clear:both; font-size: 14px; color: #6e6e6e'>
      Su cuenta en MIDAS se ha activado con exito, lo invitamos a que inicie sesión en <a href='http://midas.bes.com.co'>https://midas.bes.com.co </a> y comience con la configuración de su franquicia.
    </p>
    <div style='text-align:center'>
      <img src='http://midas.bes.com.co/app/views/default/assets/img/unnamed.png'>
    </div>
    <small style='display:block; margin-top:20px; color: #ccc'>
    <p style='color:rgb(83, 171, 22); font-weight:bold;' >Be Smart protege el ambiente, hazlo tú también e imprime este correo sólo si es necesario.
            Be Green. Be Smart.</p>

            <p>Este mensaje y los archivos anexos son confidenciales, privilegiados y/o protegidos por derechos de autor. Están dirigidos única y exclusivamente para uso del destinatario. Su reproducción, distribución, lectura y uso están prohibidos a cualquier persona diferente y puede ser ilegal. Si por error lo ha recibido, por favor discúlpenos, notifíquenoslo y elimínelo. Las opiniones, conclusiones y otra información contenida en este correo no relacionada con el negocio oficial del remitente, deben entenderse como personales y de ninguna manera son avaladas por BE SMART y/o sus filiales.
            Gracias.

            This e-mail and any files transmitted with it contain confidential and privileged information and are for the sole use of the intended recipient(s). If you are not the intended recipient we offer apology, please contact the sender by reply e-mail and destroy all copies of the original message. Any unauthorized review, use, disclosure, dissemination, forwarding, printing or copying of this e-mail or any action taken in relation to this e-mail is strictly prohibited and may be unlawful. Opinions, conclusions and any other information contained in this message no related with official business of the expeditor, must to be understood as personal and by no means, in no way represent the opinions of BE SMART and/or it's subsidiaries.
            Thank you.</p>
          </small>
    ");

    $mail->AddAddress($email);
    $mail->Send();
    $alert_type = base64_encode("alert-success");
    $alert_msn  = base64_encode("<strong>Perfecto!</strong> El usuario se activo correctamente ");


  }catch(Exception $e){
      echo $e->getMessage().' '.$e->getFile().' '.$e->getLine();
  }

header("location: ../views/default/login.php?alert=true&alty=$alert_type&almsn=$alert_msn");

?>
