<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!-- Evitar que sea Escalable -->
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <!-- <link type="text/css" rel="stylesheet" href="css/stylesheet.css"/> -->
    <!-- <script type="text/javascript" src="js/script.js"></script> -->

    <style>
        body {
            background-color: #FEFEFE;
            font-family: 'Arial';
            text-align: center;
            margin-top: 200px;
        }
    </style>
    <title>Tienda inactiva</title>
</head>
<body>
<section>
    <img src="{{ asset('/images/codizer-logo.png') }}" width="160px">
    <p>La tienda <strong>{{ $tienda->nombre }}</strong> parece no estar disponible por el momento.</p>
</section>
<footer>
    Codizer © 2016
</footer>
</body>
</html>