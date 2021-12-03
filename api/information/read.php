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

  // contact information query
  $result = $information->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any information
  if($num > 0) {
    // information array
    $information_arr = array();
    // $information_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $information_item = array(
        'id' => $id,
        'name' => $name,
        'phone_number' => $phone_number,
        'subject' => $subject,
        'message' => html_entity_decode($message),
        'email' => $email,
        'client_id' => $client_id
      );

      // Push to "data"
      array_push($information_arr, $information_item);
      // array_push($posts_arr['data'], $post_item);
    }

    // Turn to JSON & output
    echo json_encode($information_arr);

  } else {
    // No information
    echo json_encode(
      array('message' => 'No Posts Found')
    );
  }
