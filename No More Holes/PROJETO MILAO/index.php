<?php
// ================= CONFIGURAÇÃO BANCO =================
$host = 'localhost';
$db   = 'clebin';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    exit('Erro ao conectar ao banco de dados: ' . $e->getMessage());
}

// ================= PROCESSAR FORMULÁRIO =================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nome'], $_POST['email'], $_POST['local'])) {
    $nome            = trim($_POST['nome']);
    $email           = trim($_POST['email']);
    $endereco_buraco = trim($_POST['local']);
    $descricao       = isset($_POST['descricao']) ? trim($_POST['descricao']) : '';

    // =========== Inserir no banco ===========
    $stmt = $pdo->prepare("INSERT INTO contato (nome, email, endereco_buraco, descricao) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nome, $email, $endereco_buraco, $descricao]);

    echo "<script>alert('Solicitação enviada com sucesso!');</script>";
}
?>


<!DOCTYPE html>
<html lang="pt-BR" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buraco Tô Fora - Projeto Escola ORT</title>
    <meta name="description" content="Projeto desenvolvido pelos alunos da Escola ORT para transformar sua cidade! Envie fotos de buracos nas ruas e acompanhe a solução em tempo real com nosso drone inovador.">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Roboto:wght@300;500&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/684/684908.png">
    <style>
        body, html {
            background: linear-gradient(120deg, #0a192f 60%, #2563eb 100%) !important;
            color: #111 !important;
        }
        .navbar, .footer-content, .cabecalho {
            background: #112240 !important;
        }
        .navbar-brand, .navbar-nav .nav-link, .footer-content, .footer-link {
            color: #111 !important;
        }
        .navbar-nav .nav-link.active, .navbar-nav .nav-link:focus, .navbar-nav .nav-link:hover {
            background: linear-gradient(90deg, #2563eb 0%, #1e293b 100%);
            color: #fff !important;
            border-radius: 8px;
        }
        .destaque {
            background: #1e293b !important;
            color: #fff !important;
        }
        .theme-toggle {
            background: #2563eb !important;
            color: #fff !important;
            border: none;
            border-radius: 50%;
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-left: 10px;
        }
        .theme-toggle:focus {
            outline: 2px solid #fff;
        }
        .form-label, .form-control, .form-select, .form-check-label, .btn-enviar {
            color: #111 !important;
        }
        .form-control, .form-select, .form-check-input {
            background: #f8fafc !important;
            border: 1px solid #2563eb !important;
        }
        .btn-enviar {
            background: #2563eb !important;
            color: #fff !important;
            border: none;
        }
        .btn-enviar:hover {
            background: #1e293b !important;
        }
        .card, section, .contato, .sobre, .ort, .formulario {
            background: #f8fafc !important;
            color: #111 !important;
            border-radius: 18px;
            box-shadow: 0 2px 16px rgba(37, 99, 235, 0.10);
        }
        .footer-content {
            color: #fff !important;
            background: #112240 !important;
        }
        .footer-link {
            color: #60a5fa !important;
        }
        .footer-link:hover {
            color: #fff !important;
        }
        .img-drone, .img-sobre, .img-ort, .hero-img {
            box-shadow: 0 4px 24px rgba(37, 99, 235, 0.10);
            border-radius: 18px;
            display: block;
            margin: 32px auto;
        }
        .img-drone { width: 600px; height: 450px; max-width: 100%; }
        .img-sobre { width: 480px; height: 360px; max-width: 100%; }
        .img-ort { width: 600px; height: 240px; max-width: 100%; }
        .hero-img { width: 480px; height: 360px; max-width: 100%; }
        @media (max-width: 768px) {
            .img-drone, .img-sobre, .img-ort, .hero-img { width: 100% !important; height: auto !important; }
        }
        /* Ajuste para títulos amarelos */
        .contato h2,
        .sobre h2,
        .ort h2,
        .como-funciona h2,
        .formulario h2 {
            color: #111 !important;
        }
        .contato-info a,
        .contato-info a:hover,
        .footer-link,
        .footer-link:hover {
            color: #111 !important;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark py-3 shadow-sm">
    

        <div class="container">
            <!-- Container branco para todos os textos do nav -->
            <div class="bg-white rounded-4 shadow-sm w-100 px-3 py-2 d-flex align-items-center flex-wrap">
                <a class="navbar-brand d-flex align-items-center" href="#formulario">
                    <img src="https://cdn-icons-png.flaticon.com/512/684/684908.png" alt="Logo Buraco Tô Fora" width="40" height="40" class="me-2">
                    <span>Buraco Tô Fora</span>
                </a>
                <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mainNavbar">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
                        <li class="nav-item"><a class="nav-link" href="#como-funciona">Como Funciona</a></li>
                        <li class="nav-item"><a class="nav-link" href="#sobre">Sobre</a></li>
                        <li class="nav-item"><a class="nav-link" href="#ort">Escola ORT</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contato">Contato</a></li>
                         <li class="nav-item"><a class="nav-link" href="quiz.php">Quiz</a></li>
                        <li class="nav-item">
                            <button id="themeToggle" class="theme-toggle ms-2" aria-label="Alternar tema" type="button" tabindex="0">
                                <span class="theme-icon" aria-hidden="true">🌙</span>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <header class="cabecalho py-4">
        <div class="container">
            <!-- Novo container branco começa aqui -->
            <div class="bg-white rounded-4 shadow-sm px-4 py-4" id="header-white-bg">
                <div class="hero text-center">
                    <h1 class="display-5 fw-bold mb-3">
                        <span class="emoji" aria-hidden="true">🕳️🚗</span>
                        Buraco Tô Fora
                        <span class="emoji" aria-hidden="true">🚁🛠️</span>
                    </h1>
                    <p class="subtitulo fs-5 mb-3">
                        <strong>Projeto desenvolvido pelos alunos da Escola ORT</strong><br>
                        Encontrou 6 buraco na sua rua? Envie uma foto e acompanhe a solução em tempo real!<br>
                        Nosso drone vai até o local, faz o reparo e você pode acompanhar tudo.<br>
                        <span class="destaque">Juntos, deixamos a cidade mais segura, bonita e moderna para todos.</span>
                    </p>
                </div>
            </div>
            <!-- Fecha o container branco antes da imagem -->
            <img src="img/dbdb.jpg" alt="Rua com buraco" class="hero-img">
        </div>
    </header>
    <main>
        <section id="como-funciona" class="como-funciona container my-5 p-4">
            <h2 class="text-center mb-4">Como Funciona?</h2>
            <ol class="fs-5 mb-4">
                <li><strong>Identifique</strong> um buraco na sua rua ou bairro.</li>
                <li><strong>Preencha o formulário</strong> abaixo e envie uma foto do local.</li>
                <li><strong>Acompanhe</strong> o status da sua solicitação em tempo real pelo nosso site.</li>
                <li><strong>Nosso drone</strong> vai até o local e realiza o reparo de forma rápida e eficiente!</li>
            </ol>
            <img src="img/passo.png" alt="Drone voando" class="img-drone">
        </section>
        <section id="formulario" class="formulario container my-5 p-4">
            <h2 class="text-center mb-4">Envie sua Solicitação</h2>
            <form method="POST" enctype="multipart/form-data" class="mb-5">                <div class="mb-3">
                    <label for="nome" class="form-label">Seu nome:</label>
                    <input type="text" id="nome" name="nome" class="form-control" placeholder="Digite seu nome completo" required autocomplete="name" maxlength="60">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Seu e-mail:</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="exemplo@email.com" required autocomplete="email" maxlength="80">
                </div>
                <div class="mb-3">
                    <label for="local" class="form-label">Endereço do buraco:</label>
                    <input type="text" id="local" name="local" class="form-control" placeholder="Ex: Rua das Flores, 123, Bairro Centro" required maxlength="120" autocomplete="street-address">
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto do buraco:</label>
                    <input type="file" id="foto" name="foto" class="form-control" accept="image/*" required>
                    <small class="form-text text-muted">Formatos aceitos: JPG, PNG. Tamanho máximo: 5MB.</small>
                </div>
                <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição (opcional):</label>
                    <textarea id="descricao" name="descricao" class="form-control" rows="3" placeholder="Descreva o problema, se desejar."></textarea>
                </div>
                <button type="submit" class="btn btn-enviar w-100">Enviar Solicitação</button>
            </form>
            <div id="mensagem" role="status" aria-live="polite" class="mt-3"></div>
        </section>
        <section id="sobre" class="sobre container my-5 p-4">
            <h2 class="text-center mb-4">Sobre o Projeto</h2>
            <p class="fs-5">
                O <strong>Buraco Tô Fora</strong> é um projeto inovador desenvolvido pelos alunos da Escola ORT, 
                unindo tecnologia, cidadania e inovação para melhorar a infraestrutura urbana. 
                Utilizamos drones inteligentes para identificar e reparar buracos nas ruas, 
                tornando a cidade mais segura para motoristas, ciclistas e pedestres.
            </p>
            <img src="img/drone.png" alt="Drone reparando buraco" class="img-sobre">
            <ul class="fs-5">
                <li>Projeto 100% desenvolvido por alunos da Escola ORT</li>
                <li>Transparência total no acompanhamento das solicitações</li>
                <li>Parceria com órgãos públicos e privados</li>
                <li>Tecnologia de ponta aplicada à cidadania</li>
            </ul>
        </section>
        <section id="ort" class="ort container my-5 p-4">
            <h2 class="text-center mb-4">Escola ORT</h2>
            <p class="fs-5">
                A Escola ORT é uma instituição de ensino reconhecida internacionalmente por sua excelência 
                em educação tecnológica e inovação. Nossos alunos são incentivados a desenvolver projetos 
                que impactem positivamente a sociedade, como o Buraco Tô Fora.
            </p>
            <img src="img/ort.png" alt="Logo Escola ORT" class="img-ort">
            <ul class="fs-5">
                <li>Educação de qualidade desde 1937</li>
                <li>Foco em tecnologia e inovação</li>
                <li>Projetos práticos e interdisciplinares</li>
                <li>Formação de cidadãos conscientes</li>
            </ul>
        </section>
        <section id="contato" class="contato container my-5 p-4">
            <h2 class="text-center mb-4">Fale Conosco</h2>
            <p class="fs-5">Tem dúvidas, sugestões ou quer ser nosso parceiro? Entre em contato!</p>
            <div class="contato-info d-flex flex-column align-items-center gap-2">
                <a href="mailto:contato@buracotofora.com" class="footer-link fw-bold">contato@buracotofora.com</a>
                <a href="https://github.com/buracotofora" target="_blank" rel="noopener" class="footer-link">Nosso GitHub</a>
                <span>WhatsApp: <a href="https://wa.me/5521998361818" target="_blank" rel="noopener" class="footer-link">+55 21 99836-1818</a></span>
            </div>
        </section>
    </main>
    <footer class="footer-content py-4 mt-5">
        <div class="container text-center">
            <img src="https://cdn-icons-png.flaticon.com/512/684/684908.png" alt="Logo Buraco Tô Fora" width="32" height="32" class="mb-2">
            <p class="mb-1">Projeto desenvolvido pelos alunos da Escola ORT</p>
            <p>
                <a href="mailto:contato@buracotofora.com" class="footer-link">contato@buracotofora.com</a> |
                <a href="https://github.com/buracotofora" target="_blank" rel="noopener" class="footer-link">GitHub</a>
            </p>
            <p class="footer-copy mb-0">&copy; 2025 Buraco Tô Fora - Escola ORT. Todos os direitos reservados.</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
    <script>
        // Alternância de tema claro/escuro (lua = claro, sol = escuro)
        document.addEventListener('DOMContentLoaded', function() {
            const themeToggle = document.getElementById('themeToggle');
            const themeIcon = themeToggle.querySelector('.theme-icon');
            const html = document.documentElement;
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme) {
                html.setAttribute('data-theme', savedTheme);
                themeIcon.textContent = savedTheme === 'dark' ? '🌙' : '☀️';
            } else {
                themeIcon.textContent = html.getAttribute('data-theme') === 'dark' ? '🌙' : '☀️';
            }
            themeToggle.addEventListener('click', function() {
                const currentTheme = html.getAttribute('data-theme');
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                html.setAttribute('data-theme', newTheme);
                localStorage.setItem('theme', newTheme);
                themeIcon.textContent = newTheme === 'dark' ? '🌙' : '☀️';
            });

            // Menu ativo ao rolar
            const menuLinks = document.querySelectorAll('.navbar-nav .nav-link');
            const sections = ['#como-funciona', '#sobre', '#ort', '#contato'].map(id => document.querySelector(id));
            function onScroll() {
                let scrollPos = window.scrollY || window.pageYOffset;
                let found = false;
                for (let i = sections.length - 1; i >= 0; i--) {
                    if (sections[i] && sections[i].offsetTop - 80 <= scrollPos) {
                        menuLinks.forEach(link => link.classList.remove('active'));
                        if (menuLinks[i]) menuLinks[i].classList.add('active');
                        found = true;
                        break;
                    }
                }
                if (!found) menuLinks.forEach(link => link.classList.remove('active'));
            }
            window.addEventListener('scroll', onScroll);
            onScroll();
        });
    </script>
</body>
</html>
