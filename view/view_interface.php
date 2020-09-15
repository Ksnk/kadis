<?php
/**
 * Created by PhpStorm.
 * User: Аня
 * Date: 14.09.2020
 * Time: 16:40
 */
namespace view;

// не знаю зачем, но пусть будет
interface view_interface{

    /**
     * выводит нужные данные нужным обрам, не забывая про заголовки
     *
     * @return null
     */
    function print(\model\default_model $model);

}