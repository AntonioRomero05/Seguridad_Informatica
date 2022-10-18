<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Seguridad Informatica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<br>

<body>
    <?php

    require_once('conexion.php');

    $conn = new conexion();
    ?>

    <div class="container">
        <h1>Metodo de Cifrado Simetrico</h1>
        <br>
        <div class="card">
            <div class="card-header bg-info">
                <h3 class="text-white">Hash V2 - sha2</h3>

            </div>
            <div class="card-body">
                <div class="row">
                    <form method="post" action="cifrarHashv2.php" enctype="multipart/form-data">
                        <div class="col-md-6">
                            <label for="nombre">Nombre:</label>
                            <input type="text" name="nombre" id="nombre" placeholder="escriba su nombre" required autofocus class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="apellidos">Apellidos:</label>
                            <input type="text" name="apellidos" id="apellidos" placeholder="escriba sus apellidos" required class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="telefono">Telefono:</label>
                            <input type="number" name="telefono" id="telefono" placeholder="escriba su telefono" maxlength="10" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="direccion">Dirección:</label>
                            <input type="address" name="direccion" id="direccion" placeholder="escriba su direccion" required class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="identificacion">Identificacion:</label>
                            <input type="text" name="identificacion" id="identificacion" placeholder="escriba su clave de identificacion(credencial)" required class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="correo">Correo Electronico:</label>
                            <input type="email" name="correo" id="correo" placeholder="escriba su Correo electronico" required class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="password">Contraseña:</label>
                            <input type="password" name="password" id="password" placeholder=" ingrese una nueva contraseña" required class="form-control">
                        </div>
                        <br>
                        <button class="btn btn-secondary" type="submit">Enviar</button>
                    </form>

                </div>
                <br>
                <div class="row">
                    <form method="post" action="descifrarHashv2.php" enctype="multipart/form-data">
                        <div class="col-md-6">
                            <label for="numreg">Numero de Registro:</label>
                            <input type="number" name="numreg" id="numreg" placeholder="El numero del registro que desea descifrar" required class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="pass">Contraseña:</label>
                            <input type="text" name="pass" id="pass" placeholder="La contraseña para consultar" required class="form-control">
                        </div>
                        <br>
                        <button class="btn btn-warning" type="submit">Consultar</button>
                    </form>

                </div>
            </div>
            <div class="card-footer">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No. de Registro</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Telefono</th>
                            <th>Correo</th>
                            <th>Contraseña</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM hashv2";
                        $result = mysqli_query($conn->conectardb(), $sql);

                        while ($mostrar = mysqli_fetch_array($result)) {
                        ?>
                            <tr>
                                <td><?php echo $mostrar['idh2'] ?></td>
                                <td><?php echo $mostrar['nombre'] ?></td>
                                <td><?php echo $mostrar['apellidos'] ?></td>
                                <td><?php echo $mostrar['telefono'] ?></td>
                                <td><?php echo $mostrar['correo'] ?></td>
                                <td><?php echo $mostrar['pass'] ?></td>
                            </tr>
                        <?php
                        } ?>

                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <a class="btn btn-outline-success" href="SeguridadInformatica.php">Regresar al Inicio</a>

    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>