<?php

/**
 * Function auto load classes
 *
 * @author sergey
 */

function __autoload($class)
{
        //достаточно простой вариант автозагрузчика, думаю, блогу не грозит серьезное перетряхивание структуры папок в будущем
        $baseDir = __DIR__ . '/../';
        $path = $baseDir . str_replace('_', '/', strtolower($class)) . '.php';
        if (file_exists($path)) 
        {
            require_once($path);
            return true;
        } else {
            Application_Init::ErrorPage404();
        }

        return false;
}
