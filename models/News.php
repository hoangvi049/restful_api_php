<?php 
  class News {
    // DB stuff
    private $conn;
    private $table = 'news';

    // Post Properties
    public $id;
    public $hot;
    public $bannerUrl;
    public $mediaURL;
    public $title;
    public $descr;
    public $content;
    public $author;
    public $created_at;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Posts
    public function read() {
      // Create query
      $query = 'SELECT
      id,
      hot,
      bannerUrl,
      mediaURL,
      title,
      descr,
      content,
      author

    FROM
      ' . $this->table . '
    ORDER BY
      created_at DESC';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

      // Get Single News
  public function read_single(){
    // Create query
    $query = 'SELECT
      id,
      hot,
      bannerUrl,
      mediaURL,
      title,
      descr,
      content,
      author
        FROM
          ' . $this->table . '
      WHERE id = ?
      LIMIT 0,1';

      //Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(1, $this->id);

      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // set properties
      
      $this->hot = $row['hot'];
      $this->bannerUrl = $row['bannerUrl'];
      $this->mediaURL = $row['mediaURL'];
      $this->title = $row['title'];
      $this->descr = $row['descr'];
      $this->content = $row['content'];
      $this->author = $row['author'];
  }

// Create News
public function create() {
    // Create Query
    $query = 'INSERT INTO ' .
      $this->table . '
    SET
    hot = :hot,
    bannerUrl = :bannerUrl,
    mediaURL = :mediaURL,
    title = :title,
    descr = :descr,
    content = :content,
    author = :author';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->hot = htmlspecialchars(strip_tags($this->hot));
  $this->bannerUrl = htmlspecialchars(strip_tags($this->bannerUrl));
  $this->mediaURL = htmlspecialchars(strip_tags($this->mediaURL));
  $this->title = htmlspecialchars(strip_tags($this->title));
  $this->descr = htmlspecialchars(strip_tags($this->descr));
  $this->content = htmlspecialchars(strip_tags($this->content));
  $this->author = htmlspecialchars(strip_tags($this->author));

  // Bind data
  $stmt-> bindParam(':hot', $this->hot);
  $stmt-> bindParam(':bannerUrl', $this->bannerUrl);
  $stmt-> bindParam(':mediaURL', $this->mediaURL);
  $stmt-> bindParam(':title', $this->title);
  $stmt-> bindParam(':descr', $this->descr);
  $stmt-> bindParam(':content', $this->content);
  $stmt-> bindParam(':author', $this->author);


  // Execute query
  if($stmt->execute()) {
    return true;
  }

  // Print error if something goes wrong
  printf("Error: $s.\n", $stmt->error);

  return false;
  }


    // Update News
    public function update() {
        // Create query
        $query = 'UPDATE ' . $this->table . '
        SET
        hot = :hot,
        bannerUrl = :bannerUrl,
        mediaURL = :mediaURL,
        title = :title,
        descr = :descr,
        content = :content,
        author = :author
        WHERE id = :id';;

        // Prepare statement
        $stmt = $this->conn->prepare($query);

      // Clean data
  $this->hot = htmlspecialchars(strip_tags($this->hot));
  $this->bannerUrl = htmlspecialchars(strip_tags($this->bannerUrl));
  $this->mediaURL = htmlspecialchars(strip_tags($this->mediaURL));
  $this->title = htmlspecialchars(strip_tags($this->title));
  $this->descr = htmlspecialchars(strip_tags($this->descr));
  $this->content = htmlspecialchars(strip_tags($this->content));
  $this->author = htmlspecialchars(strip_tags($this->author));
  $this->id = htmlspecialchars(strip_tags($this->id));


  // Bind data
  $stmt-> bindParam(':hot', $this->hot);
  $stmt-> bindParam(':bannerUrl', $this->bannerUrl);
  $stmt-> bindParam(':mediaURL', $this->mediaURL);
  $stmt-> bindParam(':title', $this->title);
  $stmt-> bindParam(':descr', $this->descr);
  $stmt-> bindParam(':content', $this->content);
  $stmt-> bindParam(':author', $this->author);
  $stmt-> bindParam(':id', $this->id);

        // Execute query
        if($stmt->execute()) {
          return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
  }
 
  public function delete() {
    // Create query
    $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->id = htmlspecialchars(strip_tags($this->id));

    // Bind data
    $stmt->bindParam(':id', $this->id);

    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: %s.\n", $stmt->error);

    return false;
}

}

