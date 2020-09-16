<?php
/**
 * Created by PhpStorm.
 * User: Аня
 * Date: 14.09.2020
 * Time: 17:10
 */

namespace view;

/**
 * Class echo_view
 * вьюшка для консоли
 * @package view
 */
class echo_view extends body {

    function print(\model\default_model $model){
        echo $model->get_data_as_string('echo');
    }

}