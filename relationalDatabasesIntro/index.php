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

//READ

echo '<h1>All the trees in the database:</h1>';
$sql = "SELECT name, height, id FROM trees"; // forming sql

$statement = $pdo->query($sql); // passing sql to DB. then wrapping DB response in $statement

while ($row = $statement->fetch())
{
    echo $row['id'].': '.$row['name'].' '.$row['height'].'<br>';
}

echo '<h2>Of which deciduous are:</h2>';
$sql = "SELECT name, height, id
FROM trees
WHERE type = 2"; // sql query (single '=' necessary)

$statement = $pdo->query($sql);
while ($row = $statement->fetch())
{
    echo $row['id'].': '.$row['name'].' '.$row['height'].'<br>';
}

echo '<h2>Or which grow taller than 10 metres:</h2>';
$sql = "SELECT name, height, id
FROM trees
WHERE height > 10"; // sql query (single '=' necessary)

$statement = $pdo->query($sql);
while ($row = $statement->fetch())
{
    echo $row['id'].': '.$row['name'].' '.$row['height'].'<br>';
}

echo '<h2>All of the trees, sorted by height, in descending order:</h2>';
$sql = "SELECT name, height, id
FROM trees
ORDER BY height DESC"; 

$statement = $pdo->query($sql);
while ($row = $statement->fetch())
{
    echo $row['id'].': '.$row['name'].' '.$row['height'].'<br>';
}

echo '<h2>Deciduous trees, taller than 12 metres, sorted by height, in ascending order:</h2>';
$sql = "SELECT name, height, id
FROM trees
WHERE type = 2 AND height > 12
ORDER BY height"; 

$statement = $pdo->query($sql);
while ($row = $statement->fetch())
{
    echo $row['id'].': '.$row['name'].' '.$row['height'].'<br>';
}

// DELETE
$sql = "DELETE FROM trees WHERE name='Cyprus Cedar'"; //form sql instructions
$pdo->query($sql); // pass the instructions to DB

//WRITE
$sql = "INSERT INTO trees (name, height, type) VALUES ('Cyprus Cedar', 38, 1)"; // form sql

$pdo->query($sql); // send the changes to DB


// UPDATE
$sql = "UPDATE trees SET height='37.88' WHERE name='Cyprus Cedar'"; // form sql instructions
$pdo->query($sql); //send the changes to DB
?>