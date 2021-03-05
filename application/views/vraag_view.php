<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div id="ij-heading-reflectiebeheer" class="container-fluid ij-heading banner">
    <h1>Vragen van categorie: <?= $category[0]->name ?></h1>
</div>

<div class='ij-body'>
    <div class='container'>
        <a onclick="window.history.back();" class="btn btn-default">Ga terug</a>
        <button class="btn btn-info collapsed actionbutton" data-toggle="collapse" data-target=".question">Klap alles uit</button>
        <br><br>
        <?php
        $form_edit_attributes = array('class' => 'actionbuttonform');
        $form_remove_attributes = array('class' => 'actionbuttonform confirm_dialog',
            'data-confirm' => 'Weet je zeker dat je deze vraag wilt verwijderen?');
        ?>
        <?php
        foreach ($questions as $question) :
            ?>
            <div class="editgroup" style="margin-bottom: 24px;">
                <table class="table table-hover table-striped table-responsive remove_margin_bottom">
                    <thead>
                        <tr>
                            <th id="question_width"></th>
                            <th>Vraag</th>
                            <th class="actie_column" style="width: 100px;">Acties</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <button class="btn btn-info collapsable collapsed actionbutton" data-toggle="collapse" data-target="#question<?= $question->id ?>"></button>
                            </td>
                            <td><?= $question->description ?></td>
                            <td>
                                <a href='<?= base_url() . "reflectiebeheer/question_modify/{$question->id}"; ?>' class="btn btn-warning actionbutton">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </a>
                                <?= form_open("reflectiebeheer/delete_question/{$question->id}", $form_remove_attributes); ?>
                                <button type="submit" class="btn btn-danger actionbutton">
                                    <i class="glyphicon glyphicon-remove"></i>
                                </button>
                                <?= form_close(); ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div id="question<?= $question->id ?>" class="question collapse">
                    <table class="table table-hover table-striped table-responsive" style="margin-bottom: 0px;">
                        <thead>
                            <tr>
                                <th style="width: 80px">Keuze</th>
                                <th>Beschrijving</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($question->gradations as $gradation) :
                                ?>
                                <tr>
                                    <td><?= $gradation->gradationlevel ?></td>
                                    <td><?= $gradation->description ?></td>
                                </tr>
                                <?php
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php
        endforeach;
        ?>
    </div>
</div>
<script> window.onload = deleteConfirm();</script>