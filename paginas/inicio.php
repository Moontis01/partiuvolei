<?php
include "../sys/conexao.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/root.css">
    <link rel="stylesheet" href="../style/paginas.css">
    <link rel="shortcut icon" href="../img/prefeitura.png" type="image/x-icon">
    <script src="../js/func.js"></script>
</head>
<body>
    <header>
        <h1 class='title-header'>Inicio</h1>
    </header>
    <div class='infos'>
        <h1 class='title-header'>Objetivo do projeto</h1>
        <p>
            Projeto desportivo que mira, além da inclusão social, o rendimento desportivo individual e coletivo. Em sua essência, o PROJETO POMERODE VOLEIBOL 2024, visa  oportunizar às crianças e jovens do município de Pomerode o contato com a modalidade VOLEIBOL de forma gratuita e em um ambiente saudável e integrado com a sociedade.
        </p>
    </div>

    <div class='infos'>
        <h1 class='title-header'>Patrocinadores</h1>

        <div class='patrocinadores'>
            <img src='https://www.cieesc.org.br/site/wp-content/uploads/2018/10/pomerode.jpg.webp'/>
            <img src='https://cursostecnicostocantins.com.br/wp-content/uploads/2019/11/Logotipo-SENAI-Slogan.png'/>
            <img src='https://upload.wikimedia.org/wikipedia/commons/thumb/9/92/Logo_Banrisul.svg/2560px-Logo_Banrisul.svg.png'/>
            <img src='https://logosmarcas.net/wp-content/uploads/2020/09/Google-Logo.png'/>
            <img src='https://logosmarcas.net/wp-content/uploads/2020/04/Facebook-Logo.png'/>
        </div>
    </div>

    <?php if(requireLevel($__TYPE__, 3)){ ?>
    <div class='extra'>
        <div class='header-in'>
            <button onclick='openAdd(addProfessor)' class='funcBt'>+ Adicionar patrocinador</button>
        </div>
    </div>
    <div id='details'>
    </div>
    <div id='addNew'>
        <div id='addProfessor' class='add-container'>
            <h1 class='title-add'>Novo patrocinador</h1>

            <div class='inps-add'>
                <div class='inp-add-out'>
                    <h3>Nome</h3>
                    <input id='nomeAdd' type='text' placeholder='Marca patrocinadora'/>
                </div>
                <div class='inp-add-out'>
                    <h3>Imagem</h3>
                    <input id='imagemAdd' type='file' placeholder='Nova imagem' accept="image/png, image/jpeg"/>
                </div>
                
            </div>
            <div class='out-bt-sv'>
                <button class='btn-close' onclick='closeAdd()'>Fechar</button>
                <button onclick='addNewData("", {

                })' class='btn-add'>Salvar</button>
            </div>
        </div>
    </div>

    <?php } ?>

    <div class='infos'>
        <h1 class='title-header'>Contato</h1>
        <p>
            <span>Prof. Luciano Menegaz</span>
            <span>F. (48) 99806 0667</span>
            <span>lucianor.menegaz@gmail.com</span>
        </p>
    </div>

    <div class='infos'>
        <h1 class='title-header'>Endereço</h1>
        <p>
            <span>Ginasio Ralf Knaesel</span>
            <span>Secretaria de Eventos, Esporte e Lazer</span>
            <span>Endereço: Av. 21 de Janeiro - 2700</span>
            <span>Pomerode - SC</span>
            <span>Telefone(s): (47) 3387-2612</span>
            <span>E-mail: seel@pomerode.sc.gov.br</span>
        </p>
    </div>

    

    
</body>
</html>