 <!DOCTYPE html>
 <html lang="es">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incorpórate</title>
    <link rel="stylesheet" href="../assets/css/estilo_form.css">
 </head>
 <body>
      <div class="navbar">
         <img src="../assets/img/icons/logo_inc.png" alt="Logo">
         <button> <img src="../assets/img/icons/home_w.png" alt="Home"> Home </button>
         <button class="active"> <img src="../assets/img/icons/briefcase_b.png" alt="Oportunidades"> Oportunidades </button>
         <button> <img src="../assets/img/icons/users_w.png" alt="Feed"> Feed </button>      
      </div>

      <div class="content">

         <div class="label">
            <h1>¡Promueve el talento, [user]!</h1>
         </div>

<!---------------------INDICE----------------------------------------------------------------->
         <div class="linea_de_contenido">            
            <div id="general">
                <div class="circle"></div>
                <div class="category"><p>General</p></div>
            </div>
            <hr>
            <div id="detalles">
                <div class="circle"></div>
                <div class="category"><p>Detalles</p></div>
            </div>
            <hr>
            <div id="contacto">
                <div class="circle"></div>
                <div class="category"><p>Contacto</p></div>
            </div>
         </div>
<!---------------------INDICE----------------------------------------------------------------->

<!---------------------FORM----------------------------------------------------------------->
<?php
require_once "controllers/OpportunityController.php";

$controller = new OpportunityController();

$op = null;

if(isset($_GET['id'])){
    $op = $controller->show();
}

$controller->save();
?>


<form id="formOportunidad" method="POST" action="save_opportunity.php">

    <input type="hidden" name="id" value="<?= $op['id'] ?? '' ?>">

        <!-- ===================== -->
        <!-- GENERAL -->
        <!-- ===================== -->
        <div class="form-step" id="general_f">

            <input type="text" placeholder="Título de la oportunidad" name="title" value="<?= $op['title'] ?? '' ?>" required>

            <select id="tipo" name="type_opor" required>
                <option value="">Tipo de oportunidad</option>
                <option value="pasantia" <?= ($op['type_opor'] ?? '')=='pasantia'?'selected':'' ?>>Pasantía</option>
                <option value="trabajo" <?= ($op['type_opor'] ?? '')=='trabajo'?'selected':'' ?>>Trabajo</option>
            </select>

            <!-- PASANTIA -->
            <div id="campo_remuneracion" style="display:none;">
                <input type="number" placeholder="Remuneración" name="remuneration" value="<?= $op['remuneration'] ?? '' ?>">
            </div>

            <!-- TRABAJO -->
            <div id="campo_salario" style="display:none;">
                <input type="number" name="salary_min" value="<?= $op['salary_min'] ?? '' ?>">
                <input type="number" name="salary_max" value="<?= $op['salary_max'] ?? '' ?>">
            </div>

            <!-- VISIBILIDAD -->
            <div id="campo_visibilidad" style="display:none;">
                <label>
                    <input type="checkbox" name="salary_visible" <?= !empty($op['salary_visible'])?'checked':'' ?>>
                    Mostrar salario/remuneración
                </label>
            </div>

            <input type="number" placeholder="Número de vacantes" name="vacancies" value="<?= $op['vacancies'] ?? '' ?>" required>
            <input type="date" name="deadline" value="<?= $op['deadline'] ?? '' ?>" required>

        </div>

        <!-- ===================== -->
        <!-- DETALLES -->
        <!-- ===================== -->
        <div class="form-step" id="detalles_f" style="display:none;">

            <!-- Carreras -->
            <label>Carreras</label>
            <select name="careers[]" multiple>
                <!-- dinámico desde DB -->
                <option value="1">Ingeniería Sistemas</option>
                <option value="2">Administración</option>
            </select>

            <!-- Niveles -->
            <label>Nivel</label>
            <select id="nivel" name="level">
                <option value="">Seleccionar</option>
                <option value="estudiante">Estudiante</option>
                <option value="egresado">Egresado</option>
            </select>

            <!-- Año -->
            <div id="campo_anio" style="display:none;">
                <input type="number" placeholder="Año que cursa" name="year">
            </div>

            <textarea name="functions" placeholder="Funciones"><?= $op['functions'] ?? '' ?></textarea>        


            <!-- Skills -->
            <label>Skills</label>
            <select name="skills[]" multiple>
                <option value="1">PHP</option>
                <option value="2">MySQL</option>
            </select>

            <select name="modality">
                <option value="">Modalidad</option>
                <option value="presencial">Presencial</option>
                <option value="semi">Semi</option>
                <option value="remoto">Remoto</option>
            </select>

            <input type="text" name="schedule" placeholder="Horario">

            <label>Detalles del horario</label>
            <textarea name="schedule" rows="2" placeholder="Ej: Lunes a Viernes de 8:00 am a 5:00 pm. Sábados media jornada."></textarea>
        </div>

        <!-- ===================== -->
        <!-- CONTACTO -->
        <!-- ===================== -->
        <div class="form-step" id="contacto_f" style="display:none;">

            <input type="text" name="contact_name" value="Juan Pérez">
            <input type="text" name="contact_position" value="RRHH">
            <input type="email" name="contact_email" value="empresa@email.com">
            <input type="text" name="contact_phone" value="7777-7777">

        </div>

        <div class="form-navigation">
            <button type="button" class="btn_opor" id="prevBtn" style="display:none;">
                Volver
            </button>

            <button type="button" class="btn_opor" id="nextBtn">
                <span id="btnText">Next</span>
            </button>
        </div>

        <button class="btn_opor" id="btn_send"> Send </button> 

    </form>

<!---------------------FORM----------------------------------------------------------------->


            
    </div>


         

      </div>
      <script src="../assets/js/form_view.js"></script>
 </body>
 </html>