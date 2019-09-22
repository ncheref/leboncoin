<?php

############ TEST INSERT ############
$post = [
    'title'         => 'new advert',
    'content'       => 'Content of advert',
    'category'      => 'Immobilier',
    'area'          => 100,
    'price'         => 1000,
];

$ch = curl_init('http://localhost:8080/leboncoin/web/app_dev.php/adverts/create');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

// execute!
$response = curl_exec($ch);

// close the connection, release resources used
curl_close($ch);


############ TEST SHOW ############

// create curl resource
$ch = curl_init();

// set url
curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/leboncoin/web/app_dev.php/adverts/show/1");

//return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);

// $output contains the output string
$output = curl_exec($ch);

// close curl resource to free up system resources
curl_close($ch);

echo $output;

