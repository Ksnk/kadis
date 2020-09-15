<?php
/**
 * Created by PhpStorm.
 * User: Аня
 * Date: 14.09.2020
 * Time: 16:04
 */
namespace controller;

class default_controller implements controller_interface{

    function route($model){
        if (false &&  PHP_SAPI === 'cli'){
            return $this->cli_route($model);
        } else {
            return $this->web_route($model);
        }
    }

    /**
     * роут для случая cli-приложения
     * return array - {controller:{}, model:{}, view:{}}
     */
    final function cli_route($model){
        $model->put('view_class','view\\echo_view');
        $model->append('echo','не поддерживается, пользуйтесь web');
    }

    /**
     * роут для случая обычного web-приложения
     */
    final function web_route($model){
        if($_SERVER['REQUEST_METHOD']=='POST'){// это ajax и все. дальше пусть проверяет он сам
            return $this->ajax_route($model);
        }
        if(preg_match('~/history\b~',$_SERVER['REQUEST_URI'])){// это страница истории поиска
            return $this->history_page_route($model);
        }
        if(preg_match('~/($|\?)~',$_SERVER['REQUEST_URI'])){// это страница истории поиска
            return $this->get_search_form($model);
        }
        $model->put('view_class','view\\_404_view');
    }

    final function get_search_form($model){
        //$model->put('model_class','model\\history_model');
        $model->append('subtitle','Выбирайте варианты поиска');
        $model->put('view_class','view\\search_view');
    }

    final function ajax_route($model){
        if(isset($_POST['variant'])){
            switch($_POST['variant']){
                case 'words':
                    $model->append('subtitle','Поиск по словам');
                    $model->put('model_class','model\\search_words_model');
                    break;
                case 'link':
                    $model->append('subtitle','Поиск по ссылкам');
                    $model->put('model_class','model\\search_links_model');
                    break;
                case 'picture':
                    $model->append('subtitle','Поиск по картинкам');
                    $model->put('model_class','model\\search_picture_model');
                    break;
            }
        }
        if(isset($_POST['uri']))
            $model->put('uri',$_POST['uri']);
        if(isset($_POST['text']))
            $model->put('text',$_POST['text']);
        $model->put('view_class','view\\ajax_view');
    }

    function history_page_route($model){
        //$model->put('model_class','model\\history_model');
        $model->put('view_class','view\\history_view');
    }

}