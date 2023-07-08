<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/estilos.css">

    <style>
        body{
            background-image: url("index.png");
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
    
        
    <h1 class="title">BIENVENIDOS A LA BIBLIOTECA 💻📚</h1>

    <div class="container__slider">

        <div class="container">
            <input type="radio" name="slider" id="item-1" checked>
            <input type="radio" name="slider" id="item-2">
            <input type="radio" name="slider" id="item-3">

            <div class="cards">
                <label class="card" for="item-1" id="selector-1">
                    <img src="images/img1.png">
                </label>
                <label class="card" for="item-2" id="selector-2">
                    <img src="images/img2.png">
                </label>
                <label class="card" for="item-3" id="selector-3">
                    <img src="images/img3.png">
                </label>

            </div>
        </div>

    </div>
</body>

</html>






