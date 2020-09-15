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
class ajax_view extends body {

    function print(\model\default_model $model){

        $result = $model->get('result');
        if(empty($result['count'])) $model->append('echo','Ничего не найдено');
        else  $model->append('echo',sprintf('Найдено %s вариантов', $result['count']));
        if(!empty($result['found'])){
            foreach($result['found'] as $found)
                $model->append('echo', sprintf('<br>-  %s ', $found));
        }

        $contents = utf8_encode(json_encode(['resume'=>$model->getString('echo'),'debug'=>$model->getString('debug'),'result'=>$result]));
        $callback=$_GET['callback']??'log';
        if('iframe'==$_GET['target']){
            echo '<script type="text/javascript"> top.'.$callback . '('.$contents.')</script>';
        }
    }

}