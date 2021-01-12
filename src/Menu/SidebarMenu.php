<?php

namespace App\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;


class SidebarMenu
{
    protected $authorizationChecker;
    private $factory;

    public function __construct(AuthorizationCheckerInterface $authorizationChecker,FactoryInterface $factory)
    {
        $this->authorizationChecker = $authorizationChecker;
        $this->factory = $factory;
    }


   
    public function createMainMenu(array $options): ItemInterface
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('Home', ['route' => 'admin']);
        // ... add more children
        if($this->authorizationChecker->isGranted('ROLE_ADMIN')){
            $menu->addChild('Home3', ['route' => 'admin']);
        }
        return $menu;
    }
}