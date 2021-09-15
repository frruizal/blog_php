<h2>Datos de contacto</h2>
<?php

$name = $_POST["nombre"] ?? "";
$email = $_POST["email"] ?? "";
$asunto = $_POST["asunto"] ?? "";
$mensaje = $_POST["mensaje"] ?? "";


//$_FILES["imagen"]["name"]; //Nombre original del fichero en la máquina cliente
/*$_FILES['imagen']['type’] //Tipo mime del fichero. Por ejemplo, "image/gif"
$_FILES['imagen']['size’] //Tamaño en bytes del fichero subido
$_FILES['imagen']['tmp_name’] //Nombre del fichero temporal en el que se almacena el fichero 
subido en el servidor
$_FILES['imagen']['error’]*/

//para subir el fichero
if (!$_FILES["imagen"]["error"] && is_uploaded_file($_FILES["imagen"]["tmp_name"])) {
    $nombreDirectorio = dirname(__FILE__) . "/uploads/" . date('M') . "/";
    $idUnico = time();
    $nombreFichero = $idUnico . "-" . $_FILES["imagen"]["name"];
    if (!file_exists($nombreDirectorio)) {
        mkdir($nombreDirectorio, 0777, true);
    }
    move_uploaded_file(
        $_FILES["imagen"]["tmp_name"],
        $nombreDirectorio . $nombreFichero
    );
    echo "<h3>Fichero subido correctamente </h3>";
} else {
    echo "<h3>No se ha podido subir el fichero</h3>";
}

echo "Nombre y apellidos: " . $name . "<br>";
echo "Email: " . $email . "<br>";
echo "Asunto: " . $asunto . "<br>";
echo "Mensaje: " . $mensaje . "<br>";

?>