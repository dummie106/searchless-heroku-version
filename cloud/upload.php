
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

