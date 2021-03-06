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

        $result = $model->get_data('result');
        if(empty($result['count'])) $model->append_data('echo','Ничего не найдено');
        else  $model->append_data('echo',sprintf('Найден%s %s вариант%s', $this->plural($result['count'],'|о|о'),$result['count'], $this->plural($result['count'],'|а|ов')));
        if(!empty($result['found'])){
            foreach($result['found'] as $found)
                $model->append_data('echo', sprintf('<br>-  %s ', $found));
        }

        $contents = utf8_encode(json_encode(['resume'=>$model->get_data_as_string('echo'),'debug'=>$model->get_data_as_string('debug'),'result'=>$result]));
        $callback=$_GET['callback']??'log';
        if('iframe'==$_GET['target']){
            echo '<script type="text/javascript"> top.'.$callback . '('.$contents.')</script>';
        }
    }

}