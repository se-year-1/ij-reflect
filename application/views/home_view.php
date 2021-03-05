<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div id="ij-heading-home" class="container-fluid ij-heading">
    <h1>Welkom op de IJ-Reflect website, <?= $this->session->userdata('givenName') ?>!</h1>
</div>

<div class="ij-body">
    <div class="container text-center" id="hm_content">
        <?php
        if ($this->session->userdata('message')) :
            echo '<div class="alert alert-danger"><p class="lead">';
            echo $this->session->userdata('message');
            echo '</p></div>';
        endif;
        ?>
        <p class="lead">Klik op <a id="hm_line" href="<?php echo base_url() ?>reflectie/pre"><span id="home-start"><span class="glyphicon glyphicon-pencil"></span> Nieuwe Reflectie</span></a> in de menubalk om te beginnen.</p>
    </div>
</div>