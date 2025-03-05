<?php

namespace App\Services;

use App\Interfaces\ServiceInterface;

/**
 * Serviço para envio de emails
 */
class EmailService implements ServiceInterface
{
    /**
     * Envia um email
     * 
     * @param array $data
     * @return bool
     */
    public function execute(array $data)
    {
        if (empty($data['to']) || empty($data['subject']) || empty($data['message'])) {
            return false;
        }
        
        $to = $data['to'];
        $subject = $data['subject'];
        $message = $data['message'];
        $headers = isset($data['headers']) ? $data['headers'] : 'From: noreply@exemplo.com';
        
        // Em produção, você pode usar bibliotecas como PHPMailer ou Symfony Mailer
        return mail($to, $subject, $message, $headers);
    }
}
