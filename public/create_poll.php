<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VoteGuard - Criar Nova Enquete</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <!-- CSS personalizado -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar com logo e menu -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-shield-alt me-2"></i>VoteGuard
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">
                            <i class="fas fa-home me-2"></i>Início
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="create_poll.php">
                            <i class="fas fa-plus-circle me-2"></i>Nova Enquete
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-chart-bar me-2"></i>Resultados
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Container principal -->
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header text-white text-center py-3">
                        <h4 class="mb-0">
                            <i class="fas fa-plus-circle me-2"></i>Criar Nova Enquete
                        </h4>
                    </div>
                    <div class="card-body p-4">
                        <form id="createPollForm" action="api/create_poll.php" method="POST">
                            <!-- Título da Enquete -->
                            <div class="mb-4">
                                <label for="pollTitle" class="form-label">Título da Enquete</label>
                                <input type="text" class="form-control custom-input" id="pollTitle" name="title" 
                                       placeholder="Ex.: Qual é a sua linguagem de programação favorita?" required>
                            </div>

                            <!-- Descrição -->
                            <div class="mb-4">
                                <label for="pollDescription" class="form-label">Descrição (opcional)</label>
                                <textarea class="form-control custom-input" id="pollDescription" name="description" 
                                          rows="3" placeholder="Adicione uma breve descrição sobre sua enquete..."></textarea>
                            </div>

                            <!-- Opções de Voto -->
                            <div class="mb-4">
                                <label class="form-label d-flex justify-content-between align-items-center">
                                    <span>Opções de Voto</span>
                                    <button type="button" class="btn btn-sm btn-primary" id="addOption">
                                        <i class="fas fa-plus me-2"></i>Adicionar Opção
                                    </button>
                                </label>
                                <div id="optionsContainer">
                                    <div class="option-group mb-3">
                                        <div class="input-group">
                                            <span class="input-group-text custom-input">
                                                <i class="fas fa-check-circle"></i>
                                            </span>
                                            <input type="text" class="form-control custom-input" 
                                                   name="options[]" placeholder="Digite uma opção" required>
                                            <button type="button" class="btn btn-outline-danger remove-option" disabled>
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="option-group mb-3">
                                        <div class="input-group">
                                            <span class="input-group-text custom-input">
                                                <i class="fas fa-check-circle"></i>
                                            </span>
                                            <input type="text" class="form-control custom-input" 
                                                   name="options[]" placeholder="Digite uma opção" required>
                                            <button type="button" class="btn btn-outline-danger remove-option" disabled>
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Configurações -->
                            <div class="mb-4">
                                <h5 class="mb-3">Configurações</h5>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="enableCaptcha" name="enableCaptcha" checked>
                                    <label class="form-check-label" for="enableCaptcha">
                                        Habilitar proteção contra bots (Captcha)
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="preventMultipleVotes" name="preventMultipleVotes" checked>
                                    <label class="form-check-label" for="preventMultipleVotes">
                                        Impedir votos múltiplos do mesmo usuário
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="showResults" name="showResults" checked>
                                    <label class="form-check-label" for="showResults">
                                        Mostrar resultados parciais
                                    </label>
                                </div>
                            </div>

                            <!-- Botões -->
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-check-circle me-2"></i>Criar Enquete
                                </button>
                                <a href="index.php" class="btn btn-outline-primary">
                                    <i class="fas fa-arrow-left me-2"></i>Voltar
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer mt-auto py-3 bg-dark text-light">
        <div class="container text-center">
            <small>
                <i class="fas fa-shield-alt me-2"></i>VoteGuard - Sistema Seguro de Votação
            </small>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- JavaScript personalizado -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const optionsContainer = document.getElementById('optionsContainer');
            const addOptionBtn = document.getElementById('addOption');
            
            // Adicionar nova opção
            addOptionBtn.addEventListener('click', function() {
                const newOption = document.createElement('div');
                newOption.className = 'option-group mb-3';
                newOption.innerHTML = `
                    <div class="input-group">
                        <span class="input-group-text custom-input">
                            <i class="fas fa-check-circle"></i>
                        </span>
                        <input type="text" class="form-control custom-input" 
                               name="options[]" placeholder="Digite uma opção" required>
                        <button type="button" class="btn btn-outline-danger remove-option">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                `;
                optionsContainer.appendChild(newOption);
                updateRemoveButtons();
            });
            
            // Remover opção
            optionsContainer.addEventListener('click', function(e) {
                if (e.target.closest('.remove-option')) {
                    e.target.closest('.option-group').remove();
                    updateRemoveButtons();
                }
            });
            
            // Atualizar botões de remover
            function updateRemoveButtons() {
                const options = optionsContainer.querySelectorAll('.option-group');
                const removeButtons = optionsContainer.querySelectorAll('.remove-option');
                
                removeButtons.forEach(btn => {
                    btn.disabled = options.length <= 2;
                });
            }
        });
    </script>
</body>
</html>