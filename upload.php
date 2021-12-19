
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
<iframe src="https://searchless.herokuapp.com/cloud/" style="border:0px #ffffff none;" name="yo" scrolling="yes" frameborder="1" marginheight="0px" marginwidth="0px" height="100%" width="100%" allowfullscreen></iframe>
