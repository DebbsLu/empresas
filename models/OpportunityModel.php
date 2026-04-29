<?php
require_once "../config/database.php";

class OpportunityModel {
    private $conn;

    public function __construct(){
        $db = new Database();
        $this->conn = $db->connect();
    }

    // =========================
    // INSERT
    // =========================
    public function create($data){
        $sql = "INSERT INTO opportunities 
        (company_user_id, title, type_opor, salary_min, salary_max, remuneration, salary_visible, vacancies, deadline, functions, modality, schedule)
        VALUES (:company_user_id, :title, :type_opor, :salary_min, :salary_max, :remuneration, :salary_visible, :vacancies, :deadline, :functions, :modality, :schedule)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);

        $opportunity_id = $this->conn->lastInsertId();

        $this->insertRelations($opportunity_id, $data);

        return $opportunity_id;
    }

    // =========================
    // UPDATE
    // =========================
    public function update($id, $data){
        $sql = "UPDATE opportunities SET
            title=:title,
            type_opor=:type_opor,
            salary_min=:salary_min,
            salary_max=:salary_max,
            remuneration=:remuneration,
            salary_visible=:salary_visible,
            vacancies=:vacancies,
            deadline=:deadline,
            functions=:functions,
            modality=:modality,
            schedule=:schedule
        WHERE id=:id";

        $data['id'] = $id;

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);

        // limpiar relaciones
        $this->deleteRelations($id);
        $this->insertRelations($id, $data);
    }

    // =========================
    // GET ONE
    // =========================
    public function getById($id){
        $stmt = $this->conn->prepare("SELECT * FROM opportunities WHERE id=?");
        $stmt->execute([$id]);
        $op = $stmt->fetch(PDO::FETCH_ASSOC);

        // careers
        $stmt = $this->conn->prepare("SELECT career_id FROM opportunity_careers WHERE opportunity_id=?");
        $stmt->execute([$id]);
        $op['careers'] = $stmt->fetchAll(PDO::FETCH_COLUMN);

        // skills
        $stmt = $this->conn->prepare("SELECT skill_id FROM opportunity_skills WHERE opportunity_id=?");
        $stmt->execute([$id]);
        $op['skills'] = $stmt->fetchAll(PDO::FETCH_COLUMN);

        // level
        $stmt = $this->conn->prepare("SELECT * FROM opportunity_levels WHERE opportunity_id=?");
        $stmt->execute([$id]);
        $op['level_data'] = $stmt->fetch(PDO::FETCH_ASSOC);

        return $op;
    }

    // =========================
    // DELETE
    // =========================
    public function delete($id){
        $stmt = $this->conn->prepare("DELETE FROM opportunities WHERE id=?");
        return $stmt->execute([$id]);
    }

    // =========================
    // RELACIONES
    // =========================
    private function insertRelations($id, $data){

        // careers
        if(!empty($data['careers'])){
            foreach($data['careers'] as $c){
                $this->conn->prepare("INSERT INTO opportunity_careers VALUES (?,?)")
                    ->execute([$id, $c]);
            }
        }

        // skills
        if(!empty($data['skills'])){
            foreach($data['skills'] as $s){
                $this->conn->prepare("INSERT INTO opportunity_skills VALUES (?,?)")
                    ->execute([$id, $s]);
            }
        }

        // level
        if(!empty($data['level'])){
            $this->conn->prepare("INSERT INTO opportunity_levels (opportunity_id, level, year) VALUES (?,?,?)")
                ->execute([$id, $data['level'], $data['year'] ?? null]);
        }
    }

    private function deleteRelations($id){
        $this->conn->prepare("DELETE FROM opportunity_careers WHERE opportunity_id=?")->execute([$id]);
        $this->conn->prepare("DELETE FROM opportunity_skills WHERE opportunity_id=?")->execute([$id]);
        $this->conn->prepare("DELETE FROM opportunity_levels WHERE opportunity_id=?")->execute([$id]);
    }
}