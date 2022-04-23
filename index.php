<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="favicon.ico">
  <title>Convertir texto en una imagen usando php - configuroweb</title>

  <!-- Bootstrap core CSS -->
  <link href="dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="assets/sticky-footer-navbar.css" rel="stylesheet">
  <link href="assets/style.css" rel="stylesheet">
  <script>
    function validateForm() {
      var valid = true;
      document.getElementById("output").remove();
      document.getElementById("validation-response").style.display = "none";
      document.getElementById("validation-response").value = "";

      if (document.form.txt_input.value == "") {
        document.getElementById("validation-response").style.display = "block";
        document.getElementById("validation-response").innerHTML = "Cuadro de texto esta vacio";
        valid = false;
      }

      return valid;
    }
  </script>
</head>

<body>
  <header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark"> <a class="navbar-brand" href="https://www.configuroweb.com/">ConfiguroWeb</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
    </nav>
  </header>

  <!-- Begin page content -->

  <div class="container">
    <h3 class="mt-5">Convertir texto en una imagen usando php</h3>
    <hr>
    <div class="row">
      <div class="col-12 col-md-12">
        <!-- Contenido -->

        <form class="form-inline" name="form" id="form" method="post" action="index.php" enctype="multipart/form-data" onSubmit="return validateForm();">
          <br>
          <div class="form-group mx-sm-3 mb-2">
            <label for="inputPassword2" class="sr-only">Ingrese Texto:</label>
            <input type="text" class="form-control" name="txt_input" maxlength="50">
          </div>
          <button type="submit" class="btn btn-primary mb-2">Convertir Texto</button>
        </form>


        <div id="validation-response"></div>



        <!-- Fin Contenido -->
      </div>
    </div>
    <!-- Fin row -->
    <br>
    <div class="row">
      <div class="col-12 col-md-12">
        <?php
        if (!empty($_POST['txt_input'])) {
          $input_text = $_POST['txt_input'];
          $width = (strlen($input_text) * 13) + 20;
          $height = 90;

          $textImage = imagecreate($width, $height);
          $color = imagecolorallocate($textImage, 0, 0, 0);
          imagecolortransparent($textImage, $color);

          $black = imagecolorallocate($textImage, 255, 255, 255);
          // Crear capa de la imagen de fondo
          $background = imagecreatefromjpeg('img/fondo.jpg');
          // Asignamos una fuente a nuestro Còdigo
          $font = 'rock.ttf';
          imagettftext($textImage, 20, 0, 10, 40, $black, $font, $input_text);

          // Fusionar imágenes de fondo y capas de imágenes de texto
          imagecopymerge($background, $textImage, 15, 15, 0, 0, $width, $height, 100);

          $output = imagecreatetruecolor($width, $height);
          imagecopy($output, $background, 0, 0, 20, 13, $width, $height);
          ob_start();
          imagepng($output);
          printf('<img id="output" src="data:image/png;base64,%s" />', base64_encode(ob_get_clean()));
        }
        ?>
      </div>
    </div>

  </div>
  <!-- Fin container -->
  <footer class="footer">
    <div class="container"> <span class="text-muted">
        <p><a href="https://www.configuroweb.com/" target="_blank">ConfiguroWeb</a></p>
      </span> </div>
  </footer>
  <script src="assets/jquery-1.12.4-jquery.min.js"></script>

  <!-- Bootstrap core JavaScript
    ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->

  <script src="dist/js/bootstrap.min.js"></script>
</body>

</html>