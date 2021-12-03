<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  
  include_once '../../config/Database.php';
  include_once '../../models/News.php';

   // Instantiate DB & connect
   $database = new Database();
   $db = $database->connect();

// Instantiate contact information object
$news = new News($db);

// Get ID
$news->id = isset($_GET['id']) ? $_GET['id'] : die();

 // Get Information
 $news->read_single();

   // Create array
   $news_arr = array(
    'id' =>$news -> id,
    'hot' => $news -> hot,
    'bannerUrl' => $news -> bannerUrl,
    'mediaURL' => $news -> mediaURL,
    'title' => $news -> title,
    'descr' => $news -> content,
    'content' => $news -> content,
    'author' => $news -> author
  );

    // Make JSON
    print_r(json_encode($news_arr));