<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div id="ij-heading-reflectiebeheer" class="container-fluid ij-heading banner">
    <h1>Bekijk totalen</h1>
</div>

<div class = "ij-body">
    <!--Period info-->
    <div class = "container-fluid">
        <div class = "container text-center">
            <h3>Totaal ingevulde reflecties per respondent</h3>
            <br>
            <div id = "reflection-count">
                <ul class = "list-group">
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
    </div>
</div>
