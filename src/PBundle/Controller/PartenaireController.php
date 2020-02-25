<?php

namespace PBundle\Controller;

use PBundle\Entity\Partenaire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Dompdf\Dompdf;
use Dompdf\Options;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;

/**
 * Partenaire controller.
 *
 * @Route("partenaire")
 */
class PartenaireController extends Controller
{
    /**
     * Lists all partenaire entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('PBundle:Partenaire')->createQueryBuilder('p');

        if($request->query->getAlnum('filter'))
        {
            $queryBuilder
                ->where('p.nom LIKE :nom')
                ->setParameter('nom', '%'. $request->query->getAlnum('filter'). '%');
        }
        $query =$queryBuilder ->getQuery();

        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */

        $paginator =$this->get('knp_paginator');
        $result =$paginator->paginate(
            $query,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',5)
        );
        return $this->render('Partenaire/index.html.twig',[
            'partenaire'=>$result,
        ]);
    }

    /**
     * Creates a new partenaire entity.
     *
     */
    public function newAction(Request $request)
    {
        $partenaire = new Partenaire();
        $form = $this->createForm('PBundle\Form\PartenaireType', $partenaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($partenaire);
            $em->flush();

            return $this->redirectToRoute('partenaire_show', array('id' => $partenaire->getId()));
        }

        return $this->render('partenaire/new.html.twig', array(
            'partenaire' => $partenaire,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a partenaire entity.
     *
     */
    public function showAction(Partenaire $partenaire)
    {
        $deleteForm = $this->createDeleteForm($partenaire);

        return $this->render('partenaire/show.html.twig', array(
            'partenaire' => $partenaire,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Finds and displays a partenaire entity.
     *
     */
    public   function  pdfAction(Request $request)
    {

        $pdfOptions =new Options();
        $pdfOptions->set('default','Arial');

        $dompdf = new Dompdf($pdfOptions);

        $em =  $this->getDoctrine()->getManager() ;
        $partenaire =  $em->getRepository(Partenaire::class)->findAll();
        //    return $this->render("@partenaire/pdf.html.twig",array("event"=>$event));

        $html =$this->renderView('partenaire/pdf.html.twig',array("partenaire"=>$partenaire));


        $dompdf->loadHtml($html);


        $dompdf->setPaper('A4','portrait');

        $dompdf->render();

        $dompdf->stream("pdf.html.twig",["Attachment"=>true]);
        $dompdf->output();
        return $this->render("partenaire/pdf.html.twig",array("partenaire"=>$partenaire));
    }

    /**
     * Displays a form to edit an existing partenaire entity.
     *
     */
    public function editAction(Request $request, Partenaire $partenaire)
    {
        $deleteForm = $this->createDeleteForm($partenaire);
        $editForm = $this->createForm('PBundle\Form\PartenaireType', $partenaire);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('partenaire_edit', array('id' => $partenaire->getId()));
        }

        return $this->render('partenaire/edit.html.twig', array(
            'partenaire' => $partenaire,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a partenaire entity.
     *
     */
    public function deleteAction(Request $request, Partenaire $partenaire)
    {
        $form = $this->createDeleteForm($partenaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($partenaire);
            $em->flush();
        }

        return $this->redirectToRoute('partenaire_index');
    }

    /**
     * Creates a form to delete a partenaire entity.
     *
     * @param Partenaire $partenaire The partenaire entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Partenaire $partenaire)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('partenaire_delete', array('id' => $partenaire->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    public function searchAction(Request $request)

    {
        $em = $this->getDoctrine()->getManager();
        $requestString = $request->get('q');
        $partenaires =  $em->getRepository('PBundle:Partenaire')->findEntitiesByString($requestString);
        if(!$partenaires) {
            $result['partenaires']['error'] = "Partenaire Not found :( ";
        } else {
            $result['partenaires'] = $this->getRealEntities($partenaires);
        }
        return new Response(json_encode($result));
    }

    public function getRealEntities($partenaire){
        foreach ($partenaire as $partenaire){
            $realEntities[$partenaire->getId()] = [$partenaire->getNom(),$partenaire->getType()];
        }
        return $realEntities;
    }
}
