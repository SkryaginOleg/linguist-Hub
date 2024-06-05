<?php

function getIp($id, $conn) {
  require_once __DIR__ . '/../DataBase/db.php';
    $ip = $_SERVER['REMOTE_ADDR'];
   
    $sql = 'UPDATE `User` SET `IP` = ? WHERE user_id = ?';
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param('si', $ip, $id);
        $stmt->execute();
        $stmt->close();
    } else {
        echo "Помилка: " . $conn->error;
    }
}

function getMap($id, $conn) {
  require_once __DIR__ . '/../DataBase/db.php';

   
    $select = 'SELECT IP FROM User WHERE user_id = ?';
    $stmt = $conn->prepare($select);
    if ($stmt) {
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $ip = $row['IP'];
            $ip = '95.135.26.83';
            
            $url = 'https://ipinfo.io/' . $ip . '?token=23ca1abcefdf18';
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $result = curl_exec($ch);
            
            curl_close($ch);

            // get loc
            $result = json_decode($result, true);
            $result = $result['loc'];
            $result = explode(',', $result);
            $lon = $result[0];
            $lan = $result[1];
            echo $lon . " " . $lan;

                // build our mao
         
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
                    <gmp-map center='$lon,$lan' zoom='4' map-id='DEMO_MAP_ID'>
                      <gmp-advanced-marker position='$lon,$lan' title='My location'></gmp-advanced-marker>
                    </gmp-map>
                  </body>
                </html>
                ";

        } else {
            echo 'Error';
        }
        $stmt->close();
    } else {
        echo "Error " . $conn->error;
    }
}

?>