<!DOCTYPE html>
<html lang="vn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./mainstyle.css"/>
    <title>ATN data center</title>
</head>
<body>
        <?php
        ini_set('display_errors', 1);
        if (empty(getenv("DATABASE_URL"))){
            $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=postgres', 'postgres', '123456');
        }  else {
            echo getenv("dbname");
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

        $sql = "SELECT * FROM products ORDER BY products_id";
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $resultSet = $stmt->fetchAll();
    ?>
    <h1>ATN's Database</h1>
    <button onclick="location.href='index.php'">Back to Homepage</button>
    <div class="container">
        <div class="grid-view">
            <div class="grid-item">
                <img src="./databaseone.jpg"/>
                <a href="#" onClick="displayData()"><b>View Invoice Database</b></a>
            </div>
            <div class="grid-item">
                <img src="./databaseone.jpg" />
                <a href="./InsertData.php" target="framename"><b>Add database</b></a>
            </div>
            <div class="grid-item">
                <img src="./databaseone.jpg"/>
                <a href="./DeleteData.php" target="framename"><b>Delete database</b></a>
            </div>
            <div class="grid-item">
                <img src="./databaseone.jpg"/>
                <a href="UpdateData.php" target="framename"><b>Update Database</b></a>
            </div>
            <div id ="displaychange" class="grid-item">
                <table class="table table-bordered table-condensed">
                    <thead>
                    <tr>
                        <th>products_id</th>
                        <th>name</th>
                        <th>price</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                   
                            foreach ($resultSet as $row) {
                    ?>
                    
                    <tr>
                        <td scope="row"><?php echo $row['products_id'] ?></td>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['price'] ?></td>     
                    </tr>
                    
                    <?php
                            }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="./data.js"></script>
</body>
</html>
