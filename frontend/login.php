<?php
require_once '../session.php';
if (isset($_SESSION['username']))
    header("location:" . BASE_URL . "/app.php");
?>
<!DOCTYPE html>
<html>

<head>
    <title>Tesla Motors Factory</title>
    <script src="<?= BASE_URL ?>/frontend/assets/ajax.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">


</head>

<body>
    <form class="vh-100" style="background: linear-gradient(5deg, #bdfdff 0, #8dddff 25%, #53bcf2 50%, #009cda 75%, #007fc4 100%);;" action="<?= BASE_URL ?>/backend/auth.php" method="post">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5 ">
                    <div class="card shadow-2-strong shadow-lg p-3" style="border-radius: 3rem; background-color: #DCDCDC">
                        <div class="card-body p-5 text-center">
                            <h3 class="mb-5">Tesla Motors</h3>
                            <h4 class="mb-5">Login: admin@admin Senha: admin</h4>
                            <div class="form-outline mb-4">
                                <input type="email" id="username" name="email" class="form-control form-control-lg" />
                                <label class="form-label" for="username">Email</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input type="password" id="password" name="senha"
                                    class="form-control form-control-lg" />
                                <label class="form-label" for="password">Password</label>
                            </div>
                            <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>

</html>