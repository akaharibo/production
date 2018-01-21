<?php

function floatingpoint_hashrate($path){

$variable = strlen($path);
if($variable < 5){
    echo "0 MHs";

}elseif($variable == 7){
    echo substr($path, 0, 1) . "." . substr($path, 0, 2) . " MHs";
}elseif($variable == 8){
    echo substr($path, 0, 2) . "." . substr($path, 2, 2) . " MHs";
}elseif($variable == 9){
    echo substr($path, 0, 3) . "." . substr($path, 2, 2) . " MHs";
}else{
    echo "error code: floatingpoint_hashrate";
}
}





 ?>

  <?php
                    // $variable = strlen($result_ubq->currentHashrate);
                    // echo $result_ubq->currentHashrate . "<br>";
                    // if($variable == 7){
                    //  echo substr($result_ubq->currentHashrate, 0, 1) . "." . substr($result_ubq->currentHashrate, 0, 2) . " MH/s";
                    // }elseif($variable == 8){
                    //   echo substr($result_ubq->currentHashrate, 0, 2) . "." . substr($result_ubq->currentHashrate, 2, 2) . " MH/s";
                    // }elseif($variable == 9){
                    //   echo substr($result_ubq->currentHashrate, 0, 3) . "." . substr($result_ubq->currentHashrate, 2, 3) . " MH/s";
                    // }else{
                    //   echo "Unknown";
                    // }
                    // ?>
