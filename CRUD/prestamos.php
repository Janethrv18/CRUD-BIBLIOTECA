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

if (isset($_POST["submitPrestamo"])) {
    $codPrestamo = $_POST["codPrestamo"];
    $isbn = $_POST["isbn"];
    $codAlumno = $_POST["codAlumno"];
    $fechaPrestamo = $_POST["fechaPrestamo"];
    $fechaDevolucion = $_POST["fechaDevolucion"];

    $sql = "INSERT INTO Prestamo (CodPrestamo, ISBN, CodAlumno, Fechadeprestamo, Fechadedevolucion) VALUES ($codPrestamo, '$isbn', $codAlumno, '$fechaPrestamo', '$fechaDevolucion')";

    if (mysqli_query($conexion, $sql)) {
        echo "Préstamo registrado con éxito✅.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
    }
}

if (isset($_GET["delete"])) {
    $codPrestamo = $_GET["delete"];

    $sql = "DELETE FROM Prestamo WHERE CodPrestamo = $codPrestamo";

    if (mysqli_query($conexion, $sql)) {
        echo "Préstamo eliminado con éxito ";
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
    <title>Préstamos</title>
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
                <li class="nav-item">
                    <a class="nav-link" href="estudiantes.php">Estudiantes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="libros.php">Libros</a>
                </li>
                
                <li class="nav-item active">
                    <a class="nav-link" href="prestamos.php">Préstamos</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h2><center>Área de Préstamos de Libros</center></h2>

        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <div class="form-group">
                <label for="codPrestamo">Código del Préstamo:</label>
                <input type="text" class="form-control" id="codPrestamo" name="codPrestamo" required>
            </div>
            <div class="form-group">
                <label for="isbn">ISBN:</label>
                <select class="form-control" id="isbn" name="isbn" required>
                    <?php
                    $libros = obtenerLibros($conexion);
                    foreach ($libros as $isbn => $libro) {
                        echo "<option value='".$isbn."'>".$libro["Titulo"]."</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="codAlumno">Estudiante:</label>
                <select class="form-control" id="codAlumno" name="codAlumno" required>
                    <?php
                    $estudiantes = obtenerEstudiantes($conexion);
                    foreach ($estudiantes as $codAlumno => $estudiante) {
                        echo "<option value='".$codAlumno."'>".$estudiante["Nombre"]." ".$estudiante["Apellidos"]."</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="fechaPrestamo">Fecha de Préstamo:</label>
                <input type="date" class="form-control" id="fechaPrestamo" name="fechaPrestamo" required>
            </div>
            <div class="form-group">
                <label for="fechaDevolucion">Fecha de Devolución:</label>
                <input type="date" class="form-control" id="fechaDevolucion" name="fechaDevolucion" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submitPrestamo">Registrar Préstamo ▶️</button>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>CodPrestamo</th>
                    <th>ISBN</th>
                    <th>CodAlumno</th>
                    <th>Fechadeprestamo</th>
                    <th>Fechadedevolucion</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT p.CodPrestamo, p.ISBN, p.CodAlumno, p.Fechadeprestamo, p.Fechadedevolucion, e.Nombre, e.Apellidos, l.Titulo FROM Prestamo p INNER JOIN estudiante e ON p.CodAlumno = e.CodAlumno INNER JOIN libro l ON p.ISBN = l.ISBN";
                $result = mysqli_query($conexion, $sql);

                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>".$row["CodPrestamo"]."</td>";
                        echo "<td>".$row["ISBN"]."</td>";
                        echo "<td>".$row["CodAlumno"]."</td>";
                        echo "<td>".$row["Fechadeprestamo"]."</td>";
                        echo "<td>".$row["Fechadedevolucion"]."</td>";
                        echo "<td>";
                        echo "<a href='editar_prestamo.php?codPrestamo=".$row["CodPrestamo"]."'>Editar ✏️</a> | ";
                        echo "<a href='prestamos.php?delete=".$row["CodPrestamo"]."' onclick='return confirm(\"¿Estás seguro de eliminar este préstamo?\")'>Eliminar ❌</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No se encontraron préstamos.</td></tr>";
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
