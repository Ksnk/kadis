<?php
/**
 * Created by PhpStorm.
 * User: Аня
 * Date: 14.09.2020
 * Time: 16:40
 */

namespace controller;

use \model\default_model;

// не знаю зачем, но пусть будет
interface controller_interface
{

    /**
     * меняет параметры обшего пула данных.
     * model_class, view_class - устанавливает нужные имена классов
     *
     * @param default_model $model
     */
    function route(default_model $model);

}