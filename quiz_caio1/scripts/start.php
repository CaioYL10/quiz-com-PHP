<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Define o número total de questões e se não foi selecionado o valor usado vai ser 10.
        $total_questions = intval($_POST['text_total_questions']) ?? 10;

        // Chama a função do prepare game para ela se adequar ao total de questões.
        prepare_game($total_questions);

        // Redireciona para a página index para que o jogo possa começar.
        header('Location: index.php?route=game');
        exit; // Interrompe a execução para evitar que o código abaixo seja executado.
    }

        function prepare_game($total_questions) {
            // Acessa o banco de dados com as musicas
            global $capitals;

            // Inicializa um array vazio para armazenar os IDs das capitais selecionadas de forma aleatória.
            $ids = [];
            // Diz para o sistema continuar até atingir o número selecionado de questões.
            while(count($ids) < $total_questions) {
                // Gera um ID aleatório dentro dos possíveis nas capitais.
                $id = rand(0, count($capitals) - 1);
                // Verifica se o ID já foi selecionado. Se não, adiciona ao array $ids.
                if(!in_array($id, $ids)) {
                    $ids[] = $id;
                }
            }
            
            // inicia o array questions para armazenar as questões do jogo.
            $questions = [];
            // Para cada ID selecionado, cria uma questao.
            foreach($ids as $id) {
                // Inicializa um array para armazenar as respostas possíveis.
                $answers = [];

                // Faz a primeira resposta sempre ser o ID correto (Capital correspondente ao país).
                $answers[] = $id;

                // Completa com a primeira o resto do formulário mas com as questões erradas
                while (count($answers) < 3) {
                    $tmp = rand(0, count($capitals) - 1);
                    // Verifica, para evitar erros, se as respostas geradas não foram selecionadas, senão, adiciona a lista de respostas.
                    if(!in_array($tmp, $answers)) {
                        $answers[] = $tmp;
                    }
                }

                // Embaralha as alternativas para que a resposta correta fique em um lugar aleatório.
                shuffle($answers);

                // Add a questão ao array $questions.
                // Cada questão contém o nome do país, o ID da resposta correta e as 3 alternativas.
                $questions[] = [
                    'question' => $capitals[$id][0], // O nome do país.
                    'correct_answer' => $id, // O ID da resposta correta (capital).
                    'answers' => $answers // As 3 respostas possíveis (Uma correta, duas erradas).
                ];
            }

            $_SESSION['questions'] = $questions;

            $_SESSION['game'] = [
                'total_questions' => $total_questions,
                'current_question' => 0,
                'correct_answers' => 0,
                'incorrect_answers' => 0,
            ];
        }

?>

<!-- Início do código HTML para exibir o formulário na página de início -->
<div class="container posicao">
    <img src="https://c.pxhere.com/photos/a9/b8/audience_blur_concert_crowd_dark_entertainment_event_hands-1557783.jpg!d" srcset="https://c.pxhere.com/photos/a9/b8/audience_blur_concert_crowd_dark_entertainment_event_hands-1557783.jpg!d" alt="" class="imagem tras">

    <div class="row frente">
        <!-- Título do jogo -->
        <h1 class="start-h1">Quiz das Músicas <img width="35" height="35" src="https://img.icons8.com/glyph-neue/64/FFFFFF/headphones.png" alt="headphones" class="fone"/></h1>

    <!-- Formulário para definir o número de questões. -->
        <form action="index.php" method="post">
            <!-- Título do input do tipo number -->
            <h3><label for="text_total_questions" class="form-label">Quantas Questões?</label>
            <!-- Valor inicial de 10, o mínimo é 1 e o máximo é 20 -->
            <input type="number" class="form-control" id="text_total_questions" name="text_total_questions" value="10" min="1" max="20"></h3>

            <!-- Botão para enviar o formulário e começar o jogo -->
            <div class="espaco">
                <button type="submit" class="btn1"><img width="20" height="20" src="https://img.icons8.com/ios-glyphs/30/FFFFFF/four-four.png" alt="four-four" class="btnfone fone2"/> Iniciar <img width="20" height="20" src="https://img.icons8.com/ios-glyphs/30/FFFFFF/four-four.png" alt="four-four" class="btnfone fone1"/></button>
            </div>
        </form>
    </div>
</div>
