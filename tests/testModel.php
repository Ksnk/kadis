<?php
/**
 * Created by PhpStorm.
 * User: Аня
 * Date: 15.09.2020
 * Time: 18:23
 */
class testModel extends PHPUnit_Framework_TestCase
{

    function setup(){
        $options=[
            'db_host'=>'localhost',
            'db_user'=>'root',
            'db_password'=>'root',
            'db_base'=>'test'
        ];
    }

    function testClassExists()
    {
        $this->assertNotEmpty(new \model\default_model());
    }

    function testStore0()
    {
        $testarray=[1,2,3,4,5,6,7,8,9];
        $model=new  \model\default_model();
        $model->put_data([],$testarray);
        $newtest= $model->get_data([]);
        $this->assertEquals($testarray,$newtest);
    }

    function testStore1()
    {
        $testarray=[1,2,3,4,5,6,7,8,9];
        $model=new  \model\default_model();
        $model->put_data('one',$testarray);
        $newtest= $model->get_data('one');
        $this->assertEquals($testarray,$newtest);
    }

    function testClear()
    {
        $model=new  \model\default_model();
        $model->put_data([],[]);
        $newtest= $model->get_data([]);
        $this->assertEquals([],$newtest);
    }
}
