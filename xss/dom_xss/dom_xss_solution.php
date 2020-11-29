<!--Example:-->
<!--<img src="test" onerror="alert('DOM XSS')">-->

<?php
    include '../../header.php';
?>
<div class="login-container">
    <div class="login-wrapper">
        <h1 id="articleTitle">Bird</h1>
        <p id="articleContent">The Bird flew.</p>
    </div>
</div>
<script>
    const articleTitleH1 = document.getElementById('articleTitle');
    const articleContentP = document.getElementById('articleContent');

    const urlParams = new URLSearchParams(window.location.search);
    const articleTitle = urlParams.get('title');

    if (articleTitle) {
        articleTitleH1.innerText = capitalizeFirstLetter(articleTitle);
        articleContentP.innerText = getContentByArticleTitle(articleTitle);
    }

    function getContentByArticleTitle(title) {
        switch (title) {
            case 'cat':
                return 'The Cat walked.';
            case 'dog':
                return 'The Dog walked.';
        }
    }

    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }
</script>