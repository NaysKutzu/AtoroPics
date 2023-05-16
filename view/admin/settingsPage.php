<?php
require('../class/session.php');

$userdb = $conn->query("SELECT * FROM atoropics_users WHERE api_key = '" . mysqli_real_escape_string($conn, $_SESSION["api_key"]) . "'")->fetch_array();

if ($userdb['admin'] == "false") {
    header('location: /');
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        <?= $settings['app_name'] ?> - Settings
    </title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= $settings['app_logo'] ?>">
    <link rel="icon" type="image/png" href="<?= $settings['app_logo'] ?>" sizes="32x32">
    <link rel="icon" type="image/png" href="<?= $settings['app_logo'] ?>" sizes="16x16">
    <link rel="shortcut icon" href="<?= $settings['app_logo'] ?>">
    <link media="all" type="text/css" rel="stylesheet" href="/dist/vendor/select2/select2.min.css" />
    <link media="all" type="text/css" rel="stylesheet" href="/dist/vendor/bootstrap/bootstrap.min.css" />
    <link media="all" type="text/css" rel="stylesheet" href="/dist/vendor/adminlte/admin.min.css" />
    <link media="all" type="text/css" rel="stylesheet" href="/dist/vendor/adminlte/colors/skin-blue.min.css" />
    <link media="all" type="text/css" rel="stylesheet" href="/dist/vendor/sweetalert/sweetalert.min.css" />
    <link media="all" type="text/css" rel="stylesheet" href="/dist/vendor/animate/animate.min.css" />
    <link media="all" type="text/css" rel="stylesheet" href="/dist/css/pterodactyl.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <style>
        .content-wrapper {
            padding-left: 0;
        }

        .container {
            display: flex;
        }

        .box {
            flex: 1;
            margin-right: 10px;
        }
    </style>
</head>

<body class="hold-transition skin-blue fixed sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <a href="/" class="logo">
                <span>
                    <?= $settings['app_name'] ?>
                </span>
            </a>
            <nav class="navbar navbar-static-top">
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="user-menu">
                            <a href="/admin">
                                <img src="<?= $userdb['avatar'] ?>" class="user-image" alt="User Image">
                                <span class="hidden-xs">
                                    <?= $userdb['username'] ?>
                                </span>
                            </a>
                        </li>
                        <li>
                        <li><a href="/dashboard" data-toggle="tooltip" data-placement="bottom"
                                title="Exit Admin Control"><i class="fa fa-server"></i></a></li>
                        </li>
                        <li>
                        <li><a href="/auth/logout" id="logoutButton" data-toggle="tooltip" data-placement="bottom"
                                title="Logout"><i class="fa fa-sign-out"></i></a></li>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="main-sidebar">
            <section class="sidebar">
                <ul class="sidebar-menu">
                    <li class="header">BASIC ADMINISTRATION</li>
                    <li class="1">
                        <a href="/admin">
                            <i class="fa fa-home"></i> <span>Overview</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="/admin/settings">
                            <i class="fa fa-wrench"></i> <span>Settings</span>
                        </a>
                    </li>
                    <li class="1">
                        <a href="/admin/api">
                            <i class="fa fa-gamepad"></i> <span>Application API</span>
                        </a>
                    </li>
                    <li class="header">MANAGEMENT</li>
                    <li class="1">
                        <a href="/admin/nodes">
                            <i class="fa fa-sitemap"></i> <span>Nodes (SOON)</span>
                        </a>
                    </li>
                    <li class="1">
                        <a href="/admin/servers">
                            <i class="fa fa-server"></i> <span>Domains</span>
                        </a>
                    </li>
                    <li class="1">
                        <a href="/admin/nests">
                            <i class="fa fa-th-large"></i> <span>Imagines</span>
                        </a>
                    </li>
                    <li class="1">
                        <a href="/admin/users">
                            <i class="fa fa-users"></i> <span>Users</span>
                        </a>
                    </li>
                </ul>
            </section>
        </aside>
        <div class="content-wrapper" style="min-height: 888px;">
            <section class="content-header">
                <h1>Panel Settings<small>Configure Pterodactyl to your liking.</small></h1>
                <ol class="breadcrumb">
                    <li><a href="https://gamepanel.mythicalsystems.tech/admin">Admin</a></li>
                    <li class="active">Settings</li>
                </ol>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="nav-tabs-custom nav-tabs-floating">
                            <ul class="nav nav-tabs">
                                <li class="active"><a
                                        href="https://gamepanel.mythicalsystems.tech/admin/settings">General</a></li>
                                <li><a href="https://gamepanel.mythicalsystems.tech/admin/settings/mail">Mail</a></li>
                                <li><a
                                        href="https://gamepanel.mythicalsystems.tech/admin/settings/advanced">Advanced</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Panel Settings</h3>
                            </div>
                            <form action="https://gamepanel.mythicalsystems.tech/admin/settings" method="POST">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label class="control-label">Company Name</label>
                                            <div>
                                                <input type="text" class="form-control" name="app:name"
                                                    value="MythicalSystems">
                                                <p class="text-muted"><small>This is the name that is used throughout
                                                        the panel and in emails sent to clients.</small></p>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="control-label">Require 2-Factor Authentication</label>
                                            <div>
                                                <div class="btn-group" data-toggle="buttons">
                                                    <label class="btn btn-primary ">
                                                        <input type="radio" name="pterodactyl:auth:2fa_required"
                                                            autocomplete="off" value="0"> Not Required
                                                    </label>
                                                    <label class="btn btn-primary  active ">
                                                        <input type="radio" name="pterodactyl:auth:2fa_required"
                                                            autocomplete="off" value="1" checked=""> Admin Only
                                                    </label>
                                                    <label class="btn btn-primary ">
                                                        <input type="radio" name="pterodactyl:auth:2fa_required"
                                                            autocomplete="off" value="2"> All Users
                                                    </label>
                                                </div>
                                                <p class="text-muted"><small>If enabled, any account falling into the
                                                        selected grouping will be required to have 2-Factor
                                                        authentication enabled to use the Panel.</small></p>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="control-label">Default Language</label>
                                            <div>
                                                <select name="app:locale" class="form-control">
                                                    <option value="en" selected="">English</option>
                                                </select>
                                                <p class="text-muted"><small>The default language to use when rendering
                                                        UI components.</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <input type="hidden" name="_token" value="guNk2uEtCD2lMUFuzutZ43NeGQSG0RMPD5a9kdJw">
                                    <button type="submit" name="_method" value="PATCH"
                                        class="btn btn-sm btn-primary pull-right">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <footer class="main-footer">
            <div class="pull-right small text-gray" style="margin-right:10px;margin-top:-7px;">
                <strong><i class="fa fa-fw fa-code-fork"></i></strong>
                <?= $settings['version'] ?><br />
                <strong><i class="fa fa-fw fa-clock-o"></i></strong> <span id="loadtime"></span>
            </div>
            Copyright &copy; 2022 - 2023 <a href="https://atoro.tech/">Atoro Tech</a>.
        </footer>
    </div>
    <script src="/dist/js/keyboard.polyfill.js" type="application/javascript"></script>
    <script>
        keyboardeventKeyPolyfill.polyfill();
    </script>

    <script src="/dist/vendor/jquery/jquery.min.js"></script>

    <script src="/dist/vendor/sweetalert/sweetalert.min.js"></script>

    <script src="/dist/vendor/bootstrap/bootstrap.min.js"></script>

    <script src="/dist/vendor/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="/dist/vendor/adminlte/app.min.js"></script>

    <script src="/dist/vendor/bootstrap-notify/bootstrap-notify.min.js"></script>

    <script src="/dist/vendor/select2/select2.full.min.js"></script>

    <script src="/dist/js/functions.js"></script>

    <script src="/dist/js/autocomplete.js" type="application/javascript"></script>

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        })
    </script>
    <script type="text/javascript">
        var before_loadtime = new Date().getTime();
        window.onload = Pageloadtime;
        function Pageloadtime() {
            var aftr_loadtime = new Date().getTime();
            // Time calculating in seconds
            pgloadtime = (aftr_loadtime - before_loadtime) / 1000

            document.getElementById("loadtime").innerHTML = pgloadtime + "s";
        }
    </script>
</body>

</html>