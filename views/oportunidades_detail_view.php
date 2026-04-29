<?php
require_once "controllers/OpportunityController.php";

$controller = new OpportunityController();
$op = $controller->show();

$controller->save();
$controller->delete();
?>

<h1><?= $op['title'] ?></h1>
<p><?= $op['functions'] ?></p>
<p>Vacantes: <?= $op['vacancies'] ?></p>

<!-- EDIT -->
<a href="oportunidades_form_view.php?id=<?= $op['id'] ?>">
    <button>Editar</button>
</a>

<!-- DELETE -->
<form method="GET" action="delete_opportunity.php" onsubmit="return confirm('¿Eliminar?');">
    <input type="hidden" name="id" value="<?= $op['id'] ?>">
    <button type="submit">Eliminar</button>
</form>