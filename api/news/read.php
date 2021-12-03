<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/News.php';

   // Instantiate DB & connect
   $database = new Database();
   $db = $database->connect();
 
   // Instantiate blog post object
   $post = new News($db);
 
   // Blog post query
   $result = $post->read();
   // Get row count
   $num = $result->rowCount();
 
   // Check if any posts
   if($num > 0) {
     // Post array
     $posts_arr = array();
     // $posts_arr['data'] = array();
 
     while($row = $result->fetch(PDO::FETCH_ASSOC)) {
       extract($row);
 
       $post_item = array(
         'id' => $id,
         'hot' => $hot,
         'bannerUrl' => $bannerUrl,
         'mediaURL' => $mediaURL,
         'title' => $title,
         'descr' => html_entity_decode($descr),
         'content' => html_entity_decode($content),
         'author' => $author,
         
       );
 
       // Push to "data"
       array_push($posts_arr, $post_item);
       // array_push($posts_arr['data'], $post_item);
     }
 
     // Turn to JSON & output
     echo json_encode($posts_arr);
 
   } else {
     // No Posts
     echo json_encode(
       array('message' => 'No Posts Found')
     );
   }