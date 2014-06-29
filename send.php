<?php
        error_reporting(E_ALL); // Вывод ошибок.

        $to = 'pixel007@yandex.ru';

        $subject = 'Тема письма';

        $message = 'Текст письма';

        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=windows-1251' . "\r\n";
        $headers .= 'To: user <no-reply@improvement-center.ru>' . "\r\n";
        $headers .= 'From: server <pixel007@yandex.ru>' . "\r\n";

        if (mail($to, $subject, $message, $headers)) {
            echo 'good';
        } else {
            echo 'bad';
        }
?>