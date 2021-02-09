<?php if(!empty($_POST["name"])){
          foreach($data["results"] as $list){
            foreach($list["known_for"] as $valor){
              ?>
              <span><br><strong>Title:</strong> <?php echo $valor["original_title"]?><br></span>
              <span><strong>Release:</strong> <?php echo $valor["release_date"]?><br></span>
              <span><strong>Director:</strong> Not included<br></span>
              <span><strong>Protagonist:</strong> Not included<br></span>
            <?php }
          }
        }?>

