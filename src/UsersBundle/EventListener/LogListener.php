<?php

namespace UsersBundle\EventListener;

use Symfony\Component\EventDispatcher\Event;


class LogListener
{
    private $logger;

    public function __construct(\Symfony\Bridge\Monolog\Logger $logger){


	$this->logger = $logger;
	
	
    }

    public function onLogAction(\UsersBundle\Event\LogEvent $event)
    {
        $this->logger->addInfo($event->getMensaje());
    }
}