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



        $model->put('echo',  '
        <div class="container bs-docs-container"> 
    <div class="row">
    <ul class="nav nav-pills">
  <li ><a href="/">Главная</a></li>
  <li  class="disabled"><a href="/history/">История поиска</a></li>
</ul>
<div class="col-sm-8 col-lg-8 col-8" style="overflow:auto;">
    </div></div></div>
'
);
        parent::print($model);
    }

}