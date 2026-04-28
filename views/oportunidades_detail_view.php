<?php
require_once '../models/OpportunityModel.php';

$model = new OpportunityModel();
$id = $_GET['id'];

$op = $model->getOpportunity($id);
$skills = $model->getOpportunitySkills($id);
$careers = $model->getOpportunityCareers($id);
?>

<h1><?= $op['title'] ?></h1>

<h3>Skills</h3>
<?php while($s = $skills->fetch_assoc()): ?>
    <p><?= $s['name'] ?></p>
<?php endwhile; ?>

<h3>Carreras</h3>
<?php while($c = $careers->fetch_assoc()): ?>
    <p><?= $c['name'] ?></p>
<?php endwhile; ?>

<a href="oportunidades_form_view.php?id=<?= $id ?>">Editar</a>
<a href="../controllers/OpportunityController.php?delete=<?= $id ?>">Eliminar</a>