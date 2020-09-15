<?php
/**
 * Created by PhpStorm.
 * User: Аня
 * Date: 14.09.2020
 * Time: 17:10
 */

namespace view;

class history_view extends body {

    function print(\model\default_model $model){

        $db=new \model\database_model();
        $result=$db->findresult('-12 hours');
       // print_r($result);
        $list='';
        if(!empty($result)){
            $list='<table class="table"><thead><tr><th></th><th>uri</th><th>дата</th><th>текст</th></tr></thead><tbody>';
            foreach($result as $res){
                $list.='<tr><td>'.$res['reason'].'</td><td>'.$res['uri'].'</td><td>'.$res['date'].'</td><td> '.$res['text'].'</td></tr><tr><td></td><td colspan="3">';
                if(!empty($res['found'])){
                    foreach($res['found'] as $f){
                        $list.=$f['found'].'&nbsp; ';
                    }
                }
                $list.='</td></tr>';
            }
            $list.='</tbody></table>';
        }

        $model->append('echo',  '
        <div class="container bs-docs-container"> 
    <div class="row">
    <ul class="nav nav-pills">
  <li ><a href="/">Главная</a></li>
  <li  class="disabled"><a href="/history/">История поиска</a></li>
</ul>
<div class="col-sm-8 col-lg-8 col-8" style="overflow:auto;">'.$list.'
    </div></div></div>
'
);
        parent::print($model);
    }

}