<!--Example:-->
<!--<script>-->
<!--    document.addEventListener("DOMContentLoaded", () => {-->
<!--        const ordersBtn = document.getElementById("ordersBtn");-->
<!--        ordersBtn.setAttribute("href", "https://www.google.com");-->
<!--    });-->
<!--</script>-->

<?php
    include '../../header.php';


    $username = isset($_POST['username']) ? $_POST['username'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;

    if ($username && $password) {
        echo '
                <div class="login-container">
                    <div class="login-wrapper">
                        <h1>Profile - ' . $username . '</h1>
                        <a class="btn btn-primary mt-2" href="orders.php" role="button" id="ordersBtn">Orders</a>
                    </div>
                </div>
            ';
    } else {
        echo '
                <div class="login-container">
                    <div class="login-wrapper">
                        <form action="reflected_xss.php"
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
            ';
    }
?>



