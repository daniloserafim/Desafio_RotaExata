<?php
$produtos = array();
$produtos[0]['produtos']['nome'] = "Produto 1";
$produtos[0]['produtos']['descricao'] = "Descrição do produto 1";
$produtos[0]['produtos']['valor'] = 50;
$produtos[0]['produtos']['opcionais'][] = "Opcional 1";
$produtos[0]['produtos']['opcionais'][] = "Opcional 2";
$produtos[0]['produtos']['opcionais'][] = "Opcional 3";
$produtos[1]['produtos']['nome'] = "Produto 2";
$produtos[1]['produtos']['descricao'] = "Descrição do produto 2";
$produtos[1]['produtos']['valor'] = 75;
$produtos[1]['produtos']['opcionais'][] = "Opcional 1";
$produtos[1]['produtos']['opcionais'][] = "Opcional 2";
$produtos[1]['produtos']['opcionais'][] = "Opcional 3";
$produtos[1]['produtos']['opcionais'][] = "Opcional 4";
$produtos[2]['produtos']['nome'] = "Produto 3";
$produtos[2]['produtos']['descricao'] = "Descrição do produto 3";
$produtos[2]['produtos']['valor'] = 100;
$produtos[2]['produtos']['opcionais'][] = "Opcional 1";
$produtos[2]['produtos']['opcionais'][] = "Opcional 2";
?>


<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <h1>
        Lista
    </h1>
    <table>

    <thead>
        <th>Nome</th>
        <th>Descrição</th>
        <th>Valor</th>
        <th>Opcionais</th>
    </thead>

    <tbody>
        <?php
        foreach ($produtos as $produto) {
            echo "<tr>";
            echo "<td>".$produto['produtos']['nome']."</td>";
            echo "<td>".$produto['produtos']['descricao']."</td>";
            echo "<td>".$produto['produtos']['valor']."</td>";
            echo "<td>";
                foreach ($produto['produtos']['opcionais'] as $opcional){
                    echo $opcional."<br>";
                }
            echo"</td>";
            echo "</tr>";
        }
        ?>
    </tbody>

    </table>
    <br>
    <br>
    <h1>
        Lista Invertida
    </h1>
    <table>

    <thead>
        <th>Nome</th>
        <th>Descrição</th>
        <th>Valor</th>
        <th>Opcionais</th>
    </thead>

    <tbody>
        <?php

        rsort($produtos);

        foreach ($produtos as $produto) {
            echo "<tr>";
            echo "<td>".$produto['produtos']['nome']."</td>";
            echo "<td>".$produto['produtos']['descricao']."</td>";
            echo "<td>".$produto['produtos']['valor']."</td>";
            echo "<td>";
                foreach ($produto['produtos']['opcionais'] as $opcional){
                    echo $opcional."<br>";
                }
            echo"</td>";
            echo "</tr>";
        }
        ?>
    </tbody>

    </table>
</body>
</html>