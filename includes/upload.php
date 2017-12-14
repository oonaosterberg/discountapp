<?php
/**
 * Created by PhpStorm.
 * User: Anu
 * Date: 5.12.2017
 * Time: 14.09
 */

include_once 'dbh.inc.php';
?>

<!DOCTYPE html>

<html>

<head>

    <title>Take or select photo(s) and upload</title>

    <script type="text/javascript">

      function fileSelected() {

          var count = document.getElementById('fileToUpload').files.length;

          document.getElementById('details').innerHTML = "";

          for (var index = 0; index < count; index ++)

              {

                  var file = document.getElementById('fileToUpload').files[index];

                  var fileSize = 0;

                  if (file.size > 1024 * 1024)

                      fileSize = (Math.round(file.size * 100 / (1024 * 1024)) / 100).toString() + 'MB';

                  else

                      fileSize = (Math.round(file.size * 100 / 1024) / 100).toString() + 'KB';

                  document.getElementById('details').innerHTML += 'Name: ' + file.name + '<br>Size: ' + fileSize + '<br>Type: ' + file.type;

                  document.getElementById('details').innerHTML += '<p>';

              }

      }

      function uploadFile() {

          var fd = new FormData();

          var count = document.getElementById('fileToUpload').files.length;

          for (var index = 0; index < count; index ++)

              {

                  var file = document.getElementById('fileToUpload').files[index];

                  fd.append('myFile', file)

                  //Here

              }

        var xhr = new XMLHttpRequest();

        xhr.upload.addEventListener("progress", uploadProgress, false);

        xhr.addEventListener("load", uploadComplete, false);

        xhr.addEventListener("error", uploadFailed, false);

        xhr.addEventListener("abort", uploadCanceled, false);

        xhr.open("POST", "./includes/savetofile.php");

        xhr.send(fd);


      }

      function uploadProgress(evt) {

          if (evt.lengthComputable) {

              var percentComplete = Math.round(evt.loaded * 100 / evt.total);

              document.getElementById('progress').innerHTML = percentComplete.toString() + '%';

          }

          else {

              document.getElementById('progress').innerHTML = 'unable to compute';

          }

      }

      function uploadComplete(evt) {

          /* This event is raised when the server send back a response */



          alert(evt.target.responseText);

      }

      function uploadFailed(evt) {

          alert("There was an error attempting to upload the file.");

      }

      function uploadCanceled(evt) {

          alert("The upload has been canceled by the user or the browser dropped the connection.");

      }

    </script>

</head>

<body>

  <form id="form1" enctype="multipart/form-data" method="post" action="upload.php">

    <div>

      <label for="fileToUpload">Take or select photo(s)</label><br />

      <input type="file" name="fileToUpload" id="fileToUpload" onchange="fileSelected();" accept="image/*" capture="camera" />

    </div>
<br>
    <div id="details"></div><input type="text" name="Store" placeholder="Store">
      <input list="categories">
      <datalist id="categories">
          <option value="Food">
          <option value="Clothes">
          <option value="Electronics">
          <option value="Furniture">
          <option value="Misc">
      </datalist>
      <input type="number" name="Oriprice" min="0" max="9999.9" placeholder="Original price">
      <input type="number" name="Price" min="0" max="9999.9" placeholder="Discounted price"><br />
      <input type="datetime-local" name="Expires" placeholder="Discount expires">
    <div>

      <input type="button" onclick="uploadFile()" value="Upload" />

    </div>

    <div id="progress"></div>

  </form>


  <?php
  $userid = $_SESSION['u_ID'];
  $store = $_POST['Store'];
  $oriprice = $_POST['Oriprice'];
  $price = $_POST['Price'];
  $expires = $_POST['Expires'];
  $img_url = 'uploads/' . $_POST['fileToUpload'];

  $sql = "INSERT INTO discount(Start_time, Expiration_time, Img_url, Original_price, Discount_price, Added, User_id, Store_id)
  VALUES now(), '$expires', '$img_url' , '$oriprice', '$price', now(), '$userid', '$store'";
  ?>

</body>

</html>
