<?php

namespace ProjectBundle\EventListener;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\UserEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class RegistrationConfirmListener implements EventSubscriberInterface
{
    private $router;
 
    public function __construct(UrlGeneratorInterface $router)
    {
        $this->router = $router;
    }
 
    /**
     * {@inheritDoc}
     */
   public static function getSubscribedEvents()
{
    return array(
                FOSUserEvents::REGISTRATION_SUCCESS => 'onRegistrationConfirm'
    );
}
 
    public function onRegistrationConfirm(\FOS\UserBundle\Event\FormEvent $event)
    {
        $url = $this->router->generate('fos_user_security_login');

        $event->setResponse(new RedirectResponse($url));
    }
}

?>