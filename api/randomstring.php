<?php
function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
    if(isset($_GET["length"])){
        $length = $_GET["length"];
        $lengthInt = intval($_GET["length"]);
        if($length == "0"){
            die("Please specify a number!");
        }
        else if($lengthInt <1){
            die("Please specify a valid number!");
        }
        else{
            $arr = array("length" => $lengthInt, "value" => generateRandomString($length));
            die(json_encode($arr));
        }
    }
?>