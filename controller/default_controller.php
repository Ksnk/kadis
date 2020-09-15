<?php
/**
 * Created by PhpStorm.
 * User: Аня
 * Date: 14.09.2020
 * Time: 16:04
 */

namespace controller;

use \model\default_model;

class default_controller implements controller_interface
{

    function route(default_model $model)
    {
        if (false && PHP_SAPI === 'cli') {
            return $this->cli_route($model);
        } else {
            return $this->web_route($model);
        }
    }

    /**
     * роут для случая cli-приложения
     * @param default_model $model
     */
    final function cli_route(default_model $model)
    {
        $model->store('view_class', 'view\\echo_view');
        $model->append('echo', 'не поддерживается, пользуйтесь web');
    }

    /**
     * роут для случая обычного web-приложения
     * @param default_model $model
     */
    final function web_route(default_model $model)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {// это ajax и все. дальше пусть проверяет он сам
            $this->ajax_route($model);
        } else if (preg_match('~/history\b~', $_SERVER['REQUEST_URI'])) {// это страница истории поиска
            $this->history_page_route($model);
        } else if (preg_match('~/($|\?)~', $_SERVER['REQUEST_URI'])) {// это страница истории поиска
            $this->get_search_form($model);
        } else {
            $model->store('view_class', 'view\\_404_view');
        }
    }

    /**
     * @param default_model $model
     */
    final function get_search_form(default_model $model)
    {
        //$model->put('model_class','model\\history_model');
        $model->store('subtitle', 'Выбирайте варианты поиска');
        $model->store('view_class', 'view\\search_view');
    }

    /**
     * @param default_model $model
     */
    final function ajax_route(default_model $model)
    {
        if (isset($_POST['variant'])) {
            switch ($_POST['variant']) {
                case 'words':
                    $model->store('subtitle', 'Поиск по словам');
                    $model->store('model_class', 'model\\search_words_model');
                    break;
                case 'link':
                    $model->store('subtitle', 'Поиск по ссылкам');
                    $model->store('model_class', 'model\\search_links_model');
                    break;
                case 'picture':
                    $model->store('subtitle', 'Поиск по картинкам');
                    $model->store('model_class', 'model\\search_picture_model');
                    break;
            }
        }
        if (isset($_POST['uri']))
            $model->store('uri', $_POST['uri']);
        if (isset($_POST['text']))
            $model->store('text', $_POST['text']);
        $model->store('view_class', 'view\\ajax_view');
    }

    /**
     * @param default_model $model
     */
    function history_page_route(default_model $model)
    {
        //$model->put('model_class','model\\history_model');
        $model->store('view_class', 'view\\history_view');
    }

}