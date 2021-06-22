<?php

require_once 'bootstrap.php';

try {

    $rows = $container->database('mysql')
                        ->select('*')
                        ->from('table')
                        ->run();

    $container->response()->view('html/sheet', [
        'rows' => isset($rows) ? $rows : []
    ], 200);

} catch (\Exception $Exception) {

    $container->response()->json([
        'message' => $Exception->getMessage(),
    ], 500);
    
}
