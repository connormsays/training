<?php
require('../site.php');
require('../db.php');

var_dump($_FILES);
 if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    }
    else {
        move_uploaded_file($_FILES['file']['tmp_name'], __DIR__.'../../img/test/' . $_FILES['file']['name']);
    }