<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <base href="/aptech-app/templates/">
        <link rel="stylesheet" href="style/css/main.css">
        <link rel="stylesheet" href="style/font/css/all.css">
        <link rel="stylesheet" href="style/css/style.css">
        <title><?= $page_title; ?></title>
    </head>
    <body>
        <?= $page_content; ?>
        <footer>
            <div class="fixed-bottom text-center">
                <p class="text-muted">&copy; 2020 - Mon app</p>
            </div>
        </footer>
        <script src="style/js/jquery.js"></script>
        <script src="style/js/popper.js"></script>
        <script src="style/js/main.js"></script>
        <script src="style/js/app.js"></script>
    </body>
</html>