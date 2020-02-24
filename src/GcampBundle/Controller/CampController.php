<?php

namespace GcampBundle\Controller;

use GcampBundle\Entity\Camp;
use GcampBundle\Entity\Cord;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Camp controller.
 *
 */
class CampController extends Controller
{
    /**
     * Lists all camp entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $camps = $em->getRepository('GcampBundle:Camp')->findAll();

        return $this->render('camp/index.html.twig', array(
            'camps' => $camps,
        ));
    }

    /**
     * Creates a new camp entity.
     *
     */
    public function newAction(Request $request)
    {
        $camp = new Camp();
        $form = $this->createForm('GcampBundle\Form\CampType', $camp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($camp);
            $em->flush();

            return $this->redirectToRoute('camp_show', array('id' => $camp->getId()));
        }

        return $this->render('camp/new.html.twig', array(
            'camp' => $camp,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a camp entity.
     *
     */
    public function showAction(Camp $camp)
    {
        $deleteForm = $this->createDeleteForm($camp);

        return $this->render('camp/show.html.twig', array(
            'camp' => $camp,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing camp entity.
     *
     */
    public function editAction(Request $request, Camp $camp)
    {
        $deleteForm = $this->createDeleteForm($camp);
        $editForm = $this->createForm('GcampBundle\Form\CampType', $camp);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('camp_edit', array('id' => $camp->getId()));
        }

        return $this->render('camp/edit.html.twig', array(
            'camp' => $camp,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a camp entity.
     *
     */
    public function deleteAction(Request $request, Camp $camp)
    {
        $form = $this->createDeleteForm($camp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($camp);
            $em->flush();
        }

        return $this->redirectToRoute('camp_index');
    }

    /**
     * Creates a form to delete a camp entity.
     *
     * @param Camp $camp The camp entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Camp $camp)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('camp_delete', array('id' => $camp->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function pdfAction(Request $request , Camp $camp)
    {
        $snappy = $this->get("knp_snappy.pdf");

        $html = $this->renderView("camp/pdf.html.twig", array(
            "title" => "Awesome PDF Title",
            'camp'=>$camp
        ));

        $filename = "resultat";

        return new Response(
            $snappy->getOutputFromHtml($html),
            200,
            array(
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="'.$filename.'.pdf"',
            )
        );

    }
    public function mapAction(Camp $camp,$id)
    {
        $deleteForm = $this->createDeleteForm($camp);



        $coord = $this->getDoctrine()->getRepository(Cord::class)->latt($id);
        return $this->render('camp/map.html.twig', array(
            'coord' => $coord,
            'delete_form' =>$deleteForm,

        ));
    }
    public function localAction(Camp $camp,$id)
    {
        $deleteForm = $this->createDeleteForm($camp);



        $coord = $this->getDoctrine()->getRepository(Cord::class)->latt($id);
        return $this->render('camp/map.html.twig', array(
            'coord' => $coord,
            'delete_form' =>$deleteForm,

        ));
    }

}
