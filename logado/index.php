<?php
session_start();

if(isset($_SESSION['user'])){
    if($_SESSION['user']=='admin'){
        header("location: ../logado/coordenador/");
    }
}else{header("location: ../login/");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" type="image/png" href="../Imagens/Logo CG.png">
    <title>Coding Generations</title>
</head>
  <body>
  <header>
      <div class="home">
          <button class="hamburger-button">&#9776;Menu</button>
          <div style="width: 30%">
              <img class= logo src="../Imagens/Logo CG.png" alt="Logo da Coding Generations">
              <h1>Coding Generations</h1>
          </div>
          <a href="sair.php">
            <button>Sair</button>
          </a>
                
      </div>
  </header>
  <nav class="sidebar">
      <ul>
          <li><a href="./index3-1.html">Faltas</a></li>
          <li><a href="./index3-1.html">Notas</a></li>
          <li><a href="./index3-1.html">Avisos</a></li>
          <li><a href="./index3-1.html">Metas</a></li>
          <li><a href="./perfil/index.php">Perfil</a></li>
      </ul>
  </nav>
  <H2>Seja Bem-vindo(a) a Sala da Coding Generations</H2>

<div class="card-container">
  <div class="card">
    <a href="https://www.youtube.com/watch?v=LqXqBgIUbJg">
      <img src="../Imagens/front.jpg" alt="Imagens de front-end">
      <p>Aulas de Font-End</p>
    </a>
  </div>
  <div class="card">
    <a href="https://www.youtube.com/watch?v=Qjk-cSW-jk4">
      <img src="../Imagens/lingprog.jpg" alt="Imagens de back-end">
      <p>Aulas de Back-End</p>
    </a>
  </div>
  <div class="card">
    <a href="https://www.youtube.com/watch?v=E4F74yt9Now">
      <img src="../Imagens/mysql.png" alt="Imagem do mysql">
      <p>Aulas de Banco de Dados</p>
    </a>
  </div>
  <div class="card">
    <a href="https://www.youtube.com/watch?v=X-XfVvd41O8">
      <img src="../Imagens/mobile.jpg" alt="Imagem de mobile">
      <p>Aulas de Desenvolvimento mobile</p>
    </a>
  </div>
</div><br><br>

    <div class="aba-aulas">
      <h2>Trabalhos a serem enviados</h2>
      <div class="lista-tarefas">
          <div class="tarefa">
              <p>Entrega final de banco de dados</p>
          </div>
          <div class="tarefa">
            <p>Entrega do Prototipo WEB</p>
        </div>
        <div class="tarefa">
          <p>Entrega do chat em Python</p>
      </div>
      <div class="tarefa">
        <p>Entrega do site ultilizando o PHP</p>
    </div>
    <div class="tarefa">
      <p>Entrega da calculadora em JS</p>
  </div>
  
      </div>
  </div>
</div><br><br>

  <footer>
    <span class="rodape">©Todos os direitos reservados a Coding Generations</span>
</footer>
<script src="script.js"></script>
  </body>
  </html>