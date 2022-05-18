<?php
include 'connection.php';
/* Getting recipient name from db*/
if (isset($_GET['key'])) {
  $userkey = $_GET['key'];
  $stmt = $db->prepare("SELECT name FROM data WHERE userkey=:userkey");
  $stmt->execute(array(':userkey' => $userkey));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $name = $row['name'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="keywords" content="GDG Jammu, Google Developer Group Jammu">

  <!-- Favicons -->
  <link rel="apple-touch-icon" sizes="57x57" href="images/favicon/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="images/favicon/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="images/favicon/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="images/favicon/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="images/favicon/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="images/favicon/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="images/favicon/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="images/favicon/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="images/favicon/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192" href="images/favicon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="images/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="images/favicon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="images/favicon/favicon-16x16.png">
  <link rel="manifest" href="images/favicon/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="images/favicon/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <style>
    body {
      background-image: url("assets/bg.jpg");
      background-color: #cccccc;
    }

    .container {
      width: 100%;
      height: 100vh;
      position: relative;

    }

    .vertical-center {
      margin: 0;
      position: absolute;
      top: 50%;
      -ms-transform: translateY(-50%);
      transform: translateY(-50%);
    }
  </style>
  <title>GDG Jammu - Certificate: Back 2 Basic</title>


</head>

<body>

  <div class="container">
    <div class="vertical-center" style="margin-left:20px; margin-right:40px; padding:40px">
      <div class="row ">
        <div class="col-md-3 col-sm-4 col-xs-4 text-center"><img src="assets/badge.png" width="120" height="120"><br>
          <h2 style="color: #000000; margin-top:20px;">Congratulations <?php echo $name; ?>! You've earned it.</h2>
          <!-- For downloading cerificate -->
          <a href="qrcertificate.php?id=<?php echo $name; ?>&download=y&key=<?php echo $userkey; ?>" style="margin-top:20px;" class="btn btn-primary" role="button">Download</a>


          <a href="https://gdg.community.dev/gdg-jammu/" style="margin-top:20px; width:100%;" class="btn btn-success" role="button">Join GDG Jammu</a>








        </div>
        <div class="col-md-1 col-sm-4 col-xs-4 text-center" style="margin-top: 60px;"></div>
        <!-- For displaying cerificate -->
        <div class="col-md-8 col-sm-4 col-xs-4 text-center"><img src="qrcertificate.php?id=<?php echo $name; ?>&download=n&key=<?php echo $userkey; ?>" style="box-shadow: 0 0 0 10px hsl(0, 0%, 80%),0 0 0 15px hsl(0, 0%, 90%); max-width: 100%;height: auto;">

        </div>



      </div>



    </div>





  </div>
</body>

</html>