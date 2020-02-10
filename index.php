<?php
//this line makes PHP behave in a more strict way
declare(strict_types=1);
ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

//we are going to use session variables so we need to enable sessions
session_start();

$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = "";

$emailErr = "Email required";

function whatIsHappening() {
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}


//your products with their price.
$products = [
    ['name' => 'Club Ham', 'price' => 3.20],
    ['name' => 'Club Cheese', 'price' => 3],
    ['name' => 'Club Cheese & Ham', 'price' => 4],
    ['name' => 'Club Chicken', 'price' => 4],
    ['name' => 'Club Salmon', 'price' => 5]
];

$products = [
    ['name' => 'Cola', 'price' => 2],
    ['name' => 'Fanta', 'price' => 2],
    ['name' => 'Sprite', 'price' => 2],
    ['name' => 'Ice-tea', 'price' => 3],
];

$totalValue = 0;

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["street"])) {
        echo ($nameErr = "street is required</br>");
    } else {
        $name = test_input($_POST["street"]);
    }

    if (empty($_POST["streetnumber"])) {
        echo ($emailErr = "streetnumber is required</br>");
    } else {
        $email = test_input($_POST["streetnumber"]);
    }

    if (empty($_POST["city"])) {
        echo ($website = "Please fill in your city</br>");
    } else {
        $website = test_input($_POST["city"]);
    }

    if (empty($_POST["zipcode"])) {
        echo ($comment = "zipcode is required</br>");
    } else {
        $comment = test_input($_POST["zipcode"]);
    }

}
//function to validate email
function emailValidation ($mailValidation) {
    return (filter_var($mailValidation,FILTER_VALIDATE_EMAIL));
}

if (emailValidation($_POST["email"])){
    echo ("valid email");

}else {
    echo ("this is not a freaking valid mail");
}
//function to validate street number
function streetNumValidation ($numberValidation) {
    return (filter_var($numberValidation,FILTER_VALIDATE_INT));
}

if (streetNumValidation($_POST["streetnumber"])){
    echo ("valid streetnumber");
}
else {
    echo("this is not a streetNumber!");
}
whatIsHappening();
//if (empty($_GET["email"])) {
//    $emailErr = "Email is required";
//
//} else {
//    $email = ($_POST["email"]);
//    // check if e-mail address is well-formed
//    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//        $emailErr = "Invalid email format";
//    }


require 'form-view.php';
