<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div id="ij-heading-reflectiebeheer" class="container-fluid ij-heading banner">
    <h1>Bewerk vraag</h1>
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
            echo form_hidden("id", $question[0]->id);

            $name_data = array(
                'name' => 'description',
                'class' => 'form-control',
                'placeholder' => 'Vraag',
                'maxlength' => '45',
                'value' => $question[0]->description,
            );
            echo "<div class='form-group'>";
            echo "<label>Naam van de vraag</label>";
            echo form_input($name_data);
            echo "</div>";

            $dropdown_data = array(
                'class' => 'form-control',
                'id' => 'categorie_select',
            );
            $dropdown_options = array();
            $dropdown_options['0'] = '---selecteer een categorie---';
            foreach ($categories as $category) {
                $dropdown_options[$category->id] = $category->name;
            }

            echo "<div class='form-group'>";
            echo "<label>Categorie waarbij de vraag hoort</label>";
            echo form_dropdown('idcategory', $dropdown_options, $question[0]->idcategory, $dropdown_data);
            echo "</div>";

            $gradation_1_data = array(
                'name' => 'gradation[1]',
                'rows' => '2',
                'class' => 'form-control',
                'placeholder' => 'Optie 1',
                'maxlength' => '1000',
                'value' => $gradations[0]->description,
            );
            echo "<div class='form-group'>";
            echo "<label>Optie 1</label>";
            echo form_textarea($gradation_1_data);
            echo "</div>";

            $gradation_2_data = array(
                'name' => 'gradation[2]',
                'rows' => '2',
                'class' => 'form-control',
                'placeholder' => 'Optie 2',
                'maxlength' => '1000',
                'value' => $gradations[1]->description,
            );
            echo "<div class='form-group'>";
            echo "<label>Optie 2</label>";
            echo form_textarea($gradation_2_data);
            echo "</div>";

            $gradation_3_data = array(
                'name' => 'gradation[3]',
                'rows' => '2',
                'class' => 'form-control',
                'placeholder' => 'Optie 3',
                'maxlength' => '1000',
                'value' => $gradations[2]->description,
            );
            echo "<div class='form-group'>";
            echo "<label>Optie 3</label>";
            echo form_textarea($gradation_3_data);
            echo "</div>";

            $gradation_4_data = array(
                'name' => 'gradation[4]',
                'rows' => '2',
                'class' => 'form-control',
                'placeholder' => 'Optie 4',
                'maxlength' => '1000',
                'value' => $gradations[3]->description,
            );
            echo "<div class='form-group'>";
            echo "<label>Optie 4</label>";
            echo form_textarea($gradation_4_data);
            echo "</div>";

            $gradation_5_data = array(
                'name' => 'gradation[5]',
                'rows' => '2',
                'class' => 'form-control',
                'placeholder' => 'Optie 5',
                'maxlength' => '1000',
                'value' => $gradations[4]->description,
            );
            echo "<div class='form-group'>";
            echo "<label>Optie 5</label>";
            echo form_textarea($gradation_5_data);
            echo "</div>";

            $submit_data = array(
                'name' => 'submit',
                'class' => 'btn btn-default',
                'value' => 'Sla wijzigingen op'
            );
            echo form_submit($submit_data);

            echo form_close();
            ?>
        </div>
    </div>
</div>