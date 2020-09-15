<?php
/**
 * Created by PhpStorm.
 * User: Аня
 * Date: 14.09.2020
 * Time: 16:04
 */

namespace model;

/**
 * прародитель всех моделей системы. Позволяет хранить в себе данные
 * Интерфейсные функции корявы, но уже один раз переосмыслены
 * Class default_model
 * @package model
 */
class default_model
{

    /**
     * Хранилище данных. Одно на все приложение.
     */
    protected static $data = [];

    /**
     * Работа с сылками в php. По имени найти куда брать-ложить значение.
     * @param $name
     * @return array|mixed
     */
    private function &root($name)
    {
        $bar =& self::$data;
        if (is_array($name) && !empty($name)) {
            while (count($name) > 1) {
                $n = array_shift($name);
                if (!isset($bar[$n])) $bar[$n] = [];
                $bar =& $bar[$n];
            }
            $name = array_shift($name);
        }
        if (empty($name))
            return $bar;
        else
            return $bar[$name];
    }

    /**
     * заменить значение в хранилище новым значением
     * @param string|array $name
     * @param $value
     */
    function store($name, $value)
    {
        $root =& $this->root($name);
        $root = $value;
    }

    /**
     * получить значение
     * @param string|array $name
     * @return array|mixed
     */
    function load($name)
    {
        $root =& $this->root($name);
        return $root;
    }

    function append($name, $value)
    {
        $root =& $this->root($name);
        $root[] = $value;
    }

    function getString($name, $glue = '', $default = '')
    {
        $root =& $this->root($name);
        if (is_array($root)) {
            $data = implode($glue, $root);
        } else {// is_string ? верю на слово...
            $data = $root;
        }
        return empty($data) ? $default : $data;
    }

    function data_prepare()
    {

    }

}