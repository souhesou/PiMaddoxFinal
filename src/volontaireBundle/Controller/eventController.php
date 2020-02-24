<?php

namespace volontaireBundle\Controller;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use volontaireBundle\Entity\event;
use volontaireBundle\Form\eventType;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\ColumnChart;
use Dompdf\Dompdf;
use Dompdf\Options;

class eventController extends Controller
{



    public function ajouteventAction(Request $request)
    {
        $event = new event();
        $form =$this->createForm(eventType::class,$event);
        $form->handleRequest($request);
        // $candidat->setSujet(null);
        if($form->isSubmitted())
        {
            $em = $this->getDoctrine()->getManager();
            $event->uploadProfilePicture();
            $em->persist($event);
            $em->flush();
            return $this->redirectToRoute('volontaireafficheevent');
        }
        return $this->render("@volontaire/event/ajoute.html.twig",array("form"=>$form->createView()));
    }


    public   function  afficheeventAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager() ;
        $event =  $em->getRepository(event::class)->findAll();
        if($request->isMethod("POST"))
        {
            $nom =$request->get("nom");
            $event  = $em->getRepository("volontaire:event")->findBy(array("nom"=>$nom));

        }

        return $this->render("@volontaire/event/affichee.html.twig",array("event"=>$event));

    }
    public   function  calAction()
    {



        return $this->render("@volontaire/event/Calendar.html.twig");

    }

    public function supprimereventAction($id)
    {

        $em = $this->getDoctrine()->getManager() ;
        $event = $em->getRepository(event::class)->find($id) ;
        $em->remove($event);
        $em->flush();
        return $this->redirectToRoute('volontaireafficheevent');

    }


    public function updateeventAction(Request $request , $id)
    {
        $event = $this->getDoctrine()->getRepository(event::class)->find($id);
        $form = $this->createForm(eventType::class , $event) ;
        $form = $form->handleRequest($request);

        if($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager() ;
            $em->persist($event);
            $em->flush();
            return $this->redirectToRoute('volontaireafficheevent');
        }
        return $this->render('@volontaire/event/updatee.html.twig' , array('form'=>$form->createView())) ;

    }


    public function StatistiqueAction(Request $request)
    {
        $pieChart = new PieChart();
        $em= $this->getDoctrine();
        $Asso = $em->getRepository(event::class)->findAll();
        $data= array();
        $stat=['event', 'lieu'];
        $nb=0;
        array_push($data,$stat);
        foreach($Asso as $classe) {
            $stat=array();
            array_push($stat,$classe->getTitre(),$classe->getLieu());
            $nb=($classe->getPrix());
            $stat=[$classe->getLieu(),$nb];
            array_push($data,$stat);
        }
        $pieChart->getData()->setArrayToDataTable(
            $data
        );
        $pieChart->getOptions()->setTitle('lieu / Event');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);
        return $this->render('@volontaire\event\statevent.html.twig', array('piechart' => $pieChart));
    }




    public   function  pdfAction(Request $request)
    {

        $pdfOptions =new Options();
        $pdfOptions->set('default' ,'Arial');

        $dompdf = new Dompdf($pdfOptions);

        $em =  $this->getDoctrine()->getManager() ;
        $event =  $em->getRepository(event::class)->findAll();
        return $this->render("@volontaire/event/pdf.html.twig",array("event"=>$event));

        $html =$this->renderView('@volontaire/event/pdf.html.twig',array("event"=>$event));


        $dompdf->loadHtml($html);


        $dompdf->setPaper('A4','portrait');

        $dompdf->render();

        $dompdf->stream("pdf.html.twig",["Attachment"=>true]);
        $dompdf->output();
        return $this->render("@volontaire/event/affichee.html.twig",array("event"=>$event));

    }




    public function RecherchevAction(Request $request)
    {
        /*  $em = $this->getDoctrine()->getManager() ;
          $volontaire =  $em->getRepository(volontaire::class)->findAll();
          if($request->isMethod("POST"))
          {
              $recherche =$request->get('recherche');
              $volontaire  = $em->getRepository("volontaireBundle:volontaire")->findBy(array("recherche"=>$recherche));

          }
          return $this->render("@volontaire/volontaire/affichev.html.twig",array("volontaire"=>$volontaire));*/
        $em = $this->getDoctrine()->getManager();
        $requestString = $request->get('rechercher');
        $event =  $em->getRepository('volontaireBundle:event')->find($requestString);
        if(!$event) {
            $result['event']['error'] = "Post Not found :( ";
        } else {
            $result['titre'] = $event->getTitre();
            //   $result['nom'] = $event->getNom();
            //  $result['prenom'] = $event->getPrenom();
            //   $result['age'] = $volontaire->getage();

        }
        return new Response(json_encode($result));




    }

}
