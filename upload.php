
<?php
$folder = "cloud";
if (is_uploaded_file($_FILES['filename']['tmp_name']))  {  
    if (move_uploaded_file($_FILES['filename']['tmp_name'],
 $folder."/".$_FILES['filename']['name'])) {
         Echo "File uploaded";
    } else {
         Echo "File not moved to destination folder. Check permissions";
    };
} else {
     Echo "File is not uploaded.";
};
?>
<head>
  <style>
        @keyframes bgcolor {
    0% {
        background-color: #45a3e5
    }

    30% {
        background-color: #66bf39
    }

    60% {
        background-color: #eb670f
    }

    90% {
        background-color: #f35
    }

    100% {
        background-color: #864cbf
    }
}

body {
    -webkit-animation: bgcolor 30s infinite;
    animation: bgcolor 20s infinite;
    -webkit-animation-direction: alternate;
    animation-direction: alternate;
}

  </style>
</head>
<form action="upload.php" method="post" enctype="multipart/form-data">
File: <input type="file" name="filename" />
<input type="submit" value="Upload" />
</form>
<iframe src="https://searchless.herokuapp.com/cloud/" style="border:0px #ffffff none;" name="yo" scrolling="yes" frameborder="1" marginheight="0px" marginwidth="0px" height="90%" width="100%" allowfullscreen></iframe>
