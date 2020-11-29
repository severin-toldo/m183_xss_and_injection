<?php
    include '../../header.php';
    require_once('../../UserRepository.php');


    $userRepository = new UserRepository();
    $isAdminView = $_POST['isAdmin'] === 'true';

    // Example: <script>alert("Reflected XSS");</script>

    // https://stackoverflow.com/questions/7232793/should-i-use-both-striptags-and-htmlspecialchars-to-prevent-xss
    $username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : null;
    $password = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : null;

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
                <form action="stored_xss_solution.php"
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
    <form action="stored_xss_solution.php"
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