<?php
require_once "../controllers/OpportunityController.php";

$controller = new OpportunityController();
$op = $controller->show();


?>

<h1><?= $op['title'] ?></h1>

<p><strong>Tipo:</strong> <?= $op['type_opor'] ?></p>

<?php if($op['salary_visible']): ?>
    <p><strong>Salario:</strong>
        <?= $op['salary_min'] ?> - <?= $op['salary_max'] ?>
        <?= $op['remuneration'] ?>
    </p>
<?php endif; ?>

<p><strong>Vacantes:</strong> <?= $op['vacancies'] ?></p>
<p><strong>Fecha límite:</strong> <?= $op['deadline'] ?></p>
<p><strong>Modalidad:</strong> <?= $op['modality'] ?></p>
<p><strong>Horario:</strong> <?= $op['schedule'] ?></p>

<h3>Funciones</h3>
<p><?= $op['functions'] ?></p>

<h3>Carreras</h3>
<ul>
<?php foreach($op['careers'] as $c): ?>
    <li><?= $c ?></li>
<?php endforeach; ?>
</ul>

<h3>Skills</h3>
<ul>
<?php foreach($op['skills'] as $s): ?>
    <li><?= $s ?></li>
<?php endforeach; ?>
</ul>

<h3>Nivel</h3>
<p>
<?= $op['level_data']['level'] ?? 'N/A' ?>
<?php if(!empty($op['level_data']['year'])): ?>
    - Año <?= $op['level_data']['year'] ?>
<?php endif; ?>
</p>

<h3>Contacto</h3>
<p><?= $op['contact_name'] ?></p>
<p><?= $op['contact_position'] ?></p>
<p><?= $op['contact_email'] ?></p>
<p><?= $op['contact_phone'] ?></p>

<!-- EDIT -->
<a href="../view/oportunidades_form_view.php?id=<?= $op['id'] ?>">
    <button>Editar</button>
</a>

<!-- DELETE -->
<form method="POST" action="../controllers/OpportunityController.php?action=delete" onsubmit="return confirm('¿Eliminar?');">
    <input type="hidden" name="id" value="<?= $op['id'] ?>">
    <button type="submit">Eliminar</button>
</form>