<?php
// Mostrar errores para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verificar reCAPTCHA
$secretKey = "CLAVE SECRETA";
$token = $_POST['g-recaptcha-response'];
$url = "https://www.google.com/recaptcha/api/siteverify";

$data = ['secret' => $secretKey, 'response' => $token];

$options = [
    'http' => [
        'header' => "Content-type: application/x-www-form-urlencoded\r\n",
        'method' => 'POST',
        'content' => http_build_query($data)
    ]
];

$context = stream_context_create($options);
$response = file_get_contents($url, false, $context);
$result = json_decode($response, true);

if ($result['success'] && $result['score'] >= 0.5) {
    // Datos del formulario
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $subject = htmlspecialchars($_POST['subject']); 
    $message = htmlspecialchars($_POST['message']);

    if (!$email) {
        echo "Email inválido.";
        exit;
    }

    // Configuración del correo
    $to = 'correo@tudominio.com'; 
    $email_subject = "Nuevo mensaje de contacto: " . $subject; 
    $body = "Nombre: $name\nEmail: $email\nAsunto: $subject\nMensaje:\n$message"; 
    $headers = "From: $email\r\n" .
               "Reply-To: $email\r\n" .
               "X-Mailer: PHP/" . phpversion();

    // Envío del correo
    if (mail($to, $email_subject, $body, $headers)) {
        echo "Mensaje enviado con éxito.";
    } else {
        echo "Error al enviar el mensaje.";
    }
} else {
    echo "Error en la verificación de reCAPTCHA.";
}
?>
