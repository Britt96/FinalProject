<?php
  
  // Provides functionality to search bar by checking keyword against database
  
  require "config.php";
  require "common.php";

  $search = $_POST['search'];

  $connection = new PDO($dsn, $username, $password, $options);

  if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
  }

  $sql = "SELECT * FROM Books WHERE Title LIKE '%$search%'";

  $result = $connection->query($sql);

  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo $row["ID"]." ".$row["Title"]." ".$row["FirstName"]." ".$row["LastName"]." ".$row["Year"]." ".$row["Genre"]." ".$row["ReadingStatus"]." ".$row["Date"]."<br>";
    } 
  } else {
    echo "No records.";
      
  }
?>