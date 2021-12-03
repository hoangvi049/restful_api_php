<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');
  
  include_once '../../config/Database.php';
  include_once '../../models/News.php';


    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();
  
    // Instantiate blog post object
    $news = new News($db);
  
    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));
  
    $news->hot = $data->hot;
    $news->bannerUrl = $data->bannerUrl;
    $news->mediaURL = $data->mediaURL;
    $news->title = $data->title;
    $news->descr = $data->descr;
    $news->content = $data->content;
    $news->author = $data->author;

  
    // Create Category
    if($news->create()) {
      echo json_encode(
        array('message' => 'Category Created')
      );
    } else {
      echo json_encode(
        array('message' => 'Category Not Created')
      );
    }
  