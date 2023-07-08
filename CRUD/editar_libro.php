<?php
/*INTEGRANTES: BARAHONA NICOLE, BARRAGAN EILYN, RUIZ JANETH*/
include 'conexion.php';

if (isset($_GET["isbn"])) {
    $isbn = $_GET["isbn"];
    $sql = "SELECT ISBN, Titulo, Autor, Editorial, Nropaginas, Stock FROM libro WHERE ISBN = '$isbn'";
    $result = mysqli_query($conexion, $sql);

    if ($result) {
        $libro = mysqli_fetch_assoc($result);
        mysqli_free_result($result); // Liberar memoria del resultado
    } else {
        echo "Error en la consulta: " . mysqli_error($conexion);
    }
}

if (isset($_POST["submitEditarLibro"])) {
    $isbn = $_POST["isbn"];
    $titulo = $_POST["titulo"];
    $autor = $_POST["autor"];
    $editorial = $_POST["editorial"];
    $nroPaginas = $_POST["nroPaginas"];
    $stock = $_POST["stock"];

    $sql = "UPDATE libro SET Titulo = '$titulo', Autor = '$autor', Editorial = '$editorial', Nropaginas = $nroPaginas, Stock = $stock WHERE ISBN = '$isbn'";

    if (mysqli_query($conexion, $sql)) {
        header("Location: libros.php");
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
    <title>Editar Libro</title>
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
        <h2><center>Editar Libro</center></h2>

        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <div class="form-group">
                <label for="isbn">ISBN:</label>
                <input type="text" class="form-control" id="isbn" name="isbn" value="<?php echo isset($libro['ISBN']) ? $libro['ISBN'] : ''; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo isset($libro['Titulo']) ? $libro['Titulo'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="autor">Autor:</label>
                <input type="text" class="form-control" id="autor" name="autor" value="<?php echo isset($libro['Autor']) ? $libro['Autor'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="editorial">Editorial:</label>
                <input type="text" class="form-control" id="editorial" name="editorial" value="<?php echo isset($libro['Editorial']) ? $libro['Editorial'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="nroPaginas">Número de Páginas:</label>
                <input type="number" class="form-control" id="nroPaginas" name="nroPaginas" value="<?php echo isset($libro['Nropaginas']) ? $libro['Nropaginas'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="stock">Stock:</label>
                <input type="number" class="form-control" id="stock" name="stock" value="<?php echo isset($libro['Stock']) ? $libro['Stock'] : ''; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submitEditarLibro">Hecho✅</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
