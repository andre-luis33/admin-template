<!DOCTYPE html>
<html lang="pt-br">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="preconnect" href="https://fonts.gstatic.com">
   <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
   
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css" integrity="sha512-/zs32ZEJh+/EO2N1b0PEdoA10JkdC3zJ8L5FTiQu82LR9S/rOQNfQN7U59U9BC12swNeRAz3HSzIL2vpp4fv3w==" crossorigin="anonymous" />

   <link data-theme="white"  rel="stylesheet">
   <link rel="stylesheet" href="assets/css/style.css">

   <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>   
   <title>Dashboard</title>
</head>
<body>
   <header class="header">
      <div class="logo" js-link="home" href="home">
         <i class="fab fa-php"></i>
         <span>Pretty<sup>H</sup>Pamazing</span>
      </div>

      <div class="btn-toggle">
         <i class="fas fa-bars" btn-toggle-sidebar></i>
      </div>

      <div class="right-box">
         <span id="user-email">andre.moura@insightsmachine.com.br</span>

         <div class="notifications-box">
            <i class="far fa-bell"></i>
            <span id="count-notification">5</span>
         </div>

         <i class="fas fa-cog" id="btn-config"></i>
         
      </div>
   </header>

   <div id="bg"></div>

   <main>
      <aside class="sidebar">
         <div class="btn-toggle" id="btn-toggle" btn-toggle-sidebar>
            <i class="fab fa-php"></i>
            <i class="fas fa-bars" id="btn-toggle-icon"></i>
         </div>
         <ul>
            <li>
               <a js-link="home" href="home">
                  <span>Home</span>
                  <i class="fas fa-home"></i>
               </a>
            </li>
            <li>
               <a js-link="relatorios" href="relatorios">
                  <span>Relatórios</span>
                  <i class="fas fa-calendar"></i>
               </a>
            </li>
            <li>
               <a js-link="clientes" href="clientes">
                  <span>Clientes</span>
                  <i class="far fa-id-card"></i>
               </a>
            </li>
            <li>
               <a id="navbar-dropdown">
                  <span>Cadastro</span>
                  <i class="fas fa-plus"></i>
               </a>
            </li>
               <li class="hidden-navbar-item" financeiro>
                  <a js-link="cadastro-usuarios" href="cadastro-usuarios">
                     <span>Cadastrar Usuários</span>
                     <i class="fas fa-users"></i>
                  </a>
               </li>
         </ul>
      </aside>

      <aside class="config-bar">
         <span id="close-config-bar">
            <i class="fas fa-times"></i>
         </span>
         <header>
            <h4>Suas Preferências</h4>
         </header>

         <ul>
            <li class="switch-li">
               <button id="btn-theme" class="switch-btn" clicked="false"></button>
               <span>Dark Mode</span>
            </li>
         </ul>

         <header>
            <h4>Atalhos do teclado</h4>
         </header>

         <ul>
            <li class="shortcuts">
               <code>Ctrl + B</code>: Abre e fecha o menu lateral
            </li>
            <li class="shortcuts">
               <code>Esc</code>: Fecha todos os menus, modais e popups
            </li>
            <li class="shortcuts">
               <code>Alt + ↑ ↓</code>: Navega entre as páginas, de acordo com a ordem do menu
            </li>
         </ul>
      </aside>
      <div class="content-loader">
         <object data="assets/img/loading.svg" type="image/svg+xml"></object>
      </div>
      <div class="content">
         <?php require $view ?>
      </div>
   </main>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.min.js" integrity="sha512-SuxO9djzjML6b9w9/I07IWnLnQhgyYVSpHZx0JV97kGBfTIsUYlWflyuW4ypnvhBrslz1yJ3R+S14fdCWmSmSA==" crossorigin="anonymous"></script>   
   <script src="assets/js/global.js"></script>
   <script src="assets/js/app.js"></script>
</body>
</html>