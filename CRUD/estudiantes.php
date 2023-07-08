<?php
/*INTEGRANTES: BARAHONA NICOLE, BARRAGAN EILYN, RUIZ JANETH*/
include 'conexion.php';

function obtenerEstudiantes($conn) {
    $sql = "SELECT CodAlumno, Nombre, Apellidos FROM estudiante";
    $result = $conn->query($sql);
    $estudiantes = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $estudiantes[$row["CodAlumno"]] = $row;
        }
    }

    return $estudiantes;
}

if (isset($_POST["submitEstudiante"])) {
    $codAlumno = $_POST["codAlumno"];
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $email = $_POST["email"];

    $sql = "INSERT INTO estudiante (CodAlumno, Nombre, Apellidos, Email) VALUES ($codAlumno, '$nombre', '$apellidos', '$email')";

    if (mysqli_query($conexion, $sql)) {
        echo "Estudiante agregado con éxito✅";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
    }
}

if (isset($_GET["delete"])) {
    $codAlumno = $_GET["delete"];

    $sql = "DELETE FROM estudiante WHERE CodAlumno = $codAlumno";

    if (mysqli_query($conexion, $sql)) {
        echo "Estudiante eliminado con éxito";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudiantes</title>
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Inicio</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="estudiantes.php">Estudiantes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="libros.php">Libros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="prestamos.php">Préstamos</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h2><center>Ingreso de Estudiantes</center></h2>

        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <div class="form-group">
                <label for="codAlumno">Código del Alumno:</label>
                <input type="text" class="form-control" id="codAlumno" name="codAlumno" required>
            </div>
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="apellidos">Apellidos:</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submitEstudiante">Agregar Estudiante ▶️</button>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>CodAlumno</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Email</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT CodAlumno, Nombre, Apellidos, Email FROM estudiante";
                $result = mysqli_query($conexion, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>".$row["CodAlumno"]."</td>";
                        echo "<td>".$row["Nombre"]."</td>";
                        echo "<td>".$row["Apellidos"]."</td>";
                        echo "<td>".$row["Email"]."</td>";
                        echo "<td>";
                        echo "<a href='editar_estudiante.php?codAlumno=".$row["CodAlumno"]."'>Editar ✏️</a> | ";
                        echo "<a href='estudiantes.php?delete=".$row["CodAlumno"]."' onclick='return confirm(\"¿Deseas eliminar este estudiante?\")'>Eliminar ❌</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No hay estudiantes registrados</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

