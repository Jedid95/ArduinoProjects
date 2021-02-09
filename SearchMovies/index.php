<?php

require_once 'config.php';
require_once 'api.php';

$db = new API(MVDB_KEY);
$nameErr ="";
if ($_SERVER["REQUEST_METHOD"] == "POST"){
  if (empty($_POST["name"])) {
    $nameErr = "Actor name is required";
  } else {
    $name = $_POST["name"];
    $dataMVDB = $db->requestMVDB('search/person',$_POST["name"]);
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Movies</title>
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
        <br><br><h4>Movies List</h4>
        <?php $db->data($dataMVDB)?>
      </div>  
    </div>
  </body>
</html>