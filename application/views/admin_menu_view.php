<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div id="ij-heading-reflectiebeheer" class="container-fluid ij-heading banner">
    <h1>Reflectiemodel beheren</h1>
</div>

<div class='ij-body'>
    <div class='container text-center'>
        <?php
        if ($this->session->flashdata('success_message')) :
            echo '<div class="alert alert-success">';
            echo $this->session->flashdata('success_message');
            echo '</div>';
        endif;
        ?>
        <?php
        if ($this->session->flashdata('error_message')) :
            echo '<div class="alert alert-danger">';
            echo $this->session->flashdata('error_message');
            echo '</div>';
        endif;
        ?>

        <h3>Overzicht, bewerken en verwijderen</h3>
        <div class="well admin-menu-well">
            <a href="<?= base_url() . "reflectiebeheer/questions" ?>" class="btn btn-default">Bekijk alle vragen</a>
            <br><br><a href="<?= base_url() . "reflectiebeheer/category" ?>" class="btn btn-default">Bekijk alle categorieën</a>
        </div>
        <h3>Toevoegen</h3>
        <div class="well admin-menu-well">
            <a href="<?= base_url() . "reflectiebeheer/question_add" ?>" class="btn btn-primary">Voeg nieuwe vraag toe</a>
            <br><br><a href="<?= base_url() . "reflectiebeheer/category_add" ?>" class="btn btn-primary">Voeg nieuwe categorie toe</a>
        </div>
    </div>
</div>
</div>