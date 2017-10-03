<?php
  require 'cloudinary/Cloudinary.php';
  require 'cloudinary/Uploader.php';
  require 'cloudinary/Api.php';

  if ($_SERVER['HTTP_HOST'] == 'localhost:8000') {
    //if (!ini_get('display_errors')) { ini_set('display_errors', '1'); }
    //if (!ini_get('display_startup_errors')) { ini_set('display_startup_errors', '1'); }
    $root 			= 'http://localhost:8000/prlab.info/review-collection/';
    $host 			= 'localhost';
    $username 		= 'root';
    $password 		= 'root';
    $tracking     = false;

    \Cloudinary::config(array(
      "cloud_name" => "deycjf1yb",
      "api_key" => "573789383394411",
      "api_secret" => "J2jA0gYUbAL6oKeaMIxzD2pmAaQ"
    ));
  } elseif ($_SERVER['HTTP_HOST'] == 'prlab.info') {
    $root 			= 'http://prlab.info/review-collection/';
    $host 			= 'localhost';
    $username 		= 'ztwalshdb';
    $password 		= 'Z#twrz843';
    $tracking     = true;

    \Cloudinary::config(array(
      "cloud_name" => "powerreviews",
      "api_key" => "458534322846893",
      "api_secret" => "AnIDUFMziD6egcEP-aoDPEpHXRY"
    ));
  }

  $database 		= 'review_collection';
  $mysqli         = new mysqli($host, $username, $password, $database);

  session_start();
  require('functions.php');

  $merchant_group_id = set_session_var('merchant_group_id');
  $page_id = set_session_var('page_id');
  $ip = $_SERVER['REMOTE_ADDR'];
  $product_name = set_session_var('product_name', 'Ray-Ban New Wayfarer Classic Tortoise');
  $product_image_url = set_session_var('product_image_url', $root.'images/rayban.jpeg');
  $page_title = 'No Data';
  $sweepstakes = set_session_var('sweepstakes', false);
  $merchant_user_email = set_session_var('merchant_user_email');
  $order_id = set_session_var('order_id');
?>
