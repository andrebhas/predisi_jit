<?php
include 'res.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">

        <?php
        if (isset($title)) {
            $title = $title . " | " . $this->config->item('title');
        } else {
            $title = $this->config->item('title');
        }
        ?>
        <title><?= $title ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <!--base css styles-->
        <!--<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/bootstrap/bootstrap-switch/static/stylesheets/bootstrap-switch.css" />-->
        <link rel="stylesheet"href="<?= base_url() ?>assets/bootstrap/bootstrap/bootstrap.min.css">
        <link rel="stylesheet"href="<?= base_url() ?>assets/bootstrap/bootstrap/bootstrap-responsive.min.css">
        <link rel="stylesheet"href="<?= base_url() ?>assets/bootstrap/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet"href="<?= base_url() ?>assets/bootstrap/normalize/normalize.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/bootstrap/bootstrap-datepicker/css/datepicker.css">
        <!--page specific css styles-->

        <!--flaty css styles-->
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/flaty.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/flaty-responsive.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/js/select/select2.css">
        <script src="<?= base_url() ?>assets/bootstrap/modernizr/modernizr-2.6.2.min.js"></script>
        <style>
            .dataTables_filter{
                float : right;
            }
        </style>
         <script>window.jQuery || document.write('<script src="<?= base_url() ?>assets/bootstrap/jquery/jquery-1.10.1.min.js"><\/script>')</script> 

<!--        <script src="<?= base_url() ?>assets/js/jquery-3.1.1.js"></script>-->
        
        <script src="<?= base_url() ?>assets/bootstrap/bootstrap/bootstrap.min.js"></script>
        <script src="<?= base_url() ?>assets/bootstrap/nicescroll/jquery.nicescroll.min.js"></script>

        <!--page specific plugin scripts-->
        <script src="<?= base_url() ?>assets/js/select/select2.min.js"></script>
        <script src="<?= base_url() ?>assets/bootstrap/flot/jquery.flot.js"></script>
        <script src="<?= base_url() ?>assets/bootstrap/flot/jquery.flot.resize.js"></script>
        <script src="<?= base_url() ?>assets/bootstrap/flot/jquery.flot.pie.js"></script>
        <script src="<?= base_url() ?>assets/bootstrap/flot/jquery.flot.stack.js"></script>
        <script src="<?= base_url() ?>assets/bootstrap/flot/jquery.flot.crosshair.js"></script>
        <script src="<?= base_url() ?>assets/bootstrap/flot/jquery.flot.tooltip.min.js"></script>
        <script src="<?= base_url() ?>assets/bootstrap/sparkline/jquery.sparkline.min.js"></script>

        <!--<script type="text/javascript" src="<?= base_url() ?>assets/bootstrap/bootstrap-switch/static/js/bootstrap-switch.js"></script>-->
        <script type="text/javascript" src="<?= base_url() ?>assets/bootstrap/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/bootstrap/data-tables/jquery.dataTables.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/bootstrap/data-tables/DT_bootstrap.js"></script>
    </head>

    <body>
        <!-- BEGIN Navbar -->
        <div id="navbar" class="navbar navbar-fixed">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <!-- BEGIN Brand -->
                    <a href="<?= base_url() ?>" class="brand">
                        <small style="font-weight: bold">
                            <i class="icon-pinterest-sign"></i>
                            PT. IRAWAN DJAJA AGUNG
                        </small>
                    </a>
                    <!-- END Brand -->

                    <!-- BEGIN Responsive Sidebar Collapse -->
                    <a href="#" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
                        <i class="icon-reorder"></i>
                    </a>
                    <!-- END Responsive Sidebar Collapse -->

                    <!-- BEGIN Navbar Buttons -->
                    <ul class="nav flaty-nav pull-right">
                      <li>
                        <i class="icon-user"></i>
                        <span><?php echo "Welcome back, ". $this->session->userdata('user_level'); ?></span>
                      </li>
                        <li class="user-profile">
                            <a href="<?= base_url() ?>admin/logout" class="user-menu dropdown-toggle">

                                <i class="icon-power-off"></i>
                                <span class="hidden-phone" id="user_info">
                                    Logout
                                </span>
                            </a>
                        </li>
                        <!-- END Button User -->
                    </ul>
                    <!-- END Navbar Buttons -->
                </div><!--/.container-fluid-->
            </div><!--/.navbar-inner-->
        </div>
        <!-- END Navbar -->

        <!-- BEGIN Container -->
        <div class="container-fluid" id="main-container">
            <!-- BEGIN Sidebar -->
            <?php
            if($this->session->userdata('sidebar')=="hide"){
                $sidebar=array("sidebar-collapsed","right");
            }else{
                $sidebar=array("","left");
            }
            ?>
            <div id="sidebar" class="nav-collapse <?=$sidebar[0]?>">
                <?php
                $menu['level']=$level;
                $this->load->view("sidebar", $menu);
                ?>
                <!-- BEGIN Sidebar Collapse Button -->
                <div id="sidebar-collapse" class="visible-desktop">
                    <i onclick="sidebar()" class="icon-double-angle-left"></i>
                </div>
                <!-- END Sidebar Collapse Button -->
            </div>
            <!-- END Sidebar -->
            <!-- BEGIN Content -->
            <div id="main-content" style="min-height: 750px">
                <?php $this->load->view("$content_name", $content_data); ?>
		<footer>
		<p>PT. IRAWAN DJAJA AGUNG &copy 2016</p>
		</footer>
        <a id="btn-scrollup" class="btn btn-circle btn-large" href="#"><i class="icon-chevron-up"></i></a>
            </div>
        </div>
    </div>
    <!-- END Content -->
</div>
<!-- END Container -->


<!--basic scripts-->
<!--<script src="<?= base_url() ?>assets///ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>-->


<!--flaty scripts-->
<script>
$("select").select2();
function sidebar(){
    $.get('<?=base_url()."service/sidebar"?>',function(data,status){});
}
$.get('<?=base_url()."backup.php"?>',function(data,status){});

</script>
<link href="<?= base_url() ?>assets/js/jquery-ui/jquery-ui-1.8.4.custom.css" rel="stylesheet">
<script src="<?= base_url() ?>assets/js/jquery-ui-1.10.4.custom.min.js"></script>

<script src="<?= base_url() ?>assets/js/flaty.js"></script>

</body>
</html>
