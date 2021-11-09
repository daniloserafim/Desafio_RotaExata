<?php
session_start();
?>
<!DOCTYPE html>
<html>
    
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RotaExata - Sistema de Cadastro</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="css/bulma.min.css" />
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <script src="lib/jquery.js"></script>
</head>

<body>
    <section class="hero is-success is-fullheight">
        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">
                    <h3 class="title has-text-grey">Sistema de Cadastro</h3>
                    <h3 class="title has-text-grey"><a href="https://www.rotaexata.com.br/" target="_blank">RotaExata</a></h3>
                    <?php
                        if(isset($_SESSION['status_cadastro'])):
                    ?>
                    <div class="notification is-success">
                      <p>Cadastro efetuado!</p>
                      <p>Faça login informando o seu usuário e senha <a href="login.php">aqui</a></p>
                    </div>
                    <?php
                        endif;
                        unset($_SESSION['status_cadastro']);
                    ?>
                    <?php
                        if(isset($_SESSION['usuario_existe'])):
                    ?>
                    <div class="notification is-info">
                        <p>O usuário escolhido já existe. Informe outro e tente novamente.</p>
                    </div>
                    <?php
                        endif;
                        unset($_SESSION['usuario_existe']);
                    ?>
                    <div id="empty-field-notification" class="notification is-info" hidden>
                        <p>Complete todos os campos.</p>
                    </div>
                    <div class="box">
                        <div role="form" id="form">
                            <div class="field">
                                <div class="control">
                                    <input id="nome" name="nome" type="text" class="input is-large" placeholder="Nome" autofocus>
                                </div>
                            </div>
                            <div class="field">
                                <div class="control">
                                    <input id="usuario" name="usuario" type="text" class="input is-large" placeholder="Usuário">
                                </div>
                            </div>
                            <div class="field">
                                <div class="control">
                                    <input id="senha" name="senha" class="input is-large" type="password" placeholder="Senha">
                                </div>
                            </div>
                            <div class="field">
                                <div class="control">
                                    <textarea id="biografia" name="biografia" class="textarea is-large" placeholder="Biografia"></textarea>
                                </div>
                            </div>
                            <div class="select is-large">
                                <select id="genero">
                                    <option selected disabled hidden value="">Gênero</option>
                                    <option value="masculino">Masculino</option>
                                    <option value="feminino">Feminino</option>
                                    <option value="outro">Outro</option>
                                </select>
                            </div>
                            <div class="control">
                                <label class="radio">
                                    <input value="1" type="radio" name="maioridade">
                                    Sou maior de idade (+18)
                                </label>
                                <label class="radio">
                                    <input value="0" type="radio" name="maioridade" checked>
                                    Sou menor de idade (-18)
                                </label>
                            </div>
                            <button onclick="openModal()" class="button is-block is-link is-large is-fullwidth">Cadastrar</button>
                            <div class="modal" id="modal-confirm">
                                <div class="modal-background"></div>
                                <div class="modal-card">
                                    <header class="modal-card-head">
                                    <p class="modal-card-title">Confirmação de Dados</p>
                                    <button onclick="closeModal()" class="delete" aria-label="close"></button>
                                    </header>
                                    <section class="modal-card-body">
                                        <div id="modalUser">
                                        </div>
                                    </section>
                                    <footer class="modal-card-foot">
                                    <button onclick="cadastrar()" class="button is-success">Prosseguir</button>
                                    <button onclick="closeModal()" class="button">Cancelar</button>
                                    </footer>
                                </div>
                            </div>
                            <div class="field">
                                <a href= "login.php">Já sou cadastrado</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>

<script>
    function openModal() {
        const modalConfirm = document.getElementById("modal-confirm");
        modalConfirm.classList.add("is-active");

        const data = pegarDados();

        let maioridadeExtenso;

        if(data.maioridade=="0"){
            maioridadeExtenso = "menor de idade (-18)";
        } else {
            maioridadeExtenso = "maior de idade (+18)"
        }

        document.getElementById("modalUser").innerHTML=`Nome: ${data.nome} <br> Usuário: ${data.usuario} <br> Biografia: ${data.biografia} <br> Gênero: ${data.genero} <br> Maioridade: ${maioridadeExtenso}`;
    }

    function closeModal() {
        let modalConfirm = document.getElementById("modal-confirm");
        modalConfirm.classList.remove("is-active");
    }

    function cadastrar() {
        const data = pegarDados();

        if(!data.nome || !data.usuario || !data.senha || !data.biografia || data.genero=="") {
            document.getElementById("empty-field-notification").removeAttribute("hidden");
        } else {
            $.ajax({
            method: "post",
            url: "cadastrar.php",
            data,
            success: function(data){
                   document.location.reload();
            }
            });
        }

        closeModal();
    }

    function pegarDados(){
        const data = {
            nome: document.getElementById("nome").value,
            usuario: document.getElementById("usuario").value,
            senha: document.getElementById("senha").value,
            biografia: document.getElementById("biografia").value,
            genero: document.getElementById("genero").value,
            maioridade: document.querySelector('input[name = "maioridade"]:checked').value,
        }
        return data;
    }
</script>