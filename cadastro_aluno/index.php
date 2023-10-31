<?php
  include('banco/connection.php');
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="icon" type="image/png" href="assets/Logo.png" sizes="16x16">
    <link rel="stylesheet" href="cadaluno.css">
</head>
<body>
    <header class="cabeca">
        <div>
            <h1> Coding Generations </h1>
            <img class="logo" src="assets/Logo.png" alt="Logo">
        </div>
    </header>
    
    <main>
        <div id="FormularioConteiner">
            <div id="titulo">
                Cadastro de Aluno 
            </div>
            <div id="formulario">
                <form action="" id="form">
                    <div id="Nome">
                        <div class="formImput">
                            <label for="nome"> Nome </label>
                            <input type="text" name="nome" id="nome" value="">
                            
                            <span>ERRO</span>
                        </div>
                    </div>

                    <div id="email">
                        <div class="formImput">
                            <label for="email"> Email </label>
                            <input type="text" name="email" id="email" value="">
                            <span>ERRO</span>
                        </div>
                    </div>

                    <div id="cpf">
                        <div class="formImput">
                            <label for="cpf"> CPF </label>
                            <input type="text" name="cpf" id="cpf" value="">
                            <span>ERRO</span>
                        </div>
                    </div>
                    

                    <div id="dataNasc">
                        <div class="formImput">
                            <label for="dataNasc"> Data de Nascimento </label>
                            <input type="date" name="data" id="data" value="">
                            <span>ERRO</span>
                        </div>
                    </div>

                    <div id="nomeResp">
                        <div class="formImput">
                            <label for="nomeResp"> Nome Responsavel </label>
                            <input type="text" name="nomeResp" id="nomeResp" value="">
                            <span>ERRO</span>
                        </div>
                    </div>

                    <div id="docResp">
                        <div class="formImput">
                            <label for="docResp"> Documento Responsavel </label>
                            <input type="text" name="docResp" id="docResp" value="">
                            <span>ERRO</span>
                        </div>
                    </div>

                    <div id="senha">
                        <div class="formImput">
                            <label for="senha"> Senha </label>
                            <input type="password" name="senha" id="senha" value="">
                            <span>ERRO</span>
                        </div>
                    </div>

                    <div id="confirmSenha">
                        <div class="formImput">
                            <label for="confirmSenha"> Confirmar Senha </label>
                            <input type="password" name="confirmSenha" id="confirmSenha" value="">
                            <span>ERRO</span>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>

    </main>


    <footer>
        <div>
         © 2023 Coding Genereations
        </div>
    </footer>
</body>
</html>