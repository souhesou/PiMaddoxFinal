<?php

namespace GcampBundle\Controller;

use GcampBundle\Entity\Besoins;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Besoin controller.
 *
 */
class BesoinsController extends Controller
{
    /**
     * Lists all besoin entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $besoins = $em->getRepository('GcampBundle:Besoins')->findAll();

        return $this->render('besoins/index.html.twig', array(
            'besoins' => $besoins,
        ));
    }

    /**
     * Creates a new besoin entity.
     *
     */
    public function newAction(Request $request)
    {
        $besoin = new Besoins();
        $form = $this->createForm('GcampBundle\Form\BesoinsType', $besoin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($besoin);
            $em->flush();

            return $this->redirectToRoute('besoins_show', array('id' => $besoin->getId()));
        }

        return $this->render('besoins/new.html.twig', array(
            'besoin' => $besoin,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a besoin entity.
     *
     */
    public function showAction(Besoins $besoin)
    {
        $deleteForm = $this->createDeleteForm($besoin);

        return $this->render('besoins/show.html.twig', array(
            'besoin' => $besoin,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing besoin entity.
     *
     */
    public function editAction(Request $request, Besoins $besoin)
    {
        $deleteForm = $this->createDeleteForm($besoin);
        $editForm = $this->createForm('GcampBundle\Form\BesoinsType', $besoin);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('besoins_edit', array('id' => $besoin->getId()));
        }

        return $this->render('besoins/edit.html.twig', array(
            'besoin' => $besoin,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a besoin entity.
     *
     */
    public function deleteAction(Request $request, Besoins $besoin)
    {
        $form = $this->createDeleteForm($besoin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($besoin);
            $em->flush();
        }

        return $this->redirectToRoute('besoins_index');
    }

    /**
     * Creates a form to delete a besoin entity.
     *
     * @param Besoins $besoin The besoin entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Besoins $besoin)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('besoins_delete', array('id' => $besoin->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
