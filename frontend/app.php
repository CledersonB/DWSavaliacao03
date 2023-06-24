<?php
require_once '../session.php';

if (!isset($_SESSION['username'])) {
    header('Location: ' . BASE_URL . '/frontend/login.php');
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Gestro de Carros</title>
    <!-- meta refresh -->
    <meta http-equiv="refresh" content="<?= (SESSION_TIME + 1) ?>" />
    <!-- <script src="<?= BASE_URL ?>/frontend/assets/ajax.js"></script> -->
    <script>
        async function carregaDados() {
            let box = document.getElementById('dados');
            await fetch(new Request('<?= BASE_URL ?>/backend/dados.php'))
                .then(
                    function (response) {
                        response.text().then(
                            function (data) {
                                box.innerHTML = data;
                            }
                        );
                    }
                )
                .catch(
                    function (error) {
                        console.log(error);
                    }
                )
        }
    </script>
</head>

<body class="bg-light text-dark">
    <div class="bg-secondary text-white">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-11 col-sm-11">
                    <h1>Bem-Vindo:
                        <?php echo $_SESSION['username']; ?>
                </div>

                <div class="col-md-1 col-sm-1 " style="text-align: right;" >
                    <a href="<?= BASE_URL ?>/backend/logout.php" class="btn btn-dark ">Logout</a>
                    </h1>
                </div>
            </div>
        </div>
    </div>

        <?php require_once BASE_PATH . '/frontend/carros.php'; ?>
</body>