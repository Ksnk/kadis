<?php
/**
 * Created by PhpStorm.
 * User: Аня
 * Date: 15.09.2020
 * Time: 7:16
 */
namespace model;

class search_words_model extends search_model{

    // ищем все полные строки
    function data_prepare(){
        parent::data_prepare();
        $text=$this->getString('text');
        $result=$this->get('result');

        $dom = new \DOMDocument();
        @$dom->loadHTML($result['content']);

// захватить все текстовые куски
        $src=$dom->getElementsByTagName('body')->item(0)->textContent;
        $result['count']=0;
//        $this->putdeep('result','reg','/'.preg_replace('/\s+/','\\s+',preg_quote($text)).'/isu');

        if(preg_match_all('/'.preg_replace('/\s+/','\\s+',preg_quote($text)).'/isu',$src,$m)){
            //$this->putdeep('result','xxx',$m);
            $this->putdeep('result','count',count($m[0]));
        }
    }
}

