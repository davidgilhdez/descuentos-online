<?php

namespace UsersBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class LogEvent extends Event
{
    protected $mensaje;

    public function __construct($mensaje)
    {
        $this->mensaje = $mensaje;
	
    }

    public function getMensaje()
    {
        return $this->mensaje;
    }

}