<?php

namespace ForumBundle\Controller;

use ForumBundle\Entity\Cassociale;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Cassociale controller.
 *
 */
class CassocialeController extends Controller
{
    /**
     * Lists all cassociale entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $cassociales = $em->getRepository('ForumBundle:Cassociale')->findAll();


        return $this->render('cassociale/index.html.twig', array(
            'cassociales' => $cassociales,
        ));
    }
    public function index_frontAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $cassociales = $em->getRepository('ForumBundle:Cassociale')->findAll();
        $paginator= $this->get('knp_paginator');
        $cassociales = $paginator->paginate(
            $cassociales, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            3
        );

        return $this->render('cassociale/index_front.html.twig', array(
            'cassociales' => $cassociales,
        ));
    }

    /**
     * Creates a new cassociale entity.
     *
     *
     */
    public function newAction(Request $request)
    {
        $cassociale = new Cassociale();
        $form = $this->createForm('ForumBundle\Form\CassocialeType', $cassociale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cassociale);
            $em->flush();

            return $this->redirectToRoute('sociale_show', array('id' => $cassociale->getId()));
        }

        return $this->render('cassociale/new.html.twig', array(
            'cassociale' => $cassociale,
            'form' => $form->createView(),
        ));
    }
    public function new_frontAction(Request $request)
    {
        $cassociale = new Cassociale();
        $form = $this->createForm('ForumBundle\Form\CassocialeType', $cassociale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cassociale);
            $em->flush();

            return $this->redirectToRoute('sociale_show_front', array('id' => $cassociale->getId()));
        }

        return $this->render('cassociale/new_front.html.twig', array(
            'cassociale' => $cassociale,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a cassociale entity.
     *
     */
    public function showAction(Cassociale $cassociale)
    {
        $deleteForm = $this->createDeleteForm($cassociale);

        return $this->render('cassociale/show.html.twig', array(
            'cassociale' => $cassociale,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    public function show_frontAction(Cassociale $cassociale)
    {
        $deleteForm = $this->createDeleteForm($cassociale);

        return $this->render('cassociale/show_front.html.twig', array(
            'cassociale' => $cassociale,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing cassociale entity.
     *
     */
    public function editAction(Request $request, Cassociale $cassociale)
    {
        $deleteForm = $this->createDeleteForm($cassociale);
        $editForm = $this->createForm('ForumBundle\Form\CassocialeType', $cassociale);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sociale_edit', array('id' => $cassociale->getId()));
        }

        return $this->render('cassociale/edit.html.twig', array(
            'cassociale' => $cassociale,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a cassociale entity.
     *
     */
    public function deleteAction(Request $request, Cassociale $cassociale)
    {
        $form = $this->createDeleteForm($cassociale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($cassociale);
            $em->flush();
        }

        return $this->redirectToRoute('sociale_index');
    }

    /**
     * Creates a form to delete a cassociale entity.
     *
     * @param Cassociale $cassociale The cassociale entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Cassociale $cassociale)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sociale_delete', array('id' => $cassociale->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}
