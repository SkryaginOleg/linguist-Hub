<?php

class WebPage {
    private $title;
    protected $theme;
 

    public function __construct($title, $theme) {
        $this->title = $title;
        $this->theme = $theme;
    }

    public function displayHeader() {
        require "blocks/header.php";
    }

    public function displayContent(){}

    public function displayFooter() {
        require "blocks/footer.php";
    }
}

class MainPage extends WebPage{

    
    public function displayContent()
    {
        $connection = mysqli_connect("localhost", "root", "", "lingusticSchool");

        if (!$connection) {
            die("Ошибка соединения: " . mysqli_connect_error());
        }

        $query = "SELECT * FROM course";
        $result = mysqli_query($connection, $query);

        echo "<div class=\"container mt-5\"> <h3 class=\"mb-5\">$this->theme</h3>";

        echo "<div class = \"d-flex flex-wrap\"> ";     

        while ($row = mysqli_fetch_assoc($result)){              
            echo "
            <div class=\"card mb-4 rounded-3 shadow-sm\">
                <div class=\"card-header py-3\">
                    <h4 class=\"my-0 fw-normal\">{$row['language']}</h4>
                </div>
                <div class=\"card-body\">
                <img src=\"{$row['course_image']}\" class=\"img-thumbnail\"/>
                    <ul class=\"list-unstyled mt-3 mb-4\">
                        <li>Level {$row['level']}</li>
                        <li>Price {$row['price']}$</li>
                        <li>Period {$row['period']}</li>
                    </ul>
                    <a href = '\Linguist Hub\order.php?action=false&id=" . $row['id_course'] ."'><button type=\"button\" class=\"w-100 btn btn-lg btn-outline-primary\"> Заказати</button></a>

                </div>
            </div>
            ";
        }
        echo "</div> </div>";
    }

}

class BascetPage extends WebPage{

    public function displayContent()
    {
        $connection = mysqli_connect("localhost", "root", "", "lingusticSchool");

        if (!$connection) {
            die("Ошибка соединения: " . mysqli_connect_error());
        }

        if(isset($_COOKIE['user'])) {
            $userId = $_COOKIE['user'];
        } else {
            die;
        }

        $query = "SELECT * FROM course JOIN basket ON course.id_course = basket.id_course WHERE basket.id_user = '$userId'";

        $result = mysqli_query($connection, $query);

        echo "<div class=\"container mt-5\"> <h3 class=\"mb-5\">$this->theme</h3>";

        echo "<div class = \"d-flex flex-wrap\"> ";     

        while ($row = mysqli_fetch_assoc($result)){              
            echo "
            <div class=\"card mb-4 rounded-3 shadow-sm\">
                <div class=\"card-header py-3\">
                    <h4 class=\"my-0 fw-normal\">{$row['language']}</h4>
                </div>
                <div class=\"card-body\">
                <img src=\"{$row['course_image']}\" class=\"img-thumbnail\"/>
                    <ul class=\"list-unstyled mt-3 mb-4\">
                        <li>Level {$row['level']}</li>
                        <li>Price {$row['price']}$</li>
                        <li>Period {$row['period']}</li>
                    </ul>
                    <a href = '\Linguist Hub\order.php?action=true&id=" . $row['id_course'] ."'><button type=\"button\" class=\"w-100 btn btn-lg btn-outline-primary\">Видалити</button></a>
                </div>
            </div>
            ";
        }
        echo "</div> </div>";
    }
    
}