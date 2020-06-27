<?php
declare(strict_types=1);
require_once('includes/initialize.php');

if (is_post_request()) {
    require_once('includes/filtered-post-vars.php');
    try {
        $to_value = $function_call($from_value, $from_unit, $to_unit);
    } catch (TypeError $e) {
        #echo 'TypeError: ', $e->getMessage(), "\n";
        $typeError = true;
    }
    if (is_ajax_request()) {
        $response = ['to_value' => float_to_string($to_value), 'typeError' => $typeError];
        echo json_encode($response);
        exit();
    }
}
require_once('includes/shared/public_header.php');
?>

<div class="container-fluid">
    <h2 class="text-center mx-auto"><?php echo $page_title; ?></h2>
    <div class="row">

        <!-- Page Content -->
        <form class="mx-auto" id="conversion_form" action="<?php echo h($form_action); ?>" method="post">
            <div class="card shadow">
                <div class="card-body">
                    <div class="card-title">
                        <div id="btn-group" class="btn-group w-100" role="group">
                            <button id="btn_select" type="button" class="btn btn-outline-light custom-select select-picker" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span id="btn_select_title"><?php echo $btn_title; ?></span>
                            </button>
                            <div class="dropdown-menu w-100" aria-labelledby="btnGroupDrop1">
                                <a class="dropdown-item <?php echo $drop_class['length']; ?>" href="index.php?p=length">Length and distance</a>
                                <a class="dropdown-item <?php echo $drop_class['area']; ?>" href="index.php?p=area">Area</a>
                                <a class="dropdown-item <?php echo $drop_class['volume']; ?>" href="index.php?p=volume">Volume and capacity</a>
                                <a class="dropdown-item <?php echo $drop_class['mass']; ?>" href="index.php?p=mass">Mass and weight</a>
                                <a class="dropdown-item <?php echo $drop_class['speed']; ?>" href="index.php?p=speed">Speed</a>
                                <a class="dropdown-item <?php echo $drop_class['temperature']; ?>" href="index.php?p=temperature">Temperature</a>
                                <a class="dropdown-item <?php echo $drop_class['storage']; ?>" href="index.php?p=digital">Digital Storage</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div id="left-body" class="col">
                            <div id="from_value_div" class="input-group">
                                <input autofocus="autofocus" placeholder="0" id="from_value_input" class="form-control no-bottom-border" type="number" step="any" name="from_value" value="<?php echo h($from_value); ?>" />
                            </div>
                            <div id="from_unit_select" class="input-group">
                                <select name="from_unit" class="custom-select custom-select-sm custom-select-picker" id="from_unit">
                                    <?php
                                    foreach ($select_options as $unit) {
                                        $opt = optionize($unit);
                                        echo optionizer($unit, $opt, $from_unit);
                                    }
                                    ?>
                                </select>
                            </div>
                            <span class="version text-muted float-left"><?php echo $version_no; ?></span>
                        </div>
                        <div id="right-body" class="col">
                            <div id="to_value_div" class="input-group">
                                <input placeholder="0" id="to_value_input" class="form-control no-bottom-border" type="number" name="to_value" step="any" value="<?php echo float_to_string($to_value); ?>" />
                            </div>
                            <div id="to_unit_select" class="input-group">
                                <select name="to_unit" class="custom-select custom-select-sm custom-select-picker" id="to_unit">
                                    <?php
                                    foreach ($select_options as $unit) {
                                        $opt = optionize($unit);
                                        echo optionizer($unit, $opt, $to_unit);
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
        <!-- // Page Content -->
    </div>
    <div class="row">
        <div id="conversion-spinner" class="spinner-border text-secondary mt-2 mx-auto hidden" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <div class="row">
        <h2>&nbsp;</h2>
        <div class="mx-auto" aria-live="polite" aria-atomic="true" style="position: relative; min-height: 200px;">
            <div id="typeError" class="toast fade" data-delay="5500" data-autohide="true">
                <div class="toast-header">
                    <span class="mr-auto text-danger"> &#9888;  Warning</span>
                    <small>just now</small>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="toast-body">
                    Non-numeric value has been entered. 
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require_once('includes/shared/public_footer.php');
