<?php
    // Example: <script>alert("Reflected XSS");</script>
    include '../../header.php';
    require_once('../../UserRepository.php');


    $isAdminView = $_POST['isAdmin'] === 'true';
    $username = isset($_POST['username']) ? $_POST['username'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;
    $userRepository = new UserRepository();
    if ($isAdminView) {
        $users = $userRepository->executeQuery('SELECT * FROM user');

        echo '<div class="login-container">';
        echo '<div class="login-wrapper">';
        echo '<h1>Users</h1>';
        echo '<ul class="list-group">';

        foreach ($users as $user) {
            echo '<li class="list-group-item">' . $user->getUsername() . '</li>';
        }

        echo '</ul>';
        echo '</div>';
        echo '</div>';
    } else {
        echo '
        <div class="login-container">
            <div class="login-wrapper">
                <form action="stored_xss.php"
                      method="POST">
                    <h1 class="login-form-title pb-2">Register</h1>
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
        ';

        if ($username && $password !== null) {
            $userRepository->executeQuery("INSERT INTO user (username, password) VALUES ('" . $username . "', '" . $password . "');");
        }
    }
?>
<div class="m-5">
    <form action="stored_xss.php"
          method="POST">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="isAdmin" id="exampleRadios1" value="true">
            <label class="form-check-label" for="exampleRadios1">
                Admin
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="isAdmin" id="exampleRadios2" value="false" checked>
            <label class="form-check-label" for="exampleRadios2">
                User
            </label>
        </div>
        <button type="submit" class="btn btn-primary">Go</button>
    </form>
</div>