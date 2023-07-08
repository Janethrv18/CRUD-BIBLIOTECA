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

function obtenerLibros($conn) {
    $sql = "SELECT ISBN, Titulo FROM libro";
    $result = $conn->query($sql);
    $libros = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $libros[$row["ISBN"]] = $row;
        }
    }

    return $libros;
}

if (isset($_GET["codPrestamo"])) {
    $codPrestamo = $_GET["codPrestamo"];
    $sql = "SELECT p.CodPrestamo, p.ISBN, p.CodAlumno, p.Fechadeprestamo, p.Fechadedevolucion, e.Nombre, e.Apellidos, l.Titulo FROM Prestamo p INNER JOIN estudiante e ON p.CodAlumno = e.CodAlumno INNER JOIN libro l ON p.ISBN = l.ISBN WHERE p.CodPrestamo = $codPrestamo";
    $result = $conexion->query($sql);

    if ($result && $result->num_rows > 0) {
        $prestamo = $result->fetch_assoc();
        $result->free_result(); // Liberar memoria del resultado
    } else {
        echo "Error en la consulta: " . $conexion->error;
    }
}

if (isset($_POST["submitEditarPrestamo"])) {
    $codPrestamo = $_POST["codPrestamo"];
    $isbn = $_POST["isbn"];
    $codAlumno = $_POST["codAlumno"];
    $fechaPrestamo = $_POST["fechaPrestamo"];
    $fechaDevolucion = $_POST["fechaDevolucion"];

    $sql = "UPDATE Prestamo SET ISBN = '$isbn', CodAlumno = '$codAlumno', Fechadeprestamo = '$fechaPrestamo', Fechadedevolucion = '$fechaDevolucion' WHERE CodPrestamo = '$codPrestamo'";

    if ($conexion->query($sql) === TRUE) {
        header("Location: prestamos.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
}

$libros = obtenerLibros($conexion);
$estudiantes = obtenerEstudiantes($conexion);

$conexion->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Préstamo</title>
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
        <h2><center>Editar Préstamo</center></h2>

        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <div class="form-group">
                <label for="codPrestamo">Código del Préstamo:</label>
                <input type="text" class="form-control" id="codPrestamo" name="codPrestamo" value="<?php echo isset($prestamo['CodPrestamo']) ? $prestamo['CodPrestamo'] : ''; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="isbn">ISBN:</label>
                <select class="form-control" id="isbn" name="isbn" required>
                    <?php
                    foreach ($libros as $isbn => $libro) {
                        $selected = $isbn == $prestamo['ISBN'] ? 'selected' : '';
                        echo "<option value='$isbn' $selected>".$libro["Titulo"]."</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="codAlumno"> Estudiante:</label>
                <select class="form-control" id="codAlumno" name="codAlumno" required>
                    <?php
                    foreach ($estudiantes as $codAlumno => $estudiante) {
                        $selected = $codAlumno == $prestamo['CodAlumno'] ? 'selected' : '';
                        echo "<option value='$codAlumno' $selected>".$estudiante["Nombre"]." ".$estudiante["Apellidos"]."</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="fechaPrestamo">Fecha de Préstamo:</label>
                <input type="date" class="form-control" id="fechaPrestamo" name="fechaPrestamo" value="<?php echo isset($prestamo['Fechadeprestamo']) ? $prestamo['Fechadeprestamo'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="fechaDevolucion">Fecha de Devolución:</label>
                <input type="date" class="form-control" id="fechaDevolucion" name="fechaDevolucion" value="<?php echo isset($prestamo['Fechadedevolucion']) ? $prestamo['Fechadedevolucion'] : ''; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submitEditarPrestamo">Hecho✅</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
