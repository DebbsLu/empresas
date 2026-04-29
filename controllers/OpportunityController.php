<?php

require_once "../models/OpportunityModel.php";
require_once "../models/login_model.php";

class OpportunityController {

    private $model;
    private $loginModel;

    public function __construct(){
        $this->model = new OpportunityModel();
        $this->loginModel = new LoginModel(); //
    }
    
    // =========================
    // SAVE (CREATE + UPDATE)
    // =========================
    public function save(){

        $data = $_POST;

        // checkbox fix
        $data['salary_visible'] = isset($_POST['salary_visible']) ? 1 : 0;

         $data['company_user_id'] = $_SESSION['company_user_id'];

        if(!empty($_POST['id'])){
            // UPDATE
            $id = $_POST['id'];
            $this->model->update($id, $data);
        }else{
            // CREATE
            //$data['company_user_id'] = 1; // ejemplo  QUÉ ES ESTO BRO Y POR QUÉ MADRES 1 

            $id = $this->model->create($data);
        }

        // REDIRECCIÓN AL DETAIL
        header("Location: ../views/oportunidades_detail_view.php?id=".$id);
        exit();
    }

    // =========================
    // GET DETAIL
    // =========================
    public function show(){
        $id = $_GET['id'];
        return $this->model->getById($id);
    }

    // =========================
    // DELETE
    // =========================
    public function delete(){
        $id = $_GET['id'];
        $this->model->delete($id);

        header("Location: ../views/oportunidades_view.php");
        exit();
    }

        // =========================
    // DATA PARA FORM
    // =========================
    public function getFormData(){

        //session_start();

        $data = [];

        // 🔹 VALIDACIÓN DE SESIÓN
        if(!isset($_SESSION['user_id'])){
            header("Location: login_view.php");
            exit();
        }

        // 🔹 obtener company_user desde login_model
        $companyUser = $this->loginModel->getByUserId($_SESSION['user_id']);

        $data['company'] = $companyUser;

        // 🔹 listas dinámicas
        $data['careers'] = $this->model->getCareers();
        $data['skills'] = $this->model->getSkills();

        return $data;
    }
    
}


// =========================
// ROUTER SIMPLE
// =========================
if(isset($_GET['action'])){

    $controller = new OpportunityController();

    switch($_GET['action']){

        case "save":
            $controller->save();
            break;

        case "delete":
            $controller->delete();
            break;

        default:
            echo "Acción no válida";
            break;
    }
}