<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Sanskruti CRM</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?= asset_url('admin/imgs/theme/favicon.svg') ?>" />
    <!-- Template CSS -->
    <link href="<?= asset_url('admin/css/main.css?v=1.1') ?>" rel="stylesheet" type="text/css" />
</head>

<body>
    <main>
        <section class="content-main mt-155">
            <div class="card mx-auto card-login">
                <div class="card-body">
                    <h4 class="card-title mb-4">Sign in</h4>
                    <form action="" method="post" class="login-form">
                        <div class="alert alert-danger hidden"></div>
                        <div class="alert alert-success hidden"></div>
                        <div class="mb-3">
                            <input class="form-control" name="USERNAME" placeholder="Username or email" type="text" />
                            <input type="hidden" name="TYPE" value="login">
                        </div>
                        <!-- form-group// -->
                        <div class="mb-3">
                            <input class="form-control" name="PASSWORD" placeholder="Password" type="password" />
                        </div>
                        <!-- form-group// -->
                        <div class="mb-3">
                            <a href="#" class="float-end font-sm text-muted">Forgot password?</a>
                            <label class="form-check">
                                <input type="checkbox" class="form-check-input" checked="" />
                                <span class="form-check-label">Remember</span>
                            </label>
                        </div>
                        <!-- form-group form-check .// -->
                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary text-center w-100">Login</button>
                        </div>
                        <!-- form-group// -->
                    </form>
                </div>
            </div>
        </section>
        <!-- <footer class="main-footer text-center">
            <p class="font-xs">
                <script>
                    document.write(new Date().getFullYear());
                </script>
                &copy; Nest - HTML Ecommerce Template .
            </p>
            <p class="font-xs mb-80">All rights reserved</p>
        </footer> -->
    </main>
    <script>
        <?= $jdata ?>
        var crm = {};
        var crm_viewer = {};
    </script>
    <script src="<?= asset_url('admin/js/vendors/jquery-3.6.0.min.js') ?>"></script>
    <script src="<?= asset_url('admin/js/vendors/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= asset_url('admin/js/vendors/jquery.fullscreen.min.js') ?>"></script>
    <!-- Main Script -->
    <script src="<?= asset_url('admin/js/main.js?v=1.1') ?>" type="text/javascript"></script>
    <script src="<?= asset_url('custom.js') ?>" type="text/javascript"></script>

</body>

</html>