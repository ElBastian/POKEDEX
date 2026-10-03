<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

if (!defined('POKEAPI_URL')) {
    define('POKEAPI_URL', 'https://pokeapi.co/api/v2/pokemon/');
}

function e($texto)
{
    return htmlspecialchars((string) $texto, ENT_QUOTES, 'UTF-8');
}

function problemaConexion()
{
    if (!extension_loaded('openssl')) {
        return 'PHP no tiene activada la extensión openssl, así que no puede abrir direcciones https://. '
            . 'Actívala en tu php.ini (quita el ; de la línea ;extension=openssl) y reinicia el servidor.';
    }

    return $GLOBALS['ultimoErrorApi'] ?? '';
}

function pedirApi($url)
{
    $respuesta = @file_get_contents($url);

    $datos = json_decode($respuesta, true);

    return is_array($datos) ? $datos : null;
}

function imagenPokemon($id)
{
    return 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/' . (int) $id . '.png';
}

function listarPokemon($limite = 20)
{
    $datos = pedirApi(POKEAPI_URL . '?offset=0&limit=' . (int) $limite);

    $lista = [];

    if ($datos !== null && isset($datos['results'])) {
        foreach ($datos['results'] as $pokemon) {
            $id = (int) basename(rtrim($pokemon['url'], '/'));

            $lista[] = [
                'id'     => $id,
                'nombre' => $pokemon['name'],
                'imagen' => imagenPokemon($id),
            ];
        }
    } else {
        for ($id = 1; $id <= $limite; $id++) {
            $lista[] = [
                'id'     => $id,
                'nombre' => '',
                'imagen' => imagenPokemon($id),
            ];
        }
    }

    return $lista;
}

function obtenerPokemon($nombre)
{
    $nombre = strtolower(trim($nombre));

    if ($nombre === '') {
        return null;
    }

    return pedirApi(POKEAPI_URL . rawurlencode($nombre));
}

function tiposPokemon($datos)
{
    $tipos = [];
    foreach ($datos['types'] as $tipo) {
        $tipos[] = $tipo['type']['name'];
    }

    return implode(', ', $tipos);
}
