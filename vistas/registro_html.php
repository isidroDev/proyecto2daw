    <?php

    require_once 'php/conexion.php';

    $conuslta = "SELECT * FROM comunidades";
    $resultadoComunidades = mysqli_query($link, $conuslta);

    if (isset($_SESSION['mensaje'])) {
        echo "<div style='text-align: center; font-size: 20px; color: red;'>" . $_SESSION['mensaje'] . "</div>";
        unset($_SESSION['mensaje']);
    }

    ?>

    <!-- formulario de registro -->

    <div class="container-fluid">
        <div class="row">
            <div class="d-flex flex-column align-items-center mt-5">
                <div class="col-md-6">
                    <div class="card mb-5">
                        <div class="card-header">
                            <h5 class="card-title text-dark text-center">Registro</h5>
                        </div>

                        <div class="card-body ">
                            <form action="/php/insertar_registro.php" method="post" onsubmit="return validarFormulario()" style="width: 100%; max-width: 1000px; margin: auto;">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email:</label>
                                        <input type="email" class="form-control" id="email" name="email">
                                        <div id="emailError" class="invalid-feedback" style="display: none;"></div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="password" class="form-label">Contraseña:</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="password" name="password" title="La contraseña debe tener al menos 12 caracteres, contener al menos una letra mayúscula, una letra minúscula, un dígito, y no debe contener espacios.">
                                            <div class="input-group-append">
                                                <button id="show_password" class="btn btn-outline-secondary" type="button" onmousedown="showPassword()" onmouseup="hidePassword()" ontouchstart="showPassword()" ontouchend="hidePassword()">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                            <div id="contrasenaError" class="invalid-feedback" style="display: none;"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="nombre" class="form-label">Nombre:</label>
                                            <input type="text" class="form-control" id="nombre" name="nombre">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="apellidos" class="form-label">Apellidos:</label>
                                            <input type="text" class="form-control" id="apellidos" name="apellidos">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="movil" class="form-label">Móvil:</label>
                                            <input type="text" class="form-control" id="movil" name="movil">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="dni" class="form-label">DNI:</label>
                                            <input type="text" class="form-control" id="dni" name="dni">
                                            <div id="dniError" class="invalid-feedback" style="display: none;"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 text-dark text-center">
                                        <label for="comunidad" class="form-label">Comunidad donde te presentas:</label>
                                        <select class="form-control" id="comunidad" name="comunidad">
                                            <?php
                                            while ($comunidad = mysqli_fetch_assoc($resultadoComunidades)) {
                                                echo "<option value='{$comunidad['comunidad']}'>{$comunidad['comunidad']}</option>";
                                            }
                                            ?>
                                        </select>
                                        <div class="mb-3 d-flex justify-content-center mt-3">
                                            <button type="submit" class="btn btn-primary w-100">Registrarse</button>
                                        </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>
    <?php
    include 'vistas/footer.php';
    ?>


 

    <script>
        //funcion para calcular la letra del DNI
        function calcularLetraDNI(numero) {
            const letras = "TRWAGMYFPDXBNJZSQVHLCKE";
            const resto = numero % 23;
            return letras.charAt(resto);
        }

        //funcion para validar el DNI
        function validarDni(dni) {
            const numero = dni.slice(0, -1);
            const letra = dni.slice(-1).toUpperCase();
            const letraCalculada = calcularLetraDNI(numero);
            return letra === letraCalculada;
        }

        //funcion para validar el email
        function validarEmail(email) {
            const re = /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;
            return re.test(String(email).toLowerCase());
        }

        //funcion para validar la contraseña
        function validarContrasena(password) {
            // Longitud mínima
            if (password.length < 6) {
                return "La contraseña debe tener al menos 6 caracteres.";
            }

            // Verificar si contiene al menos una letra mayúscula
            if (!/[A-Z]/.test(password)) {
                return "La contraseña debe contener al menos una letra mayúscula.";
            }

            // Verificar si contiene al menos una letra minúscula
            if (!/[a-z]/.test(password)) {
                return "La contraseña debe contener al menos una letra minúscula.";
            }

            // Verificar si contiene al menos un dígito
            if (!/[0-9]/.test(password)) {
                return "La contraseña debe contener al menos un dígito.";
            }

            // Verificar si contiene espacios
            if (/\s/.test(password)) {
                return "La contraseña no debe contener espacios.";
            }

            // Si todas las condiciones se cumplen
            return "";
        }

        //funcion para validar el formulario antes de enviarlo
        function validarFormulario() {
            const dni = document.getElementById('dni').value;
            const email = document.getElementById('email').value;
            const contrasena = document.getElementById('password').value;
            const dniError = document.getElementById('dniError');
            const emailError = document.getElementById('emailError');
            const contrasenaError = document.getElementById('contrasenaError');

            if (!validarDni(dni)) {
                dniError.textContent = 'DNI no válido';
                dniError.style.display = 'block';
                return false;
            } else {
                dniError.style.display = 'none';
            }

            if (!validarEmail(email)) {
                emailError.textContent = 'Email no válido';
                emailError.style.display = 'block';
                return false;
            } else {
                emailError.style.display = 'none';
            }

            const resultadoContrasena = validarContrasena(contrasena);
            if (resultadoContrasena !== "") {
                contrasenaError.textContent = resultadoContrasena;
                contrasenaError.style.display = 'block';
                return false;
            } else {
                contrasenaError.style.display = 'none';
            }

            return true;
        }
    </script>

<!-- JS para mostrar y ocultar la contraseña -->

<script>
        function showPassword() {
    var passwordInput = document.getElementById('password');
    var passwordButton = document.getElementById('show_password');
    var passwordIcon = passwordButton.querySelector('i');
    passwordInput.type = "text";
    passwordIcon.classList.remove('fa-eye');
    passwordIcon.classList.add('fa-eye-slash');
    }

        function hidePassword() {
    var passwordInput = document.getElementById('password');
    var passwordButton = document.getElementById('show_password');
    var passwordIcon = passwordButton.querySelector('i');
    passwordInput.type = "password";
    passwordIcon.classList.remove('fa-eye-slash');
    passwordIcon.classList.add('fa-eye');
    }
</script>