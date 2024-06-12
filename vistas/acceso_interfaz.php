<?php
if (isset($_SESSION['mensaje'])) {
  echo "<div style='text-align: center; font-size: 20px; color: black;'>" . $_SESSION['mensaje'] . "</div>";
  unset($_SESSION['mensaje']);  // Elimina el mensaje después de mostrarlo
}
?>
<!-- Sección para acceder a la web y enlace al registro si no tiene cuenta -->
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <h1 class="text-center">Aula TCAE Integral</h1>
      <div class="card">
        <div class="card-header">
          <h5 class="card-title text-dark text-center">Acceso</h5>
        </div>

        <div class="card-body">
          <form action="/php/acceso.php" method="post">
            <div class="mb-3">
              <label for="email" class="form-label">Email:</label>
              <input type="email" class="form-control" id="email" name="email" />
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Contraseña:</label>
              <div class="input-group">
                <input type="password" class="form-control" id="password" name="password" />
                <div class="input-group-append">
                  <button id="show_password" class="btn btn-outline-secondary" type="button" onmousedown="showPassword()" onmouseup="hidePassword()" ontouchstart="showPassword()" ontouchend="hidePassword()">
                    <i class="fas fa-eye"></i>
                  </button>
                </div>
              </div>
            </div>

            <div class="d-flex justify-content-center">
              <button type="submit" class="btn btn-primary w-100">
                Acceder
              </button>
            </div>
          </form>
          <div class="mt-3 text-center">
            <a href="/preparadoratcae.php?m=registro">¿No tienes una cuenta? Regístrate aquí</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<br>

<!-- INCLUIMOS EL FOOTER -->
<?php
include 'vistas/footer.php';
?>


<!-- JS para el comportamiento del botón del passowrd -->
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