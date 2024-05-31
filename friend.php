<!DOCTYPE html>
<html lang="ua">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <title>Головна сторінка</title>
    <link rel="stylesheet" href="CSS/friend.css">
    <script src="JS/friend.js"></script>
</head>

<body>

   <?php
   require_once("blocks/header.php");
   ?>

    <div class="content-area">

        <div class="row1">
            <?php
    require_once("DataBase/db.php");
    $user_id = $_COOKIE['user'];
    $query = 'SELECT * FROM User WHERE user_id = '.$user_id.'';
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $photo = base64_encode($row['photo']);
            
          echo' <img src="data:image/jpeg;base64,' . $photo . '">';
            echo '<h1>'.$row['full_name'].'</h1>';
            ?>
        </div>

        <div class="row2">

            <div class="column1">

                <div class="addcolumn1">
                    <h1>Friends</h1>
                    <button class="custom-button" data-modal="modal1">
                        <img
                            src="data:image/png;base64,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">
                        <p>Your friends</p>
                    </button>
                    <button class="custom-button" data-modal="modal2">
                        <img
                            src="data:image/png;base64,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">
                        <p>Add friends</p>
                    </button>
                    <button class="custom-button" data-modal="modal3">
                        <img
                            src="data:image/png;base64,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">
                        <p>Invitation</p>
                    </button>
                    <button class="custom-button" data-modal="modal4">
                        <img
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAP1BMVEX///8AAADe3t55eXnFxcWNjY1zc3OgoKC4uLjv7+/b29uWlpaJiYmcnJy7u7sNDQ3T09NKSkqmpqZfX1/5+fndXyz0AAAFB0lEQVR4nO2cWY4bMQwFW/F4ku7Mku3+Zw0UJRjbvUnkeySB8B3AcqHqs6VpyuVyuVwul8vlcrlcLpfL5XL/zb55/wH2ruXN+y9w91JK+eJz9Py+GJxyLcULcX4v5RP9lAZYPEKd/xzMRnwp/2Zucf57MDfUayleiDXRQrd4C2gc6nxzMA/xpdzP0OJ8dzAr1Gt5nBniR6JMi2tAs1Dn1cEMxMdEDS2uARmhbhk0QnxMlGNxD9Ag1C2DeMTtRE0s7gFiQ903SEfcThRt8RiQGuq+QSTiUaJki8eAqFDPDBIRjxLFWewBJIV6ZhCDeJ5oG8FiD6A+1D6DFMTzRNt0FvsB4aH2GdQi9ibaBrXYD6gJdcQgGLE30TapxVFAYKgjBuWIY4m2gSyOAspCHTcIQxxLtG3cogwQEuq4QQmiJNE2tUUZ4GioUoMAREmibSMWNYDKUKUGxxDlibYpLGoA+0PVGVQhyhNt67OoBxSHqjPYi6hNtE1kUQ/YEyrCYJ0AUZto25lFFGAp8zAg6OBjREyidU9egMeh4gwOA07TM+zwfYuugNN0gR2/h+iYKBpxO1Rng3XcUAMAckN1TxSN+BhqCIN1rFDDALJCDZIoGvEj1EAG6/ChBgPEhxoqUTRiDTWcwTpkqCEBkRZxvwQFRCKiBgZEhooZHDCaRQJgLEQKYKRQSYBxLNIAoyASAWOESgWMYJEM6I9IB/QO1QDQ16IJoCeiEaBfqGaAXhYNAX0QTQE9QjUGtLdoDmiN6ABoG6oLoKVFJ0A7RDdAq1AdAW0sugJaIDoD8kN1B2RbDADIRQwByAw1CCDPYhhAFmIgQE6ooQAZFoMB4hHDAaJDDQiItRgScJq+wwB/eKNs7zMM0OKRNMFegYAhEZEG6yxe8xsaGjCcRWyiARHxBusChcoBDGSRkWgoRJbBuhChMgFDWOQlGgSRa7DOOVQ+oLNFdqLuiBYG69xCtQJ0s2iTqCOincE6h1BtAR0sWibqgmhtsM40VA9AU4v2iRoj+hisMwrVD9DIoleiZoieBuvooXoD0i36JtpGRfQ3WEcMNQYg0WKERNtIiFEM1lFCjQRIsRgn0TY4YiyDdeBQcYA/Yb8EtYhL9MngkTTBcAbrdzLsR9LcAW1e8xsaMtG2YKGiDWIRAaEyAEOFik+0LUyoHINYRFWoPMAgobISbQsQKtMgFlEYKhvQPVRuom2uoeLegj76Zts11AV09PFH6a6hYhDPvrrHWRx+kx2DeH6tAIX4dRwQgdhzbwITqghQj9h3MQRh8VUGqEXsvfmiRxQa1CL2X+3RhqoA1CCO3F3SWRQnqkMcu5ylQVQZlCOO3j6Th6oGlCGOX6+TWlQmKkWU3B+UIQIMShBlFyQloYIARxGlN0DHLUISHUeUX3EdRYQZrOtH1NzhHQsVCtiPqLukPGIRmGhbH6L2FnY/IthgXQ+i/pp5b6gEwB5ExD36PovwRNvOEDEPBfQgUgzWHSOiXkI4D5UGeIyIe+rhzCIp0bZ9RORbFseIRIN1e4jYxzqOQiUD7iGiXyPZt0hNtG0LEf/cyh4i3WDdGpHxnsx2qCaAa0TOgzlbFg0SbVsMALcQjQzWLQaA61ANAW8RmW863Vs0S7RtMQC8RzQ1WLcYAN6Gag7YEPnPjl18Em1bTN5Vu3gZrPtlcsqzH6DVLj6JWu7N+w/kcrlcLpfL5XK5XC6Xy+VyuWn6DV3LVQLGYJRtAAAAAElFTkSuQmCC">
                        <p>Blocked</p>
                    </button>
                </div>

                <div class="addcolumn2">
                    <h1>Groups</h1>
                    <button class="custom-button" data-modal="modal5">
                        <img
                            src="data:image/jpeg;base64,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">
                        <p>Your groups</p>
                    </button>
                    <button class="custom-button" data-modal="modal6">
                        <img
                            src="data:image/png;base64,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">
                        <p>Invitation in group</p>
                    </button>
                    <button class="custom-button" data-modal="modal7">
                        <img
                            src="data:image/png;base64,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">
                        <p>Search group</p>
                    </button>
                    <button class="custom-button" data-modal="modal8">
                        <img
                            src="data:image/png;base64,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">
                        <p>Create group</p>
                    </button>
                </div>

            </div>

            <div class="column2">

                <div class="addrows1">
                    <h1 id="text-field"></h1>
                </div>

                <div class="addrows2">
                    <div id="modal1" class="modal">
                        <div class="modal1-content">

                            <div class="m1cr2">
                                <div class="scroll-container">
                                    <h1>Online</h1>
                         
                                    <div class="m1cr2first">
                                        
                                    <?php 
