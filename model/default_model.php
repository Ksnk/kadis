<?php
/**
 * Created by PhpStorm.
 * User: Аня
 * Date: 14.09.2020
 * Time: 16:04
 */
namespace model;

class default_model{

    var $data=[];

    function __construct($data=null)
    {
        if(is_array($data))
            $this->data=$data;
        else if(is_subclass_of($data,__CLASS__) || __CLASS__==get_class($data)){
            $this->data=$data->data;
        } else if(!is_null($data)){
            throw new \Exception('Некорректные данные '.__CLASS__.' vs '.get_class($data));
        }
    }

    function put($name,$value){
        $this->data[$name]=[];
        $this->data[$name][]=$value;
    }

    function putdeep($name,$subname,$value){
        if(!isset($this->data[$name]))$this->data[$name]=[];
        $this->data[$name][$subname]=$value;
    }

    function append($name,$value){
        if(!isset($this->data[$name]))$this->data[$name]=[];
        $this->data[$name][]=$value;
    }

    function get($name){
        if(!isset($this->data[$name]))$this->data[$name]=[];
        return $this->data[$name];
    }

    function getString($name,$glue='',$default=''){
        if(!isset($this->data[$name]))$this->data[$name]=[];
        $data=implode($glue,$this->data[$name]);
        return empty($data)?$default:$data;
    }

    function data_prepare(){

    }

}