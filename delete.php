<?php

  //Delete book from list

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
 
<?php if ($success) echo $success ?>
  <form method="post" style="width:75%;display:block;margin:auto;">
    <input type="text" class="form-control" id="input" placeholder="Search for book...">
    <button class="btn" type="submit" value="Search" style="margin-top:5px;">Submit</button>
    <div style="width:75%;display:block;margin:auto;">
    <label for="sortOptions">Sort By</label>
    <div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="sortDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-bottom:5px;">Title <i class="fa fa-caret-down" aria-hidden="true"></i></button>
    <ul class="dropdown-menu" aria-labelledby="sortDropdown">
      <li><a value="Title">Title</a></li>
      <li><a value="Last Name">Last Name</a></li>
      <li><a value="Year">Year</a></li>
      <li><a value="Genre">Genre</a></li>
      <li><a value="ReadingStatus">Reading Status</a></li>
      <li><a value="Date">Date</a></li>
    </ul>
    </div>
      <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
      <table class="table" style="margin-left:auto;margin-right:auto;" >
        <thead>
          <tr>
            <th>ID</th>
            <th>Title</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Publication Year</th>
            <th>Genre</th>
            <th>Reading Status</th>
            <th>Date</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>  
        </thead>
        <tbody>
        <?php foreach ($result as $row) : ?>
          <tr>
            <td><?php echo escape($row["ID"]); ?></td>
            <td><?php echo escape($row["Title"]); ?></td>  
            <td><?php echo escape($row["FirstName"]); ?></td>  
            <td><?php echo escape($row["LastName"]); ?></td>  
            <td><?php echo escape($row["Year"]); ?></td>  
            <td><?php echo escape($row["Genre"]); ?></td>  
            <td><?php echo escape($row["ReadingStatus"]); ?></td>
            <td><?php echo escape($row["Date"]); ?></td>
            <td><button class="btn m-3" type="submit" name="edit" value="<?php echo $row["ID"]; ?>">Edit</button></td>
            <td><button class="btn m-3" type="submit" name="delete" value="<?php echo $row["ID"]; ?>">Delete</button></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </form>
<?php require "footer.php"; ?>