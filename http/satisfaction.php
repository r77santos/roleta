<?php

use App\Model\Contact;

require_once 'bootstrap.php';

try {

    $contact = null;

    $settings = $container->settings('mail')->find('smtp');

    $request = $container->request()->json([
        'nome', 'mail', 'celular'
    ]);

    $request['created'] = date('Y-m-d');

    $validation = $container->validation('pt-br', $request, [
        // validação dos dados de contato
        'nome'  => 'required|min:2|max:250',
        'mail' => 'required|email|min:3|max:191|unique:table,mail',
        'celular'  => 'required|min:15|max:15',
    ]);

    if( $validation->fails() ) {

        $container->response()->json([
            'message' => 'Verifique as informações',
            'errors'  => $validation->errors()->toArray(),
        ], 422);

    }

    if( $connection = $container->connection('mysql') ) {
        $contact    = Contact::build($connection)->create($request);
    }

    if( is_null($contact) || !isset($contact['id'])) {
        throw new \Exception("Tente novamente mais tarde!");
    }

    $container->response()->json([
        'message' => 'Contato salvo com sucesso',
    ], 200);

} catch (\Exception $Exception) {
    
    $container->response()->json([
        'errors' => [],
        'trace'  => $Exception->getTrace(),
        'message' => $Exception->getMessage(),
    ], 500);

}