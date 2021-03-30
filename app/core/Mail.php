<?php

namespace App;

// direct script
defined('BASE_PATH') or die('Direct Script not Allowed');



class Mail
{
    protected $mailer = '';
    protected $title = false;
    protected $to = [];
    protected $from = [];
    protected $body = false;
    function __construct()
    {

        $mail_config = include __DIR__ . '/../config/Email.php';

        $transport = (new Swift_SmtpTransport($mail_config['server'], $mail_config['protocol']))
            ->setUsername($mail_config['username'])
            ->setPassword($mail_config['password']);
        unset($mail_config);

        $this->mailer = new Swift_Mailer($transport);
        return $this;
    }

    protected function get_builtBody()
    {
        if (empty($this->title) || empty($this->to) || empty($this->from) || empty($this->body))
            return false;
        // Create a message
        return (new Swift_Message($this->title))
            ->setFrom(array_unique($this->from))
            ->setTo(array_unique($this->to))
            ->setBody($this->body);
    }

    public function title($title = '')
    {
        $this->title = $title;
        return $this;
    }
    public function to($to = '')
    {
        is_array($to) ?  array_merge($this->to, $to) : $this->to[] = $to;
        return $this;
    }
    public function from($from = '')
    {
        is_array($from) ?  array_merge($this->from, $from) : $this->from[] = $from;
        return $this;
    }
    public function body($body = '')
    {
        $this->body = $body;
        return $this;
    }
    public function send()
    {
        if ($this->mailer->send($this->get_builtBody()))
            return true;
        return false;
    }

    public function template($name = '', $args = [])
    {
        if (file_exists(BASE_PATH . 'app/templates/mail/' . $name . '.php')) {
            if (is_array($args) && !empty($args))
                extract($args);
            return include BASE_PATH . 'app/templates/mail/' . $name . '.php';
        }
    }
}
