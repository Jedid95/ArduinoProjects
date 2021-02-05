<?php

require_once 'config.php';
require_once 'mvdb-api.php';

$mvdb = new MVDB_API(MVDB_KEY);
$nameErr ="";
if ($_SERVER["REQUEST_METHOD"] == "POST"){
  if (empty($_POST["name"])) {
    $nameErr = "Actor name is required";
  } else {
    $name = $_POST["name"];
    $data = $mvdb->request('search/person','Tom Cruise');
  }
}


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Search Movies</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div id="container">
    <div id="search">
      <h1>Search Movies</h1>
      <form method="post">
        <label>Actor Name:</label> <input type="text" name="name" value="<?php echo $name?>">
        <span class="error">* <?php echo $nameErr;?></span>
        <button type="submit" name="button">Click</button>
      </form>
    </div>
    <div id="list">
      <?php if(!empty($_POST["name"])){
        foreach($data["results"] as $list){
          var_dump($list["known_for"]); ?><br><br><?php
        }
      }?>
    </div>  
  </div>


  
</body>
</html>