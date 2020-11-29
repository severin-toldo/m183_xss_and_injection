<?php
    include '../../header.php';
?>
<div class="login-container">
    <div class="login-wrapper">
        <form action="reflected_xss_solution.php"
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
<?php
    // Example: <script>alert('Reflected XSS');</script>

    // https://stackoverflow.com/questions/7232793/should-i-use-both-striptags-and-htmlspecialchars-to-prevent-xss
    $username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '';
    $password = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '';

    echo '<b>Output:</b><br/>';
    echo $username . '<br/>';
    echo $password . '<br/>';
?>




