<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Confirmation</title>
</head>
<body>
    <h1>Rohirrim Tour Booking Confirmation</h1>
    <?php
        function sanitise_input($data) {
            $data = trim($data);                // 앞뒤 공백 제거
            $data = stripslashes($data);        // 백슬래시 제거
            $data = htmlspecialchars($data);    // <, > 같은 특수기호 무력화
            return $data;
        }
        
        
        $errMsg = "";

        // First Name 검사
        if (isset($_POST["firstname"])) {
            $firstname = sanitise_input($_POST["firstname"]);
            if ($firstname == "") {
                header ("location: register.html");
                exit(); // 👈 이거 필수!
                $errMsg .= "<p>You must enter your first name.</p>";
            } elseif (!preg_match("/^[a-zA-Z]+$/", $firstname)) {
                $errMsg .= "<p>Only alpha letters allowed in your first name.</p>";
            }
        } else {
            $errMsg .= "<p>First name is missing.</p>";
        }
        
        
        // Last Name 검사
        if (isset($_POST["lastname"])) {
            $lastname = sanitise_input($_POST["lastname"]);
            if ($lastname == "") {
                $errMsg .= "<p>You must enter your last name.</p>";
            } elseif (!preg_match("/^[a-zA-Z-]+$/", $lastname)) {
                $errMsg .= "<p>Only letters or hyphens allowed in your last name.</p>";
            }
        } else {
            $errMsg .= "<p>Last name is missing.</p>";
        }
        
        // Age 검사
        if (isset($_POST["age"])) {
            $age = sanitise_input($_POST["age"]);
            if (!is_numeric($age) || $age < 10 || $age > 10000) {
                $errMsg .= "<p>Age must be a number between 10 and 10,000.</p>";
            }
        } else {
            $errMsg .= "<p>Age is missing.</p>";
        }
        
        if (isset($_POST["food"])) $food = sanitise_input($_POST["food"]);       
        if (isset($_POST["partysize"])) $partysize = sanitise_input($_POST["partysize"]);
        if (isset($_POST["species"])) {
            $species = sanitise_input($_POST["species"]);
            
        } else {
            $species = "Unknown species";
        }

        $tour ="";
        if (isset($_POST["accom"])) $tour.= "Accommodation Tour ";
        if (isset($_POST["4day"])) $tour.= "Four Day Tour ";
        if (isset($_POST["10day"])) $tour.= "Ten Day Tour ";
        $tour = sanitise_input($tour); // ✅ 마지막에 전체 문자열로 정제



        if ($errMsg != "") {
            echo "<p>Error msg: $errMsg</p>";
        } else {
            echo "<p>---------Welcome $firstname $lastname!--------<br />
            You are now booked on the $tour<br />
            Species: $species<br />
            Age: $age<br />
            Meal Preference: $food<br />
            Number of Travellers: $partysize</p>";
        }
    ?>

</body>
</html>
