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
 * Интерфейсные функции корявы и требуют переосмысления
 * Class default_model
 * @package model
 */
class default_model{

    /**
     * Хранилище данных. Одно на все приложение
     * @var array
     */
    protected static $data=[];

    function __construct($data=null)
    {
        if(is_array($data)){
            self::$data=array_merge(self::$data,$data);
        }
    }

    function put($name,$value){
        self::$data[$name]=[];
        self::$data[$name][]=$value;
    }

    function putdeep($name,$subname,$value){
        if(!isset(self::$data[$name]))self::$data[$name]=[];
        if(empty($subname))
            self::$data[$name]=$value;
        else
            self::$data[$name][$subname]=$value;
    }

    function getdeep($name,$subname){
        if(!isset(self::$data[$name]))self::$data[$name]=[];
        if(!isset(self::$data[$name][$subname]))self::$data[$name][$subname]='';
        return self::$data[$name][$subname];
    }

    function append($name,$value){
        if(!isset(self::$data[$name]))self::$data[$name]=[];
        self::$data[$name][]=$value;
    }

    function get($name){
        if(!isset(self::$data[$name]))self::$data[$name]=[];
        return self::$data[$name];
    }

    function getString($name,$glue='',$default=''){
        if(!isset(self::$data[$name]))self::$data[$name]=[];
        $data=implode($glue,self::$data[$name]);
        return empty($data)?$default:$data;
    }

    function data_prepare(){

    }

}