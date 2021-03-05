<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div id="ij-heading-reflectiebeheer" class="container-fluid ij-heading banner">
    <h1>Categorieën</h1>
</div>

<div class='ij-body'>
    <div class='container'>
        <a onclick="window.history.back();" class="btn btn-default">Ga terug</a>
        <br><br>
        <?php
        $form_edit_attributes = array('class' => 'actionbuttonform');
        $form_remove_attributes = array('class' => 'actionbuttonform confirm_dialog',
            'data-confirm' => 'Weet je zeker dat je deze categorie wilt verwijderen?');
        ?>
        <div class="editgroup">
            <table class="table manage-content table-hover table-striped table-responsive">
                <thead>
                    <tr>
                        <th>Naam</th>
                        <th>Beschrijving</th>
                        <th class="actie_column">Acties</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($categories as $category) :
                        ?>
                        <tr>
                            <td>
                                <a href="<?= base_url() ?>reflectiebeheer/questions/<?= $category->id ?>">
                                    <?= $category->name ?>
                                </a>
                            </td>
                            <td><?= $category->description ?></td>
                            <td>
                                <a href='<?= base_url() . "reflectiebeheer/category_modify/{$category->id}"; ?>' class="btn btn-warning actionbutton">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </a>
                                <?= form_open("reflectiebeheer/delete_category/{$category->id}", $form_remove_attributes); ?>
                                <button type="submit" class="btn btn-danger actionbutton">
                                    <i class="glyphicon glyphicon-remove"></i>
                                </button>
                                <?= form_close(); ?>
                            </td>
                        </tr>
                        <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script> window.onload = deleteConfirm();</script>