<?php 

require_once 'bootstrap.php';

use App\Model\Winner;

try {

    $settings = $container->settings('mail')->find('smtp');

    $request = $container->request()->json([
        'nome',
        'mail',
        'celular',
    ]);

    $validation = $container->validation('pt-br', $request, [
        'nome'  => 'required|min:2|max:250',
        'mail' => 'required|email|min:3|max:50',
        'celular'  => 'required|min:15|max:15',
    ]);

    if( $validation->fails() ) {
        $container->response()->json([
            'message' => 'Verifique as informações',
            'errors'  => $validation->errors()->toArray(),
        ], 422);
    }

    if( $mailer = mailer($settings) ) {

        if( $connection = $container->connection('mysql') ) {
            $winner     = Winner::build($connection)
                                ->create($request);
        }
        
        $mailer->Subject = 'GANHADOR ROLETA DA SORTE';
        $mailer->AddAddress($request['mail']);
    
        $mailer->Body = $container->template (
            'mail/satisfaction', $request
        );
    
        if( !$mailer->Send() ) {
            throw new \Exception($mailer->ErrorInfo);
        }

        $container->response()->json([
            'message' => 'Finalizado com sucesso',
        ], 200);

    }

} catch (\Exception $Exception) {

    $container->response()->json([
        'errors' => [],
        'trace'  => $Exception->getTrace(),
        'message' => $Exception->getMessage(),
    ], 500);

}