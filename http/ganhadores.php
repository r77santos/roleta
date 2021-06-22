<?php

require_once 'bootstrap.php';

try {

    $rows = $container->database('mysql')
                        ->select('*')
                        ->from('ganhadores')
                        ->run();

    

    $container->response()->json($rows, 200);

} catch (\Exception $Exception) {

    $container->response()->json([
        'message' => $Exception->getMessage(),
    ], 500);
    
}
