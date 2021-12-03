<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Information.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate contact information object
  $information = new Information($db);

  // Get ID
  $information->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get Information
  $information->read_single();

  // Create array
  $information_arr = array(
    'id' =>$information -> id,
    'name' => $information -> name,
    'phone_number' => $information -> phone_number,
    'subject' => $information -> subject,
    'message' => $information -> message,
    'email' => $information -> email,
    'client_id' => $information -> client_id
  );

  // Make JSON
  print_r(json_encode($information_arr));