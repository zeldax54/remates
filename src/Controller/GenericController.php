<?php

namespace App\Controller;

use App\Entity\Lote;
use App\Entity\Oferta;
use App\Entity\Toro;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
use stdClass;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;




class GenericController extends AbstractController
{

    /**
     * @Route("/filterLotesRetIds", name="filterLotesRetIds",options={"expose"= true}, methods={"POST"})
     */
    public function FilterLotesRetIds(Request $request)
    {
        $cabanaid = $request->request->get('eventoid'); //evtnto
        $categoria = $request->request->get('categoria');
        $cabana = $request->request->get('cabana');
        $raza = $request->request->get('raza');


        $qb = new QueryBuilder($this->getDoctrine()->getManager());
        $qb
            ->select("L", "T", "R", "C", "CE")
            ->from("App:Lote", "L")
            ->leftJoin("L.raza", "R")
            ->leftJoin("L.toros", "T")
            ->leftJoin("L.cabana", "C")
            ->leftJoin("L.categoria", "Ca")
            ->leftJoin("L.cabanaentity", "CE")
            ->Where("C.id=" . $cabanaid);


        if ($raza != -1)
            $qb->andWhere("R.id=" . $raza);
        if ($categoria != -1)
            $qb->andWhere("Ca.id=" . $categoria);
        if ($cabana != -1)
            $qb->andWhere("CE.id=" . $cabana);
        $result = $qb->getQuery()->getArrayResult();
        $info = array();
        foreach ($result as $o)
            $info[] = $o['id'];

        return new JsonResponse(
            array('data' => $info)
        );
    }

    /**
     * @Route("/offerhistory", name="offerhistory",options={"expose"= true}, methods={"POST"})
     */
    public function GetOfferHistory(Request $request)
    {
        $toroid = $request->request->get('toroid');
        $ofertas  = $this->getDoctrine()->getRepository(Oferta::class)->findBy(
            array('toro' => $toroid),
            array('fecha' => 'desc')
        );
        $info = '';
        foreach ($ofertas as $o) {
            $info .= $o->getOfertado() . ' / ' . $o->getFecha()->format('d-m-Y H:i:s') . "\r\n";
        }

        return new JsonResponse(
            array('data' => $info)
        );
    }



    /**
     * @Route("/admin/generictable", name="generictable")
     */
    public function getData(Request $request): Response
    {
        date_default_timezone_set("America/Argentina/Buenos_Aires");
        $entityName = $request->request->get('entityName');
        $columnsName = $request->request->get('columnsName');
        $current = $request->request->get('current');
        $searchPhrase = $request->request->get('searchPhrase');
        $rowCount = $request->request->get('rowCount');
        $sort = $request->request->get('sort');
        $parentEntity = $request->request->get('parentEntity');
        $offset = 0;
        $query = $this->filtrar($entityName, $searchPhrase, $columnsName, $sort, $parentEntity);
        $paginator = new Paginator($query, $fetchJoinCollection = true);
        $total = $paginator->count();

        if ($rowCount >= 0 && $current > 0) {
            $offset = ($current - 1) * $rowCount;
            if ($offset > $total || $offset < 0) {
                $current = 1;
                $offset = 0;
            }
            $query
                ->setFirstResult($offset)
                ->setMaxResults($rowCount);
        }
        $entities = $query->getArrayResult();

        $result = array(
            "current" => intval($current),
            "rowCount" => intval($rowCount),
            "rows" => $entities,
            "total" => $rowCount
        );
        return new JsonResponse($result);
    }

    private function filtrar($entityName, $searchPhrase, $columnNames, $sort, $parentEntity)
    {
        $qb = new QueryBuilder($this->getDoctrine()->getManager());

        if ($parentEntity != null) {
            $qb->select("E", "P")
                ->from("App:" . $entityName, "E")
                ->leftJoin("E." . $parentEntity, "P");
        } else {
            $qb
                ->select("E")
                ->from("App:" . $entityName, "E");
        }

        if ($searchPhrase != null) {
            foreach ($columnNames as $column)
                $qb->where($qb->expr()->like("E." . $column, $qb->expr()->literal("%" . $searchPhrase . "%")));

            if ($parentEntity != null)
                $qb->where($qb->expr()->like("P.nombre", $qb->expr()->literal("%" . $searchPhrase . "%")));
        }
        if ($sort != null) {
            foreach ($sort as $key => $value)
                $qb->orderBy("E." . $key, $value);
        } else
            $qb->orderBy("E.id", 'DESC');
        return $qb->getQuery();
    }


