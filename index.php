<?php

use Symfony\Component\Dotenv\Dotenv;

require './vendor/autoload.php';

$dotenv = new Dotenv();
$dotenv->load(__DIR__ . '/.env');

$medoo = new Medoo\Medoo(
  [
    'type' => 'mysql',
    'host' => $_ENV['DB_HOST'],
    'database' => $_ENV['DB_NAME'],
    'username' => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASS'],
    'port' => $_ENV['DB_PORT']
  ]
);

if (isset($_POST['saveInfo'])) {
  $medoo->insert('info',
    [
      'feuerwehr' => $_POST['jugendfeuerwehr'],
      'name' => $_POST['name'],
      'info' => $_POST['message']
    ]
  );

  header('Location: /?saved=1');
  exit();
}
?>
<!doctype html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>Jugendfeuerwehr Zeltlager</title>
  <link rel="stylesheet" href="/src/css/bulma.min.css">
</head>
<body>
<section class="section">
  <div class="container">
    <div class="columns is-mobile is-multiline">
      <?php if (!empty($_GET['saved'])) { ?>
        <div class="column is-12">
          <article class="message is-success">
            <div class="message-body">
              Erfolgreich gespeichert
            </div>
          </article>
        </div>
        <script>
          document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
              window.location.href = "/";
            }, 1500);
          });
        </script>
      <?php } ?>
      <div class="column is-12">
        <div class="box">
          <h3 class="title is 3">Wen möchtest du grüßen oder was muss in die Lagerzeitung</h3>
          <div class="box-body">
            <form method="post">
              <div class="field">
                <label for="name" class="label">Dein Name</label>
                <input type="text" name="name" id="name" class="input">
              </div>
              <div class="field">
                <label for="jugendfeuerwehr" class="label">Deine Jugendabteilung</label>
                <div class="control is-expanded">
                  <div class="select is-fullwidth">
                    <select name="jugendfeuerwehr" id="jugendfeuerwehr">
                      <option value="">-- Bitte wählen --</option>
                      <option value="Loga">Loga</option>
                      <option value="Leer">Leer</option>
                      <option value="Heisfelde">Heisfelde</option>
                      <option value="Nuettermoor">Nüttermoor</option>
                      <option value="Bingum">Bingum</option>
                      <option value="THW">THW</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="field">
                <label for="message" class="label">Nachricht</label>
                <textarea name="message" id="message" cols="30" rows="10" class="textarea"></textarea>
              </div>
              <div class="field">
                <input type="submit" value="Speichern" class="button is-success is-fullwidth"
                       name="saveInfo">
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="column is-6"></div>
    </div>
  </div>
</section>
</body>
</html>