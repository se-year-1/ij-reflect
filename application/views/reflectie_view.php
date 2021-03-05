<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!--Category-->
<div class="container-fluid ij-heading-sm" id="ij-heading-reflectie">
    <?php echo '<h1>' . $category[0]->name . '</h1>'; ?>
    <button type="button" class="btn btn-info collapsable collapsed" data-toggle="collapse" data-target="#rv-category">Toelichting</button>
    <div class="collapse container" id="rv-category">
        <br>
        <?php echo $category[0]->description; ?>
    </div>
</div>

<!--Reflection display-->
<div class="ij-body-sm">
    <!--Question-->
    <div id="rv-question" data-spy="affix" data-offset-top="164">
        <div class="container-fluid">
            <?php echo '<h3>' . $question[0]->description . '</h3>'; ?>
        </div>
    </div>

    <!--Gradations-->
    <div class="container-fluid">
        <?php
        if (count($forminfo['formdata']) != $forminfo['current_question_index'] + 1) {
            echo form_open('reflectie/q/' . $forminfo['next_question']->categoryid . '/' . $forminfo['next_question']->questionid);
        } else {
            echo form_open('reflectie/result/');
        }
        ?>

        <div class="container text-center gradation-container" id="rv-gradations">
            <!--Left gradation-->
            <div class="col-xs-3" id="rv-gradationleft">
                <div id="rv-gradationleft-sub">
                    <?= $gradations[0]->description ?>
                </div>
            </div>

            <!--Radio buttons-->
            <div class="col-xs-6" id="rv-gradationlabels">
                <?php foreach ($gradations as $gradation) : ?>
                    <span class="gradation">
                        <?php
                        if ($gradation->gradationlevel == $forminfo['selected_gradation_level']) {
                            echo form_radio(['name' => 'gradation', 'id' => $gradation->gradationlevel, 'value' => $gradation->gradationlevel, 'checked' => true]);
                        } else {
                            echo form_radio(['name' => 'gradation', 'id' => $gradation->gradationlevel, 'value' => $gradation->gradationlevel]);
                        }
                        ?>
                        <label class="btn btn-default ij-label <?= $gradation->gradationlevel == 1 || $gradation->gradationlevel == 5 ? 'ij-label-dark' : ($gradation->gradationlevel == 3 ? 'ij-label-light' : 'ij-label-medium') ?>" id="ij-label-id<?= $gradation->gradationlevel ?>" <?= ($gradation->gradationlevel == $forminfo['selected_gradation_level']) ? 'id="rv-checked"' : 0 ?> data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="<?= ($gradation->gradationlevel == 1 || $gradation->gradationlevel == 5) ? '' : $gradation->description ?>" <?= 'for="' . $gradation->gradationlevel . '"'; ?>>
                        </label>
                    </span>
                <?php endforeach; ?>
            </div>

            <!--Right gradation-->
            <div class="col-xs-3" id="rv-gradationright">
                <div id="rv-gradationright-sub">
                    <?= $gradations[4]->description ?>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <!--            Progress bar
                        <div class="container">
                            <div class="progress">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="70" 
                                     aria-valuemin="0" aria-valuemax="100" 
                                     style="width:<?php echo round($forminfo['percentage_done'], 1) ?>%">
            <?php echo round($forminfo['percentage_done'], 1) . '% Beantwoord'; ?>
                                </div>
                            </div>
                        </div>-->
        </div>
    </div>
</div>

<!--Navigation-->
<div class="container text-center" id="rv-navigation">

    <!--Next button-->
    <span class="col-md-3">
        <?php if (count($forminfo['formdata']) != $forminfo['current_question_index'] + 1) : ?> 
            <button type="submit" class="btn btn-lg btn-primary" id="next-button">
                volgende vraag<i class="glyphicon glyphicon-triangle-right"></i>
            </button>                
            <?php
        else :
            ?>
            <button type="submit" class="btn btn-lg btn-danger" id="next-button">
                resultaat<i class="glyphicon glyphicon-triangle-right"></i>
            </button>    
        <?php
        endif;
        echo form_close();
        ?>
    </span>

    <!--Pagination-->
    <div class="col-md-6" id="rv-pagination">
        <ul class="pagination">
            <?php foreach ($forminfo['formdata'] as $key => $value) : ?>
                <li 
                <?php
                if ($key == $forminfo['current_question_index']) {
                    echo 'class="ij-page-selected"';
                }
                ?>
                    ><a 
                        <?php
                        if ($value->gradation != 0) {
                            echo 'class="ij-page-answered"';
                        }
                        ?>
                        href="<?= base_url() . 'reflectie/q/' . $value->categoryid . '/' . $value->questionid ?>"><?= $key + 1 ?></a></li>
                <?php endforeach; ?>
        </ul>
    </div>

    <!--Previous button-->
    <span class="col-md-3">
        <?php
        if (!empty($forminfo['previous_question']) && $forminfo['current_question_index'] != 0) :
            echo form_open('reflectie/q/' . $forminfo['previous_question']->categoryid . '/' . $forminfo['previous_question']->questionid);
            ?>    
            <button type="submit" class="btn btn-lg btn-primary" id="previous-button">
                <i class="glyphicon glyphicon-triangle-left"></i>vorige vraag
            </button>
            <?php
            echo form_close();
        endif;
        ?>
    </span>


</div>
<!--Question progress-->
<!--<div class="container" id="rv-questionprogress" >
<?php
echo 'Vraag ' . ($forminfo['current_question_index'] + 1) . ' van de ' . count($forminfo['formdata']);
?>
</div>-->

<script>
    $(document).ready(function () {
        $('[data-toggle="popover"]').popover();

        $("#1").click(function () {
            $('#rv-gradationleft-sub').addClass("highlighted");
            $('#rv-gradationright-sub').removeClass("highlighted");
        });

        $("#ij-label-id1").hover(function () {
            $('#rv-gradationleft-sub').addClass("semi-highlighted");
        }, function () {
            $('#rv-gradationleft-sub').removeClass("semi-highlighted");
        });

        $("#2, #3, #4").click(function () {
            $('#rv-gradationleft-sub').removeClass("highlighted");
            $('#rv-gradationright-sub').removeClass("highlighted");
        });

        $("#5").click(function () {
            $('#rv-gradationleft-sub').removeClass("highlighted");
            $('#rv-gradationright-sub').addClass("highlighted");
        });

        $("#ij-label-id5").hover(function () {
            $('#rv-gradationright-sub').addClass("semi-highlighted");
        }, function () {
            $('#rv-gradationright-sub').removeClass("semi-highlighted");

        });
    });
</script>