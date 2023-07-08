<?php
/*INTEGRANTES: BARAHONA NICOLE, BARRAGAN EILYN, RUIZ JANETH*/
include 'conexion.php';

if (isset($_POST["submitLibro"])) {
    $isbn = $_POST["isbn"];
    $titulo = $_POST["titulo"];
    $autor = $_POST["autor"];
    $editorial = $_POST["editorial"];
    $nroPaginas = $_POST["nroPaginas"];
    $stock = $_POST["stock"];

    $sql = "INSERT INTO libro (ISBN, Titulo, Autor, Editorial, Nropaginas, Stock) VALUES ('$isbn', '$titulo', '$autor', '$editorial', $nroPaginas, $stock)";

    if (mysqli_query($conexion, $sql)) {
        echo "Libro agregado con éxito✅";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
    }
}

if (isset($_GET["delete"])) {
    $isbn = $_GET["delete"];

    $sql = "DELETE FROM libro WHERE ISBN = '$isbn'";

    if (mysqli_query($conexion, $sql)) {
        echo "Libro eliminado con éxito";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
    }
}

$sql = "SELECT ISBN, Titulo, Autor, Editorial, Nropaginas, Stock FROM libro";
$result = mysqli_query($conexion, $sql);
$libros = array();

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $libros[$row["ISBN"]] = $row;
    }
}

mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libros</title>
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
                <li class="nav-item active">
                    <a class="nav-link" href="libros.php">Libros</a>
                </li>
               
                <li class="nav-item">
                    <a class="nav-link" href="prestamos.php">Préstamos</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h2><center>Ingreso de Libros</center></h2>

        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <div class="form-group">
                <label for="isbn">ISBN:</label>
                <input type="text" class="form-control" id="isbn" name="isbn" required>
            </div>
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>
            <div class="form-group">
                <label for="autor">Autor:</label>
                <input type="text" class="form-control" id="autor" name="autor" required>
            </div>
            <div class="form-group">
                <label for="editorial">Editorial:</label>
                <input type="text" class="form-control" id="editorial" name="editorial" required>
            </div>
            <div class="form-group">
                <label for="nroPaginas">Número de Páginas:</label>
                <input type="number" class="form-control" id="nroPaginas" name="nroPaginas" required>
            </div>
            <div class="form-group">
                <label for="stock">Stock:</label>
                <input type="number" class="form-control" id="stock" name="stock" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submitLibro">Agregar Libro ▶️</button>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>ISBN</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Editorial</th>
                    <th>Número de Páginas</th>
                    <th>Stock</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($libros as $isbn => $libro) {
                    echo "<tr>";
                    echo "<td>".$libro["ISBN"]."</td>";
                    echo "<td>".$libro["Titulo"]."</td>";
                    echo "<td>".$libro["Autor"]."</td>";
                    echo "<td>".$libro["Editorial"]."</td>";
                    echo "<td>".$libro["Nropaginas"]."</td>";
                    echo "<td>".$libro["Stock"]."</td>";
                    echo "<td>";
                    echo "<a href='editar_libro.php?isbn=".$libro["ISBN"]."'>Editar ✏️</a> | ";
                    echo "<a href='libros.php?delete=".$libro["ISBN"]."' onclick='return confirm(\"¿Estás seguro de eliminar este libro?\")'>Eliminar ❌</a>";
                    echo "</td>";
                    echo "</tr>";
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
