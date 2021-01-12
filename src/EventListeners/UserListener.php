<?php


namespace App\EventListener;


use AppBundle\Controller\Traits\FuncionesFichero;
use DateTimeZone;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Http\SecurityEvents;

class UserListener implements EventSubscriberInterface
{
    private $router;
    private $ruta;
    use FuncionesFichero;

    public function __construct(UrlGeneratorInterface $router,KernelInterface $kernel)
    {
        $this->router = $router;
        $this->ruta = $kernel->getRootDir();
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::REGISTRATION_INITIALIZE => 'onRegistrationInitialize',
            FOSUserEvents::REGISTRATION_SUCCESS => 'onRegistrationSuccess',
            FOSUserEvents::CHANGE_PASSWORD_SUCCESS => 'onChangePasswordSuccess',
            FOSUserEvents::RESETTING_SEND_EMAIL_COMPLETED => 'onResettingSendEmailCompleted',
            FOSUserEvents::RESETTING_RESET_COMPLETED => 'onResettingResetComplete',
            FOSUserEvents::PROFILE_EDIT_INITIALIZE => 'onProfileEditInitialize',
            FOSUserEvents::PROFILE_EDIT_SUCCESS => 'onProfileEditSuccess',
        );
    }

    public function onRegistrationInitialize(GetResponseUserEvent $event)
    {
        $usuario = $event->getUser();
        if(!is_null($event->getRequest()->files->get('fos_user_registration_form')) && array_key_exists('fichero',$event->getRequest()->files->get('fos_user_registration_form'))) {
            $fichero = $event->getRequest()->files->get('fos_user_registration_form')['fichero'];
            if (!is_null($fichero)) {
                // Generar un nombre unico para el fichero antes de salvarlo
                $extension = $fichero->guessExtension();
                $fecha = new \DateTime('now', new DateTimeZone('America/Havana'));
                if (!strpos($fichero->getClientOriginalName(), '.'))
                    $fileName = $fecha->format('d-m-Y-h-i-') . $fichero->getClientOriginalName() . '.' . $extension;
                else
                    $fileName = $fecha->format('d-m-Y-h-i-') . $fichero->getClientOriginalName();
                $this->moverFichero($fichero, $fileName,$this->ruta);
                $usuario->setAvatar($fileName);
                $event->getRequest()->files->remove('fos_user_registration_form');
            }
        }
        $usuario->setEnabled(false);
    }

    public function onRegistrationSuccess(FormEvent $event)
    {
        $url = $this->router->generate('fos_user_security_login');

        $event->setResponse(new RedirectResponse($url));
    }

    public function onChangePasswordSuccess(FormEvent $event)
    {
        $url = $this->router->generate('fos_user_profile_edit');

        $event->setResponse(new RedirectResponse($url));
    }

    public function onResettingSendEmailCompleted(GetResponseUserEvent $event)
    {
        $url = $this->router->generate('fos_user_security_login');

        $event->setResponse(new RedirectResponse($url));
    }

    public function onResettingResetComplete(FilterUserResponseEvent $event)
    {
        $url = $this->router->generate('fos_user_security_login');

        $event->setResponse(new RedirectResponse($url));
    }

    public function onProfileEditInitialize(GetResponseUserEvent $event)
    {
        $usuario = $event->getUser();
        if(!is_null($event->getRequest()->files->get('fos_user_profile_form')) && array_key_exists('fichero',$event->getRequest()->files->get('fos_user_profile_form'))) {
            $fichero = $event->getRequest()->files->get('fos_user_profile_form')['fichero'];
            if (!is_null($fichero)) {
                // Generar un nombre unico para el fichero antes de salvarlo
                $extension = $fichero->guessExtension();
                $fecha = new \DateTime('now', new DateTimeZone('America/Havana'));
                if (!strpos($fichero->getClientOriginalName(), '.'))
                    $fileName = $fecha->format('d-m-Y-h-i-') . $fichero->getClientOriginalName() . '.' . $extension;
                else
                    $fileName = $fecha->format('d-m-Y-h-i-') . $fichero->getClientOriginalName();
                $this->moverFichero($fichero, $fileName,$this->ruta);
                $usuario->setAvatar($fileName);
                $event->getRequest()->files->remove('fos_user_profile_form');
            }
        }
    }

    public function onProfileEditSuccess(FormEvent $event)
    {
        $url = $this->router->generate('fos_user_profile_edit');

        $event->setResponse(new RedirectResponse($url));
    }
}