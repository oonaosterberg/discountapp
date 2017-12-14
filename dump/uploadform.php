<?php
include_once 'header.php';
?>

    <section class="main-container">
        <div class="main-wrapper">
            <h2>Upload</h2>
            <?php


            if (isset($_SESSION['u_ID'])) {
                echo "You are logged in!";
                include 'includes/upload.php';

            } else {
                echo "You must be logged in in order to upload.";
            }
            ?>
        </div>
    </section>


<?php
include_once 'footer.php';
?>