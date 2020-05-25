<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="public/css/bootstrap.css">
        <title>Learn jQuery</title>
    </head>
    <body>
    <div class="container">
        <form method="POST" class="mt-4">
            <div class="col-4 form-group">
                <input type="text" class="form-control" placeholder="Something to write">
            </div>
            <div class="col-4 form-group">
                <button type="submit" class="btn btn-primary">Appuyé sur moi!</button>
            </div>
        </form>
    </div>
    <script src="public/js/jquery.js"></script>
    <script>
        $(document).ready(function () {
            $('button').mousedown(function () {
                $(this).html('Click on me')
            })
        })
    </script>
    </body>
</html>