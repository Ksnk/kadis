<?php
/**
 * Created by PhpStorm.
 * User: Аня
 * Date: 15.09.2020
 * Time: 7:16
 */
namespace model;

class search_model extends default_model{

    function data_prepare(){
        $uri=$this->getString('uri');
        if(!empty($uri)){
            $db=new database_model();
            if($cache=$db->cache('uri://'.$uri)){
                $contents=$cache["cache"];
            } else {
                $contents=file_get_contents($uri);
                $db->cache_put('uri://'.$uri,$contents);
            }
            $this->store(['result','content'],$contents);
        }
    }
}

