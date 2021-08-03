<?php
$contra = "Vendedor1";
$hash = password_hash($contra, PASSWORD_DEFAULT);
echo $hash;
 ?>
