<?php
$pass = "Hello im";
$pass2 = md5( $pass );
if(md5($pass) == $pass2){
    echo "True";
}
else{
    echo "false";
}


?>