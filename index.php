<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php
    require_once('model/experiencia.php');
    ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Viatges</title>
</head>

<body>

    <div class="flexible">
        <div>
            <img id="logo" src="logo_rombo/facebook_cover_photo_1.png">
        </div>
        <div>
            <button type="button" class="btn btn-light">Inicia Sessió</button>
            <button type="button" class="btn btn-light">Registrarse</button>
        </div>
    </div>

    <div id="bienvenida">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-xl-5">
                        <img src="img/main-avion.gif" height="280" width="437.5">
                    </div>
                    <div class="col-12 col-xl-6">
                        <h1>Benvingut</h1>
                        <p id="mensajeBienvenida">Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae officia cumque nostrum neque, incidunt corrupti. Eaque praesentium modi cumque amet aliquam ea fugit explicabo dolores quod sapiente? Repudiandae, quae. Ut.</p>
                    </div>
                </div>
        </div>
    </div>

    <div class="display-4">Últimes experiències</div>
    <div class="container">
        <div class="row">
            <?php
                $experiencia = new Experiencia();

                $experiencies = $experiencia->selectUltimesExperiencies();

                for ($i = 0; $i < sizeof($experiencies); $i++) {
                    $iExperiencia = $experiencies[$i];

                    echo '<div class="col-sm">'.$iExperiencia['titol'].'</div>';
                }
                
                ?>
        </div>
    </div>

</body>

</html>