require_once("DataBase/db.php");
if(isset($_COOKIE['user'])){
    $user = intval($_COOKIE['user']);
}
$query = 'SELECT `User`.* FROM `User` JOIN `Friends` ON `User`.`user_id` = `Friends`.`User_id2` WHERE `Friends`.`User_id1` = ?';
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user);
// Виконання запиту
$stmt->execute();

// Отримання результатів
$result = $stmt->get_result();


    while ($row = $result->fetch_assoc()) {
        $photo = base64_encode($row['photo']);
            echo '<div class="m1cr2first1">
            <div class="m1cr2first1column1">
                <img src="data:image/jpeg;base64,' . $photo . '">
                <p>'.$row['full_name'].'</p>
            </div>

            <div class="m1cr2first1column2">
                <div class="dropdown">

                    <button onclick="toggleDropdown(this)" class="dropbtn"></button>
                    <div class="dropdown-content">
                        <a href="profile.php?id='.$row['user_id'].'">Open profile</a>
                        <a href="#">Write message</a>
                        <a href="#">Create meeting</a>
                        <a href="#">Delete from friends</a>
                    </div>

                </div>
            </div>

        </div>';

    }
$stmt->close();
$conn->close();


?>
                    
                                    </div>

                                 

# -------------------------------------------------------------------------------------------------------                        
                                    <h1>Offline</h1>

                                    <div class="m1cr2first">
                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <div class="dropdown">

                                                    <button onclick="toggleDropdown(this)" class="dropbtn"></button>
                                                    <div class="dropdown-content">
                                                        <a href="#">Open profile</a>
                                                        <a href="#">Write message</a>
                                                        <a href="#">Create meeting</a>
                                                        <a href="#">Delete from friends</a>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>

                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <div class="dropdown">

                                                    <button onclick="toggleDropdown(this)" class="dropbtn"></button>
                                                    <div class="dropdown-content">
                                                        <a href="#">Open profile</a>
                                                        <a href="#">Write message</a>
                                                        <a href="#">Create meeting</a>
                                                        <a href="#">Delete from friends</a>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>

                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <div class="dropdown">

                                                    <button onclick="toggleDropdown(this)" class="dropbtn"></button>
                                                    <div class="dropdown-content">
                                                        <a href="#">Open profile</a>
                                                        <a href="#">Write message</a>
                                                        <a href="#">Create meeting</a>
                                                        <a href="#">Delete from friends</a>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>

                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <div class="dropdown">

                                                    <button onclick="toggleDropdown(this)" class="dropbtn"></button>
                                                    <div class="dropdown-content">
                                                        <a href="#">Open profile</a>
                                                        <a href="#">Write message</a>
                                                        <a href="#">Create meeting</a>
                                                        <a href="#">Delete from friends</a>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>

                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <div class="dropdown">

                                                    <button onclick="toggleDropdown(this)" class="dropbtn"></button>
                                                    <div class="dropdown-content">
                                                        <a href="#">Open profile</a>
                                                        <a href="#">Write message</a>
                                                        <a href="#">Create meeting</a>
                                                        <a href="#">Delete from friends</a>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>

                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <div class="dropdown">

                                                    <button onclick="toggleDropdown(this)" class="dropbtn"></button>
                                                    <div class="dropdown-content">
                                                        <a href="#">Open profile</a>
                                                        <a href="#">Write message</a>
                                                        <a href="#">Create meeting</a>
                                                        <a href="#">Delete from friends</a>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>

                                    </div>


                                </div>
                            </div>


                        </div>
                    </div>


                    <div class="addrows2">
                        <div id="modal2" class="modal">

                            <div class="modal2-content">

                                <div class="upblock">

                                    <div class="upblockcolumn">
                                        <p>Age:</p>
                                        <select>
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="1">5</option>
                                        </select>
                                    </div>

                                    <div class="upblockcolumn">
                                        <p>Sex:</p>
                                        <select>
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="1">5</option>
                                        </select>
                                    </div>

                                    <div class="upblockcolumn">
                                        <p>Country:</p>
                                        <select>
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="1">5</option>
                                        </select>
                                    </div>

                                    <div class="upblockcolumn">
                                        <p>Language:</p>
                                        <select>
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="1">5</option>
                                        </select>
                                    </div>

                                    <div class="upblockcolumn">
                                        <p>Rating:</p>
                                        <select>
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="1">5</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="downblock">
                                    <div class="scroll-container">
                                        <h1>Result</h1>

                                        <div class="m1cr2first">
                                            <div class="m1cr2first1">
                                                <div class="m1cr2first1column1">
                                                    <img src="">
                                                    <p>Full name</p>
                                                </div>

                                                <div class="m1cr2first1column2">
                                                    <button></button>

                                                </div>

                                            </div>

                                            <div class="m1cr2first1">
                                                <div class="m1cr2first1column1">
                                                    <img src="">
                                                    <p>Full name</p>
                                                </div>

                                                <div class="m1cr2first1column2">
                                                    <button></button>

                                                </div>

                                            </div>

                                            <div class="m1cr2first1">
                                                <div class="m1cr2first1column1">
                                                    <img src="">
                                                    <p>Full name</p>
                                                </div>

                                                <div class="m1cr2first1column2">
                                                    <button></button>

                                                </div>

                                            </div>

                                            <div class="m1cr2first1">
                                                <div class="m1cr2first1column1">
                                                    <img src="">
                                                    <p>Full name</p>
                                                </div>

                                                <div class="m1cr2first1column2">
                                                    <button></button>

                                                </div>

                                            </div>

                                            <div class="m1cr2first1">
                                                <div class="m1cr2first1column1">
                                                    <img src="">
                                                    <p>Full name</p>
                                                </div>

                                                <div class="m1cr2first1column2">
                                                    <button></button>

                                                </div>

                                            </div>

                                            <div class="m1cr2first1">
                                                <div class="m1cr2first1column1">
                                                    <img src="">
                                                    <p>Full name</p>
                                                </div>

                                                <div class="m1cr2first1column2">
                                                    <button></button>

                                                </div>

                                            </div>

                                            <div class="m1cr2first1">
                                                <div class="m1cr2first1column1">
                                                    <img src="">
                                                    <p>Full name</p>
                                                </div>

                                                <div class="m1cr2first1column2">
                                                    <button></button>

                                                </div>

                                            </div>

                                            <div class="m1cr2first1">
                                                <div class="m1cr2first1column1">
                                                    <img src="">
                                                    <p>Full name</p>
                                                </div>

                                                <div class="m1cr2first1column2">
                                                    <button></button>

                                                </div>

                                            </div>

                                            <div class="m1cr2first1">
                                                <div class="m1cr2first1column1">
                                                    <img src="">
                                                    <p>Full name</p>
                                                </div>

                                                <div class="m1cr2first1column2">
                                                    <button></button>

                                                </div>

                                            </div>

                                            <div class="m1cr2first1">
                                                <div class="m1cr2first1column1">
                                                    <img src="">
                                                    <p>Full name</p>
                                                </div>

                                                <div class="m1cr2first1column2">
                                                    <button></button>

                                                </div>

                                            </div>

                                            <div class="m1cr2first1">
                                                <div class="m1cr2first1column1">
                                                    <img src="">
                                                    <p>Full name</p>
                                                </div>

                                                <div class="m1cr2first1column2">
                                                    <button></button>

                                                </div>

                                            </div>

                                            <div class="m1cr2first1">
                                                <div class="m1cr2first1column1">
                                                    <img src="">
                                                    <p>Full name</p>
                                                </div>

                                                <div class="m1cr2first1column2">
                                                    <button></button>

                                                </div>
                                            </div>

                                            <div class="m1cr2first1">
                                                <div class="m1cr2first1column1">
                                                    <img src="">
                                                    <p>Full name</p>
                                                </div>

                                                <div class="m1cr2first1column2">
                                                    <button></button>

                                                </div>
                                            </div>

                                            <div class="m1cr2first1">
                                                <div class="m1cr2first1column1">
                                                    <img src="">
                                                    <p>Full name</p>
                                                </div>

                                                <div class="m1cr2first1column2">
                                                    <button></button>

                                                </div>

                                            </div>

                                            <div class="m1cr2first1">
                                                <div class="m1cr2first1column1">
                                                    <img src="">
                                                    <p>Full name</p>
                                                </div>

                                                <div class="m1cr2first1column2">
                                                    <button></button>

                                                </div>

                                            </div>

                                            <div class="m1cr2first1">
                                                <div class="m1cr2first1column1">
                                                    <img src="">
                                                    <p>Full name</p>
                                                </div>

                                                <div class="m1cr2first1column2">
                                                    <button></button>

                                                </div>

                                            </div>

                                            <div class="m1cr2first1">
                                                <div class="m1cr2first1column1">
                                                    <img src="">
                                                    <p>Full name</p>
                                                </div>

                                                <div class="m1cr2first1column2">
                                                    <button></button>

                                                </div>

                                            </div>
                                            <div class="m1cr2first1">
                                                <div class="m1cr2first1column1">
                                                    <img src="">
                                                    <p>Full name</p>
                                                </div>

                                                <div class="m1cr2first1column2">
                                                    <button></button>

                                                </div>

                                            </div>
                                            <div class="m1cr2first1">
                                                <div class="m1cr2first1column1">
                                                    <img src="">
                                                    <p>Full name</p>
                                                </div>

                                                <div class="m1cr2first1column2">
                                                    <button></button>

                                                </div>

                                            </div>
                                            <div class="m1cr2first1">
                                                <div class="m1cr2first1column1">
                                                    <img src="">
                                                    <p>Full name</p>
                                                </div>

                                                <div class="m1cr2first1column2">
                                                    <button></button>

                                                </div>

                                            </div>
                                            <div class="m1cr2first1">
                                                <div class="m1cr2first1column1">
                                                    <img src="">
                                                    <p>Full name</p>
                                                </div>

                                                <div class="m1cr2first1column2">
                                                    <button></button>

                                                </div>

                                            </div>
                                            <div class="m1cr2first1">
                                                <div class="m1cr2first1column1">
                                                    <img src="">
                                                    <p>Full name</p>
                                                </div>

                                                <div class="m1cr2first1column2">
                                                    <button></button>

                                                </div>

                                            </div>

                                        </div>


                                    </div>
                                </div>


                            </div>

                        </div>

                        <div id="modal3" class="modal">

                            <div class="modal3-content">

                                <div class="invdownblock">

                                    <div class="invdownblockrow2">

                                        <div class="scroll-container">

                                            <div class="m1cr2first11">

                                                <div class="invinfoc1">

                                                    <h1>Invite from: Best team in the world</h1>

                                                </div>

                                                <div class="invinfoc2">
                                                    <p>qwertyqwertyqwertyqwertyqwerty</p>
                                                </div>

                                                <div class="invinfoc3">
                                                    <button>Accept</button>
                                                    <button>Decline</button>
                                                </div>

                                            </div>

                                            <div class="m1cr2first11">

                                                <div class="invinfoc1">

                                                    <h1>Invite from: Best team in the world</h1>

                                                </div>

                                                <div class="invinfoc2">
                                                    <p>qwertyqwertyqwertyqwertyqwerty</p>
                                                </div>

                                                <div class="invinfoc3">
                                                    <button>Accept</button>
                                                    <button>Decline</button>
                                                </div>

                                            </div>

                                            <div class="m1cr2first11">

                                                <div class="invinfoc1">

                                                    <h1>Invite from: Best team in the world</h1>

                                                </div>

                                                <div class="invinfoc2">
                                                    <p>qwertyqwertyqwertyqwertyqwerty</p>
                                                </div>

                                                <div class="invinfoc3">
                                                    <button>Accept</button>
                                                    <button>Decline</button>
                                                </div>

                                            </div>

                                            <div class="m1cr2first11">

                                                <div class="invinfoc1">

                                                    <h1>Invite from: Best team in the world</h1>

                                                </div>

                                                <div class="invinfoc2">
                                                    <p>qwertyqwertyqwertyqwertyqwerty</p>
                                                </div>

                                                <div class="invinfoc3">
                                                    <button>Accept</button>
                                                    <button>Decline</button>
                                                </div>

                                            </div>

                                            <div class="m1cr2first11">

                                                <div class="invinfoc1">

                                                    <h1>Invite from: Best team in the world</h1>

                                                </div>

                                                <div class="invinfoc2">
                                                    <p>qwertyqwertyqwertyqwertyqwerty</p>
                                                </div>

                                                <div class="invinfoc3">
                                                    <button>Accept</button>
                                                    <button>Decline</button>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>


                        <div id="modal4" class="modal">

                            <div class="modal4-content">



                                <div class="blockedrow2">

                                    <div class="scroll-container">

                                        <div class="m1cr2first12">

                                            <div class="blockedinfoc1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="blockedinfoc2">
                                                <button>Unblock</button>
                                            </div>

                                        </div>

                                        <div class="m1cr2first12">

                                            <div class="blockedinfoc1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="blockedinfoc2">
                                                <button>Unblock</button>
                                            </div>

                                        </div>

                                        <div class="m1cr2first12">

                                            <div class="blockedinfoc1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="blockedinfoc2">
                                                <button>Unblock</button>
                                            </div>

                                        </div>

                                        <div class="m1cr2first12">

                                            <div class="blockedinfoc1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="blockedinfoc2">
                                                <button>Unblock</button>
                                            </div>

                                        </div>

                                        <div class="m1cr2first12">

                                            <div class="blockedinfoc1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="blockedinfoc2">
                                                <button>Unblock</button>
                                            </div>

                                        </div>

                                        <div class="m1cr2first12">

                                            <div class="blockedinfoc1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="blockedinfoc2">
                                                <button>Unblock</button>
                                            </div>

                                        </div>

                                        <div class="m1cr2first12">

                                            <div class="blockedinfoc1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="blockedinfoc2">
                                                <button>Unblock</button>
                                            </div>

                                        </div>

                                        <div class="m1cr2first12">

                                            <div class="blockedinfoc1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="blockedinfoc2">
                                                <button>Unblock</button>
                                            </div>

                                        </div>

                                        <div class="m1cr2first12">

                                            <div class="blockedinfoc1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="blockedinfoc2">
                                                <button>Unblock</button>
                                            </div>

                                        </div>

                                        <div class="m1cr2first12">

                                            <div class="blockedinfoc1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="blockedinfoc2">
                                                <button>Unblock</button>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div>

                        <div id="modal5" class="modal">

                            <div class="modal4-content">
                                <div class="scroll-container">
                                    <div class="m1cr2first">
                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <button></button>

                                            </div>

                                        </div>

                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <button></button>

                                            </div>

                                        </div>

                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <button></button>

                                            </div>

                                        </div>

                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <button></button>

                                            </div>

                                        </div>

                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <button></button>

                                            </div>

                                        </div>

                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <button></button>

                                            </div>

                                        </div>

                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <button></button>

                                            </div>

                                        </div>

                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <button></button>

                                            </div>

                                        </div>

                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <button></button>

                                            </div>

                                        </div>

                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <button></button>

                                            </div>

                                        </div>

                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <button></button>

                                            </div>

                                        </div>

                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <button></button>

                                            </div>
                                        </div>

                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <button></button>

                                            </div>
                                        </div>

                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <button></button>

                                            </div>

                                        </div>

                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <button></button>

                                            </div>

                                        </div>

                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <button></button>

                                            </div>

                                        </div>

                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <button></button>

                                            </div>

                                        </div>
                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <button></button>

                                            </div>

                                        </div>
                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <button></button>

                                            </div>

                                        </div>
                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <button></button>

                                            </div>

                                        </div>
                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <button></button>

                                            </div>

                                        </div>
                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <button></button>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div id="modal6" class="modal">

                        <div class="modal6-content">

                            <div class="createinvitehead">
                                <h1>Invite new user to your group!</h1>
                            </div>

                            <div class="createinvite">

                                <div class="createinvite1">

                                    <div class="createinvite1row1">

                                        <div class="findcl">
                                            <p>Age:</p>
                                            <select>
                                                <option value="1">1</option>
                                                <option value="1">2</option>
                                                <option value="1">3</option>
                                                <option value="1">4</option>
                                                <option value="1">5</option>
                                            </select>
                                        </div>

                                        <div class="findcl">
                                            <p>Sex:</p>
                                            <select>
                                                <option value="1">1</option>
                                                <option value="1">2</option>
                                                <option value="1">3</option>
                                                <option value="1">4</option>
                                                <option value="1">5</option>
                                            </select>
                                        </div>

                                        <div class="findcl">
                                            <p>Country:</p>
                                            <select>
                                                <option value="1">1</option>
                                                <option value="1">2</option>
                                                <option value="1">3</option>
                                                <option value="1">4</option>
                                                <option value="1">5</option>
                                            </select>
                                        </div>

                                        <div class="findcl">
                                            <p>Language:</p>
                                            <select>
                                                <option value="1">1</option>
                                                <option value="1">2</option>
                                                <option value="1">3</option>
                                                <option value="1">4</option>
                                                <option value="1">5</option>
                                            </select>
                                        </div>

                                        <div class="findcl">
                                            <p>Rating:</p>
                                            <select>
                                                <option value="1">1</option>
                                                <option value="1">2</option>
                                                <option value="1">3</option>
                                                <option value="1">4</option>
                                                <option value="1">5</option>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="createinvite1row2">

                                        <div class="scroll-container">
                                            <div class="m1cr2first">
                                                <div class="m1cr2first1">
                                                    <div class="m1cr2first1column1">
                                                        <img src="">
                                                        <p>Full name</p>
                                                    </div>

                                                    <div class="m1cr2first1column2">
                                                        <button></button>

                                                    </div>

                                                </div>

                                                <div class="m1cr2first1">
                                                    <div class="m1cr2first1column1">
                                                        <img src="">
                                                        <p>Full name</p>
                                                    </div>

                                                    <div class="m1cr2first1column2">
                                                        <button></button>

                                                    </div>

                                                </div>

                                                <div class="m1cr2first1">
                                                    <div class="m1cr2first1column1">
                                                        <img src="">
                                                        <p>Full name</p>
                                                    </div>

                                                    <div class="m1cr2first1column2">
                                                        <button></button>

                                                    </div>

                                                </div>

                                                <div class="m1cr2first1">
                                                    <div class="m1cr2first1column1">
                                                        <img src="">
                                                        <p>Full name</p>
                                                    </div>

                                                    <div class="m1cr2first1column2">
                                                        <button></button>

                                                    </div>

                                                </div>

                                                <div class="m1cr2first1">
                                                    <div class="m1cr2first1column1">
                                                        <img src="">
                                                        <p>Full name</p>
                                                    </div>

                                                    <div class="m1cr2first1column2">
                                                        <button></button>

                                                    </div>

                                                </div>

                                                <div class="m1cr2first1">
                                                    <div class="m1cr2first1column1">
                                                        <img src="">
                                                        <p>Full name</p>
                                                    </div>

                                                    <div class="m1cr2first1column2">
                                                        <button></button>

                                                    </div>

                                                </div>

                                                <div class="m1cr2first1">
                                                    <div class="m1cr2first1column1">
                                                        <img src="">
                                                        <p>Full name</p>
                                                    </div>

                                                    <div class="m1cr2first1column2">
                                                        <button></button>

                                                    </div>

                                                </div>

                                                <div class="m1cr2first1">
                                                    <div class="m1cr2first1column1">
                                                        <img src="">
                                                        <p>Full name</p>
                                                    </div>

                                                    <div class="m1cr2first1column2">
                                                        <button></button>

                                                    </div>

                                                </div>

                                                <div class="m1cr2first1">
                                                    <div class="m1cr2first1column1">
                                                        <img src="">
                                                        <p>Full name</p>
                                                    </div>

                                                    <div class="m1cr2first1column2">
                                                        <button></button>

                                                    </div>

                                                </div>

                                                <div class="m1cr2first1">
                                                    <div class="m1cr2first1column1">
                                                        <img src="">
                                                        <p>Full name</p>
                                                    </div>

                                                    <div class="m1cr2first1column2">
                                                        <button></button>

                                                    </div>

                                                </div>

                                                <div class="m1cr2first1">
                                                    <div class="m1cr2first1column1">
                                                        <img src="">
                                                        <p>Full name</p>
                                                    </div>

                                                    <div class="m1cr2first1column2">
                                                        <button></button>

                                                    </div>

                                                </div>

                                                <div class="m1cr2first1">
                                                    <div class="m1cr2first1column1">
                                                        <img src="">
                                                        <p>Full name</p>
                                                    </div>

                                                    <div class="m1cr2first1column2">
                                                        <button></button>

                                                    </div>
                                                </div>

                                                <div class="m1cr2first1">
                                                    <div class="m1cr2first1column1">
                                                        <img src="">
                                                        <p>Full name</p>
                                                    </div>

                                                    <div class="m1cr2first1column2">
                                                        <button></button>

                                                    </div>
                                                </div>

                                                <div class="m1cr2first1">
                                                    <div class="m1cr2first1column1">
                                                        <img src="">
                                                        <p>Full name</p>
                                                    </div>

                                                    <div class="m1cr2first1column2">
                                                        <button></button>

                                                    </div>

                                                </div>

                                                <div class="m1cr2first1">
                                                    <div class="m1cr2first1column1">
                                                        <img src="">
                                                        <p>Full name</p>
                                                    </div>

                                                    <div class="m1cr2first1column2">
                                                        <button></button>

                                                    </div>

                                                </div>

                                                <div class="m1cr2first1">
                                                    <div class="m1cr2first1column1">
                                                        <img src="">
                                                        <p>Full name</p>
                                                    </div>

                                                    <div class="m1cr2first1column2">
                                                        <button></button>

                                                    </div>

                                                </div>

                                                <div class="m1cr2first1">
                                                    <div class="m1cr2first1column1">
                                                        <img src="">
                                                        <p>Full name</p>
                                                    </div>

                                                    <div class="m1cr2first1column2">
                                                        <button></button>

                                                    </div>

                                                </div>
                                                <div class="m1cr2first1">
                                                    <div class="m1cr2first1column1">
                                                        <img src="">
                                                        <p>Full name</p>
                                                    </div>

                                                    <div class="m1cr2first1column2">
                                                        <button></button>

                                                    </div>

                                                </div>
                                                <div class="m1cr2first1">
                                                    <div class="m1cr2first1column1">
                                                        <img src="">
                                                        <p>Full name</p>
                                                    </div>

                                                    <div class="m1cr2first1column2">
                                                        <button></button>

                                                    </div>

                                                </div>
                                                <div class="m1cr2first1">
                                                    <div class="m1cr2first1column1">
                                                        <img src="">
                                                        <p>Full name</p>
                                                    </div>

                                                    <div class="m1cr2first1column2">
                                                        <button></button>

                                                    </div>

                                                </div>
                                                <div class="m1cr2first1">
                                                    <div class="m1cr2first1column1">
                                                        <img src="">
                                                        <p>Full name</p>
                                                    </div>

                                                    <div class="m1cr2first1column2">
                                                        <button></button>

                                                    </div>

                                                </div>
                                                <div class="m1cr2first1">
                                                    <div class="m1cr2first1column1">
                                                        <img src="">
                                                        <p>Full name</p>
                                                    </div>

                                                    <div class="m1cr2first1column2">
                                                        <button></button>

                                                    </div>

                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <div class="createinvite2">
                                    <textarea class="textarea"
                                        placeholder="Write message to new group member!"></textarea>
                                </div>

                                <div class="createinvite3">
                                    <button>Send Invite!</button>
                                </div>

                            </div>

                        </div>

                    </div>

                    <div id="modal7" class="modal">

                        <div class="modal7-content">

                            <div class="groupsearch">
                                <img src="">
                                <input class="input4">
                            </div>

                            <div class="grouppar">

                                <div class="groupparcl1">
                                    <p>Language:</p>
                                    <select>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>

                                <div class="groupparcl2">
                                    <p>Number of people:</p>
                                    <select>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>

                            </div>

                            <div class="groupres">

                                <div class="scroll-container">
                                    <div class="m1cr2first">
                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <button></button>

                                            </div>

                                        </div>

                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <button></button>

                                            </div>

                                        </div>

                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <button></button>

                                            </div>

                                        </div>

                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <button></button>

                                            </div>

                                        </div>

                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <button></button>

                                            </div>

                                        </div>

                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <button></button>

                                            </div>

                                        </div>

                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <button></button>

                                            </div>

                                        </div>

                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <button></button>

                                            </div>

                                        </div>

                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <button></button>

                                            </div>

                                        </div>

                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <button></button>

                                            </div>

                                        </div>

                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <button></button>

                                            </div>

                                        </div>

                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <button></button>

                                            </div>
                                        </div>

                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <button></button>

                                            </div>
                                        </div>

                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <button></button>

                                            </div>

                                        </div>

                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <button></button>

                                            </div>

                                        </div>

                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <button></button>

                                            </div>

                                        </div>

                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <button></button>

                                            </div>

                                        </div>
                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <button></button>

                                            </div>

                                        </div>
                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <button></button>

                                            </div>

                                        </div>
                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <button></button>

                                            </div>

                                        </div>
                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <button></button>

                                            </div>

                                        </div>
                                        <div class="m1cr2first1">
                                            <div class="m1cr2first1column1">
                                                <img src="">
                                                <p>Full name</p>
                                            </div>

                                            <div class="m1cr2first1column2">
                                                <button></button>

                                            </div>

                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                    <div id="modal8" class="modal">

                        <div class="modal8-content">

                            <div class="creategroup">

                                <div class="creategroupbox">
                                    <p>Name of group:</p>
                                    <input class="input4">
                                </div>

                                <div class="creategroupbox">
                                    <p>Description:</p>
                                    <textarea class="textarea" placeholder="Tell about your group"></textarea>
                                </div>

                                <div class="creategroupbox">

                                    <p>Language:</p>

                                    <select>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>

                                </div>

                                <div class="creategroupbox">

                                    <p>Max number of members:</p>

                                    <select>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>

                                </div>

                                <div class="creategroupbox">
                                    <button>Create!</button>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>