<?php

namespace Extranet\DispositionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Extranet\DispositionBundle\Entity\Wkdate;
use Extranet\DispositionBundle\Form\WkdateType;

/**
 * Wkdate controller.
 *
 * @Route("/wkdate")
 */
class WkdateController extends Controller
{

    /**
     * Lists all Wkdate entities.
     *
     * @Route("/", name="wkdate")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ExtranetDispositionBundle:Wkdate')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Wkdate entity.
     *
     * @Route("/", name="wkdate_create")
     * @Method("POST")
     * @Template("ExtranetDispositionBundle:Wkdate:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Wkdate();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('wkdate_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Wkdate entity.
     *
     * @param Wkdate $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Wkdate $entity)
    {
        $form = $this->createForm(new WkdateType(), $entity, array(
            'action' => $this->generateUrl('wkdate_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Wkdate entity.
     *
     * @Route("/new", name="wkdate_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Wkdate();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Wkdate entity.
     *
     * @Route("/{id}", name="wkdate_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExtranetDispositionBundle:Wkdate')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Wkdate entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Wkdate entity.
     *
     * @Route("/{id}/edit", name="wkdate_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExtranetDispositionBundle:Wkdate')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Wkdate entity.');
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
    * Creates a form to edit a Wkdate entity.
    *
    * @param Wkdate $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Wkdate $entity)
    {
        $form = $this->createForm(new WkdateType(), $entity, array(
            'action' => $this->generateUrl('wkdate_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Wkdate entity.
     *
     * @Route("/{id}", name="wkdate_update")
     * @Method("PUT")
     * @Template("ExtranetDispositionBundle:Wkdate:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExtranetDispositionBundle:Wkdate')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Wkdate entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {

            $em->flush();

            return $this->redirect($this->generateUrl('wkdate_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Wkdate entity.
     *
     * @Route("/{id}", name="wkdate_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ExtranetDispositionBundle:Wkdate')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Wkdate entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('wkdate'));
    }

    /**
     * Creates a form to delete a Wkdate entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('wkdate_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
