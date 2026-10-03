<?php $titulo = $titulo ?? 'Pokedex shida'; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($titulo) ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 900px;
            margin: 0 auto;
            padding: 16px;
        }

        .buscador input {
            padding: 8px;
            width: 250px;
        }

        .buscador button,
        .boton {
            padding: 8px 16px;
            cursor: pointer;
        }

        .boton {
            display: inline-block;
            background: #e3350d;
            color: white;
            border-radius: 6px;
            text-decoration: none;
        }

        .boton:hover {
            background: #b72a0a;
        }

        .ficha {
            border: 2px solid #e3350d;
            border-radius: 10px;
            padding: 16px;
            text-align: center;
            margin: 16px auto;
            max-width: 300px;
        }

        .ficha h2 {
            margin-top: 0;
        }

        .cuadricula {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 12px;
        }

        .tarjeta {
            display: block;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 8px;
            text-align: center;
            text-decoration: none;
            color: #222;
        }

        .tarjeta:hover {
            border-color: #e3350d;
            background: #fff4f2;
        }

        .tarjeta img {
            width: 96px;
            height: 96px;
        }

        .tarjeta small {
            color: #777;
        }

        .aviso {
            background: #fff4e5;
            border: 1px solid #f0a020;
            border-radius: 6px;
            padding: 10px;
        }

        .ver-mas {
            text-align: center;
            margin: 24px 0;
        }
    </style>
</head>

<body>

    <nav>
        <a href="pokemon.php">Inicio</a>
    </nav>

    <hr>