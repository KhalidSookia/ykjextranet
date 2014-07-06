<?php

namespace Extranet\PersonnelBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Extranet\PersonnelBundle\Entity\Personnel;
use Extranet\PersonnelBundle\Form\PersonnelType;

/**
 * Personnel controller.
 *
 * @Route("/personnel")
 */
class PersonnelController extends Controller
{

    /**
     * Lists all Personnel entities.
     *
     * @Route("/", name="personnel")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ExtranetPersonnelBundle:Personnel')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Personnel entity.
     *
     * @Route("/", name="personnel_create")
     * @Method("POST")
     * @Template("ExtranetPersonnelBundle:Personnel:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Personnel();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('personnel_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Personnel entity.
    *
    * @param Personnel $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Personnel $entity)
    {
        $form = $this->createForm(new PersonnelType(), $entity, array(
            'action' => $this->generateUrl('personnel_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Personnel entity.
     *
     * @Route("/new", name="personnel_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Personnel();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Personnel entity.
     *
     * @Route("/{id}", name="personnel_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExtranetPersonnelBundle:Personnel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Personnel entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Personnel entity.
     *
     * @Route("/{id}/edit", name="personnel_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExtranetPersonnelBundle:Personnel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Personnel entity.');
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
    * Creates a form to edit a Personnel entity.
    *
    * @param Personnel $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Personnel $entity)
    {
        $form = $this->createForm(new PersonnelType(), $entity, array(
            'action' => $this->generateUrl('personnel_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Personnel entity.
     *
     * @Route("/{id}", name="personnel_update")
     * @Method("PUT")
     * @Template("ExtranetPersonnelBundle:Personnel:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExtranetPersonnelBundle:Personnel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Personnel entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('personnel_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Personnel entity.
     *
     * @Route("/{id}", name="personnel_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ExtranetPersonnelBundle:Personnel')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Personnel entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('personnel'));
    }

    /**
     * Creates a form to delete a Personnel entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('personnel_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
