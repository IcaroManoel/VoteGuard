<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VoteGuard - Sistema Seguro de Votação</title>
    
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
            <a class="navbar-brand" href="#">
                <i class="fas fa-shield-alt me-2"></i>VoteGuard
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">
                            <i class="fas fa-home me-2"></i>Início
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="create_poll.php">
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
        <!-- Área de Votação -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header text-white text-center py-3">
                        <h4 class="mb-0">
                            <i class="fas fa-vote-yea me-2"></i>Enquete Atual
                        </h4>
                    </div>
                    <div class="card-body p-4">
                        <!-- Título da Enquete -->
                        <h5 class="card-title text-center mb-4 text-white">
                            Qual é a sua linguagem de programação favorita?
                        </h5>

                        <!-- Opções de Voto -->
                        <div class="vote-options">
                            <div class="vote-option">
                                <input type="radio" class="btn-check" name="vote" id="option1" autocomplete="off">
                                <label class="btn btn-outline-primary w-100 text-start custom-option" for="option1">
                                    <i class="fab fa-python me-2"></i>Python
                                </label>
                            </div>
                            
                            <div class="vote-option">
                                <input type="radio" class="btn-check" name="vote" id="option2" autocomplete="off">
                                <label class="btn btn-outline-primary w-100 text-start custom-option" for="option2">
                                    <i class="fab fa-js me-2"></i>JavaScript
                                </label>
                            </div>
                            
                            <div class="vote-option">
                                <input type="radio" class="btn-check" name="vote" id="option3" autocomplete="off">
                                <label class="btn btn-outline-primary w-100 text-start custom-option" for="option3">
                                    <i class="fab fa-java me-2"></i>Java
                                </label>
                            </div>
                            
                            <div class="vote-option">
                                <input type="radio" class="btn-check" name="vote" id="option4" autocomplete="off">
                                <label class="btn btn-outline-primary w-100 text-start custom-option" for="option4">
                                    <i class="fab fa-php me-2"></i>PHP
                                </label>
                            </div>
                        </div>

                        <!-- Botão de Envio -->
                        <div class="d-grid gap-2 mt-4">
                            <button type="button" class="btn btn-primary btn-lg">
                                <i class="fas fa-paper-plane me-2"></i>Enviar Voto
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Card de Resultados Parciais -->
                <div class="card shadow-sm mt-4">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-chart-bar me-2"></i>Resultados Parciais
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="results-bar">
                            <div class="mb-3">
                                <label class="d-flex justify-content-between">
                                    <span>Python</span>
                                    <span>45%</span>
                                </label>
                                <div class="progress">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 45%"></div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="d-flex justify-content-between">
                                    <span>JavaScript</span>
                                    <span>30%</span>
                                </label>
                                <div class="progress">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 30%"></div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="d-flex justify-content-between">
                                    <span>Java</span>
                                    <span>15%</span>
                                </label>
                                <div class="progress">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 15%"></div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="d-flex justify-content-between">
                                    <span>PHP</span>
                                    <span>10%</span>
                                </label>
                                <div class="progress">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 10%"></div>
                                </div>
                            </div>
                        </div>
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
</body>
</html>
