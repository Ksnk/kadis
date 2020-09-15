<?php
/**
 * Created by PhpStorm.
 * User: Аня
 * Date: 14.09.2020
 * Time: 17:10
 */

namespace view;

class _404_view extends body {

    function print(\model\default_model $model){
        $model->store(['header','status'],"HTTP/1.0 404 Not Found");
        $model->append('echo',"Страница не найдена, попробуйте в другой день недели или поищите <a href=\"/\">в корне сайта</a>...");
        parent::print($model);
    }

}