<!--Contains links to CSS and Bootstrap files php files can access with require statment, eliminating the need to copy and paste it to each file.-->

<!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Reading Tracker</title>
    
      <link rel="stylesheet" href="style.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
      <script src="../scripts/validation.js"></script>
    </head>
      <body>
      
        <!--Navigation Bar-->
        <nav class="navbar navbar-default">
          <div class="contsiner-fluid">
            <div class="navbar-header">
              <a class="navbar-brand" href="index.html">Reading Tracker</a>
            </div>
          </div>
          <ul class="nav navbar-nav"> 
            <li>
              <a href="update.php">View List</a>
            </li>  
            <li>
              <a href="create.php">Add Book</a>
            </li>  
          </ul>  
        </nav>