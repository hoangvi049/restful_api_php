<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Information.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $information = new Information($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $information->name = $data->name;
  $information->email = $data->email;
  $information->number = $data->number;
  $information->subject = $data->subject;
  $information->message = $data->message;

  // Create post
  if($information->create()) {
    echo json_encode(
      array('message' => 'Contact Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Contact Not Created')
    );
  }

