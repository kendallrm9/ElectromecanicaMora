<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

$nombre = htmlspecialchars($_POST["nombre"], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$telefono = htmlspecialchars($_POST["numero"], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$email = htmlspecialchars($_POST["email"], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$capacitacion = htmlspecialchars($_POST["Capacitaciones"], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$mensaje = htmlspecialchars($_POST["mensaje"], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$fecha_envio = date("d/m/Y H:i:s");

// Configuración del servidor SMTP


//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
  //Server settings
  $mail->SMTPDebug = 0;                      //Enable verbose debug output
  $mail->isSMTP();                                            //Send using SMTP
  $mail->Host       = $smtpHost;                     //Set the SMTP server to send through
  $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
  $mail->Username   = $smtpUser;                     //SMTP username
  $mail->Password   = $smtpPass;                               //SMTP password
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
  $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

  // Configurar codificación UTF-8
  $mail->CharSet = 'UTF-8';
  $mail->Encoding = 'base64';

  //Recipients
  $mail->setFrom('servicios@electromecanicamora.com', 'Eduardo Mora');
  $mail->addAddress('kendallrm9@gmail.com', 'Kendall reyes');    //Add a recipient
  // $mail->addAddress('ellen@example.com');               //Name is optional
  // $mail->addReplyTo('info@example.com', 'Information');
  // $mail->addCC('cc@example.com');
  // $mail->addBCC('bcc@example.com');

  //Attachments
  // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
  // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

  //Content
  $mail->isHTML(true);                                 //Set email format to HTML
  $mail->Subject = 'Solicitud de Servicios';
  $mail->Body    = '
     
     <div
  style="
    font-family: Arial, sans-serif;
    max-width: 600px;
    margin: auto;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 10px;
    background-color: #ffffff;
  "
>
  <!-- Logo -->
  <div style="text-align: left; padding-bottom: 10px">
    <img
      src="https://electromecanicamora.com/images/generales/logo-principal.webp"
      alt="Logo de la empresa"
      style="width: 150px"
    />
  </div>

  <!-- Título -->
  <h2 style="color: #000; text-align: center; margin-bottom: 20px">
    Solicitud de Servicios
  </h2>

  <!-- Tabla con la información -->
  <table
    style="
      width: 100%;
      border-collapse: collapse;
      background-color: #ffffff;
      border-radius: 10px;
      overflow: hidden;
    "
  >
    <tr>
      <th
        style="
          background-color: #000;
          color: white;
          padding: 12px;
          text-align: left;
          font-size: 14px;
        "
      >
        Dato
      </th>
      <th
        style="
          background-color: #000;
          color: white;
          padding: 12px;
          text-align: left;
          font-size: 14px;
        "
      >
        Información
      </th>
    </tr>
    <tr>
      <td
        style="
          border-bottom: 1px solid #ddd;
          padding: 10px;
          background-color: #f2f2f2;
        "
      >
        <strong>Nombre:</strong>
      </td>
      <td style="border-bottom: 1px solid #ddd; padding: 10px">
        ' . $nombre . '
      </td>
    </tr>
    <tr>
      <td
        style="
          border-bottom: 1px solid #ddd;
          padding: 10px;
          background-color: #f2f2f2;
        "
      >
        <strong>Teléfono:</strong>
      </td>
      <td style="border-bottom: 1px solid #ddd; padding: 10px">
        ' . $telefono . '
      </td>
    </tr>
    <tr>
      <td
        style="
          border-bottom: 1px solid #ddd;
          padding: 10px;
          background-color: #f2f2f2;
        "
      >
        <strong>Email:</strong>
      </td>
      <td style="border-bottom: 1px solid #ddd; padding: 10px">
        <a
          href="mailto:' . $email . '"
          style="color: #000; text-decoration: none; font-weight: bold"
          >' . $email . '</a
        >
      </td>
    </tr>
    <tr>
      <td
        style="
          border-bottom: 1px solid #ddd;
          padding: 10px;
          background-color: #f2f2f2;
        "
      >
        <strong>Capacitación:</strong>
      </td>
      <td style="border-bottom: 1px solid #ddd; padding: 10px">
        ' . $capacitacion . '
      </td>
    </tr>
    <tr>
      <td
        style="
          border-bottom: 1px solid #ddd;
          padding: 10px;
          background-color: #f2f2f2;
        "
      >
        <strong>Mensaje:</strong>
      </td>
      <td style="border-bottom: 1px solid #ddd; padding: 10px">
        ' . $mensaje . '
      </td>
    </tr>
  </table>

  <!-- Footer con fecha y hora de envío -->
  <p
    style="
      margin-top: 20px;
      margin-left: 5px;
      font-size: 12px;
      color: #555;
      text-align: left;
    "
  >
    Enviado el: ' . $fecha_envio . '
  </p>
</div>
     
';
  $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

  $mail->send();
  echo json_encode('exito');
} catch (Exception $e) {
  echo json_encode('error');
}
