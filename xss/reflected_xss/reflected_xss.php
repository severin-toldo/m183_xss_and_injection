<?php
    include '../../header.php';
?>
<body>
    <h1>Reflected XSS - Risk</h1>
    <form action="reflected_xss.php"
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
            <input type="text"
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
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';

    echo '<b>Entered Data:</b><br/>';
    echo $_POST['name'] . '<br/>';
    echo $_POST['email'] . '<br/>';
?>

<!--<script>alert('Reflected XSS');</script>-->


