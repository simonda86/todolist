<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link rel="stylesheet" type="text/css" href="/css/app.css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">TodoList</div>
                <a href="<?= action('Auth\AuthController@getLogin'); ?>" class="btn btn-default btn-lg" style="margin-right:5px;">Log in</a> <a href="<?= action('Auth\AuthController@getRegister'); ?>" class="btn btn-primary btn-lg">Sign up</a>
            </div>
        </div>
    </body>
</html>
