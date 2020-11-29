<?php
    include '../header.php';
    require_once('../UserRepository.php');
?>
<div class="login-container">
    <div class="login-wrapper">
        <form action="injection_solution.php"
              method="POST">
            <h1 class="login-form-title pb-2">Login</h1>
            <div class="form-group">
                <input type="text"
                       class="form-control"
                       name="username"
                       placeholder="Username"
                       required>
            </div>
            <div class="form-group">
                <input type="password"
                       class="form-control"
                       name="password"
                       placeholder="Password"
                       required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
<div class="m-5">
    <?php
        $userRepository = new UserRepository();

        // Example: input'; INSERT INTO user (username, password) VALUES ('new', 'user');
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';

        $sql = "SELECT * FROM user where username = '%s' and password = '%s'";
        $sql = sprintf($sql, mysqli_real_escape_string($userRepository->getConn(), $username), mysqli_real_escape_string($userRepository->getConn(), $password));

        echo '<b>Output:</b><br/>';
        echo 'Query: ' . $sql . '<br>';

        $userRepository->executeQuery($sql);
        $users = $userRepository->executeQuery('SELECT * FROM user');
        $userRepository->printUsers($users);
    ?>
</div>
