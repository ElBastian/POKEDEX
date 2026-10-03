<?php
require_once 'functions.php';

$porPagina = 20;
$limite = (int) ($_GET['limite'] ?? $porPagina);
if ($limite < $porPagina) {
    $limite = $porPagina;
}

$busqueda = trim($_GET['pokemon'] ?? '');
$datos = null;
$error = '';

if ($busqueda !== '') {
    $datos = obtenerPokemon($busqueda);

    if ($datos === null && problemaConexion() === '') {
        $error = 'No se encontró el Pokémon "' . $busqueda . '". Revisa el nombre.';
    }
}

$listaPokemon = listarPokemon($limite);
$problema = problemaConexion();

$titulo = 'Pokedex shida';
include_once 'header.php';
?>

<h1>Pokémon</h1>

<form class="buscador" method="GET" action="pokemon.php">
    <input
        type="text"
        name="pokemon"
        value="<?= e($busqueda) ?>"
        placeholder="Ingrese el nombre del Pokémon"
        required>
    <input type="hidden" name="limite" value="<?= e($limite) ?>">
    <button type="submit">Buscar</button>
</form>

<?php if ($error !== ''): ?>
    <p style="color: red;"><?= e($error) ?></p>
<?php elseif ($datos !== null): ?>
    <div class="ficha">
        <h2><?= e(ucfirst($datos['name'])) ?> #<?= e($datos['id']) ?></h2>

        <?php if (!empty($datos['sprites']['front_default'])): ?>
            <img src="<?= e($datos['sprites']['front_default']) ?>" alt="<?= e($datos['name']) ?>" width="150">
        <?php endif; ?>

        <p>Tipo: <?= e(tiposPokemon($datos)) ?></p>
        <p>Altura: <?= e($datos['height'] / 10) ?> m</p>
        <p>Peso: <?= e($datos['weight'] / 10) ?> kg</p>
    </div>
<?php endif; ?>

<hr>

<div class="cuadricula">
    <?php foreach ($listaPokemon as $pokemon): ?>
        <a class="tarjeta" href="pokemon.php?pokemon=<?= e($pokemon['id']) ?>&limite=<?= e($limite) ?>">
            <img src="<?= e($pokemon['imagen']) ?>" alt="Pokémon <?= e($pokemon['id']) ?>" loading="lazy">
            <br>
            <small>#<?= e($pokemon['id']) ?></small>
            <?php if ($pokemon['nombre'] !== ''): ?>
                <br>
                <?= e(ucfirst($pokemon['nombre'])) ?>
            <?php endif; ?>
        </a>
    <?php endforeach; ?>
</div>

<div class="ver-mas">
    <a class="boton" href="pokemon.php?limite=<?= e($limite + $porPagina) ?><?= $busqueda !== '' ? '&pokemon=' . e($busqueda) : '' ?>">Ver más Pokémon</a>
</div>

<?php include_once 'footer.php'; ?>