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

// READ:

echo '<h2>INNER JOIN</h2>';

$sql = "SELECT trees.id as tId, name, height, typeId, typeName, treetypes.id as ttId  FROM trees INNER JOIN treetypes ON treetypes.typeid = trees.type;";

$statement = $pdo->query($sql); 
while ($row = $statement->fetch())
{
    echo $row['tId'].': '.$row['name'].$row['typeName'].'<br>';
}

echo '<h2>LEFT JOIN</h2>';

$sql = "SELECT trees.id as tId, name, height, typeId, typeName, treetypes.id as ttId  FROM trees INNER JOIN treetypes ON treetypes.typeid = trees.type;";

$statement = $pdo->query($sql); 
while ($row = $statement->fetch())
{
    echo $row['tId'].': '.$row['name'].$row['typeName'].'<br>';
}


echo '<h2>RIGHT JOIN</h2>';

$sql = "SELECT trees.id as tId, name, height, typeId, typeName, treetypes.id as ttId  FROM trees INNER JOIN treetypes ON treetypes.typeid = trees.type;";

$statement = $pdo->query($sql); 
while ($row = $statement->fetch())
{
    echo $row['ttId'].': '.$row['name'].$row['typeName'].'<br>';
}

?>