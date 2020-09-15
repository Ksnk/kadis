<?php
/**
 * Created by PhpStorm.
 * User: Аня
 * Date: 14.09.2020
 * Time: 17:10
 */

namespace view;

class search_view extends body {

    function print(\model\default_model $model){

        $model->append('echo',  '
        <div class="container bs-docs-container"> 
            <ul class="nav nav-pills">
  <li class="disabled" ><a href="/">Главная</a></li>
  <li><a href="/history/">История поиска</a></li>
</ul>

    <div class="row">
<div class="col-sm-8 col-lg-8 col-8" style="overflow:auto;">
    <iframe name="cexecution" id="cexecution" style="display:none"></iframe>
    <form action="?callback=log&target=iframe" target ="cexecution" method="POST">
    <div class="panel panel-primary"> <div class="panel-heading">
    <h3 class="input-group-addon" style="color: white;background: none;border: none;">'.$model->getString('subtitle','','xxx').'</h3></div>
    <div class="panel-body">
    <div class="row">
    <label class="control_label col-xs-4 control-label">варианты :</label><div class="col-xs-8">
    <label class="radio-inline"><input type="radio" name="variant" value="words">Словосочетания</label>
    <label class="radio-inline"><input type="radio" name="variant" value="link">ссылки</label>
    <label class="radio-inline"><input type="radio" name="variant" value="picture">картинки</label>
    </div></div>
    <div class="row">
    <label class="control_label col-xs-4 control-label">сайт :</label><div class="col-xs-8">
    <input type="text" name="uri" class="input-sm form-control">
    </div></div>
    <div class="row">
    <label class="control_label col-xs-4 control-label">текст :</label><div class="col-xs-8">
    <input type="text" name="text" class="input-sm form-control">
    </div></div>
    <div class="row">
    <label class="control_label col-xs-4 control-label"></label><div class="col-xs-8">
        <button  class="input-sm form-control btn-primary" type="submit" name="action"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
    </div></div>
    </div></div>
    </form></div></div>
    <div class="row">
    <div id="result" class="col-sm-8 col-lg-8 col-8" style="overflow:auto;">
    </div>
    </div>
    </div>
'
);
        parent::print($model);
    }

}