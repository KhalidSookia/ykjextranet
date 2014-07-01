<?php

namespace Extranet\DiversBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Extranet\DiversBundle\Entity\Taux;
use Extranet\DiversBundle\Form\TauxType;

/**
 * Taux controller.
 *
 * @Route("/taux")
 */
class TauxController extends Controller
{

    /**
     * Lists all Taux entities.
     *
     * @Route("/", name="taux")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ExtranetDiversBundle:Taux')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Taux entity.
     *
     * @Route("/", name="taux_create")
     * @Method("POST")
     * @Template("ExtranetDiversBundle:Taux:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Taux();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('taux_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Taux entity.
    *
    * @param Taux $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Taux $entity)
    {
        $form = $this->createForm(new TauxType(), $entity, array(
            'action' => $this->generateUrl('taux_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Taux entity.
     *
     * @Route("/new", name="taux_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Taux();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Taux entity.
     *
     * @Route("/{id}", name="taux_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExtranetDiversBundle:Taux')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Taux entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Taux entity.
     *
     * @Route("/{id}/edit", name="taux_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExtranetDiversBundle:Taux')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Taux entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Taux entity.
    *
    * @param Taux $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Taux $entity)
    {
        $form = $this->createForm(new TauxType(), $entity, array(
            'action' => $this->generateUrl('taux_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Taux entity.
     *
     * @Route("/{id}", name="taux_update")
     * @Method("PUT")
     * @Template("ExtranetDiversBundle:Taux:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExtranetDiversBundle:Taux')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Taux entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('taux_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Taux entity.
     *
     * @Route("/{id}", name="taux_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ExtranetDiversBundle:Taux')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Taux entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('taux'));
    }

    /**
     * Creates a form to delete a Taux entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('taux_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
