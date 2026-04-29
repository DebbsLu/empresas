 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incorpórate</title>
    <link rel="stylesheet" href="../assets/css/estilo.css">
 </head>
 <body>
      <div class="navbar">
         <img src="../assets/img/icons/logo_inc.png" alt="Logo">
         <a href="home_view.php"> <button> <img src="../assets/img/icons/home_w.png" alt="Home"> Home </button></a>
         <a href="oportunidades_view.php"><button class="active"> <img src="../assets/img/icons/briefcase_b.png" alt="Oportunidades"> Oportunidades </button></a>
         <a href="feed_view.php"><button> <img src="../assets/img/icons/users_w.png" alt="Feed"> Feed </button></a>      
      </div>
      <div class="content">
         <div class="label">
            <h1>¡Promueve el talento, [user]!</h1>
         </div>
         <a href="oportunidades_form_view.php"><button class="btn_opor"> <img src="../assets/img/icons/plus-small_w.png" alt="Crear oportunidad"> Crear oportunidad </button> </a>      
         <div class="cards_background">
            <!--Titulo y filtros-->
            <div class="header_oportunidades">
               <h2>Oportunidades publicadas</h2>
               <div class="search_background">   
                  <button class="filter"> <img src="../assets/img/icons/settings-sliders_g.png" alt="filtrar"></button> 
               </div>
            </div>
            <!--CARD-->
            <div class="card">
               <div class="category">
                  <p>Pasantia</p>
               </div>
               <h3>Nombre de la oportunidad</h3>
               <div class="info_1">
                  <img src="../assets/img/icons/user_b.png">
                  <p>Vacantes: </p>
                  <p>4/5</p>
               </div>
               <div class="info_1">
                  <img src="../assets/img/icons/users_b.png">
                  <p>Aplicaciones: </p>
                  <p>12</p>
               </div>
               <div class="card_btn">
                  <button class="btn_card"> <img src="../assets/img/icons/arrow-right_w.png"></button> 
                  <button class="btn_card"> <img src="../assets/img/icons/handshake_w.png"></button> 
                  <button class="btn_card"> <img src="../assets/img/icons/trash_w.png"></button> 
               </div>
            </div>
         </div>
      </div>
 </body>
 </html>