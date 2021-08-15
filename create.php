<?php 
  //Adds book to list by inserting user input into and executing SQL query
  
  require "config.php";
  require "common.php";
  
  if (isset($_POST['submit'])) {
    try {
      $conn = new PDO($dsn, $username, $password, $options);
        
      $Title = $_POST["Title"];
      $FirstName = $_POST["FirstName"];
      $LastName = $_POST["LastName"];
      $Year = $_POST["Year"];
      $Genre = $_POST["Genre"];
      $ReadingStatus = $_POST["ReadingStatus"];
        
      $sql = "INSERT INTO Books(Title, FirstName, LastName, Year, Genre, ReadingStatus)
          VALUES ('$Title', '$FirstName', '$LastName', '$Year', '$Genre', '$ReadingStatus');";

      //Displays error message if any of the below fields are blank
    
      if ($Title == "") {
        echo "Please enter a title.";
        exit;
      } elseif ($FirstName == "") {
        echo "Please enter author's first name.";
        exit;
      } elseif ($LastName == "") {
        echo "Please enter author's last name.";
        exit;
      } elseif ($Year == "") {
        echo "Please enter publication year.";
        exit;
      } elseif (is_numeric($Year) == false) {
        echo "Publication year is not valid.";
        exit;
      } elseif ($Genre == "") {
        echo "Please enter a genre.";
        exit;
      } elseif ($ReadingStatus == "") {
        echo "Please enter reading status.";
        exit;
      }
          
      $statement = $conn->prepare($sql);
      $statement->execute();
          
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
  }

?>

<?php require "header.php"; ?>

  <?php if (isset($_POST['submit']) && $statement) {
    echo $_POST['Title']; ?> successfully entered.
  <?php } ?>

  <h2 style="text-align:center;">Add Book</h2>
  
  <!--Add book form-->
  
  <div>
    <form method="post" id="entry" style="width:75%;display:block;margin:auto;">
      <label for="Title">Title</label>
      <input class="form-control" type="text" name="Title" id="Title">     
      <label for="FirstName">Author First Name</label>
      <input class="form-control" type="text" name="FirstName" id="FirstName">
      <label for="LastName">Author Last Name</label>
      <input class="form-control" type="text" name="LastName" id="LastName">
      <label for="Year">Publication Year</label>
      <input class="form-control" type="text" name="Year" id="Year" placeholder="YYYY">
      <label for="Genre">Genre</label>
    <div class="dropdown">
    <select name="Genre">
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
        <select name="ReadingStatus">
          <li><option value="">Select...</option></li>
          <li><option value="Read">Read</option></li>
          <li><option value="Unread">Unread</option></li>
          <li><option value="Did Not Finish (DNF)">Did Not Finish (DNF)</option></li> 
      </select>
      </div>
      <button class="btn" onclick="update();" type="submit" name="submit" value="Submit" style="float:right;">Submit</button>
    </form>
  </div>
<?php require "footer.php"; ?>