<?php

    // Obtem os números lá do php do game para mostrar aqui nessa tela.
    $total_questions = $_SESSION['game']['total_questions'];
    $correct_answers = $_SESSION['game']['correct_answers'];
    $incorrect_answers = $_SESSION['game']['incorrect_answers'];

?>

<!-- Início do código HTML para exibir os resultados finais do jogo -->
<div class="result-container">   
   
    <h1 class="margin-h1">Quiz das Músicas</h1>
    <h2></h2>

    <h3>Total de questões:<strong class="result-value"><?= $total_questions ?></strong></h3>

    <h3>Respostas corretas: <strong class="result-value"><?= $correct_answers ?></strong></h3>

    <h3>Respostas erradas: <strong class="result-value"><?= $incorrect_answers ?></strong></h3>

    <div>
        <a href="index.php?route=start" class="btn btn-secundary p-3 w-50"><img width="20" height="20" src="https://img.icons8.com/ios-glyphs/30/FFFFFF/four-four.png" alt="four-four" class="btnfone fone2"/> Jogar novamente <img width="20" height="20" src="https://img.icons8.com/ios-glyphs/30/FFFFFF/four-four.png" alt="four-four" class="btnfone fone2"/></a>
    </div>

</div>


