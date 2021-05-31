<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin/usuarios")
 */
class UsuariosController extends AbstractController
{
    /**
     * @Route("/", name="usuarios_index")
     */
    public function index(Request $request): Response
    {
    
          return $this->render('Usuarios/index.html.twig', [
            'usuarios' => 'asd',
        ]);
    }

     /**
     * @Route("/makeadmin/{id}",options={"expose"=true}, name="makeadmin")
     */
    public function makeadmin($id): Response
    {
       
        $usuario =  $this->getDoctrine()->getRepository(User::class)->findOneBy(array(
            'id'=>$id,             
        ));   
        $usuario->addRole("ROLE_ADMIN");      
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($usuario);          
        $entityManager->flush();          
        $this->addFlash('success', 'Usuario '.$usuario->getUserName().' actualizado como administrador');
        return $this->render('Usuarios/index.html.twig', [
            'usuarios' => 'asd'           
        ]);
    }

     /**
     * @Route("/removeadmin/{id}",options={"expose"=true}, name="removeadmin")
     */
    public function removeadmin($id): Response
    {
    
        $usuario =  $this->getDoctrine()->getRepository(User::class)->findOneBy(array(
            'id'=>$id,             
        ));   
        $usuario->removeRole("ROLE_ADMIN");      
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($usuario);          
        $entityManager->flush();      
        $this->addFlash('warning', 'todos los permisos para el usuario '.$usuario->getUserName().' han sido eliminados. Se forzará un cierre de sesion si es el usuario logueado'); 
        return $this->render('Usuarios/index.html.twig', [
            'usuarios' => 'asd',
        ]);
    }
}
