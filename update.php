<?php

  // Displays Books table
  require "config.php";
  require "common.php";

    try {
      $connection = new PDO($dsn, $username, $password, $options);

      $sql = "SELECT * 
             FROM Books";
             
      $statement = $connection->prepare($sql);
      $statement->execute();
      
      $result = $statement->fetchAll();
    } catch (PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
      
    }
    
  if(isset($_POST["sort"])) {
     try {
      $connection = new PDO($dsn, $username, $password, $options);
        
      $sortOption = $_POST['sortOption'];
      //$sql = "ORDER BY `Books`.`$sortOption` ASC";
      
      switch($sortOption) {
        case 'Title':
          $sql = "ORDER BY `Books`.`Title` ASC";
        case 'Date':
          $sql = "ORDER BY `Books`.`Date` ASC";
        case 'Last Name':
          $sql = "ORDER BY `Books`.`LastName` ASC";
        case 'Genre':
          $sql = "ORDER BY `Books`.`Genre` ASC";
        case 'ReadingStatus':
          $sql = "ORDER BY `Books`.`ReadingStatus` ASC";
          
      $statement = $connection->prepare($sql);
      $statement->execute();
        
      }
      
     } catch (PDOException $error) {
       echo $sql . "<br>" . $error->getMessage(); 
    }
}

  try {
    $connection = new PDO($dsn, $username, $password, $options);
      
    $sql = "SELECT * 
           FROM Books";
      
    $statement = $connection->prepare($sql);
    $statement->execute();
      
    $result = $statement->fetchAll();
  } catch (PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
  
  if(isset($_POST["delete"])) {
    try {
      $connection = new PDO($dsn, $username, $password, $options);
      
      $ID = $_POST["delete"];
        
      $sql = "DELETE FROM Books 
             WHERE ID = :ID";
        
      $statement = $connection->prepare($sql);
      $statement->bindValue(':ID', $ID);
      $statement->execute();
        
      $success = "Book successfully deleted.";
    }  catch (PDOException $error) {
       echo $sql . "<br>" . $error->getMessage(); 
    }
  }
?>

<?php require "header.php"; ?>
  <h2 style="text-align:center;">Books</h2>

  <form action="search.php" method="post" style="width:75%;display:block;margin:auto;">
  <input type="text" class="form-control" name="search" placeholder="Search for book...">
  <input class="btn" type="submit" style="margin-top:5px;">
  </form>
  <div style="width:75%;display:block;margin:auto;">
  <label for="sortOptions">Sort By</label>
  <div class="dropdown">
    <select style="margin-bottom:15px;" name="sortOption">
      <li><option value="">Select...</option></li>
      <li><option value="Title">Title</option></li>
      <li><option value="LastName">Last Name</option></li>
      <li><option value="Year">Year</option></li>
      <li><option value="Genre">Genre</option></li>
      <li><option value="ReadingStatus">Reading Status</option></li>
      <li><option value="Date">Date</option></li>
    </select>
  </div>
  <td><button class="btn m-3" type="submit" name="sort" value="<?php echo $row["sortOption"]; ?>">Sort</button></td>
  <br>
  <table class="table" style="margin-left:auto;margin-right:auto;" id="bookTable">
    <thead>
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Publication Year</th> 
        <th>Genre</th>
        <th>Status</th>
        <th>Date</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>  
    </thead>
    <tbody>
    <?php foreach ($result as $row) : ?>
      <tr>
        <td><?php echo $row["ID"]; ?></td>
        <td><?php echo $row["Title"]; ?></td>
        <td><?php echo $row["FirstName"]; ?></td>
        <td><?php echo $row["LastName"]; ?></td>
        <td><?php echo $row["Year"]; ?></td>
        <td><?php echo $row["Genre"]; ?></td>
        <td><?php echo $row["ReadingStatus"]; ?></td>
        <td><?php echo $row["Date"]; ?></td>
        <td><button class="btn m-3" type="submit" name="edit" value="<?php echo $row["ID"]; ?>"><a href="edit.php" style="color:black;text-decoration:none;">Edit</a></button></td>
        <td><button class="btn m-3" type="submit" name="delete" value="<?php echo $row["ID"]; ?>"><a href="delete.php?ID=<?php echo escape($row["ID"]); ?>" style="color:black;text-decoration:none;">Delete</a></button></td>-
      </tr>
      <?php endforeach; ?>
      </tbody>
  </table>
  </div>
<?php require "footer.php"; ?>