<?php
/**
 * Created by PhpStorm.
 * User: Аня
 * Date: 15.09.2020
 * Time: 7:16
 */
namespace model;

/**
 * Class search_words_model
 * @package model
 */
class search_words_model extends search_model{

    // ищем все полные строки
    function data_prepare(){
        parent::data_prepare();
        $text=$this->getString('text');
        $result=$this->load('result');

        $dom = new \DOMDocument();
        @$dom->loadHTML($result['content']);

// захватить все текстовые куски
        $src=preg_replace('/\s+/su',' ',$dom->getElementsByTagName('body')->item(0)->textContent);
        $result['count']=0;
        $result['found']=[];

        if(preg_match_all('/.{0,30}'.preg_replace('/\s+/','\\s+',preg_quote($text,'/')).'.{0,30}/isu',$src,$m)){
            for ($i = 0; $i < count($m[0]); $i++) {
                $url = $m[0][$i];
                $result['found'][]=$url;
                $result['count']++;
            }
print_r($m);
        }
        $db=new database_model();
        $db->storeresult($text,$this->getString('uri'),$this->getString('subtitle'),$result['found']);
        $this->store('result',$result);
    }
}

