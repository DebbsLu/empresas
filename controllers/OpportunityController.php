<?php
require_once "../models/OpportunityModel.php";

class OpportunityController {

    private $model;

    public function __construct(){
        $this->model = new OpportunityModel();
    }

    // =========================
    // SAVE (CREATE + UPDATE)
    // =========================
    public function save(){

        $data = $_POST;

        // checkbox fix
        $data['salary_visible'] = isset($_POST['salary_visible']) ? 1 : 0;

        if(!empty($_POST['id'])){
            // UPDATE
            $id = $_POST['id'];
            $this->model->update($id, $data);
        }else{
            // CREATE
            $data['company_user_id'] = 1; // ejemplo
            $id = $this->model->create($data);
        }

        // REDIRECCIÓN AL DETAIL
        header("Location: oportunidades_detail_view.php?id=".$id);
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

        header("Location: oportunidades_list.php");
        exit();
    }
}