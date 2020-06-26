<!DOCTYPE html>
<html>
<body>

<h1>Delete Data</h1>

<h4>ID of Product</h4>

<form name="delete" method="POST" action="DeleteData.php">
    <lable for="id">ID Product</label><input type="text" name="id" placeholder="..."/><br>
    <input type="submit" value="Delete">
</form>

<?php
ini_set('display_errors', 1);
?>

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

$sql = "DELETE FROM products WHERE products_id = '$_POST[id]'";
$stmt = $pdo->prepare($sql);
if($stmt->execute() == TRUE){
    echo "deleted successfully.";
} else {
    echo "Error deleting record: ";
}

?>
</body>
</html>
