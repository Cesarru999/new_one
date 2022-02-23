<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Products List</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body class="bg-secondary">
    <?php
    include '../logica/config.php';
    session_start();
    if (!isset($_SESSION['negocio'])) {
        $_SESSION['message'] = "Usuario o contraseña incorrecto!";
        header('location: ../index.php');
    }
    $user = $_SESSION['name'];
    $negocio = $_SESSION['negocio'];
    $id = $_SESSION['id'];
    ?>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <!-- Brand -->
        <a class="navbar-brand"><?php echo $user ?> | Admin</a>

        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" onclick="leave()">Salir</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10 bg-light mt-2 rounded pb-3">
                <h1 class="text-primary p-1 "><?php echo $negocio ?></h1>

                <hr>
                <div class="form-inline">
                    <label for="search" class="font-weight-bold lead text-dark">Search:</label>&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text" name="search" id="search_text" class="form-control form-control-lg rounded-0 border-primary" placeholder="Search..">
                </div>
                <hr>
                <div class="form-inline float-right " id="btn"><a class="btn btn-primary mb-10" href="#create" onclick="appear()">Agregar</a></div><br>
                <hr>

                <?php

                $stmt = $conn->prepare("SELECT * FROM producto WHERE id_N=" . $id);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows < 1) {
                    echo "hola";
                }

                ?>
                <table class="table table-hover table-light table-striped" id="table-data">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 1; $i <= $row = $result->fetch_assoc(); $i++) { ?>
                            <tr id="tr<?= $i; ?>">
                                <td><?= $i; ?></td>
                                <td class="hide"><?= $row['id_P']; ?></td>
                                <td><?= $row['name']; ?></td>
                                <td><?= $row['des']; ?></td>
                                <td><?= $row['cantidad']; ?></td>
                                <td><?= $row['precio']; ?></td>
                                <td><a class="btn btn-warning m-2" id="<?= $i; ?>" href="#updt" onclick="updt(this.id)">Update</a>
                                    <form action="../logica/del.php" method="post" onSubmit="advice()"><input type="hidden" name="id" value="<?= $row['id_P']; ?>"><input type="submit" class="btn btn-danger m-2" value="Delete"></form>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <hr>
                <div class="form-inline float-right mb-2" id="btn1"></div>
                <div class="create hide mt-5 mb-5" id="create">
                    <form action="../logica/ins.php" method="POST" id="ins">
                        <label>Producto:</label><br>
                        <input type="text" name="np" placeholder="Nombre del producto..." required><br>
                        <label>Producto:</label><br>
                        <textarea name="desc" maxlength="100" rows="3" required></textarea>
                        <label>Cantidad:</label>
                        <input type="text" name="cant" placeholder="Ejemplo(1pza)" required>
                        <label>Precio:</label>
                        <input type="text" name="precio" placeholder="$$$$" required>
                        <input type="hidden" name="idn" value="<?= $id ?>">
                        <input type="submit" id="send">
                    </form>
                </div>
                <div class="updt hide mt-5 mb-5" id="updt">
                    <form action="../logica/updt.php" method="POST">
                        <input type="hidden" name="idp1" id="idp1" value="">
                        <label>Producto:</label><br>
                        <input type="text" name="name1" id="name1" placeholder="Nombre del producto..." value="" required><br>
                        <label>Producto:</label><br>
                        <textarea name="desc1" id="desc1" maxlength="100" rows="3" required></textarea>
                        <label>Cantidad:</label>
                        <input type="text" name="cant1" id="cant1" placeholder="Ejemplo(1pza)" required>
                        <label>Precio:</label>
                        <input type="text" name="precio1" id="precio1" placeholder="$$$$" required>
                        <input type="submit" id="send" value="Update">
                    </form>
                </div>

            </div>

        </div>

    </div>


    <script type="text/javascript">
        $(document).ready(function() {
            $("#search_text").keyup(function() {
                var search = $(this).val();
                $.ajax({
                    url: '../logica/action.php',
                    method: 'post',
                    data: {
                        query: search
                    },
                    success: function(response) {
                        $("#table-data").html(response);
                    }
                });
            });
        });


        function leave() {
            var answer = confirm("do you want to leave")

            if (answer) {
                alert("bye");
                window.location = "../logica/salir.php";
            }
        }

        function advice() {
            alert('El dato ha sido eliminado');
        }
        const create = document.getElementById('create');

        function appear() {
            create.classList.toggle('hide');
            document.getElementById('btn').innerHTML = '<a class="btn btn-primary mb-10"   onclick="disappear()">Ocultar</a>';
            document.getElementById('btn1').innerHTML = '<a class="btn btn-primary mb-10"   onclick="disappear()">Ocultar</a>';
        }

        function disappear() {
            create.classList.add('hide');
            document.getElementById('btn').innerHTML = '<a class="btn btn-primary mb-10"  href="#create" onclick="appear()">Agregar</a>';
            document.getElementById('btn1').innerHTML = '';
        }

        const update = document.getElementById('updt');

        function updt(tr) {
            if (update.classList.contains('hide')) {
                update.classList.toggle('hide');
            }
            const a = document.getElementById('tr' + tr + '').getElementsByTagName('td');
            console.log(a[1].innerHTML);
            for (var i = 2; i < 6; i++) {
                console.log(a[i].innerHTML);
            }
            var id = a[1].innerHTML;
            document.getElementById('idp1').value = id;
            var name = a[2].innerHTML;
            document.getElementById('name1').value = name;
            var desc = a[3].innerHTML;
            document.getElementById('desc1').value = desc;
            var cant = a[4].innerHTML;
            document.getElementById('cant1').value = cant;
            var precio = a[5].innerHTML;
            document.getElementById('precio1').value = precio;
        }
    </script>
</body>

</html>