<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Quiz - Buraco Tô Fora</title>
    <style>
        body { background: #dbeafe; font-family: Arial, sans-serif; }
        .quiz-container { max-width: 700px; margin: 40px auto; background: #fff; border-radius: 16px; box-shadow: 0 2px 16px rgba(37,99,235,0.10); padding: 32px; }
        .quiz-container h1 { text-align: center; margin-bottom: 24px; }
        .question { margin-bottom: 24px; }
        .options label { display: block; margin-bottom: 8px; cursor: pointer; }
        .btn-enviar { margin-top: 24px; }
        .result { text-align: center; font-size: 1.3rem; font-weight: bold; margin-top: 24px; }
    </style>
</head>
<body>
    <div class="quiz-container">
        <h1>Quiz - Buraco Tô Fora</h1>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $score = 0;
            if (isset($_POST['q0']) && $_POST['q0'] == '0') $score++;
            if (isset($_POST['q1']) && $_POST['q1'] == '1') $score++;
            if (isset($_POST['q2']) && $_POST['q2'] == '0') $score++;
            if (isset($_POST['q3']) && $_POST['q3'] == '0') $score++;
            if (isset($_POST['q4']) && $_POST['q4'] == '0') $score++;

            echo '<div class="result">';
            echo "Você acertou $score de 5 perguntas.<br>";
            if ($score === 5) {
                echo "Parabéns! Você sabe tudo sobre o projeto! 🚁";
            } elseif ($score >= 3) {
                echo "Muito bem! Você conhece bastante o projeto.";
            } else {
                echo "Que tal conhecer melhor o site e tentar novamente?";
            }
            echo '</div>';
        } else {
        ?>
        <form method="post">
            <div class="question">
                <strong>1. Qual é o objetivo principal do projeto Buraco Tô Fora?</strong>
                <div class="options">
                    <label><input type="radio" name="q0" value="0" required> A) Identificar e reparar buracos nas ruas usando drones.</label>
                    <label><input type="radio" name="q0" value="1"> B) Vender drones para escolas.</label>
                    <label><input type="radio" name="q0" value="2"> C) Ensinar programação para crianças.</label>
                    <label><input type="radio" name="q0" value="3"> D) Criar jogos online.</label>
                </div>
            </div>
            <div class="question">
                <strong>2. Quem desenvolveu o projeto Buraco Tô Fora?</strong>
                <div class="options">
                    <label><input type="radio" name="q1" value="0" required> A) Prefeitura do Rio de Janeiro.</label>
                    <label><input type="radio" name="q1" value="1"> B) Alunos da Escola ORT.</label>
                    <label><input type="radio" name="q1" value="2"> C) Empresa privada de tecnologia.</label>
                    <label><input type="radio" name="q1" value="3"> D) Governo Federal.</label>
                </div>
            </div>
            <div class="question">
                <strong>3. Como o cidadão pode participar do projeto?</strong>
                <div class="options">
                    <label><input type="radio" name="q2" value="0" required> A) Enviando fotos de buracos pelo site.</label>
                    <label><input type="radio" name="q2" value="1"> B) Ligando para a prefeitura.</label>
                    <label><input type="radio" name="q2" value="2"> C) Comprando um drone.</label>
                    <label><input type="radio" name="q2" value="3"> D) Indo até a escola ORT.</label>
                </div>
            </div>
            <div class="question">
                <strong>4. O que acontece após o envio da solicitação pelo site?</strong>
                <div class="options">
                    <label><input type="radio" name="q3" value="0" required> A) O drone vai até o local e realiza o reparo.</label>
                    <label><input type="radio" name="q3" value="1"> B) Nada acontece.</label>
                    <label><input type="radio" name="q3" value="2"> C) O usuário recebe um prêmio.</label>
                    <label><input type="radio" name="q3" value="3"> D) O buraco é ignorado.</label>
                </div>
            </div>
            <div class="question">
                <strong>5. Qual instituição é parceira do projeto?</strong>
                <div class="options">
                    <label><input type="radio" name="q4" value="0" required> A) Escola ORT.</label>
                    <label><input type="radio" name="q4" value="1"> B) Fierj.</label>
                    <label><input type="radio" name="q4" value="2"> C) Google.</label>
                    <label><input type="radio" name="q4" value="3"> D) Apple.</label>
                </div>
            </div>
            <button class="btn btn-enviar" type="submit">Enviar Respostas</button>
        </form>
        <?php } ?>
        <div style="text-align:center; margin-top:32px;">
            <a href="index.html" class="footer-link">← Voltar para o site</a>
        </div>
    </div>
</body>
</html>
