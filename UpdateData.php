<!DOCTYPE html>
<html>
<body>

<h1>Update Product</h1>

<?php
ini_set('display_errors', 1);
echo "Update database!";
?>

<form name="update" action="UpdateData.php" method="POST">
    <label for="id">ID Product:</label><input type="text" name="id" placeholder="input id product"/>
    <label for="newname">New Name:</label><input type="text" name="newname" placeholder="input new product name"/><br>
    <input type="submit" value="Update">
</form>

<?php


if (empty(getenv("DATABASE_URL"))){
    echo '<p>The DB does not exist</p>';
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=postgres', 'postgres', '123456');
}  else {
     
   $db = parse_url(getenv("DATABASE_URL"));
   $pdo = new PDO("pgsql:" . sprintf(
    "host=ec2-54-81-37-115.compute-1.amazonaws.com;port=5432;user=
htrongpavlkseq
;password=
c731685fd6d4f0ff39ed14bc0ef44f61524bc9d6b189ff230f81b8d76522ca38;dbname=d87d49488vu5if",
        $db["host"],
        $db["port"],
        $db["user"],
        $db["pass"],
        ltrim($db["path"], "/")
   ));
}  


$sql = "UPDATE products SET name = '$_POST[newname]' WHERE products_id = '$_POST[id]'";
      $stmt = $pdo->prepare($sql);
if($stmt->execute() == TRUE){
    echo "Record updated successfully.";
} else {
    echo "Error updating record. ";
}
    
?>
</body>
</html>
