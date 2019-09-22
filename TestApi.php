<?php
// create curl resource
$ch = curl_init();

// set url
curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/leboncoin/web/app_dev.php/adverts/show/2");

//return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);

// $output contains the output string
$output = curl_exec($ch);

// close curl resource to free up system resources
curl_close($ch);

echo $output;

