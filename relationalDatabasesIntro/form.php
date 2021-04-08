<?php

$host = '127.0.0.1';
$db = 'forest';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

if(!empty($_POST)) 
{
    if($_POST['action'] == 'add') {
        $sql = "INSERT INTO trees (name, height, type)
        VALUES ('".$_POST['name']."', ".$_POST['height'].", ".$_POST['type'].")";
        
        $pdo->query($sql);
    }
    if($_POST['action'] == 'delete') {
        $sql = "DELETE FROM trees WHERE id=".$_POST['id'].""; 
        $pdo->query($sql);
    }
    
    header ('Location: http://localhost/septintas/relationalDatabasesIntro/form.php');
    die;
}

?>
    <!-- Create -->
    <form action="" method="post">
        Name: <input type="text" name="name">
        Type: <input type="text" name="type">
        Height: <input type="text" name="height">
        <button type="submit" name="action" value="add">Seed</button>
    </form>
    <hr>

    <!-- Delete -->
    <form action="" method="post">
        Id: <input type="text" name="id">
        <button type="submit" name="action" value="delete">Pull</button>
    </form>
    <hr>



<?php

echo '<h2>Finished</h2>';

$sql = 'SELECT name, height, id FROM trees';
$statemenet = $pdo->query($sql);
while ($row = $statemenet->fetch()) 
{
    echo $row['id'].': '.$row['name'].' '.$row['height'].'<br>';
}

?>