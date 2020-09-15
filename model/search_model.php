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
            $this->putdeep('result','content',file_get_contents($uri));
        }
    }
}