    public function filterLotes(Request $request)
    {

        $raza = $request->request->get('raza');
        $categoria = $request->request->get('categoria');
        $cabana = $request->request->get('cabana');
        $cabanasentity = $request->request->get('cabanasentity');

        $qb = new QueryBuilder($this->getDoctrine()->getManager());
        $qb
            ->select("L", "T", "R", "C", "CE")
            ->from("App:Lote", "L")
            ->leftJoin("L.raza", "R")
            ->leftJoin("L.toros", "T")
            ->leftJoin("L.cabana", "C")
            ->leftJoin("L.categoria", "Ca")
            ->leftJoin("L.cabanaentity", "CE");

        if ($raza != -1)
            $qb->andWhere("R.id=" . $raza);
        if ($categoria != -1)
            $qb->andWhere("Ca.id=" . $categoria);
        if ($cabana != -1)
            $qb->andWhere("C.id=" . $cabana);
        if ($cabanasentity != -1)
            $qb->andWhere("CE.id=" . $cabanasentity);
      
            $result = $qb->getQuery()->getArrayResult();

        /* foreach ($result as &$r) {
            if (count($r['gallery']) > 0)
                $r['portadaImg'] =   $request->getUriForPath('/uploads/Lote/Gallery/' . reset($r['gallery']));
            else
                $r['portadaImg']  =   $request->getUriForPath('/uploads/genericsimages/bullsilhouette.jpg');
            $r['oferInfo'] = $this->getDoctrine()->getRepository(Lote::class)->find($r['id'])->OferTextInfo();
        }*/

        $info = array();
        foreach ($result as $o)
            $info[] = $o['id'];

        return new JsonResponse(
            array('data' => $info)
        );
    }

    /**
     * @Route("/getLastOffer", name="getLastOffer",options={"expose"= true}, methods={"POST"})
     */
    public function getLastOffer(Request $request): Response
    {
        $toroId = $request->request->get('toroId');
        $loteId = $request->request->get('loteId');

        $oferta = $this->getOferta($loteId, $toroId);
        $lote = $this->getDoctrine()->getRepository(Lote::class)->find($loteId);
        $preciobase = $this->getDoctrine()->getRepository(Toro::class)->find($toroId)->getPreciobase();;
        $hasprev = !count($oferta) == 0;
        $resp = new stdClass();
        $resp->preciobase = $hasprev == false ? $preciobase : $oferta[0]->getOfertado() + $lote->getIncrementominimo();
        $resp->incminimo = $lote->getIncrementominimo();
        return new JsonResponse($resp);
    }

