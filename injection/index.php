<!DOCTYPE html>
<html lang='en'>
<head>
    <title>SQL Injection Example</title>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css'>
    <link rel='stylesheet' type='text/css' href='stylesheet_old.css'>
</head>
<body>
<div class='container-login'>
    <div class='wrap-login'>
        <form action='index.php' method='POST'>
            <span class='login-form-title pb-4'>Welcome</span>
            <div class='form-group'>
                <input type='text' class='form-control' name='username' id='username' placeholder='username'>
            </div>
            <div class='form-group'>
                <input type='text' class='form-control' name='password' id='password' placeholder='password'>
            </div>
            <button type='submit' class='btn btn-primary'>Submit</button>
        </form>
    </div>
</div>
</body>
</html>
<?php
// Example: password = '; select * from user where '' = '
$servername = '127.0.0.1';
$serverUsername = 'root';
$serverPassword = '!24Zoro24!';
$serverDB = 'owasp_risks';
$port = 3306;

$conn = new mysqli($servername, $serverUsername, $serverPassword, $serverDB, $port);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}


$sql = "SELECT * FROM user where username = '%s' and password = '%s'";


if (!empty($_POST['username']) && !empty($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    echo '<pre>';
    echo print_r($_POST);
    echo '</pre>';

    $formattedSQL = sprintf($sql, $username, $password);
    echo $formattedSQL . '<br>';
    if ($conn -> multi_query($formattedSQL)) {
        do {
            // Store first result set
            if ($result = $conn -> store_result()) {
                while ($row = $result -> fetch_row()) {
                    printf('%s<br>', print_r($row));
                }
                $result -> free_result();
            }
            // if there are more result-sets, the print a divider
            if ($conn -> more_results()) {
                printf('-------------<br>');
            }
            //Prepare next result set
        } while ($conn -> next_result());
    }
}

$conn -> close();
?>