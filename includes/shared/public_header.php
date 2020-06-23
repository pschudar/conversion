<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="A free tool written in PHP that converts length, area, volume, mass, speed, and temperature between different formats. Utilizes Bootstrap 4, jQuery and some JavaScript">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link href="./assets/css/conversion.styles.css" rel="stylesheet" type="text/css">
        <link rel="icon" type="image/x-icon" sizes="32x32" href="./assets/images/favicon.ico">
        <title>
            <?php
            if (!isset($page_title)) {
                $page_title = 'Conversion Tool';
            }
            echo $page_title;
            ?>
        </title>
    </head>
    <body>