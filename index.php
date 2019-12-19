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
    <!-- LLIBRERIA D'ICONES PER EL LIKE I DISLIKE -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- BOOTSTRAP JS-->
    <!--script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="icon" href="logos/favicon_3.png">

    <title>Viatges</title>
</head>

<body>
    <header id="main-header">

        <div class="container">
            <div class="row">
                <div class="col-4 col-lg-4">
                    <img id="logo" src="logos/logo.png">
                </div>
                <div class="col-1 col-lg-4"></div>
                <div class="col-7 col-lg-4" id="headerRight" style="margin-top: 5px;">

                </div>
            </div>
        </div>
    </header>


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


    <div class="display-4 margin-bottom-20">Últimes experiències</div>

    <div class="container margin-bottom-20">
        <div class="row d-flex flex-row-reverse bd-highlight col-12">
            <div id="afegir"></div>
            <div id="filtreCat"></div>
            <div id="ordenacio" class="col-10 col-md-8 col-lg-6 col-xl-4 row"></div>
        </div>
    </div>
    <div class="container">
        <div class="row" id="experiencies">

        </div>
    </div>

    <div class="modal fade" id="myModal" role="dialog">
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
                        <input type="text" id="inputUser" class="form-control" placeholder="User" required autofocus>
                        <label for="inputPassword" class="sr-only">Password</label>
                        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
                    </form>
                    <p id="message" class= "message-error"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" id="botoIni" class="btn btn-lg btn-primary btn-block">Sign in</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModalExp" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title h3 mb-3 font-weight-normal">Nova experiencia</h1>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form class="form-signin">
                        <label for="inputTitol" class="sr-only">Títol</label>
                        <input type="text" id="inputTitol" class="form-control" placeholder="Titol" required autofocus>
                        <p id="titolRes" class="message-error"></p>
                        <label for="inputData" class="sr-only">Data</label>
                        <input type="text" id="inputData" class="form-control" placeholder="Data" required>
                        <p id="fechaRes" class="message-error"></p>
                        <label for="inputText" class="sr-only">Text</label>
                        <textarea type="text" rows="4" id="inputText" class="form-control" placeholder="Text"
                            required></textarea>
                        <p id="textRes" class="message-error"></p>
                        <select id="inputCatNou" class="form-control">
                            <?php
                                require_once('model/Categoria.php');
                                $categoria = new Categoria();
                                $categories = $categoria->selectTotesCategories();
                                foreach ($categories as $cat){
                                    echo '<option value='.$cat['id'].'>'.$cat['nom'].'</option>';
                                }
                            ?>
                        </select>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="afegirExp" class="btn btn-lg btn-primary btn-block">Afegir</button>
                </div>
            </div>
        </div>
    </div>
        <div class="modal fade" id="modalRegist" role="dialog" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title h3 mb-3 font-weight-normal">Registra't</h1>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>
                    <div class="modal-body">
                        <form class="form-signin">
                            <label for="inputUserReg" class="sr-only">User</label>
                            <input type="text" id="inputUserReg" class="form-control" placeholder="User" required=""
                                autofocus="">
                            <label for="inputPasswordReg" class="sr-only">Password</label>
                            <input type="password" id="inputPasswordReg" class="form-control" placeholder="Password"
                                required="">
                        </form>
                        <p id="messageReg" class="message-error"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="botoRegistrar"
                            class="btn btn-lg btn-primary btn-block">Register</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->

        <footer class="page-footer font-small py-5">
            <!-- Footer Links -->
            <div class="container text-center text-md-left mt-5">

                <!-- Grid row -->
                <div class="row mt-3 dark-grey-text">

                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <div class="mapouter">
                            <div class="gmap_canvas">
                                <iframe width="368" height="361" id="gmap_canvas"
                                    src="https://maps.google.com/maps?q=Barcelona%2C%20Av.%20d'Esplugues%2C%2036%2C%2042&amp;t=&amp;z=15&amp;ie=UTF8&amp;iwloc=&amp;output=embed"
                                    frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                                <a href="https://www.embedgooglemap.net/blog/elementor-pro-discount-code-review/">elementor
                                    review</a>
                            </div>
                            <style>
                                .mapouter {
                                    position: relative;
                                    text-align: right;
                                    height: 361px;
                                    width: 368px;
                                }

                                .gmap_canvas {
                                    overflow: hidden;
                                    background: none !important;
                                    height: 361px;
                                    width: 368px;
                                }
                            </style>
                        </div>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">

                        <!-- Links -->
                        <h6 class="text-uppercase font-weight-bold">Contacte</h6>
                        <hr class="teal accent-3 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                        <p>
                            <i></i> - Barcelona, Av. d'Esplugues, 36, 42</p>
                        <p>
                            <i></i> - a8076391@xtec.cat</p>
                        <p>
                            <i></i> - 932 033 332</p>
                        <p>
                            <i></i> - 932 046 212</p>
                        <p>
                            <a class="text-muted" href="admin">Pàgina
                                Admin</a></p>

                    </div>
                    <!-- Grid column -->

                </div>
                <!-- Grid row -->

            </div>
            <!-- Footer Links -->

            <!-- Copyright -->
            <div class="footer-copyright text-center text-black-50 py-3">© 2019:
                <a class="dark-grey-text"> Sonia, Laia, Yahya</a>
            </div>
            <!-- Copyright -->

        </footer>

        <script type="text/javascript" src="js/scripts.js"></script>
</body>

</html>