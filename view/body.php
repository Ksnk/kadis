<?php

namespace view;

class body implements view_interface {

    function plural($n, $suf = '')
    {
        list($one, $two, $five, $trash) = explode('|', $suf . '|||', 4);
        if ($n < 20 && $n > 9) return $five;
        $n = $n % 10;
        if ($n == 1) return $one;
        if ($n < 5 && $n > 1) return $two;
        return $five;
    }

    function header(\model\default_model $model){
        $headers=$model->get_data('header');
        if(!empty($headers))
            foreach($headers as $header){
                header($header);
            }
    }

    function print(\model\default_model $model){
        $this->header($model);
        echo '<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>'.$model->get_data(['option','title'], 'Приложение').'</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css"
          integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
<style>
   .panel-body {
    padding: 15px;
}
</style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
    integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
    crossorigin="anonymous"></script>
    </head>
<body>
'
            .$model->get_data_as_string('echo',' ','!oops!')
            .'<div class="debug">'.$model->get_data_as_string('debug').'</div>'
            .'<script type="text/javascript">
    function log(obj){
        console.log(obj);
        $(\'div#result\').html(obj.resume||\'\');
    }
'
            .'</script></body></html>';
    }

}