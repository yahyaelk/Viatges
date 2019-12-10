<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php
    require_once('model/experiencia.php');
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <title>Viatges</title>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <img id="logo" src="logo_rombo/facebook_cover_photo_1.png">
            </div>
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
            
    <?php
        session_start();

        if (empty($_SESSION['userLogged'])) {
            echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Inicia Sessió</button>
                <button type="button" class="btn btn-secondary">Registrarse</button>';
            
            //MODAL

            echo '<div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h1 class="modal-title h3 mb-3 font-weight-normal">Please sign in</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-signin">
                                <label for="inputEmail" class="sr-only">Email address</label>
                                <input type="email" id="inputEmail" class="form-control"
                                    placeholder="Email address" required autofocus>
                                <label for="inputPassword" class="sr-only">Password</label>
                                <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                        </div>
                    </div>
                </div>
            </div>';
        }else{
            //TODO En cas de que estigui loguejat
        }
    ?>
            </div>
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
                    <p id="mensajeBienvenida">Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae officia
                        cumque nostrum neque, incidunt corrupti. Eaque praesentium modi cumque amet aliquam ea fugit
                        explicabo dolores quod sapiente? Repudiandae, quae. Ut.</p>
                </div>
            </div>
        </div>
    </div>

    
    <div class="display-4">
        <?php
            if (empty($_SESSION['userLogged'])) {
                echo 'Últimes experiències';
            }else{
                echo 'Experiències';
            }
        ?>
    </div>
    <div class="container">
        <div class="row" id="experiencies">
            <?php
                $experiencia = new Experiencia();

                if (empty($_SESSION['userLogged'])) {
                    $experiencies = $experiencia->selectUltimesExperiencies();

                    for ($i = 0; $i < sizeof($experiencies); $i++) {
                        $iExperiencia = $experiencies[$i];
    
                        echo '<div class="col-4 experiencia">'.$iExperiencia['titol'].'</div>';
                    }
                }else{
                    //TODO En cas de que estigui loguejat
                }
                ?>
        </div>
    </div>

</body>

</html>