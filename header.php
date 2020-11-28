<head>
    <title>OWASP Risks Live Demo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
</head>
<?php
    $basePath = '/m183_xss_and_injection/';

    $paths = [
            'Reflected XSS' => 'xss/reflected_xss/reflected_xss.php',
            'Reflected XSS - Solution' => 'xss/reflected_xss/reflected_xss_solution.php'
    ];

    $navLinks = '';

    foreach ($paths as $key => $value) {
        $href = $basePath . $value;
        $navLinks = $navLinks . '<a class="nav-item nav-link" href="' . $href . '">' . $key . '</a>';
    }

    echo '
        <nav class="navbar navbar-expand-lg navbar navbar-dark bg-primary">
            <a class="navbar-brand" href="#">OWASP Risks Live Demo</a>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">' .
                $navLinks
                . '</div>
            </div>
        </nav>
    ';
?>





