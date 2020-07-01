
<?php

use \utility\Utility;

require_once('includes/initialize.php');

if (Utility::isPostRequest()) {
    require_once(SHARED_PATH . 'filtered-post-vars.php');

    try {
        $to_value = $instance->processConversion($from_value, $from_unit, $to_unit);
    } catch (Throwable $t) {
        #echo '', $t->getMessage(), "\n";
        $typeError = true;
    }
    if (Utility::isAjaxRequest()) {
        $response = ['to_value' => Utility::floatToString($to_value), 'typeError' => $typeError];
        echo json_encode($response);
        exit();
    }
}
require_once(SHARED_PATH . 'public_header.php');
?>

<div class="wrapper">
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container">
                <div class="row mb-3 mt-2">
                        <h2 class="m-0 text-dark mx-auto"><?php echo $page_title; ?></h2>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto">

                        <form class="mx-auto" id="conversion_form" action="<?php echo Utility::h($form_action); ?>" method="POST">
                            <div class="card shadow">
                                <div class="card-body">
                                    <div class="card-title">
                                        <div id="btn-group" class="btn-group w-100" role="group">
                                            <button id="btn_select" type="button" class="btn btn-outline-light custom-select select-picker" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span id="btn_select_title"><?php echo $btn_title; ?></span>
                                            </button>
                                            <div class="dropdown-menu w-100" aria-labelledby="btnGroupDrop1">
                                                <a class="dropdown-item <?php echo $drop_class['area']; ?>" href="index.php?p=area">Area</a>
                                                <a class="dropdown-item <?php echo $drop_class['storage']; ?>" href="index.php?p=digital">Digital Storage</a>
                                                <a class="dropdown-item <?php echo $drop_class['fuel']; ?>" href="index.php?p=fuel">Fuel Economy</a>
                                                <a class="dropdown-item <?php echo $drop_class['length']; ?>" href="index.php?p=length">Length and distance</a>
                                                <a class="dropdown-item <?php echo $drop_class['mass']; ?>" href="index.php?p=mass">Mass and weight</a>
                                                <a class="dropdown-item <?php echo $drop_class['speed']; ?>" href="index.php?p=speed">Speed</a>
                                                <a class="dropdown-item <?php echo $drop_class['temperature']; ?>" href="index.php?p=temperature">Temperature</a>
                                                <a class="dropdown-item <?php echo $drop_class['time']; ?>" href="index.php?p=time">Time</a>
                                                <a class="dropdown-item <?php echo $drop_class['volume']; ?>" href="index.php?p=volume">Volume and capacity</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div id="left-body" class="col">
                                            <div id="from_value_div" class="input-group">
                                                <input autofocus="autofocus" placeholder="0" id="from_value_input" class="form-control no-bottom-border" type="number" step="any" name="from_value" value="<?php echo Utility::h($from_value); ?>" />
                                            </div>
                                            <div id="from_unit_select" class="input-group">
                                                <select name="from_unit" class="custom-select custom-select-sm custom-select-picker" id="from_unit">
                                                    <?php
                                                    foreach ($select_options as $unit) {
                                                        $opt = Utility::optionize($unit);
                                                        echo Utility::optionizer($unit, $opt, $from_unit);
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <span class="version text-muted float-left"><?php echo VERSION_NO; ?></span>
                                        </div>
                                        <div id="right-body" class="col">
                                            <div id="to_value_div" class="input-group">
                                                <input placeholder="0" id="to_value_input" class="form-control no-bottom-border" type="number" name="to_value" step="any" value="<?php echo Utility::floatToString($to_value); ?>" />
                                            </div>
                                            <div id="to_unit_select" class="input-group">
                                                <select name="to_unit" class="custom-select custom-select-sm custom-select-picker" id="to_unit">
                                                    <?php
                                                    foreach ($select_options as $unit) {
                                                        $opt = Utility::optionize($unit);
                                                        echo Utility::optionizer($unit, $opt, $to_unit);
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <input id="submit" class="btn btn-outline-secondary float-right mt-2" type="submit" name="submit" value="Submit" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div id="conversion-spinner" class="spinner-border text-secondary mt-2 mx-auto hidden" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>

</div>

<?php
require_once(SHARED_PATH . 'public_footer.php');
