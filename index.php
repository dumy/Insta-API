<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Instagram User Profile </title>
  <link href='https://fonts.googleapis.com/css?family=Lato:400,900,700' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  
      <link rel="stylesheet" href="css/style.css">

  
</head>

<body>
<?php
         $name = "";
         $nameErr = "";
         
         if ($_SERVER["REQUEST_METHOD"] == "POST") {
          if (empty($_POST["name"])) {
            $nameErr = "Name is required";
          } else {
            $name = test_input($_POST["name"]);
          }
        }
        function test_input($data) {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
        }
         
        $url = 'https://api.instagram.com/v1/users/'.$name.'?access_token=295597781.1677ed0.ddd75abdd8ec4f1db07dc0f85635cafd';
        $api_response = file_get_contents($url);
        $record = json_decode($api_response);

        $json = file_get_contents("https://api.instagram.com/v1/users/2'.$name.'/media/recent?access_token=295597781.1677ed0.ddd75abdd8ec4f1db07dc0f85635cafd");
$data = json_decode($json);


$images = array();
foreach( $data->data as $user_data ) {
    $images[] = (array) $user_data->images;
}



$standard = array_map( function( $item ) {
    return $item['standard_resolution']->url;
}, $images );

      ?>
  <div id="iCard">
  <br>
  
  <br>
 <form class="form-inline" method = "post">
  
  <div class="form-group mx-sm-3 mb-2 ">
    <label for="inputPassword2" class="sr-only">Id User</label>
    <input type="text" class="form-control" name = "name" placeholder="ID user" >
  </div>
  <button type="submit" class="btn btn-primary mb-2  t-5" name = "submit" value = "Submit">Confirm identity</button>
</form>
  <div class="logo"></div>
  <div class="user"><?php echo $media = "<img  src=".$record->data->profile_picture.">" ?></div>
  <div class="details">
      
    <h1><?php echo $media = $record->data->full_name ?></h1>
    <h2>username:<?php echo $media = $record->data->username ?><h2>
    <h2><?php echo $media = $record->data->is_business; ?><h2>
  </div>
  <div class="count">
      <ul>
        <li class="media"><span><b><?php echo $media = $record->data->counts->media ?></b> Posts </span></li>
        <li class="followers"><span><b><?php echo $media = $record->data->counts->follows ?></b> Followers</span></li>
        <li class="following"><span><b><?php echo $media = $record->data->counts->followed_by ?></b> Following</span></li>
      </ul>
    </div>
  <div class="stats"></div>
  <div class="photos">    <?php

$int = 0;
$limit = 9;
foreach( $standard as $url ) {
  if($int < $limit){ 
    echo "<img src=\"$url\" height=\"120\" width=\"120\"  > "; 
   
  $int++;
  }
 
}
?></div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>
