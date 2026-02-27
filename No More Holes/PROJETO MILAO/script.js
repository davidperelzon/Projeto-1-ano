// Aguarda o carregamento completo do documento e aplica animações e melhorias visuais
document.addEventListener('DOMContentLoaded', function() {
    // Gerenciamento do tema
    const themeToggle = document.getElementById('themeToggle');
    const themeIcon = themeToggle.querySelector('.theme-icon');
    const html = document.documentElement;
    
    // Verifica se há um tema salvo no localStorage
    const savedTheme = localStorage.getItem('theme') || 'light';
    html.setAttribute('data-theme', savedTheme);
    updateThemeIcon(savedTheme);

    // Função para alternar o tema (lua = claro, sol = escuro)
    function toggleTheme() {
        const currentTheme = html.getAttribute('data-theme');
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        html.setAttribute('data-theme', newTheme);
        localStorage.setItem('theme', newTheme);
        updateThemeIcon(newTheme);
        document.body.style.transition = 'background 0.6s ease, color 0.6s ease';
    }

    // Atualiza o ícone do tema (lua = claro, sol = escuro)
    function updateThemeIcon(theme) {
        themeIcon.textContent = theme === 'dark' ? '🌙' : '☀️';
    }

    // Adiciona o evento de clique no botão
    themeToggle.addEventListener('click', toggleTheme);

    // Animação de entrada para o header (hero)
    const hero = document.querySelector('.hero');
    if (hero) {
        hero.style.opacity = 0;
        hero.style.transform = 'translateY(-40px)';
        setTimeout(() => {
            hero.style.transition = 'opacity 1.2s cubic-bezier(.77,0,.18,1), transform 1.2s cubic-bezier(.77,0,.18,1)';
            hero.style.opacity = 1;
            hero.style.transform = 'translateY(0)';
        }, 200);
    }

    // Animação suave para o nav
    const navbar = document.querySelector('.navbar');
    if (navbar) {
        navbar.style.opacity = 0;
        navbar.style.transform = 'translateY(-30px)';
        setTimeout(() => {
            navbar.style.transition = 'opacity 1s cubic-bezier(.77,0,.18,1), transform 1s cubic-bezier(.77,0,.18,1)';
            navbar.style.opacity = 1;
            navbar.style.transform = 'translateY(0)';
        }, 100);
    }

    // Destaque animado no menu ao passar o mouse
    const menuLinks = document.querySelectorAll('.menu a');
    menuLinks.forEach(link => {
        link.addEventListener('mouseenter', () => {
            link.style.background = 'linear-gradient(90deg, #ffb347 0%, #ffcc33 100%)';
            link.style.color = '#222';
            link.style.borderRadius = '8px';
            link.style.transition = 'all 0.3s ease';
            link.style.boxShadow = '0 2px 8px rgba(255, 204, 51, 0.15)';
        });
        link.addEventListener('mouseleave', () => {
            if (!link.classList.contains('ativo')) {
                link.style.background = 'none';
                link.style.color = '';
                link.style.boxShadow = 'none';
            }
        });
    });

    // Animação para a imagem do drone na seção "Como Funciona"
    const droneImg = document.querySelector('.img-drone');
    if (droneImg) {
        droneImg.style.transition = 'transform 1.5s cubic-bezier(.77,0,.18,1)';
        droneImg.style.transform = 'translateY(-30px) scale(0.8)';
        setTimeout(() => {
            droneImg.style.transform = 'translateY(0) scale(1)';
        }, 800);
    }

    // Animação de fade-in para as seções
    const sections = document.querySelectorAll('section');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = 1;
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, { threshold: 0.1 });

    sections.forEach(section => {
        section.style.opacity = 0;
        section.style.transform = 'translateY(20px)';
        section.style.transition = 'opacity 0.8s ease-out, transform 0.8s ease-out';
        observer.observe(section);
    });

    // Efeito de foco nos campos do formulário
    const formInputs = document.querySelectorAll('.formulario input, .formulario textarea');
    formInputs.forEach(input => {
        input.addEventListener('focus', () => {
            input.style.outline = '2px solid #ffcc33';
            input.style.boxShadow = '0 0 8px #ffcc3355';
        });
        input.addEventListener('blur', () => {
            input.style.outline = '';
            input.style.boxShadow = '';
        });
    });

    // Validação do formulário
    const form = document.getElementById('buracoForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validação básica
            let isValid = true;
            const requiredFields = form.querySelectorAll('[required]');
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.style.borderColor = '#ff4444';
                } else {
                    field.style.borderColor = '#eee';
                }
            });

            if (isValid) {
                const mensagem = document.getElementById('mensagem');
                mensagem.textContent = 'Solicitação enviada com sucesso! Em breve entraremos em contato.';
                mensagem.style.color = '#4CAF50';
                form.reset();
            } else {
                const mensagem = document.getElementById('mensagem');
                mensagem.textContent = 'Por favor, preencha todos os campos obrigatórios.';
                mensagem.style.color = '#ff4444';
            }
        });
    }

    // Sincroniza destaque do menu com a seção ativa ao rolar a página
    const menuSections = ['#como-funciona', '#sobre', '#ort', '#contato'].map(id => document.querySelector(id));
    
    function onScroll() {
        let scrollPos = window.scrollY || window.pageYOffset;
        let found = false;
        
        for (let i = menuSections.length - 1; i >= 0; i--) {
            if (menuSections[i] && menuSections[i].offsetTop - 80 <= scrollPos) {
                menuLinks.forEach(link => link.classList.remove('ativo'));
                if (menuLinks[i]) menuLinks[i].classList.add('ativo');
                found = true;
                break;
            }
        }
        
        if (!found) menuLinks.forEach(link => link.classList.remove('ativo'));
    }

    window.addEventListener('scroll', onScroll);
    onScroll();

    // Mensagem de boas-vindas animada no console
    setTimeout(() => {
        console.log('%cBem-vindo ao Buraco Tô Fora! 🚁🕳️', 'color: #ffb347; font-size: 1.2em; font-weight: bold;');
        console.log('%cProjeto desenvolvido pelos alunos da Escola ORT', 'color: #666; font-size: 1em;');
    }, 500);
});