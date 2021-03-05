<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div id="ij-heading-voltooideperiodes" class="container-fluid ij-heading">
    <h1>Voltooide Periodes</h1>
</div>

<div class="ij-body">
    <div class="container text-center help">
        <a class="glyphicon glyphicon-question-sign helpbutton" href="#" 
           data-trigger="click" data-html="true" data-placement="left" data-toggle="popover" 
           title="Voltooide periodes" 
           data-content="Op dit scherm krijg je een overzicht te zien van je voltooide periodes. 
           Je kunt je periodes
           met elkaar vergelijken op het <a href='<?= base_url() . "grafieken" ?>'>vergelijkscherm</a>.
           Je kunt de gegevens van een periode inladen door op het grafiek-icoontje naast een
           periode te klikken."></a>
    </div>
    <!--HELP AND WARNINGS-->
    <?php if (empty($completed_periods)) : ?>
        <div class="alert alert-info container" id="table-dataless-warning">
            <h4>
                <?php if (empty($completed_periods)) : ?>
                    Je hebt nog geen voltooide periodes.
                    <br><br>Klik op 
                    <a id="vl_line" href="<?php base_url(); ?>huidige_periode"><span id="home-start"><span class="glyphicon glyphicon-list"></span> Huidige periode</span></a>
                    om naar je huidige periode te gaan.
                <?php endif; ?>
            </h4>
        </div>
    <?php else : ?>
    <?php endif; ?>
    <!--Feedback warnings etc.-->
    <div class="container feedback-div text-center">
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
    </div>

    <!--Period Table-->
    <div class="container" id="vp-period-table">
        <?php
        foreach ($completed_periods as $period) :
            ?>
            <div class="editgroup" style="margin-bottom: 24px;">
                <div class="t-reflecties-head">
                    <h4 class="text-center t-reflecties-body"><?= $period->name ?></h4>
                </div>
                <table class="table table-hover table-striped table-responsive remove_margin_bottom">
                    <thead>
                        <tr>
                            <th class="table-corner-width"></th>
                            <th class="table-heading">Datum en Tijd</th>
                            <th class="table-heading">Aantal Reflecties</th>
                            <th class="actie_column">Acties</th>
                        </tr>
                    </thead>
                    <tbody class="vp-table-body">
                        <tr>
                            <td><button class="btn btn-info collapsable collapsed actionbutton" data-toggle="collapse" data-target="#period<?= $period->id ?>"></button></td>
                            <td><?= $period->datetime ?></td>
                            <td><?= $period->amount ?></td>
                            <td>
                                <button type="button" class="btn btn-danger vp-remove" id="delete-period-button" data-toggle="modal" data-target="#delete-period" data-period_id="<?= $period->id ?>" data-period_name="<?= $period->name ?>" data-period_amount="<?= count($form_history) ?>"><i class="glyphicon glyphicon-trash"></i></button>
                                <button type="button" class="btn btn-warning vp-edit" id="change-period-button" data-toggle="modal" data-target="#set-name" data-period_id="<?= $period->id ?>" data-period_name="<?= $period->name ?>" ><i class="glyphicon glyphicon-edit"></i></button>
                                <a href='<?= base_url() . "grafieken/id/{$period->id}"; ?>' class="btn btn-default actionbutton">
                                    <i class="glyphicon glyphicon-stats"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!--Reflection table-->
                <div id="period<?= $period->id ?>" class="collapse">
                    <?php if ($period->amount == 0) : ?>
                        <div class="alert alert-info container" id="table-warning-sm">
                            <h5>
                                Je hebt geen reflecties in deze voltooide periode.
                                <br><br>Klik op
                                <button type="button" class="btn btn-danger" id="delete-period-button" data-toggle="modal" data-target="#delete-period" data-period_id="<?= $period->id ?>" data-period_name="<?= $period->name ?>" data-period_amount="<?= count($form_history) ?>"><i class="glyphicon glyphicon-trash"></i></button>
                                om deze lege periode te verwijderen.
                            </h5>
                        </div>
                    <?php else : ?>
                        <table class="table table-hover table-striped table-responsive" id="reflection-table">
                            <div class="t-reflecties-head2">
                                <h5 class="text-center t-reflecties-body2">Reflecties van deze periode</h5>
                            </div>
                            <thead class="my-tablehead">
                                <tr>
                                    <th class="table-corner-width"></th>
                                    <th class="table-heading">Datum en Tijd</th>
                                    <th class="table-heading">Respondent</th>
                                    <th class="table-heading">Naam Respondent</th>
                                    <th class="actie_column">Acties</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($form_history as $object) :
                                    if ($object->period_id == $period->id) :
                                        ?>
                                        <tr>
                                            <td class="table-corner-width"></td>
                                            <td><p><?php echo $object->datetime ?></p></td>
                                            <td><p><?php echo $object->respondent ?></p></td>
                                            <td><p><?php echo $object->name_respondent ?></p></td>
                                            <td class="no-border-cell">
                                                <button type="button" class="btn btn-default btn-danger btn-sm" data-toggle="modal" data-target="#delete-reflection" data-datetime="<?= $object->datetime ?>"><i class="glyphicon glyphicon-trash"></i></button> 
                                            </td>
                                        </tr>
                                        <?php
                                    endif;
                                endforeach;
                                ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>

            </div>
        <?php endforeach; ?>
    </div>


    <!--Change name modal-->
    <div class="container">
        <div class="modal fade" id="set-name" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Verander huidige periode naam</h4>
                    </div>
                    <div class="modal-body text-center">
                        <h3>Nieuwe periode naam: </h3>

                        <form id="change-name-form" action="#" method="post" accept-charset="utf-8">
                            <input id="change-name-input" type="text" name="period_name" value="#" class="form-control text-center input-lg" placeholder="Naam periode">
                        </form>
                    </div>
                    <div class="modal-footer text-center">
                        <button type="submit" form="change-name-form" class="btn btn-default btn-primary btn-lg">OK</button>
                        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Annuleren</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Delete period modal-->
    <div class="container">
        <div class="modal fade" id="delete-period" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Periode verwijderen</h4>
                    </div>
                    <div class="modal-body text-center" id="modal-body-period">
                        <h3>Weet je zeker dat je de periode<br><br>'<b class="text-danger" id="b1"></b>'<br><br>wil verwijderen?<br><br></h3>
                    </div>
                    <div class="modal-footer text-center">
                        <a href="#" id="del-period-modal-btn"><button class="btn btn-lg btn-danger">
                                <i class="glyphicon glyphicon-trash"></i> Verwijder periode
                            </button></a>
                        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Annuleren</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Delete reflection modal-->
    <div class="container">
        <div class="modal fade" id="delete-reflection" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Reflectie verwijderen</h4>
                    </div>
                    <div class="modal-body text-center">
                        <h3 class="text-danger">Weet je zeker dat je deze reflectie wil verwijderen?</h3>
                    </div>
                    <div class="modal-footer text-center">
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
        a.href = "<?= base_url() ?>voltooide_periodes/delete_form_history/" + datetime;
    });

    $(document).ready(function () {
        $('[data-toggle="popover"]').popover();
    });

    $('#delete-period').on('show.bs.modal', function (e) {
        var period_id = e.relatedTarget.dataset.period_id;
        var period_name = e.relatedTarget.dataset.period_name;
        var period_amount = e.relatedTarget.dataset.period_amount;

        var a = document.getElementById('del-period-modal-btn');
        a.href = "<?= base_url() ?>voltooide_periodes/delete_period/" + period_id;

        $("#modal-body-period #b1").text(period_name);
        $("#modal-body-period #b2").text(period_amount);
    });

    $('#set-name').on('show.bs.modal', function (e) {
        var period_name = e.relatedTarget.dataset.period_name;
        var period_id = e.relatedTarget.dataset.period_id;

        var changeNameInput = document.getElementById('change-name-input');
        changeNameInput.value = period_name;

        var changeFormAction = document.getElementById('change-name-form');
        changeFormAction.action = "<?= base_url() ?>voltooide_periodes/update_period_name/" + period_id;
    });
</script>