<!-- Sección para contacto (solo formulario) -->

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="text-center">¿Tienes dudas? Contacta conmigo!!</h1>
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title text-dark text-center"></h5>
                </div>

                <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="mensaje" class="form-label">Mensaje:</label>
                            <textarea class="form-control" id="mensaje" name="mensaje" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br>

<?php
include 'vistas/footer.php';
?>