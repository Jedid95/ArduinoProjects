<?php

class API{
    private $key = null;

    function __construct($key=null){
        if(!empty($key)) $this->key = $key;
    }

    function requestMVDB($endpoint = '',$person = ''){
        $person = str_replace(' ','+',$person);
        //var_dump($person);
        $url = "https://api.themoviedb.org/3/".$endpoint."?api_key=".$this->key."&query=".$person."&format=json";
        
        $response = @file_get_contents($url);
        return json_decode($response,true);
    }

    function data($dataMVDB){
        if(!empty($_POST["name"])){
            foreach($dataMVDB["results"] as $list){
              foreach($list["known_for"] as $valor){
                ?>
                <span><br><strong>Title:</strong> <?php echo $valor["original_title"]?><br></span>
                <span><strong>Release:</strong> <?php echo $valor["release_date"]?><br></span>
                <span><strong>Director:</strong> Not included<br></span>
                <span><strong>Protagonist:</strong> Not included<br></span>
              <?php }
            }
          }
    }

    
}
?>