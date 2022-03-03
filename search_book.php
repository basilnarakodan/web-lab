<?php
require_once('config.php');
$proccess=0;
$name="";
if ($_SERVER['REQUEST_METHOD']=="GET") {

    if (isset($_GET['submit'])) {
  
        function validate_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
      
        $name=validate_input($_GET['name']);
    
    

        $sql="SELECT * FROM `book` WHERE b_name LIKE '%$name%'";
        if (mysqli_query($con, $sql)) {
          $result=mysqli_query($con,$sql);
       $proccess=1;
         
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
    }
}



?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Search book</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
  <div class="nav">
           <div style="padding-left:10px">
           <a href="admin_home.php">

<h2>LMS</h2>
</a>
           </div>
           <div >
     <a class="nav-item" href="add_book.php">Add Books</a>

        <a class="nav-item" href="issue_book.php">Issue Books</a>
        <a class="nav-item" href="renew_book.php">Renew Books</a>
        <a class="nav-item" href="return_book.php">Return Books</a>
     </div>

       </div>
    <div class="container">
      <h3>Search Book</h3>
      <form action="search_book.php" method="get" class="form" style="flex-direction: row;">
     
        <input
          type="text"
          required
          class="ip-item"
          name="name"
          value='<?php echo $name ?>'
          id=""
          placeholder="Name"
        />
    
        <button class="btn" type="submit" name="submit">Search Book</button>
      </form>

<?php 
if($proccess!=0)
if(mysqli_num_rows($result)>0){



  ?>
  <table > 
    <thead>
      <th>ID</th>
      <th>Title</th>
      <th>Author(s)</th>
      <th>Publisher</th>
      <th>Edition</th>
    </thead>

  <tbody>

    
    <?php
    
  if($row=mysqli_fetch_assoc($result)){
    
    echo "<tr>
    <td>".$row['b_id']."</td>
    <td>".$row['b_name']."</td>
    <td>".$row['b_author']."</td>
    <td>".$row['publication']."</td>
    <td>".$row['edition']."</td>
  </tr>";
    
    
  }
  ?>
  </tbody>
  </table>
<?php

}else
{echo "No Books";}
?>

    </div>
  </body>
</html>
