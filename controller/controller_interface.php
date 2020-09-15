<?php
/**
 * Created by PhpStorm.
 * User: Аня
 * Date: 14.09.2020
 * Time: 16:40
 */
namespace controller;

// не знаю зачем, но пусть будет
interface controller_interface{

    /**
     * возвращает структуру вида
     * {controller:'', model:'', view:'', data:''}
     * Каждое поле может отсутствовать, поля - имена существующих классов, data - просто data,
     * его использует мшуц естественным для него способом
     *
     * @return mixed
     */
    function route($model);

}