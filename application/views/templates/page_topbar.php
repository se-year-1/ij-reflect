<!--Top bar-->
<div class="navbar navbar-default navbar-fixed-top ij-topbar">
    <div class="container-fluid ij-navbar">
        <!--Header Topbar-->
        <div class="navbar-header" id="tp-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand ij-reflect-brand" style="color: cornflowerblue" href="<?php echo base_url() ?>">IJ-Reflect</a>
        </div>
        <div class="collapse navbar-collapse">
            <!--Left Side Topbar-->
            <ul class="nav navbar-nav nav-menu">
                <?php $user_level = $this->session->userdata('level'); ?>
                <?php if ($user_level == 1) : ?>
                    <li><a class="menubutton <?= $this->uri->segment(1) == "reflectie" ? "activelink" : "" ?>" style="color: #666666" href="<?php echo base_url() ?>reflectie/pre"><span style="color: #66BB6A" class="glyphicon glyphicon-pencil"></span><span class="hidden-sm"> Nieuwe Reflectie</span></a></li>
                    <li><a class="menubutton <?= $this->uri->segment(1) == "huidige_periode" ? "activelink" : "" ?>" style="color: #666666" href="<?php echo base_url() ?>huidige_periode"><span style="color: #0288D1" class="glyphicon glyphicon-list"></span><span class="hidden-sm"> Huidige Periode</span></a></li>
                    <li><a class="menubutton <?= $this->uri->segment(1) == "voltooide_periodes" ? "activelink" : "" ?>" style="color: #666666" href="<?php echo base_url() ?>voltooide_periodes"><span style="color: #8D6E63" class="glyphicon glyphicon-book"></span><span class="hidden-sm hidden-md"> Voltooide Periodes</span></a></li>
                    <li><a class="menubutton <?= $this->uri->segment(1) == "grafieken" ? "activelink" : "" ?>" style="color: #666666" href="<?php echo base_url() ?>grafieken"><span style="color: #DAB377" class="glyphicon glyphicon-stats"></span><span class="hidden-sm hidden-md"> Vergelijken</span></a></li>
                <?php endif; ?>
                <?php if ($user_level == 2) : ?>
                    <li><a class="menubutton <?= $this->uri->segment(1) == "reflectiebeheer" ? "activelink" : "" ?>" style="color: #666666" href="<?php echo base_url() ?>reflectiebeheer"><span style="color: #607D8B" class="glyphicon glyphicon-pencil"></span><span class="hidden-sm"> Beheer reflectiemodel</span></a></li>
                    <li><a class="menubutton <?= $this->uri->segment(1) == "totalen" ? "activelink" : "" ?>" style="color: #666666" href="<?php echo base_url() ?>totalen"><span style="color: #607D8B" class="glyphicon glyphicon-list-alt"></span><span class="hidden-sm"> Bekijk totalen</span></a></li>
                <?php endif; ?>
            </ul>
            <!--Right Side Topbar-->
            <ul class="nav navbar-nav navbar-right">

                <?php if (NULL !== $this->session->userdata('email')) : ?>
                    <li class="navbar-text" style="height: 22px">
                        <img id="tp-icon" src="<?= $this->session->userdata('picture') . "?sz=50"; ?>"></img>
                        <?= $this->session->userdata('email'); ?>
                    </li>
                    <li>
                        <!--Logout button-->
                        <a class='btn btn-default-outline' href='https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=<?php echo base_url(); ?>user_authentication/logout'>Log uit <span class="glyphicon glyphicon-log-out"></span></a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>