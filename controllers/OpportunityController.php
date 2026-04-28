<?php
require_once '../models/OpportunityModel.php';

$model = new OpportunityModel();

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    $op = $model->getOpportunity($id);
    $selectedSkills = $model->getOpportunitySkillIds($id);
    $selectedCareers = $model->getOpportunityCareerIds($id);
}

// =========================
// GUARDAR
// =========================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = [
        'company_user_id' => 1,
        'title' => $_POST['title'],
        'type_opor' => $_POST['type_opor'],
        'modality' => $_POST['modality'],
        'vacancies' => $_POST['vacancies'],
        'deadline' => $_POST['deadline']
    ];

    $skills = $_POST['skills'] ?? [];
    $careers = $_POST['careers'] ?? [];

    // VALIDACIÓN BÁSICA
    if (empty($data['title']) || empty($skills) || empty($careers)) {
        die("Datos inválidos");
    }

    $id = $model->insertOpportunity($data, $skills, $careers);

    header("Location: ../views/oportunidades_detail_view.php?id=$id");
    exit;
}

// =========================
// ELIMINAR
// =========================
if (isset($_GET['delete'])) {
    $model->deleteOpportunity($_GET['delete']);
    header("Location: listado.php");
}