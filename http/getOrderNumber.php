<?php

require_once 'bootstrap.php';

try {

    $order = $container->database('mysql')
                        ->select('*')
                        ->from('pesquisa')
                        ->where('id', '=', 1)
                        ->first();

    $value = $order['value'] = $order['value'] + 1;

    $container->database('mysql')
                ->update('pesquisa')
                ->set([ 'value' => $value ])
                ->where('id', '=', $order['id'])
                ->run();

    $count = $container->database('mysql')
                        ->select([ '*' ])
                        ->from('ganhadores')
                        ->count();

    if($count < 10)
    {
        $orderNumber = $value;
    }
    else
    {
        $orderNumber = -1;
    }

    $container->response()->json([
        'orderNumber' => $orderNumber,
    ], 200);

} catch (\Exception $Exception) {
    $container->response()->json([
        'orderNumber' => 0,
    ]);
}