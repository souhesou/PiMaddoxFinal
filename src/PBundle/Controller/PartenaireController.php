<?php

namespace PBundle\Controller;

use PBundle\Entity\Partenaire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Dompdf\Dompdf;
use Dompdf\Options;

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
     * @Route("/", name="partenaire_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $partenaires = $em->getRepository('PBundle:Partenaire')->findAll();

        return $this->render('partenaire/index.html.twig', array(
            'partenaires' => $partenaires,
        ));
    }

    /**
     * Creates a new partenaire entity.
     *
     * @Route("/new", name="partenaire_new")
     * @Method({"GET", "POST"})
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
     * @Route("/{id}", name="partenaire_show")
     * @Method("GET")
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
     * @Route("/{id}/pdf", name="partenaire_pdf")
     * @Method("GET")
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
     * @Route("/{id}/edit", name="partenaire_edit")
     * @Method({"GET", "POST"})
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
     * @Route("/{id}", name="partenaire_delete")
     * @Method("DELETE")
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

    public function getRealEntities($partenaires){
        foreach ($partenaires as $partenaire){
            $realEntities[$partenaires->getId()] = [$partenaires->getNom(),$partenaires->getType()];
        }
        return $realEntities;
    }
}
