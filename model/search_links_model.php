<?php
/**
 * Created by PhpStorm.
 * User: Аня
 * Date: 15.09.2020
 * Time: 7:16
 */
namespace model;

class search_links_model extends search_model{

    // ищем все полные строки
    function data_prepare(){
        parent::data_prepare();
        $text=$this->getString('text');
        $result=$this->load('result');

        $dom = new \DOMDocument();
        @$dom->loadHTML($result['content']);

// захватить все ссылки на странице
        $xpath = new \DOMXPath($dom);
        $hrefs = $xpath->evaluate("/html/body//a");
        $result['count']=0;
        $result['found']=[];

        $result['total']=$hrefs->length;
        for ($i = 0; $i < $hrefs->length; $i++) {
            $href = $hrefs->item($i);
            $url = $href->getAttribute('href');
            if(preg_match('/'.preg_quote($text,'/').'/',$url)) {
                $result['found'][]=$url;
                $result['count']++;
            }
        }
        $db=new database_model();
        $db->storeresult($text,$this->getString('uri'),$this->getString('subtitle'),$result['found']);
        $this->store('result',$result);
    }
}

