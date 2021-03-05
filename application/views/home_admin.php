<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container-fluid ij-heading" id="ij-heading-home">
    <h1>Welkom op de IJ-Reflect website, <?= $this->session->userdata('givenName') ?>!</h1>
</div>

<div class="ij-body">
    <div class="container text-center" id="hma_content">
        <?php
        if ($this->session->userdata('message')) :
            echo '<div class="alert alert-danger"><p class="lead">';
            echo $this->session->userdata('message');
            echo '</p></div>';
        endif;
        ?>
        <p class="lead">U bent ingelogd als administrator.</p>
        <p class="lead">Klik op <a id="hm-line-admin" href="<?php echo base_url() ?>reflectiebeheer"><span id="home-start"><span class="glyphicon glyphicon-pencil"></span> Beheer reflectiemodel</span></a> om het reflectiemodel te bewerken.</p>
    </div>
</div>