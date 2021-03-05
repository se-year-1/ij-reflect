<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div id="ij-heading-pre" class='container-fluid ij-heading'>
    <h1>Kies de persoon die de reflectie voor jou invult</h1>
</div>

<div class="ij-body">
    <div class="container text-center help">
        <a class="glyphicon glyphicon-question-sign helpbutton" href="#" 
           data-trigger="click" data-html="true" data-placement="left" data-toggle="popover" 
           title="Reflectie" 
           data-content="Een reflectie gaat zoals je het gewend bent. Je krijgt een
           stelling te zien en vervolgens kun je het antwoord kiezen dat bij je past. Je
           kunt een overzicht van je reflecties voor deze periode zien in het
           <a href='<?= base_url() . "huidige_periode" ?>'>Huidige periodescherm</a>"></a>
    </div>
    <div class="container text-center" id="prv-content">
        <?php echo form_error('name_respondent', '<div id="is-not-completed" class="h3 text-danger">', '</div>'); ?>
        <?php
        echo form_open('reflectie/reflectie_init');

        $options = array(
            'Ikzelf' => 'Ikzelf',
            'Medeleerling' => 'Een medeleerling',
            'Expert' => 'Een expert',
            'Ouder/Verzorger' => 'Een ouder/verzorger'
        );
        ?>

        <div class="form-group col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-4">
            <label for="respondent" class="h3">Wie vult het voor je in?</label>
            <br>
            <?= form_dropdown('respondent', $options, set_value('respondent'), 'class="form-control input-lg" onchange="autofill_name(\'' . $this->session->userdata('name') . '\')" id="respondent"'); ?>
        </div>

        <div class="form-group col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-4">
            <label for="name_respondent" class="h3">Vul zijn/haar naam in:</label>

            <?= form_input('name_respondent', '', 'class="form-control text-center input-lg" placeholder="Naam respondent" id="name_respondent"'); ?>
        </div>

        <?php
        $starting_datetime = date('Y-m-d H:i:s');
        echo form_hidden('starting_datetime', $starting_datetime);
        ?>
    </div>
</div>
<div class="container text-center">
    <?php
    echo form_submit('start', 'Start de reflectie', 'class="btn btn-lg btn-success"');
    ?>
</div>
</div>  
<script>
    window.onload = autofill_name('<?php echo $this->session->userdata('name') ?>');

    $(document).ready(function () {
        $('[data-toggle="popover"]').popover();
    });
</script>