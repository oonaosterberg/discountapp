
<link rel="stylesheet" href="style.css">

<?php
include_once 'header.php';
require_once ("includes/dbh.inc.php");
?>

<section class="main-container">
    <div class="main-wrapper">



        <?php
        //haetaan tuotteen tiedot getillä
        $ID = mysqli_real_escape_string($conn, $_GET['ID']);
        $sql = "SELECT * FROM discount WHERE ID = '$ID'";
        $result = mysqli_query($conn, $sql) or die ("Bad Query: $sql");
        $row = mysqli_fetch_array($result);
        ?>

        <img src = "<?php echo $row['Img_url']?>" class="opened">
        <br>
        <h3><?php echo $row['Discount_name']?></h3>
        <p>Price: <?php echo $row['Discount_price']?></p>
        <p>Original price: <?php echo $row['Original_price']?></p>
        <p>Expires: <?php echo $row['Expiration_time']?></p>
        <a href="add-to-mypage.php?ID=<?php echo $row['ID']?>">Add to Shopping List</a>

        <?php

        ?>



    </div>


</section>



<?php
include_once 'footer.php';
?>

