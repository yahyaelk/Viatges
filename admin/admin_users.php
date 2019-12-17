<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Administrar usuaris</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center" style="margin-top: 50px;">
                <div class="col-6">
                    <ul class="list-group">

                        <?php
                        require_once('../model/Usuari.php');

                        $usuari = new Usuari();

                        $usuaris = $usuari->selectTotsUsuaris();

                        for ($i = 0; $i < sizeof($usuaris); $i++) {
                            $iUsuari = $usuaris[$i];
                            echo '<li class="list-group-item">' . $iUsuari['nom'] . '<button type="button" name="' . $iUsuari['id'] . '" class="close eliminarContacte" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button></li>';
                        }
                        ?>

                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title h3 mb-3 font-weight-normal">Estàs segur?</h1>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Estàs segur que vols eliminar-lo?</p>
                </div>
                <div class="modal-footer">
                    <form action="eliminar_usuari.php" method="post">
                        <input type="hidden" id="idEliminar" name="idEliminar">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel·lar</button>
                        <input type="submit" class="btn btn-primary" value="Eliminar">
                    </form>
                </div>
            </div>
        </div>
    </div>

    

    <script>
        $(document).ready(function() {
            $('.eliminarContacte').click(function() {
                var id = $(this).attr('name');

                $('#idEliminar').val(id);

                $('#myModal').modal('show');
            });
        });
    </script>

</body>

</html>