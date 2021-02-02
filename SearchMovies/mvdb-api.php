<?php

class MVDB_API{
    private $key = null;

    function __construct($key=null){
        if(!empty($key)) $this->key = $key;
    }

    function request($endpoint = '',$person = ''){
        $person = str_replace(' ','+',$person);
        var_dump($person);
        $url = "https://api.themoviedb.org/3/".$endpoint."?api_key=".$this->key."&query=".$person."&format=json";
        
        $response = @file_get_contents($url);
        return json_decode($response,true);
    }
}
?>