<?php
    include '../../header.php';
?>
<body>
    <h1>Reflected XSS - Solution</h1>
    <form action="reflected_xss_solution.php"
          method="post">
        <label>
            Name:
            <input type="text"
                   name="name"
                   required>
        </label>
        <br/>
        <label>
            E-mail:
            <input type="email"
                   name="email"
                   required>
        </label>
        <br/>
        <button type="submit">Submit</button>
    </form>
    <br/>
    <br/>
</body>
<?php
    $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';

    echo '<b>Entered Data:</b><br/>';
    echo $name . '<br/>';
    echo $email . '<br/>';
?>

<!-- <script>alert('Reflected XSS');</script> -->


