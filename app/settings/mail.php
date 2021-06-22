<?php 

return [

    'smtp' => [
        // attribute
        'SMTPDebug' => 0,
        'Host' => 'mail.hostmail.com',
        'Port' => 587,
        'SMTPSecure' => 'tls',
        'SMTPAuth' => true,
        'Username' => 'addreass@mail.com.br',
        'Password' => 'secret',
        'CharSet' => 'UTF-8',
        'SMTPOptions' => [
            // 'ssl' => [
            //     'verify_peer' => false,
            //     'verify_peer_name' => false,
            //     'allow_self_signed' => true
            // ],
        ],
        // methods
        'isSMTP' => [ true ],
        'IsHTML' => [ true ],
        'setFrom' => [
            'addreass@mail.com.br', 'Display Name'
        ],
        // driver
        'provider' => PHPMailer\PHPMailer\PHPMailer::class,
    ],
    
];
