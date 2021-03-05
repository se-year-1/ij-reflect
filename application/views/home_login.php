<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container-fluid ij-heading" id="ij-heading-home">
    <h1>Welkom op de IJ-Reflect website!</h1>
</div>
<div class="ij-body">
     <div class="container text-center" id="hml_content">
        <?php
        if ($this->session->userdata('message')) :
            echo '<div class="alert alert-danger"><p class="lead">';
            echo $this->session->userdata('message');
            echo '</p></div>';
        endif;
        ?>
        <p class="lead">
            Om gebruik te maken van de IJ-Reflect website, heb je een Google account nodig. <br>
        </p>
        <a class="btn btn-social btn-google-plus" href="<?php echo base_url() . 'user_authentication' ?>">
            <i class="fa fa-google-plus"></i> Log in met Google
        </a>

    </div>

    <div class="container text-center" id="hml_line">
        IJ-Reflect is eigendom van het IJburg College.
        <a href="<?php echo base_url() . 'overons' ?>">Meer informatie</a>
    </div>
</div>