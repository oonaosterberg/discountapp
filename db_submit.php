<?php
include_once 'includes/dbh.inc.php';


// TÄMÄ KOODI TOIMII TÄLLÄ HETKELLÄ! Vaatii vielä hiomista tosin.


session_start();

//Asetetaan kaikki nulliksi alussa varan vuoksi.
$Discountname = NULL;
$oriprice = NULL;
$price = NULL;
$expires = NULL;
$img_url = NULL;
$store = NULL;
$category = NULL;
$categories = NULL;
$storeresult = NULL;
$usersearch = NULL;
$useridresult = NULL;
$currentuser = NULL;
$sql = NULL;

//Lomakkeen tiedot
$Discountname = $_POST['name'];
$oriprice = $_POST['oriprice'];
$price = $_POST['price'];
$expires = $_POST['expires'];
$img_url = $_POST['tiedosto'];
$category = $_POST['categeories'];
$city = $_POST['city'];
$store = $_POST['store'];

/*//Kategoria ----------------------  NÄMÄ EIVÄT VIELÄ TOIMI!!! ----------------------------------
$catsearch = "SELECT ID FROM category WHERE Category_name = $category;";

if(mysqli_query($conn, $catsearch)){
    $categorylookup = mysqli_query($conn, $catsearch);

} else {
    $categorycreate = "INSERT INTO category(Category_name) VALUES '$category';";
    mysqli_query($conn, $categorycreate);
    $categorylookup = mysqli_query($conn, $catsearch);
}


//Kaupan tiedot (Store)
$storesearch = "SELECT ID FROM store WHERE Store_name = '$store';";
if (mysqli_query($conn, $storesearch)){
    $storeid = mysqli_query($conn, $storesearch);

} else {
    $storecreate = "INSERT INTO store(Category_id, Store_name, City) VALUES('$categorylookup', '$store', '$city');";
    $storeid = mysqli_query($conn, $storesearch);
}----------------------  NÄMÄ EIVÄT VIELÄ TOIMI!!! ----------------------------------*/


//Käyttäjä
$user_id = $_SESSION['u_ID'];


//    $sql = "INSERT INTO discount (Start_time, Expiration_time, Discount_name, Original_price, Discount_price, User_id, Store_id, Img_url)
//    VALUES (now(), $expires, '$Discountname', $oriprice, $price, $useridresult, $storeresult, '$img_url')";
//TO-DO: error handlers
// check for empty fields

//Insert into
$sql = "INSERT INTO discount (Discount_name, Original_price, Discount_price, Start_time, Expiration_time, User_id, Img_url) VALUES ('$Discountname', $oriprice, $price, CURRENT_TIMESTAMP, '$expires', '$user_id', '$img_url');";
print_r($_POST);
if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


session_unset();
session_destroy();

?>