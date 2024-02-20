<?php include 'conn.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="Admin/img/logo/puc.png" rel="icon">
        <title>401 Error</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f5f5f5;
                text-align: center;
                padding: 50px;
            }
            h1 {
                color: #ff0000;
            }
        </style>
    </head>
    <body>
        <h1>Unauthorized Access</h1>
        <p>You do not have permission to access this page.</p>
        <img src="Admin/img/error.png" style="max-height: 350px">
        <div class="text-center">
            <a href="logout.php">&larr; Back to Home</a>
        </div>
    </body>
</html>