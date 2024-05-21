<?php
// function getIP(){
//     if(!empty($_SERVER['HTTP_CLIENT_IP'])){
//         $ip = $_SERVER['HTTP_CLIENT_IP'];
//     }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
//         $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
//     } else {
//         $ip = $_SERVER['REMOTE_ADDR'];
//     }
//     return $ip;
// }




$url = 'ipinfo.io/';
$params = array(
    'title'=> '94.158.152.248',
    'token'=> '23ca1abcefdf18'
);
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_URL,$url . $params['title'] . '?token=' . $params['token']);
$ex = curl_exec($ch);
curl_close($ch);

$data = json_decode($ex, true);
$info = explode(',',$data['loc']);
echo ''. $info[0] .''. $info[1];
$lon = $info[0];
$sh = $info[1];
// echo getIP();



echo "
<!DOCTYPE html>
<html>
  <head>
    <title>Simple Marker</title>
    <!-- The callback parameter is required, so we use console.debug as a noop -->
    <script async src='https://maps.googleapis.com/maps/api/js?key=AIzaSyA0R_04vmfdBLAsP0Y0zuexKRyAg37-BmQ&callback=console.debug&libraries=maps,marker&v=beta'>
    </script>
    <style>
    gmp-map {
        height: 500px; /* Устанавливаем высоту карты */
        width: 500px; /* Ширина карты на всю страницу */
      }
  
      /* Optional: Makes the sample page fill the window. */
      html,
      body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
  </style>

  </head>
  <body>
    <gmp-map center='$lon,$sh' zoom='4' map-id='DEMO_MAP_ID'>
      <gmp-advanced-marker position='$lon,$sh' title='My location'></gmp-advanced-marker>
    </gmp-map>
  </body>
</html>
";
?>