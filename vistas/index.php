<?php
//mensajes de información sobre el registro del cliente y el acceso a la web
if (isset($_SESSION['mensaje'])) {
  echo "<div style='text-align: center; font-size: 20px; color: black;'>" . $_SESSION['mensaje'] . "</div>";
  unset($_SESSION['mensaje']);  // Eliminar el mensaje después de mostrarlo
}

?>


<div class="container-fluid">
  <div class="row">
    <img src="/img/portada.png">
  </div>
</div>
</div>

<!-- Carrusel automático cada 3 segundos -->

<div class="container">
    <div class="row">
      <div class="d-flex justify-content-center text-center">
      <div class="col-6">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="/img/curso_pruebas_libres.png" class="d-block w-100" alt="Curso pruebas libres">
              <div class="carousel-caption d-none d-md-block">
                <h5></h5>
                <p></p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="/img/opiniones.png" class="d-block w-100" alt="opiniones ">
              <div class="carousel-caption d-none d-md-block">
                <h5></h5>
                <p></p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="/img/proximamente.png" class="d-block w-100" alt="próximo curso oposiciones">
              <div class="carousel-caption d-none d-md-block">
                <h5></h5>
                <p></p>
              </div>
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<br>

<!-- Scrip para poner WhatsApp (facilitado por JoinChat en su versión gratuita) -->

<script>
  (function() {
    var options = {
      whatsapp: "+34678976822", // Número de teléfono de WhatsApp
      call_to_action: "Hola! soy Rocío En qué puedo ayudarte ;)?", // Texto del botón
      position: "right", // Posición del botón (right o left)
    };
    var proto = document.location.protocol,
      host = "getbutton.io",
      url = proto + "//static." + host;
    var s = document.createElement('script');
    s.type = 'text/javascript';
    s.async = true;
    s.src = url + '/widget-send-button/js/init.js';
    s.onload = function() {
      WhWidgetSendButton.init(host, proto, options);
    };
    var x = document.getElementsByTagName('script')[0];
    x.parentNode.insertBefore(s, x);
  })();
</script>

<!-- footer -->

<?php
include 'vistas/footer.php';
?>
