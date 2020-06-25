<?php

# defaulting initial values
$from_value = '';
$from_unit = '';
$to_unit = '';
$to_value = '';
$typeError = null;

# filter _GET['p'] as a stripped string - defaults to length
$getPage = filter_input(INPUT_GET, 'p', 513) ?? 'length';
# default drop_class values to null
$drop_class = ['length' => null, 'area' => null, 'volume' => null, 'mass' => null, 'speed' => null, 'temperature' => null];
$form_action = '#';

switch ($getPage) {
    case 'length':
        $page_title = 'Convert Length';
        $function_call = 'convert_length';
        $btn_title = 'Length and distance';
        $drop_class['length'] = 'active';
        $select_options = $length_options;
        break;
    case 'area':
        $page_title = 'Convert Area';
        $function_call = 'convert_area';
        $btn_title = 'Area';
        $drop_class['area'] = 'active';
        $select_options = $area_options;
        break;
    case 'volume':
        $page_title = 'Convert Volume';
        $function_call = 'convert_volume';
        $btn_title = 'Volume and capacity';
        $drop_class['volume'] = 'active';
        $select_options = $volume_options;
        break;
    case 'mass':
        $page_title = 'Convert Mass';
        $function_call = 'convert_mass';
        $btn_title = 'Mass and weight';
        $drop_class['mass'] = 'active';
        $select_options = $mass_options;
        break;
    case 'speed':
        $page_title = 'Convert Speed';
        $function_call = 'convert_speed';
        $btn_title = 'Speed';
        $drop_class['speed'] = 'active';
        $select_options = $speed_options;
        break;
    case 'temperature':
        $page_title = 'Convert Temperature';
        $function_call = 'convert_temperature';
        $btn_title = 'Temperature';
        $drop_class['temperature'] = 'active';
        $select_options = $temp_options;
        break;
    default:
        $page_title = 'Convert Length';
        $function_call = 'convert_length';
        $btn_title = 'Length and distance';
        $drop_class['length'] = 'active';
        $select_options = $length_options;
        break;
}
