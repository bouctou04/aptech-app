<?php

namespace App;

class Mail
{
    /**
     * @var string
     */
    private string $to;

    /**
     * @var string
     */
    private string $subject;

    /**
     * @var string
     */
    private string $message;

    /**
     * @var string
     */
    private string $header;

    /**
     * Mail constructor.
     */
    public function __construct()
    {
        $to = "bmaiga08@gmail.com";

        $subject = "Votre inscription sur APTECHAPP.com a bien été pris en compte !";

        $message = "Bravo ! Votre inscription a bien été pris en compte";

        $header = "MIME-version: 1.0\r\n";
        $header .= 'FROM: "<aptechapp.com <aptechapp@gmail.com>"'. "\n";
        $header .= 'Content-Type:text/html; charset="utf-8"'. "\n";
        $header .= 'Content-Transfert-Encoding: 8bit';

        $this->setTo($to);
        $this->setSubject($subject);
        $this->setMessage($message);
        $this->setHeader($header);

    }

    /**
     * @param string|null $to
     * @param string|null $subject
     * @param string|null $message
     * @param string|null $header
     * @return bool
     */
    public function sendMail(?string $to = NULL, ?string $subject = NULL, ?string $message = NULL, ?string $header = NULL):bool {

        if($to == NULL) {
            $to = $this->to;
        }

        if($subject == NULL) {
            $subject = $this->subject;
        }

        if($message == NULL) {
            $message = $this->message;
        }

        if($header == NULL) {
            $header = $this->header;
        }

        if(mail($to, $subject, $message, $header)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return string
     */
    public function getTo():string {
        return $this->to;
    }

    /**
     * @return string
     */
    public function getSubject():string {
        return $this->subject;
    }

    /**
     * @return string
     */
    public function getMessage():string {
        return $this->message;
    }

    public function getHeader(string $header):string {
        return $this->header;
    }

    /**
     * @param string $to
     */
    public function setTo(string $to):void {
        $this->to = $to;
    }

    /**
     * @param string $subject
     */
    public function setSubject(string $subject):void {
        $this->subject = $subject;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message):void {
        $this->message = $message;
    }

    /**
     * @param string $header
     */
    public function setHeader(string $header):void {
        $this->header = $header;
    }
}