<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>In Out</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" 
    integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
    <script src="https://use.fontawesome.com/8913a5c2b2.js"></script>
    <link rel="stylesheet" type="text/css" href="css/inout.css">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bungee+Inline&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bungee+Shade&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Jura&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Alegreya+Sans+SC&display=swap" rel="stylesheet">

    <style>

      .top-col {
        background-color: #0043E2;
      }

      .header-font2 {
        font-family: 'Orbitron', sans-serif;
        font-size: 20px;
        color:#F7DF4B;
      }

      .header-font {
        font-family: 'Orbitron', sans-serif;
        font-size: 20px;
        color:#F7DF4B;
      }

      .spacet {
        padding-right:50px; 
      }

      table {
        margin-top: 0px;
        margin-bottom:150px;
        
      }

      th {
        font-family: 'Orbitron', sans-serif;
        font-size: 50px;
        background-image: linear-gradient(10deg,  #CFC6B5 , #EDE0CF , #CFC6B5) !important;
        color:#0F3C5E;
        padding: 20px 0px;
        opacity: 1;
        border-top: 5px solid #000000;
        text-align: center !important;
      }

      td {
        font-family: 'Orbitron', sans-serif;
        font-size: 24px;
        background-image: linear-gradient(10deg, #FFFFFF , #FFFFFF, #FFFFFF) !important;
        background-size: cover; 
        background-repeat: no-repeat;
        opacity: 1;
        padding-top:8px;
        padding-bottom: 8px;
        color: #000000;
        text-align: center;
      }
      
    </style>
  </head>

  <body style="background-color:#0043E2; background-size: cover; background-repeat: no-repeat; opacity: 1;">

    <!-- Navigation -->

    <nav class="navbar top-col">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="header-font2" href="#">IN OUT</a>
        </div>
        <ul class="nav justify-content-center">
          <li><a class="header-font spacet" href="#">|</a></li>
          <li><a class="header-font spacet" href="#">Admin</a></li>
          <li><a class="header-font spacet" href="#">|</a></li>
          <li><a class="header-font" href="#">Refresh</a></li>
        </ul>
      </div>
    </nav>

    <!-- End Navigation -->


    <!-- table -->

    <table class="container-fluid table-bordered">
      <tr>
          <th>Employee</th>
          <th>In</th>
          <th>Out</th>
          <th>Message</th>
      </tr>
      
      <tbody>

        <?php
        $servername = "localhost";
        $username = "jaxcode95";
        $password = "jaxcode95";
        $dbname = "jaxcode95";

        // Change Message

        if(isset($_POST['message'])) {

        $_POST['message'] = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
        if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "UPDATE io_employees SET message ='{$_POST['message']}' WHERE userid={$_POST['userid']}";

        if (mysqli_query($conn, $sql)) {

        } else {
        echo "Error updating record: " . mysqli_error($conn);
        }
        }


        // Change In Out Status

        if(isset($_GET['io'])) {
        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
        if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "UPDATE io_employees SET io ='{$_GET['io']}' WHERE userid={$_GET['userid']}";

        if (mysqli_query($conn, $sql)) {

        } else {
        echo "Error updating record: " . mysqli_error($conn);
        }
        }




        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
        if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT * FROM io_employees";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
          <td class="align-middle"><?=$row['user']?></td>

          <? if($row['io'] == '0') { ?>
          <td class="text-center"><a href="index.php?userid=<?=$row['userid']?>&io=1">
          <img src="images/circle_green.png" alt="green circle image" class="hidden" style="height:50px; width:50px;"></a></td>

          <td class="text-center"><img src="images/circle_red.png" alt="red circle image" style="height:50px; width:50px;"></td>

          <? } else { ?>
          <td class="text-center"><img src="images/circle_green.png" alt="green circle image" style="height:50px; width:50px;"></td>

          <td class="text-center"><a href="index.php?userid=<?=$row['userid']?>&io=0">
          <img src="images/circle_red.png" alt="red circle image" style="height:50px; width:50px;"  class="hidden"></a></td>

          <? } ?>
          <td>
          <? if($row['message'] != '') { ?>
          <a data-toggle="collapse" href="#collapse<?=$row['userid']?>" aria-expanded="false" 
          aria-controls="collapse<?=$row['userid']?>" style="color:#000000;">
          <?=$row['message']?>
          </a>
          <? } else {?>
          <a data-toggle="collapse" href="#collapse<?=$row['userid']?>" aria-expanded="false" 
          aria-controls="collapse<?=$row['userid']?>" class="text-muted float-right" 
          style="text-decoration-style: dashed;font-style: italic;font-size:12px;text-decoration: underline;">
          <i class="far fa-edit"></i></a>
          <? } ?>



          <div class="collapse" id="collapse<?=$row['userid']?>">
          <div>
            <form action="index.php" method="POST">
            <input type="text" name="message" value="<?=$row['message']?>">
            <input type="hidden" name="userid" value="<?=$row['userid']?>">
            <input class="btn btn-secondary btn-md" style="padding:0 4px;" type="submit" value="Submit">
            </form>
          </div>
          </div>



          </td>
        </tr>
        <?
        }
        } else {
        echo "0 results";
        }

        mysqli_close($conn);
        ?>


      </tbody>
    </table>

    <!-- End Table -->


    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

  </body>
</html>