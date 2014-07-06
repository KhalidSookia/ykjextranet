<?php

namespace Extranet\DiversBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Extranet\DiversBundle\Entity\Conditions;
use Extranet\DiversBundle\Form\ConditionsType;

/**
 * Conditions controller.
 *
 * @Route("/conditions")
 */
class ConditionsController extends Controller
{

    /**
     * Lists all Conditions entities.
     *
     * @Route("/", name="conditions")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ExtranetDiversBundle:Conditions')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Conditions entity.
     *
     * @Route("/", name="conditions_create")
     * @Method("POST")
     * @Template("ExtranetDiversBundle:Conditions:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Conditions();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('conditions_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Conditions entity.
    *
    * @param Conditions $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Conditions $entity)
    {
        $form = $this->createForm(new ConditionsType(), $entity, array(
            'action' => $this->generateUrl('conditions_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Conditions entity.
     *
     * @Route("/new", name="conditions_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Conditions();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Conditions entity.
     *
     * @Route("/{id}", name="conditions_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExtranetDiversBundle:Conditions')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Conditions entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Conditions entity.
     *
     * @Route("/{id}/edit", name="conditions_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExtranetDiversBundle:Conditions')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Conditions entity.');
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
    * Creates a form to edit a Conditions entity.
    *
    * @param Conditions $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Conditions $entity)
    {
        $form = $this->createForm(new ConditionsType(), $entity, array(
            'action' => $this->generateUrl('conditions_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Conditions entity.
     *
     * @Route("/{id}", name="conditions_update")
     * @Method("PUT")
     * @Template("ExtranetDiversBundle:Conditions:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExtranetDiversBundle:Conditions')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Conditions entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('conditions_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Conditions entity.
     *
     * @Route("/{id}", name="conditions_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ExtranetDiversBundle:Conditions')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Conditions entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('conditions'));
    }

    /**
     * Creates a form to delete a Conditions entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('conditions_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
