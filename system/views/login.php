<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Page | <?= $this->config->item('title') ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <!--base css styles-->
        <link rel="stylesheet"href="<?= base_url() ?>assets/bootstrap/bootstrap/bootstrap.min.css">
        <link rel="stylesheet"href="<?= base_url() ?>assets/bootstrap/bootstrap/bootstrap-responsive.min.css">
        <link rel="stylesheet"href="<?= base_url() ?>assets/bootstrap/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet"href="<?= base_url() ?>assets/bootstrap/normalize/normalize.css">

        <!--page specific css styles-->

        <!--flaty css styles-->
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/flaty.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/flaty-responsive.css">

    </head>

    <body class="login-page">

        <div class="login-wrapper">
            <!-- BEGIN Login Form -->
            <center>
                <h3><b>PT. IRAWAN DJAJA AGUNG</b></h3>
                <h4>Jl. Raya Sukodono No.09</h4>
                <h4>Sukodono, Jawa Timur</h4>
                <h4>Indonesia</h4>
            </center>
            <form id="form-login" method="post">

                <hr/>
                <div class="control-group">
                    <div class="controls">
                        <input type="text" name="name" required="" placeholder="Username" class="input-block-level" />
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <input type="password" name="pass" required="" placeholder="Password" class="input-block-level" />
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <button type="submit" class="btn btn-primary input-block-level">Sign In</button>
                    </div>
                </div>
                <?php
                if (isset($status)) {
                    ?>
                    <div class="control-group">
                        <div class="controls" style="text-align: center;font-weight: bold;color: red">
                            Username atau Password Salah!
                        </div>
                    </div>
                    <?php
                }
                ?>
                <hr/>
            </form>

        </div>
    </body>
</html>
