<?php

?>

<!DOCTYPE html>
<html>
<section class="main-container">
    <div class="main-wrapper">
        <h2>Upload</h2>


        <head>
            <!--    <script src="js/photo.js"></script>-->
            <title>Take or select photo(s) and upload</title>
            <script src="js/vendor/modernizr-2.8.3.min.js"></script>


        </head>

        <body id="body">
        <p id="result"></p>

        <form id="upForm" enctype="multipart/form-data" method="post" action="upload.php">

            <div>

                <label for="fileToUpload">Take or select photo(s)</label><br/>

                <input type="file" name="fileToUpload" id="fileToUpload" accept="image/*" capture="camera"/>

            </div>
            <br>
            <div id="details">

            </div>

            <input type="text" name="name" placeholder="Product">
            <input type="text" name="city" placeholder="City">

            <input type="text" name="store" placeholder="Store">

            <input list="categories">
            <datalist id="categories">
                <option value="Food">
                <option value="Clothes">
                <option value="Electronics">
                <option value="Furniture">
                <option value="Misc">
            </datalist>
            <input type="number"  step="0.01" name="oriprice" min="0" max="9999.9" placeholder="Original price">
            <input type="number" step="0.01" name="price" min="0" max="9999.9" placeholder="Discounted price">
            <input type="datetime-local" name="expires" placeholder="Discount expires">
            <input type="hidden" name="tiedosto" id="faili">
            <div>

                <input type="submit" value="Upload" name="Upload"/>

            </div>

            <div id="progress"></div>

        </form>


        <script src="includes/photo.js"></script>




        </body>


    </div>
</section>

</html>