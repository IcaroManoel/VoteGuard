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
                            <i class="fas fa-vote-yea me-2"></i>Enquetes Disponíveis
                        </h4>
                    </div>
                    <div class="card-body p-4">
                        <?php
                        // Lê as enquetes do arquivo JSON
                        $pollsFile = __DIR__ . '/../data/polls.json';
                        $polls = file_exists($pollsFile) ? json_decode(file_get_contents($pollsFile), true) : [];
                        if (empty($polls)) {
                            echo '<div class="alert alert-info text-center">Nenhuma enquete disponível no momento.</div>';
                        } else {
                            foreach ($polls as $pollId => $poll) {
                                echo '<div class="mb-5">';
                                echo '<h5 class="card-title text-center mb-4 text-white">' . htmlspecialchars($poll["title"]) . '</h5>';
                                echo '<form method="post" action="vote.php">';
                                if (!empty($poll["options"])) {
                                    echo '<div class="vote-options">';
                                    foreach ($poll["options"] as $optIdx => $option) {
                                        $inputId = "poll{$pollId}_option{$optIdx}";
                                        echo '<div class="vote-option">';
                                        echo '<input type="radio" class="btn-check" name="vote_option" id="' . $inputId . '" value="' . htmlspecialchars($option) . '" autocomplete="off">';
                                        echo '<label class="btn btn-outline-primary w-100 text-start custom-option" for="' . $inputId . '">' . htmlspecialchars($option) . '</label>';
                                        echo '</div>';
                                    }
                                    echo '</div>';
                                }
                                echo '<input type="hidden" name="poll_id" value="' . htmlspecialchars($pollId) . '">';
                                echo '<div class="d-grid gap-2 mt-4">';
                                echo '<button type="submit" class="btn btn-primary btn-lg">';
                                echo '<i class="fas fa-paper-plane me-2"></i>Enviar Voto';
                                echo '</button>';
                                echo '</div>';
                                echo '</form>';
                                echo '</div>';
                            }
                        }
                        ?>
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
