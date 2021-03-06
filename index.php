<?php
/**
 * Created by PhpStorm.
 * User: Аня
 * Date: 14.09.2020
 * Time: 16:01
 */

// эпизодические косяки с настройкой времени на новом месте решаются вот таким нехитрым приемом
if ('' == ini_get('date.timezone')) {
    date_default_timezone_set('UTC');
}

// автолод какой уж есть, чо...
spl_autoload_register(function ($class) {
    $fn = strtolower(str_replace('\\', '/', __DIR__ . '/' . $class . '.php'));
    if (file_exists($fn)) require_once $fn;
});

try {
    ob_start();
    // просто место для хранения всяких данных
    $model = new model\default_model();
    $model->put_data('option', include __DIR__."/config.php");

    // контроллер
    $controller = new controller\default_controller();

    // тут можно было бы влепить множественную передачу контроллеров друг другу, но пока не вижу надобности
    $controller->route($model);

    // подмена модели на реально заказанную
    $model_class = $model->get_data_as_string('model_class');
    if (!empty($model_class)) {
        if (!class_exists($model_class))
            throw new Exception('Неустановленная модель ' . $model_class);
        $model = new $model_class();
    }
    $model->data_prepare(); // чтение нужных данных

    $view_class = $model->get_data_as_string('view_class', '', 'view\\_404_view');
    if (!class_exists($view_class))
        throw new Exception('Неустановленное view ' . $view_class);
    /** @var \view\body $view */
    $view = new $view_class;

    $model->append_data('debug', ob_get_contents());
    ob_end_clean();
    $view->print($model);
} catch (Exception $e) {
    echo 'something terrible happen :' . $e->getMessage();
}