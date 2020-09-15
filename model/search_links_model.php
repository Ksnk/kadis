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
        $result=$this->get('result');

        $dom = new \DOMDocument();
        $dom->loadHTML($result['content']);

// захватить все ссылки на странице
        $xpath = new \DOMXPath($dom);
        $hrefs = $xpath->evaluate("/html/body//a");
        $result['count']=0;

        $this->putdeep('result','total',$hrefs->length);
        for ($i = 0; $i < $hrefs->length; $i++) {
            $href = $hrefs->item($i);
            $url = $href->getAttribute('href');
            if(preg_match('/'.preg_quote($text).'/',$url))
                $result['count']++;
        }
        $this->putdeep('result','count',$result['count']);
    }
}

