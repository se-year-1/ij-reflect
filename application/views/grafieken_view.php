<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="ij-heading-grafieken" class="container-fluid ij-heading">
    <h1>Vergelijken</h1>
</div>
<form action="">
    <input type="hidden" id="id_period" value="<?= $id_period ?>"/>
    <input type="hidden" id="location" value="<?= base_url() . "grafieken/graphdata" ?>"/>
</form>
<div class="ij-body">
    <div class="container text-center help">
        <a class="glyphicon glyphicon-question-sign helpbutton" href="#" 
           data-trigger="click" data-placement="left" data-toggle="popover" 
           title="Vergelijken" 
           data-content="Op dit scherm kun je jouw prestaties
           in twee periodes met elkaar vergelijken,
           met behulp van radar-diagrammen. Als je een periode hebt afgesloten,
           worden je resultaten omgezet in scores die je hier kunt zien."></a>
    </div>
    <div class="container text-center gv-container">
        <div class="row">
            <div class="col-md-6">
                <div class="gv-chartsection" id="gv-leftsection">
                    <div class="gv-form">
                        <form action="">
                            <?php
                            $dropdown_left_data = array(
                                'id' => 'dropdown_left',
                                'class' => 'form-control',
                            );
                            $dropdown_left_options = array();
                            $dropdown_left_options['0'] = "--Selecteer een periode--";
                            foreach ($periods as $period) {
                                $dropdown_left_options[$period->id] = $period->name . " (" . substr($period->datetime, 0, 10) . ")";
                            }
                            
                            $selected_id = 0;
                            if($id_period !== "") {
                                $selected_id = $id_period;
                            }

                            echo form_dropdown('dropdown_left', $dropdown_left_options, $selected_id, $dropdown_left_data);
                            ?>
                        </form>
                    </div>
                    <div class="gv-chart">
                        <span id="gv-nodata-left">Deze periode heeft geen reflectiegegevens.</span>
                        <canvas id="leftChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="gv-chartsection" id="gv-rightsection">
                    <div class="gv-form">
                        <form action="">
                            <?php
                            $dropdown_right_data = array(
                                'id' => 'dropdown_right',
                                'class' => 'form-control',
                            );
                            $dropdown_right_options = array();
                            $dropdown_right_options['0'] = "--Selecteer een andere periode--";
                            foreach ($periods as $period) {
                                $dropdown_right_options[$period->id] = $period->name . " (" . substr($period->datetime, 0, 10) . ")";
                            }

                            echo form_dropdown('dropdown_right', $dropdown_right_options, 0, $dropdown_right_data);
                            ?>
                        </form>
                    </div>
                    <div class="gv-chart">
                        <span id="gv-nodata-right">Deze periode heeft geen reflectiegegevens.</span>
                        <canvas id="rightChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    /*
     * Contains all chart functions. Commented parts are from the original bar
     * chart
     */
    $(document).ready(function () {
        /*
         * Set up global options
         */

        // Global animation durations
        Chart.defaults.global.animation.duration = 600;
        var showDuration = 200;
        var showDurationSlow = 300;

        // Radar chart
        var typeRadar = "radar";
//        var typeBar = "bar";

        // Options for the radar chart
        var optionsRadar = {
            responsive: true,
            responsiveAnimationDuration: 600,
            maintainAspectRatio: false,
            scale: {
                ticks: {
                    min: 0,
                    max: 100,
                    maxTicksLimit: 3,
                    display: true,
                    beginAtZero: true
                }
            }
        };

//        // Options for the bar chart
//        var optionsBar = {
//            responsive: true,
//            responsiveAnimationDuration: 200,
//            maintainAspectRatio: false,
//            scales: {
//                yAxes: [{
//                        ticks: {
//                            max: 15,
//                            min: -15,
//                            display: true,
//                            // Add a '%' sign to the tick labels
//                            callback: function (value, index, values) {
//                                return (Math.sign(value) === -1 ? "" : "+") + value + "%";
//                            }
//                        }
//                    }],
//                xAxes: [{
//                        stacked: true
//                    }]
//            },
//            legend: {
//                display: true
//            },
//            tooltips: {
//                enabled: true
//            }
//        };

        // Optimization by storing the jQuery selectors in variables
        var $rightsection = $("#gv-rightsection");
//        var $differencesection = $(".gv-difference");

        // Get the value of the hidden id_period field
        var id_period = $("#id_period").val();
        var location = $("#location").val();

        // Selecting the chart canvas elements
        var $ctxLeft = $("#leftChart");
        var $ctxRight = $("#rightChart");
//        var $ctxDifference = $("#differenceChart");

        var $noDataLeft = $("#gv-nodata-left");
        var $noDataRight = $("#gv-nodata-right");

        // Setup of the chart and data variables
        var chartLeft = new myChart($ctxLeft, typeRadar, optionsRadar);
        var chartRight = new myChart($ctxRight, typeRadar, optionsRadar);
//        var chartDifference = new myChart($ctxDifference, typeBar, optionsBar);

        /*
         * Oneliner object to easily switch between and get different graph colors
         */
        var color = {
            // Pointer to point to a color in the colors array
            colorPointer: 0,
            colors: [
                "rgb(191,26,0)",
                "rgb(51,23,13)",
                "rgb(0,166,22)",
                "rgb(57,218,230)",
                "rgb(34,0,255)",
                "rgb(242,190,182)",
                "rgb(229,184,0)",
                "rgb(77,102,94)",
                "rgb(51,112,204)",
                "rgb(204,0,163)"
            ],
            // Move the color array pointer
            movePointer: function () {
                this.colorPointer++;
                if (this.colorPointer === this.colors.length) {
                    this.colorPointer = 0;
                }
            },
            // Get the next color
            getNext: function () {
                this.movePointer();
                return this.colors[this.colorPointer];
            },
            // Get the current color with decreased opacity
            getOpaque: function () {
                return this.colors[this.colorPointer]
                        .replace(')', ', 0.16)')
                        .replace('rgb', 'rgba');
            }
        };

        /*
         * Wrapper prototype for the charts
         * @param {object} canvas the canvas of the chart
         * @param {string} type the type of chart
         * @param {object} options the options of the chart
         */
        function myChart(canvas, type, options) {
            this.chart = null;
            this.canvas = canvas;
            this.type = type;
            this.data = null;
            this.options = options;

            // Return whether this chart is generated or not
            this.isGenerated = function () {
                return (this.chart === null);
            };

            // Generates spider chart data and puts it in the data property
            this.generateSpider = function (json) {
                var solidColor;
                var opaqueColor;

                // Set up data variable
                this.data = {};
                this.data.labels = json[0].categories;
                this.data.datasets = [];

                // Loop through the JSON data and fill the dataset inside data
                for (var i = 0; i < json.length; i++) {
                    solidColor = color.getNext();
                    opaqueColor = color.getOpaque();
                    this.data.datasets.push({
                        label: json[i].name,
                        data: json[i].scores,
                        backgroundColor: opaqueColor,
                        borderColor: solidColor,
                        pointBackgroundColor: solidColor,
                        pointHoverBorderColor: solidColor,
                        pointBorderColor: "#fff",
                        pointHoverBackgroundColor: "#fff"
                    });
                }

                // Generate the chart with this data
                this.generateChart();
            };

//            // Generates bar chart data and puts it in the data property
//            this.generateBar = function (chartBefore, chartAfter) {
//
//                var beforeSet = chartBefore.data.datasets;
//                var afterSet = chartAfter.data.datasets;
//
//                var beforeTotal = new Uint8Array(beforeSet[0].data.length);
//                var beforeAverage = new Uint8Array(beforeSet[0].data.length);
//                var afterTotal = new Uint8Array(beforeSet[0].data.length);
//                var afterAverage = new Uint8Array(beforeSet[0].data.length);
//
//                var i = 0;
//                for (i in beforeSet) {
//                    for (var j in beforeSet[i].data) {
//                        beforeTotal[j] += beforeSet[i].data[j];
//                    }
//                }
//                
//                console.log(beforeTotal);
//                
//                var i = 0;
//                for (i in afterSet) {
//                    for (var j in afterSet[i].data) {
//                        beforeTotal[j] += beforeSet[i].data[j];
//                    }
//                }
//
//                // Set up data variable
//                this.data = {};
//                this.data.labels = chartBefore.data.labels;
//                this.data.datasets = [];
//
//                this.data.datasets.push({
//                    label: "Negatief",
//                    data: [-10, -4, 0],
//                    backgroundColor: "rgba(255, 0, 0, 0.3)",
//                    borderColor: "rgb(255, 0, 0)",
//                    borderWidth: 2
//                });
//
//                this.data.datasets.push({
//                    label: "Positief",
//                    data: [0, 0, 5],
//                    backgroundColor: "rgba(0, 255, 0, 0.3)",
//                    borderColor: "rgb(0, 255, 0)",
//                    borderWidth: 2
//                });
//
//                // Generate the chart with this data
//                this.generateChart();
//            };

            // Generate the chart
            this.generateChart = function () {
                this.destroyChart();
                this.chart = new Chart(this.canvas, {
                    type: this.type,
                    data: this.data,
                    options: this.options
                });
            };

            // Destroy the chart
            this.destroyChart = function () {
                if (this.chart !== null) {
                    this.chart.destroy();
                    this.chart = null;
                }
            };
        }

        // Check if the page wasn't sent additional period options
        if (id_period !== "") {

            // Set the data to be sent in the request
            var data = {"id": id_period.toString()};

            // Perform the AJAX request
            $.ajax({
                url: location,
                data: data,
                type: "POST",
                dataType: "json",
                success: function (result) {
                    // Check if the period actually contains graph data
                    if (result) {
                        $rightsection.show(showDuration);
                        chartLeft.generateSpider(result);
                    } else {
                        $rightsection.hide(showDuration);
//                            $differencesection.hide(showDuration);
                        $noDataLeft.show();
                        chartLeft.destroyChart();
                    }
                }
            });
        }

        // Left dropdown menu event listener
        $("#dropdown_left").change(function () {

            /*
             * Check the value of the dropdown menu. If it's default, don't
             * perform the AJAX request.
             */
            if (this.value !== "0") {

                // Set the data to be sent in the request
                var data = {"id": this.value};

                // Perform the AJAX request
                $.ajax({
                    url: location,
                    data: data,
                    type: "POST",
                    dataType: "json",
                    success: function (result) {
                        // Check if the period actually contains graph data
                        if (result) {
                            $rightsection.show(showDuration);
                            $noDataLeft.hide();
                            chartLeft.generateSpider(result);
                        } else {
                            $rightsection.hide(showDuration);
//                            $differencesection.hide(showDuration);
                            $noDataLeft.show();
                            chartLeft.destroyChart();
                        }
                    }
                });
            } else {
                $rightsection.hide(showDuration);
//                $differencesection.hide(showDuration);

                chartLeft.destroyChart();
            }
        });

        // Right dropdown menu event listener
        $("#dropdown_right").change(function () {

            /*
             * Check the value of the dropdown menu. If it's default, don't
             * perform the AJAX request.
             */
            if (this.value !== "0") {

                // Set the data to be sent in the request
                var data = {"id": this.value};

                // Perform the AJAX request
                $.ajax({
                    url: location,
                    data: data,
                    type: "POST",
                    dataType: "json",
                    success: function (result) {
                        // Check if the period actually contains graph data
                        if (result) {
                            chartRight.generateSpider(result);
                            $noDataRight.hide();
//                            $differencesection.show(showDurationSlow, function () {
//                                chartDifference.generateBar(chartLeft, chartRight);
//                            });
                        } else {
//                            $differencesection.hide(showDurationSlow);
                            $noDataRight.show();
                            chartRight.destroyChart();
                        }
                    }
                });
            } else {
//                $differencesection.hide(showDurationSlow);

                chartRight.destroyChart();
            }
        });
    });
    
    $(document).ready(function () {
        $('[data-toggle="popover"]').popover();
    });
</script>
<script src="<?php echo base_url("/assets/js/Chart.min.js"); ?>"></script>