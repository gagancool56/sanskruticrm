<?php
defined('BASEPATH') or exit('No direct script access allowed');

class WhatsappController extends CRM_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function send_message()
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://graph.facebook.com/v15.0/105954558954427/messages');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{ \"messaging_product\": \"whatsapp\", \"to\": \"15555555555\", \"type\": \"template\", \"template\": { \"name\": \"hello_world\", \"language\": { \"code\": \"en_US\" } } }");

        $headers = array();
        $headers[] = 'Authorization: Bearer EAAFl...';
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
    }
}
