<?php
// src/EventSubscriber/MenuBuilderSubscriber.php
namespace App\EventSubscriber;

use KevinPapst\AdminLTEBundle\Event\SidebarMenuEvent;
use KevinPapst\AdminLTEBundle\Model\MenuItemModel;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class MenuBuilderSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            SidebarMenuEvent::class => ['onSetupMenu', 100],
        ];
    }
    
    public function onSetupMenu(SidebarMenuEvent $event)
    {
        $blog = new MenuItemModel('nomecladorId', 'Nomencladores', 'index_admin', [], 'fa fa-edit text-blue');
    
        $blog->addChild(
            new MenuItemModel('caracteristicasId', 'Categorias', 'categoria_index', [], 'fa fa-circle-o text-blue')
        )->addChild(
            new MenuItemModel('razasId', 'Razas', 'razas_index', [], 'fa fa-circle-o text-blue')
        );

        $toro = new MenuItemModel('toroId', 'Toros', 'toro_index', [], 'fas fa-book-open');
        $lote = new MenuItemModel('loteId', 'Lotes', 'lote_index', [], 'fas fa-book-open');
        $cabana = new MenuItemModel('cabanaId', 'Cabañas', 'cabana_index', [], 'fas fa-book-open');
        
        $event->addItem($blog);
        $event->addItem($toro);
        $event->addItem($lote);
        $event->addItem($cabana);

        $this->activateByRoute(
            $event->getRequest()->get('_route'),
            $event->getItems()
        );
    }

    /**
     * @param string $route
     * @param MenuItemModel[] $items
     */
    protected function activateByRoute($route, $items)
    {
        foreach ($items as $item) {
            if ($item->hasChildren()) {
                $this->activateByRoute($route, $item->getChildren());
            } elseif ($item->getRoute() == $route) {
                $item->setIsActive(true);
            }
        }
    }
}