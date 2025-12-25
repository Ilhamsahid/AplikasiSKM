<?php

if(!function_exists('getView')){
    function getView($view, $data=[]){
        $base_path = __DIR__ . '/../view/';
        $path = $base_path . str_replace('.', '/', $view) . '.php';
        extract($data);

        ob_start();
        include $path;
        return ob_get_clean();
    }
}
