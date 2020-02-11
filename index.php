<?php
//this line makes PHP behave in a more strict way
declare(strict_types=1);
ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

//we are going to use session variables so we need to enable sessions
session_start();

$streetErr = $streetNumbErr = $cityErr = $zipcodeErr = "";
$street = $streetNumb = $city = $zipcode = "";
$emailSes = $streetSes = $streetNumbSes = $citySes = $zipcodeSes = "";
$productsDrinks = $products = "";
$formSend ="";



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

$productsDrinks = [
    ['name' => 'Cola', 'price' => 2],
    ['name' => 'Fanta', 'price' => 2],
    ['name' => 'Sprite', 'price' => 2],
    ['name' => 'Ice-tea', 'price' => 3],
];

if (!isset($_GET["food"])) {
    $_GET["food"] = 1;
}

if ($_GET["food"] == 1){
    $products = $products;
} else {
    $products = $productsDrinks;
}


$totalValue = 0;

function inputfield($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


//$emailSes = $_SESSION["email"];
//$streetSes = $_SESSION["street"];
//$streetNumbSes = $_SESSION["streetnumber"];
//$citySes = $_SESSION["city"];
//$zipcodeSes = $_SESSION["zipcode"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (empty($_POST["email"])) {
        $streetErr = "E-mail is required</br>";
    } else {
        $email = inputfield($_POST["email"]);
       $emailSes = $_SESSION["email"] = $_POST["email"];


    }
    if (empty($_POST["street"])) {
         $streetErr = "street is required</br>";
    } else {
        $street = inputfield($_POST["street"]);
       $streetSes = $_SESSION["street"] = $_POST["street"];
    }

    if (empty($_POST["streetnumber"])) {
        ($streetNumbErr = "streetnumber is required</br>");
    } else {
        $streetNumb = inputfield($_POST["streetnumber"]);
       $streetNumbSes = $_SESSION["streetnumber"] = $_POST["streetnumber"];
    }

    if (empty($_POST["city"])) {
        ($cityErr = "Your city is required</br>");
    } else {
        $city = inputfield($_POST["city"]);
        $citySes = $_SESSION["city"] = $_POST["city"];
    }

    if (empty($_POST["zipcode"])) {
        ($zipcodeErr = "zipcode is required</br>");
    } else {
        $zipcode = inputfield($_POST["zipcode"]);
        $zipcodeSes = $_SESSION["zipcode"] = $_POST["zipcode"];
    }

}

//function to validate email
function emailValidation ($mailValidation) {
    return (filter_var($mailValidation,FILTER_VALIDATE_EMAIL));
}
if (isset($_POST["email"]) && $_POST["streetnumber"]){

    //mail validation
    if (emailValidation($_POST["email"])){
        echo ("valid email");


    }else {
        echo ("this is not a freaking valid mail </br>");
    }

    //streetnum validation
    if (streetNumValidation($_POST["streetnumber"])){
        echo ("valid streetnumber");

    }
    else {
        echo("this is not a streetNumber!</br>");
    }

} else {
    echo ("Nothing in the INPUTA");
}

//function to validate street number
function streetNumValidation ($numberValidation) {
    return (filter_var($numberValidation,FILTER_VALIDATE_INT));
}


whatIsHappening();

if (isset($_POST["refresh"])) {
    header("refresh");

}

//valid form message

if (isset ($_POST["order"])) {
    if ($_POST["order"] = false) {
        echo ("trash");

    } else {
        $formSend = "<div class=\"alert alert-success\" role=\"alert\">Your form has been submitted</div>";
    }
}

require 'form-view.php';

