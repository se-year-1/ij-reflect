

<div id="ij-heading-post" class="container-fluid ij-heading">
    <h1>Overzicht</h1>
</div>

<div class="ij-body">

    <div class="container">
        <?php if ($iscompleted == 0) : ?>

            <div id="is-not-completed" class="container h3 alert alert-danger">
                <strong>Let op!</strong> Reflectie is niet volledig ingevuld
            </div>
            <div>
                <?php
                echo form_open('reflectie/reflectie_init');
                echo form_hidden('starting_datetime', $starting_datetime);
                echo form_hidden('respondent', $respondent);
                echo form_hidden('name_respondent', $name_respondent);
                ?> 
                <button type="submit" class="btn btn-warning actionbutton" id="prv-editbutton">
                    <i class="glyphicon glyphicon-triangle-left"></i>Terug naar de reflectie
                </button>
                <?php
                echo form_close();
                ?>
            </div>
        <?php else : ?> 
            <div>
                <a href="<?= base_url() ?>huidige_periode/index"><button class="btn actionbutton" id="prv-overzichtbutton">
                        naar Huidige Periode<i class="glyphicon glyphicon-triangle-right"></i>
                    </button></a>
            </div>

        <?php endif; ?>
    </div>


    <div class='container'>
        <table id="reflectie-huidigeperiode-tabel" class='table container-fluid'>
            <thead>
                <tr>
                    <th class="h4">Categorie</th>
                    <th class="h4">Vraag</th>
                    <th class="h3">Jouw antwoord</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($formdata)) :
                    $last_id = $formdata[0]->categoryid;
                    foreach ($formdata as $value) :
                        ?>

                        <!-- Different gray scales -->
                        <?php
                        $style_color;
                        if ($value->categoryid % 2 == 0) {
                            $style_color = '#ECEFF1';
                        } else {
                            $style_color = '#FAFAFA';
                        }
                        ?>

                        <tr <?php
                        if ($value->categoryid != $last_id) {
                            echo 'style="border-top: 2px solid #BDBDBD;"';
                        }
                        ?>>
                            <td class="text-muted" style="background-color: <?php echo $style_color ?>"><?php echo $value->categoryname; ?></td>
                            <td><?php echo $value->questiondescription; ?></td>
                            <td><strong><?php echo $value->gradationdescription ?></strong></td>
                        </tr>

                        <?php
                        $last_id = $value->categoryid;
                    endforeach;
                endif;
                ?>
            </tbody>
        </table>
    </div>
</div>
