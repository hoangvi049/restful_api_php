<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Information.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate contact information object
  $information = new Information($db);

  // Get raw information data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $information->id = $data->id;

  // Delete contact information
  if($information->delete()) {
    echo json_encode(
      array('message' => 'Contact Deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Contact Not Deleted')
    );
  }