    /**
     * @Route("/setOffer", name="setOffer",options={"expose"= true}, methods={"POST"})
     */
    public function setOffer(Request $request, MailerInterface $mailer, \Twig_Environment $twig): Response
    {
        try {

            $loteId = $request->request->get('lote');
            $toroId = $request->request->get('toro');
            $nombre = $request->request->get('nombre');
            $empresa = $request->request->get('empresa');
            $dnicuit = $request->request->get('dnicuit');
            $email = $request->request->get('email');
            $telefono = $request->request->get('telefono');
            $oferta = $request->request->get('oferta');
            //Revalidar Oferta
            $ofertainbd = $this->getOferta($loteId, $toroId);
            $lotebd = $this->getDoctrine()->getRepository(Lote::class)->find($loteId);
            $torobd = $this->getDoctrine()->getRepository(Toro::class)->find($toroId);
            // print_r($ofertainbd[0]->getOfertado());die();   
            if (count($ofertainbd) > 0 && $ofertainbd[0]->getOfertado() >= $oferta) {
                $result = array(
                    'msj' => "Hemos registrado que alguien ha hecho una oferta nueva de " .
                        $ofertainbd[0]->getOfertado() . " . Su oferta debe ser al menos de " . ($ofertainbd[0]->getOfertado() + $lotebd->getIncrementominimo()),
                    'newValue' => $ofertainbd[0]->getOfertado() + $lotebd->getIncrementominimo(),
                    'st' => 'FO' //forceReofer
                );
                return new JsonResponse($result);
            }

            $ofertaNueva = new Oferta();
            $ofertaNueva->setNombre($nombre);
            $ofertaNueva->setEmpresa($empresa);
            $ofertaNueva->setDnicuit($dnicuit);
            $ofertaNueva->setEmail($email);
            $ofertaNueva->setTelefono($telefono);
            $ofertaNueva->setOfertado($oferta);
            $ofertaNueva->setFecha(new \DateTime('now'));
            $ofertaNueva->setLote($lotebd);
            $ofertaNueva->setToro($torobd);
            $guid = $this->GUID();
            $ofertaNueva->setToken($guid);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ofertaNueva);
            $entityManager->flush();

            $ofermsj = $this->GethtmlOder($ofertaNueva);
            /*Images*/
            $image1 = $request->getUriForPath('/uploads/genericsimages/image-1.png');
            $image2 = $request->getUriForPath('/uploads/genericsimages/image-2.png');
            $image3 = $request->getUriForPath('/uploads/genericsimages/image-3.png');
            $image4 = $request->getUriForPath('/uploads/genericsimages/image-4.png');
            $image5 = $request->getUriForPath('/uploads/genericsimages/image-5.png');
            $cabeceramsjcliente = '<span class="spanmsj"> Se registr&ograve; una oferta desde su email que esta siendo revisada:</span><br>';
            $footermsjcliente = '<span class="spanmsj">Recibir&aacute; un email similar cuando la oferta sea aprobada o rechazada</span>';
            $html =  $twig->render('frontpages/emailtemplate.html.twig', array(
                'mensaje' => $cabeceramsjcliente . $ofermsj . $footermsjcliente,
                'nombre' => $nombre,
                'image1' => $image1,
                'image2' => $image2,
                'image3' => $image3,
                'image4' => $image4,
                'image5' => $image5,

            ));

            $from = $this->getParameter('mailer_user');
            $this->sendMail('Info Oferta', $email, $from, $html, $mailer);

            //Admin Mail
            $urldenied = $this->generateUrl('deniedoffer', array('oferid' => $ofertaNueva->getId(), 'token' => $guid), UrlGeneratorInterface::ABSOLUTE_URL);
            $urlaccept = $this->generateUrl('aceptdOffer', array('oferid' => $ofertaNueva->getId(), 'token' => $guid), UrlGeneratorInterface::ABSOLUTE_URL);

            $cabeceramsjadmin = '<span class="spanmsj"> Oferta realizada:</span><br>';
            $footermsjadmin = '<span class="spanmsj"> <a href="' . $urlaccept . '"> <span>Aceptar Oferta</span> </a> <br><br><br> <a href="' . $urldenied . '"><span>Rechazar Oferta</span></a></span>';

            $html =  $twig->render('frontpages/emailtemplate.html.twig', array(
                'mensaje' => $cabeceramsjadmin . $ofermsj . $footermsjadmin,
                'nombre' => 'Admin',
                'image1' => $image1,
                'image2' => $image2,
                'image3' => $image3,
                'image4' => $image4,
                'image5' => $image5,
            ));
            $adminmail = $this->getParameter('mailer_admin');
            $this->sendMail('Info Oferta', $adminmail, $from, $html, $mailer);

            $result = array(
                'msj' => 'Oferta enviada con éxito! Recibir&aacute; un email de confirmación.',
                'newValue' => $oferta + $lotebd->getIncrementominimo(),
                'st' => 'ET' //exito
            );
            return new JsonResponse($result);
        } catch (\Exception $e) {
            $adminmail = $this->getParameter('mailer_admin');
            $emessage = (new Email())->subject('Error en el sistema de ofertas')->to($adminmail);
            $from = $this->getParameter('mailer_user');
            $emessage->from($from);
            $emessage->html($e->getMessage() . ' .Linea:' . $e->getLine(), 'text/plain');
            $mailer->send($emessage);
            $result = array(
                'msj' => 'Detectamos un error en el sistema, nuestros especialistas seran alertados automaticamente. Le sugerimos intentar mas tarde.',
                'newValue' => 0,
                'st' => 'ERR' //error
            );
            return new JsonResponse($result);
        }
    }



    /**
     * @Route("/deniedoffer/{oferid}/{token}",options={"expose"=true}, name="deniedoffer")
     */
    public function deniedOffer(Request $request, $oferid, $token, MailerInterface $mailer, \Twig_Environment $twig)
    {
        $ofer =  $this->getDoctrine()->getRepository(Oferta::class)->findOneBy(array(
            'id' => $oferid,
            'token' => $token
        ));
        $ofer->setStatus('R');
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($ofer);
        $entityManager->flush();
        //Email
        $image1 = $request->getUriForPath('/uploads/genericsimages/image-1.png');
        $image2 = $request->getUriForPath('/uploads/genericsimages/image-2.png');
        $image3 = $request->getUriForPath('/uploads/genericsimages/image-3.png');
        $image4 = $request->getUriForPath('/uploads/genericsimages/image-4.png');
        $image5 = $request->getUriForPath('/uploads/genericsimages/image-5.png');
        $cabeceramsjcliente = '<span class="spanmsj">Su oferta ha sido Rechazada, detalles:</span><br>';
        $ofertaHtml = $this->GethtmlOder($ofer);
        $html =  $twig->render('frontpages/emailtemplate.html.twig', array(
            'mensaje' => $cabeceramsjcliente . $ofertaHtml,
            'nombre' => $ofer->getNombre(),
            'image1' => $image1,
            'image2' => $image2,
            'image3' => $image3,
            'image4' => $image4,
            'image5' => $image5,
        ));
        $from = $this->getParameter('mailer_user');
        $email = $ofer->getEmail();
        $this->sendMail('Info Oferta', $email, $from, $html, $mailer);
        return new JsonResponse('Oferta Rechazada. Se ha notificado al cliente');
    }
    /**
     * @Route("/aceptdOffer/{oferid}/{token}",options={"expose"=true}, name="aceptdOffer")
     */
    public function aceptdOffer(Request $request, $oferid, $token, MailerInterface $mailer, \Twig_Environment $twig)
    {
        $ofer =  $this->getDoctrine()->getRepository(Oferta::class)->findOneBy(array(
            'id' => $oferid,
            'token' => $token
        ));
        $toro = $ofer->getToro();
        $toro->setOfertaActual($ofer->getOfertado());
        $ofer->setStatus('A');
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($ofer);
        $entityManager->persist($toro);
        $entityManager->flush();
        //Mail

        $image1 = $request->getUriForPath('/uploads/genericsimages/image-1.png');
        $image2 = $request->getUriForPath('/uploads/genericsimages/image-2.png');
        $image3 = $request->getUriForPath('/uploads/genericsimages/image-3.png');
        $image4 = $request->getUriForPath('/uploads/genericsimages/image-4.png');
        $image5 = $request->getUriForPath('/uploads/genericsimages/image-5.png');
        $cabeceramsjcliente = '<span class="spanmsj">Su oferta ha sido <span style="font-weight:bold;color:green">aceptada</span>!</span><br>';
        $ofertaHtml = $this->GethtmlOder($ofer);
        $html =  $twig->render('frontpages/emailtemplate.html.twig', array(
            'mensaje' => $cabeceramsjcliente . $ofertaHtml,
            'nombre' => $ofer->getNombre(),
            'image1' => $image1,
            'image2' => $image2,
            'image3' => $image3,
            'image4' => $image4,
            'image5' => $image5,
        ));
        $from = $this->getParameter('mailer_user');
        $email = $ofer->getEmail();
        $this->sendMail('Info Oferta', $email, $from, $html, $mailer);
        //Notificar ofertante anterior
        $toroId =  $ofer->getToro()->getId();
        $loteId = $ofer->getLote()->getId();
        $lastOfer =  $this->getDoctrine()->getRepository(Oferta::class)->findBy(array(
            'lote' => $loteId,
            'toro' => $toroId,
            'status' => 'A',

        ), array('id' => 'desc'));

        if (count($lastOfer) > 1) {
            $prevOfer = $lastOfer[1];
            $cabeceramsjcliente = '<span class="spanmsj">Su oferta ha sido <span style="font-weight:bold;color:red">superada</span><br>' .
                'Toro: ' . $ofer->getToro()->getNombre() . '<br> Lote: ' . $ofer->getLote()->getNombre() . '<br> Nueva Oferta: ' .
                $ofer->getOfertado() . '</span><br>';
            $newofertaUrl = $this->generateUrl(
                'lote_detail',
                array(
                    'id' => $ofer->getLote()->getId()
                ),
                UrlGeneratorInterface::ABSOLUTE_URL
            );
            $newoferta = '<br><span style="font-weight:bold;color:#FF7F50;font-size:20px">Click <a href="' . $newofertaUrl . '"> aqui</a> para hacer una nueva oferta<a>';
            $html =  $twig->render('frontpages/emailtemplate.html.twig', array(
                'mensaje' => $cabeceramsjcliente . $newoferta,
                'nombre' => $prevOfer->getNombre(),
                'image1' => $image1,
                'image2' => $image2,
                'image3' => $image3,
                'image4' => $image4,
                'image5' => $image5,
            ));
            //set offert superada
            $prevOfer->setStatus('S');
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($prevOfer);
            $entityManager->flush();
            //
            $from = $this->getParameter('mailer_user');
            $email = $prevOfer->getEmail();
            $this->sendMail('Info Oferta', $email, $from, $html, $mailer);
        }
        return new JsonResponse('Oferta Aceptada. Se ha notificado al cliente y a la oferta previa de su superaci&oacute;n');
    }


    private function getOferta($loteId, $toroId)
    {
        $qb = new QueryBuilder($this->getDoctrine()->getManager());
        $qb->select("O")
            ->from("App:Oferta", "O")
            ->where("O.toro=" . $toroId)
            ->andWhere("O.lote=" . $loteId)
            ->andWhere("O.status='A'")
            ->orderBy('O.id', 'DESC')->setMaxResults(1);
        return $qb->getQuery()->getResult();
    }

    private function sendMail($subjet, $toEmail, $from, $html, $mailer)
    {
        $emessage = (new Email())->subject($subjet)->to($toEmail);
        $from = $this->getParameter('mailer_user');
        $emessage->from($from);
        $emessage->html($html, 'text/plain');
        $mailer->send($emessage);
    }


    private function GUID()
    {
        if (function_exists('com_create_guid') === true) {
            return trim(com_create_guid(), '{}');
        }

        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }

    private function GethtmlOder($oferta)
    {

        $ofermsj = '<span class="spanmsj"> Detalles de la Oferta </span><br>';
        $ofermsj .= '<span class="spanmsj"> Nombre: ' . $oferta->getNombre() . '</span><br>';
        $ofermsj .= '<span class="spanmsj"> Empresa: ' . $oferta->getEmpresa() . '</span><br>';
        $ofermsj .= '<span class="spanmsj"> DNI/CUIT: ' . $oferta->getDnicuit() . '</span><br>';
        $ofermsj .= '<span class="spanmsj"> Email: ' . $oferta->getEmail() . '</span><br>';
        $ofermsj .= '<span class="spanmsj"> Tel&eacute;fono: ' . $oferta->getTelefono() . '</span><br><br><br>';
        $ofermsj .= '<span class="spanmsj"><strong> Ofertado: ' . $oferta->getOfertado() . '</strong></span><br>';
        $ofermsj .= '<span class="spanmsj"> Lote: ' . $oferta->getLote()->getNombre() . '</span><br>';
        $ofermsj .= '<span class="spanmsj"> Toro: ' . $oferta->getToro()->getNombre() . '</span><br><br><br>';
        return $ofermsj;
    }
}
