<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php
    require_once('model/Experiencia.php');
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- BOOTSTRAP CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- BOOTSTRAP JS-->
    <!--script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <link rel="icon" href="logos/favicon.png">
    
    <title>Viatges</title>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <img id="logo" src="logos/logo.png">
            </div>
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
            
    <?php
        session_start();

        if (empty($_SESSION['userLogged'])) {
            echo '<button type="button" id="iniciarSessio" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Inicia Sessió</button>
                <button type="button" class="btn btn-secondary">Registrarse</button>';
            
            //MODAL

            echo '<div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title h3 mb-3 font-weight-normal">Please sign in</h1>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form class="form-signin">
                                <label for="inputUser" class="sr-only">User</label>
                                <input type="text" id="inputUser" class="form-control"
                                    placeholder="User" required autofocus>
                                <label for="inputPassword" class="sr-only">Password</label>
                                <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type= "button" id= "botoIni" class="btn btn-lg btn-primary btn-block">Sign in</button>
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
                    <img id="object_plane" src="img/avion.png" width="50">
                    <p id="mensajeBienvenida">Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae officia
                        cumque nostrum neque, incidunt corrupti. Eaque praesentium modi cumque amet aliquam ea fugit
                        explicabo dolores quod sapiente? Repudiandae, quae. Ut.</p>
                </div>
            </div>
        </div>
    </div>

    
    <div class="display-4 margin-bottom-20">
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
                    echo '<div class="col-4 margin-bottom-20">
                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top" src="img/card.jpg" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">Experiencia</h5>
                                    <p class="card-text"><small class="text-muted">09-12-2019</small></p>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card\'s content.</p>
                                </div>
                            </div>
                        </div>';
                }
                ?>

            
        </div>
    </div>
    <script type="text/javascript" src="js/scripts.js"></script>
</body>

</html>