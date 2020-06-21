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
require_once('includes/assets/shared/public_header.php');
$self = filter_input(INPUT_SERVER, 'PHP_SELF', 522);
if (isset($getPage) && !empty($getPage)) {
    $form_action = $self . '?p=' . $getPage;
}
?>

<div class="container-fluid">

    <div class="row">
        <div id="left-spacer" class="col">&nbsp;</div>
        <!-- Page Content -->
        <div id="conversion-tool" class="col-sm-6">
            <h2 class="text-center"><?php echo $page_title; ?></h2>
            <form id="conversion_form" action="<?php echo h($form_action); ?>" method="post">
                <div id="conversion-card" class="card shadow">
                    <div class="card-body">
                        <div class="card-title">
                            <div class="btn-group w-100" role="group">
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
                                </div>
                            </div>
                        </div>
                        <!-- Can put something here that spans the length of the card -->
                        <div class="row">
                            <div class="col-md-5">
                                <div id="from_value_div" class="input-group">
                                    <input placeholder="0" id="from_value_input" class="form-control" type="text" name="from_value" value="<?php echo h($from_value); ?>" style='border-bottom: none;' />
                                </div>
                                <div id="from_value_select" class="input-group">
                                    <select name="from_unit" class="custom-select custom-select-sm select-picker" id="from_unit">
                                        <?php
                                        foreach ($select_options as $unit) {
                                            $opt = optionize($unit);
                                            echo optionizer($unit, $opt, $from_unit);
                                        }
                                        ?>
                                    </select>
                                </div>
                                <span class="version text-muted hidden">v1.0.0.1</span>
                            </div>
                            <div class="col-md-2 text-center">
                                <span style="font-size: x-large">=</span>
                                <br>
                                <div id="conversion-spinner" class="spinner-border text-secondary text-center" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div id="to_value_div" class="input-group">
                                    <input placeholder="Output" id="to_value_input" class="form-control" type="text" name="to_value" value="<?php echo float_to_string($to_value); ?>" style='border-bottom: none;' />
                                </div>
                                <div id="to_value_select" class="input-group">
                                    <select name="to_unit" class="custom-select custom-select-sm select-picker" id="to_value">
                                        <?php
                                        foreach ($select_options as $unit) {
                                            $opt = optionize($unit);
                                            echo optionizer($unit, $opt, $to_unit);
                                        }
                                        ?>
                                    </select>
                                </div>
                                <br>
                                <input class="btn btn-outline-secondary float-right" type="submit" name="submit" value="Submit" />
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div id="right-spacer" class="col">
            <?php
            if ($typeError) : $dah = "true";
            else : $dah = "false";
            endif;
            ?>
            <div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 200px;">
                <h2 class="text-center">&nbsp;</h2><!-- spacer: instead of using -- style="position: absolute; top: 68px;" -->
                <div id="typeError" class="toast fade" data-delay="5500" data-autohide="<?php echo $dah; ?>">
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
            <?php #endif;   ?>
        </div>

    </div>
</div>
<?php
require_once('includes/assets/shared/public_footer.php');
