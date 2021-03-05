<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div id="ij-heading-huidigeperiode" class="container-fluid ij-heading">
    <h1>Huidige Periode</h1>
</div>

<div class="ij-body">
    <div class="container text-center help">
        <a class="glyphicon glyphicon-question-sign helpbutton" href="#" 
           data-trigger="click" data-html="true" data-placement="left" data-toggle="popover" 
           title="Huidige periode" 
           data-content="Op dit scherm zie je een overzicht van de reflecties in de periode
           waar je nu in werkt.
           Je kunt hier je periode afsluiten en beginnen aan een nieuwe periode als je vindt
           dat je genoeg reflecties hebt verzameld. Je kunt een overzicht van al je
           periodes bekijken op het <a href='<?= base_url() . "voltooide_periodes" ?>'>Voltooide periodesscherm</a>"></a>
    </div>
    <!--Period info-->
    <div class="container-fluid" id="periode-info-div">
        <div class="container text-center" id="periode-info">

            <div class="well" id="period-naam">

                <?php
                if ($this->session->flashdata('success_message')) :
                    echo '<div class="alert alert-success hpv-alert">';
                    echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                    echo $this->session->flashdata('success_message');
                    echo '</div>';
                endif;
                ?>
                <?php
                if ($this->session->flashdata('error_message')) :
                    echo '<div class="alert alert-danger hpv-alert">';
                    echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                    echo $this->session->flashdata('error_message');
                    echo '</div>';
                endif;
                ?>
                <h3><?= $active_period->name ?> 
                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#set-name"><i class="glyphicon glyphicon-edit"></i></button>
                </h3>

                <!--More information-->
                <button type="button" class="btn btn-sm btn-info collapsable collapsed" data-toggle="collapse" data-target="#period-info-collapse">Meer informatie</button>
                <div class="collapse" id="period-info-collapse">
                    <div>
                        <h5>Startdatum periode:</h5>  
                        <?= $active_period->datetime ?>
                    </div>
                    <!--Respondent Counter-->
                    <h5>Aantal respondenten in deze periode:</h5>
                    <div id="reflection-count">
                        <ul class="list-group">
                            <?php
                            echo '<li class="list-group-item"><b>Totaal </b><span class="badge">' . count($form_history) . '</span></li>';
                            ?> 
                            <?php
                            foreach ($respondent_count as $key => $value) {
                                echo '<li class="list-group-item">' . $key . '<span class="badge">' . $value . '</span></li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>

                <!--Change name modal-->
                <div class="container">
                    <div class="modal fade" id="set-name" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header ij-modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Verander huidige periode naam</h4>
                                </div>
                                <div class="modal-body ij-modal-body">
                                    <h3>Nieuwe periode naam: </h3>
                                    <?php
                                    echo form_open('huidige_periode/update_period_name');

                                    $attr = array(
                                        'class' => 'form-control text-center input-lg',
                                        'placeholder' => 'Naam periode'
                                    );
                                    echo form_input('period_name', $active_period->name, $attr);
                                    ?>
                                </div>
                                <div class="modal-footer ij-modal-footer">
                                    <button type="submit" class="btn btn-default btn-lg btn-primary">OK</button>
                                    <?= form_close() ?>
                                    <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Annuleren</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-default" id="voltooi-periode-modal-btn" data-toggle="modal" data-target="#complete-period"><i class="glyphicon glyphicon-book"></i> Sluit huidige periode af</button>
            <!--Complete period modal-->
            <div class="container">
                <div class="modal fade" id="complete-period" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Huidige periode afsluiten</h4>
                            </div>
                            <div class="modal-body">
                                <h3 class="text-danger">Weet je zeker dat je de huidige periode wil afsluiten?</h3>
                                <div class="well">
                                    <h4>Er kunnen geen nieuwe reflecties meer aan deze periode worden toegevoegd wanneer je deze afsluit.</h4>
                                    <h4>Check of alle reflecties die je nodig hebt in de huidige periode staan!</h4>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <!--Complete button-->
                                <div class="container-fluid text-center col-sm-12" >
                                    <a href="<?= base_url() ?>huidige_periode/complete_period"><button class="btn actionbutton" id="voltooi-periode-btn">
                                            <i class="glyphicon glyphicon-book"></i> Sluit huidige periode af
                                        </button></a>
                                    <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Annuleren</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!--Reflection Table-->
    <?php if (empty($form_history)) : ?>
        <div class="alert alert-info container" id="table-dataless-warning">
            <h4>
                Je hebt nog geen reflecties aangemaakt voor deze periode.<br><br>Klik op 
                <a id="hm_line" href="<?php echo base_url(); ?>reflectie/pre"><span id="home-start"><span class="glyphicon glyphicon-pencil"></span> Nieuwe Reflectie</span></a>
                om er een aan te maken.
            </h4>
        </div>
    <?php else : ?>
        <div class="container-fluid" id="hpv-table-div">
            <div class='container table-responsive'>
                <div class="h2 text-center">
                    Reflecties van deze periode
                </div>
                <table id="reflectie-huidigeperiode-tabel" class='table table-striped'>
                    <thead>
                        <tr>
                            <th class="h3">Datum en Tijd</th>
                            <th class="h3">Respondent</th>
                            <th class="h3">Naam Respondent</th>
                            <th class="h3">Voortgang</th>
                            <th class="h3 no-border-cell"></th>
                            <th class="h3 no-border-cell"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($form_history as $object) : ?>
                            <tr>
                                <td><p><?php echo $object->datetime ?></p></td>
                                <td><p><?php echo $object->respondent ?></p></td>
                                <td><p><?php echo $object->name_respondent ?></p></td>
                                <td width="40%"><?php if ($object->completed == 1): ?>
                                        <p class="bg-success well-sm">Voltooid</p>
                                    <?php else : ?>
                                        <p class="bg-danger well-sm"><?php echo round($object->percentage_done, 1) . '% voltooid' ?></p>
                                    <?php endif; ?>
                                </td>
                                <td class="no-border-cell"><?php
                                    if (!$object->completed == 1) :
                                        echo form_open('reflectie/reflectie_init');
                                        echo form_hidden('starting_datetime', $object->datetime);
                                        echo form_hidden('respondent', $object->respondent);
                                        echo form_hidden('name_respondent', $object->name_respondent);

                                        $attributes = array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-lg btn-warning glyph-align',
                                            'onclick' => 'this.form.submit()'
                                        );
                                        echo form_button('start', '<span class="glyphicon glyphicon-edit"></span>', $attributes);
                                        echo form_close();
                                    endif;
                                    ?>
                                </td>
                                <td class="no-border-cell">
                                    <button type="button" class="btn btn-default btn-lg btn-danger" data-toggle="modal" data-target="#delete-reflection" data-datetime="<?= $object->datetime ?>"><i class="glyphicon glyphicon-trash"></i></button> 
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
    <!--Delete reflection modal-->
    <div class="container">
        <div class="modal fade" id="delete-reflection" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Reflectie verwijderen</h4>
                    </div>
                    <div class="modal-body">
                        <h3 class="text-danger">Weet je zeker dat je deze reflectie wil verwijderen?</h3>
                    </div>
                    <div class="modal-footer">
                        <!--Complete button-->
                        <div class="container-fluid text-center col-sm-12" >
                            <a href="#" id="modal-url"><button class="btn btn-lg btn-danger">
                                    <i class="glyphicon glyphicon-trash"></i> Verwijder reflectie 
                                </button></a>
                            <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Annuleren</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#delete-reflection').on('show.bs.modal', function (e) {
        var datetime = e.relatedTarget.dataset.datetime;
        var a = document.getElementById('modal-url');
        a.href = "<?= base_url() ?>huidige_periode/delete_form_history/" + datetime;

    });

    $(document).ready(function () {
        $('[data-toggle="popover"]').popover();
    });
</script>