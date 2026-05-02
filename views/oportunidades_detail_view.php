<?php
require_once "../controllers/OpportunityController.php";
require_once "../controllers/ApplicationController.php";

$controller = new OpportunityController();
$op = $controller->show();

$appController = new ApplicationController();
$applications = $appController->getByOpportunity($op['id']);

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
<a href="../views/oportunidades_form_view.php?id=<?= $op['id'] ?>">
    <button>Editar</button>
</a>

<!-- DELETE -->
<form method="POST" action="../controllers/OpportunityController.php?action=delete" onsubmit="return confirm('¿Eliminar?');">
    <input type="hidden" name="id" value="<?= $op['id'] ?>">
    <button type="submit">Eliminar</button>
</form>

<div id="applications_section"> 

    <h3>Cvs que se han postulado a esta oportunidad</h3>

    <?php if(!empty($applications)): ?>
        
        <?php foreach($applications as $app): ?>
            
            <div class="card">

                <div class="category">
                    <p><?= $app['level'] ?></p>
                </div>

                <h3><?= $app['full_name'] ?></h3>

                <?php if(!empty($app['photo'])): ?>
                    
                    <img src="../../alumnos/assets/img/uploads/<?= $app['photo'] ?>" width="100">
                <?php endif; ?>

                <div class="info_1">
                    <p><strong>Año:</strong> <?= $app['year'] ?? 'N/A' ?></p>
                </div>

                <div class="info_1">
                    <p><strong>Estado:</strong> <?= $app['status'] ?></p>
                </div>

                <div class="info_1">
                    <p><strong>Aplicado:</strong> <?= $app['applied_at'] ?></p>
                </div>

                <!-- 🔥 OPCIONAL: ver CV -->
                <a href="cv_detail_view.php?id=<?= $app['cv_id'] ?>">
                    <button>Ver CV</button>
                </a>

                <form method="POST" action="../controllers/ApplicationController.php?action=updateStatus">
                    
                    <input type="hidden" name="application_id" value="<?= $app['application_id'] ?>">
                    <input type="hidden" name="opportunity_id" value="<?= $_GET['id'] ?>">

                    <select name="status">
                        <option value="aplicado" <?= $app['status']=='aplicado'?'selected':'' ?>>Aplicado</option>
                        <option value="revision" <?= $app['status']=='revision'?'selected':'' ?>>Revisión</option>
                        <option value="rechazado" <?= $app['status']=='rechazado'?'selected':'' ?>>Rechazado</option>
                        <option value="aceptado" <?= $app['status']=='aceptado'?'selected':'' ?>>Aceptado</option>
                    </select>

                    <button type="submit">Actualizar</button>

                </form>

            </div>

        <?php endforeach; ?>

    <?php else: ?>
        <p>Nadie ha aplicado a esta oportunidad</p>
    <?php endif; ?>

</div>
