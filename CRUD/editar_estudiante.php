<?php
/*INTEGRANTES: BARAHONA NICOLE, BARRAGAN EILYN, RUIZ JANETH*/
include 'conexion.php';

if (isset($_GET["codAlumno"])) {
    $codAlumno = $_GET["codAlumno"];
    $sql = "SELECT CodAlumno, Nombre, Apellidos, Email FROM estudiante WHERE CodAlumno = '$codAlumno'";
    $result = mysqli_query($conexion, $sql);
    $estudiante = mysqli_fetch_assoc($result);
}

if (isset($_POST["submitEditarEstudiante"])) {
    $codAlumno = $_POST["codAlumno"];
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $email = $_POST["email"];

    $sql = "UPDATE estudiante SET Nombre = '$nombre', Apellidos = '$apellidos', Email = '$email' WHERE CodAlumno = '$codAlumno'";

    if (mysqli_query($conexion, $sql)) {
        header("Location: estudiantes.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
    }
}

mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Estudiante</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body{
            background-image: url("biblioteca.png");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2><center>Editar Estudiante</center></h2>

        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <div class="form-group">
                <label for="codAlumno">Código del Alumno:</label>
                <input type="text" class="form-control" id="codAlumno" name="codAlumno" value="<?php echo $estudiante['CodAlumno']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $estudiante['Nombre']; ?>" required>
            </div>
            <div class="form-group">
                <label for="apellidos">Apellidos:</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo $estudiante['Apellidos']; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $estudiante['Email']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submitEditarEstudiante">Hecho✅</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
