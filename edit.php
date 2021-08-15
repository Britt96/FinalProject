<?php
  // Edits existing entry
  
  require "config.php";
  require "common.php";
    
  if (isset($_POST['update'])) {
    try {
      $connection = new PDO($dsn, $username, $password, $options);
      
      // Creates an array with book details
      $book =[
        "ID"            => $_POST['ID'],
        "Title"         => $_POST['Title'],
        "FirstName"     => $_POST['FirstName'],
        "LastName"      => $_POST['LastName'],
        "Year"          => $_POST['Year'],
        "Genre"         => $_POST['Genre'],
        "ReadingStatus" => $_POST['ReadingStatus']
      ];
    
      $sql = "UPDATE Books
              SET ID = :ID,
                Title = :Title,
                FirstName = :FirstName,
                LastName = :LastName,
                Year = :Year,
                Genre = :Genre,
                ReadingStatus = :ReadingStatus,
              WHERE ID = :ID";
      
      $statement = $connection->prepare($sql);
      $statement->execute($book); 
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
  }
  
  // Selects book chosen by user
  
  if (isset($_GET["ID"])) {
    try {
      $connection = new PDO($dsn, $username, $password, $options);
      $ID = $_GET["ID"];
        
      $sql = "SELECT * FROM Books WHERE ID = :ID";
      $statement = $connection->prepare($sql);
      $statement->bindValue(':ID', $ID);
      $statement->execute();
        
      $book = $statement->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    } 
  }
?>

<?php require "header.php" ?>

  <?php if (isset($_POST['update']) && $statement) : ?>
    <blockquote><?php echo escape($_POST['Title']); ?> successfully updated.</blockquote>
  <?php endif; ?>

  <h2 style="text-align:center;">Edit Book</h2>

  <div>
    <form method="post" id="entry" style="width:75%;display:block;margin:auto;">
      <label for="Title">Title</label>
      <input class="form-control" type="text" name="Title" id="Title" value="<?php echo["Title"]; ?>">     
      <label for="FirstName">Author First Name</label>
      <input class="form-control" type="text" name="FirstName" id="FirstName" value="<?php echo["FirstName"]; ?>">
      <label for="LastName">Author Last Name</label>
      <input class="form-control" type="text" name="LastName" id="LastName" value="<?php echo["LastName"]; ?>">
      <label for="Year">Publication Year</label>
      <input class="form-control" type="text" name="Year" id="Year" placeholder="YYYY" value="<?php echo["Year"]; ?>">
      <label for="Genre">Genre</label>
      <div class="dropdown">
        <select name="Genre" value=value="<?php echo["Genre"]; ?>">
          <li><option value="">Select...</option></li>
          <li><option value="Action/Adventure">Action/Adventure</option></li>
          <li><option value="Anthology">Anthology</option></li>
          <li><option value="Chick Lit">Chick Lit</option></li>
          <li><option value="Children's Fiction">Children's Fiction</option></li>
          <li><option value="Christian">Christian</option></li>
          <li><option value="Drama">Drama</option></li>
          <li><option value="Fantasy">Fantasy</option></li>
          <li><option value="Comic/Graphic Novel">Comic/Graphic Novel</option></li>
          <li><option value="Historical">Historical</option></li>
          <li><option value="Humor">Humor</option></li>
          <li><option value="Horror">Horror</option></li>
          <li><option value="LGBTQIA+">LGBTQIA+</option></li>
          <li><option value="Manga">Manga</option></li>
          <li><option value="Mystery/Crime">Mystery/Crime</option></li>
          <li><option value="Nonfiction">Nonfiction</option></li>
          <li><option value="Poetry">Poetry</option></li>
          <li><option value="Romance">Romance</option></li>
          <li><option value="Science Fiction">Science Fiction</option></li>
          <li><option value="Self Help">Self Help</option></li>
          <li><option value="Short Story">Short Story</option></li>
          <li><option value="Sports">Sports</option></li>
          <li><option value="Suspense/Thriller">Suspense/Thriller</option></li>
          <li><option value="Young Adult">Young Adult</option></li>
          <li><option value="Other">Other</option></li>
        </select>
        </div>
        <label for="ReadingStatus">Status</label>
          <div class="dropdown">
            <select name="ReadingStatus" value="<?php echo["ReadingStatus"]; ?>">
              <li><option value="">Select...</option></li>
              <li><option value="Read">Read</option></li>
              <li><option value="Unread">Unread</option></li>
              <li><option value="Did Not Finish (DNF)">Did Not Finish (DNF)</option></li> 
            </select>
          </div>
        <button class="btn" type="submit" name="update" value="Submit" style="float:right;">Submit</button>
      </form>
    </div>
<?php require "footer.php" ?>