<?php
session_start();
include('config.php');
include('firebaseRDB.php');

$db = new firebaseRDB($databaseURL);

$insert = $db->insert("nid", [
    "nid_number" => $_POST['nid_number'],
    "nid_name" => $_POST['nid_name'],
    "nid_dob" => $_POST['nid_dob']
]);
echo "data Saved";