<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div id="ij-heading-reflectiebeheer" class="container-fluid ij-heading banner">
    <h1>Voeg categorie toe</h1>
</div>

<div class='ij-body'>
    <div class='container'>
        <div class="form-group col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-4">
            <?php
            if (validation_errors() != false) {
                echo '<div class="alert alert-danger">';
                echo "<p><b>Actie kan niet worden voltooid: </b></p>";
                echo validation_errors();
                echo '</div>';
            }
            ?>
            <?php
            echo form_open('');
            $name_data = array(
                'name' => 'name',
                'class' => 'form-control',
                'placeholder' => 'Naam categorie',
                'maxlength' => '45',
                'value' => set_value('name'),
            );
            echo form_input($name_data);
            $description_data = array(
                'name' => 'description',
                'class' => 'form-control',
                'placeholder' => 'Beschrijving',
                'maxlength' => '1000',
                'value' => set_value('description'),
            );
            echo "<br>";
            echo form_textarea($description_data);

            $submit_data = array(
                'name' => 'submit',
                'class' => 'btn btn-default',
                'value' => 'Voeg categorie toe'
            );
            echo "<br>";
            echo form_submit($submit_data);
            echo form_close();
            ?>
        </div>
    </div>
</div>