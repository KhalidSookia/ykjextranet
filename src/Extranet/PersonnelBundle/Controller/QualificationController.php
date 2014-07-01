<?php

namespace Extranet\PersonnelBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Extranet\PersonnelBundle\Entity\Qualification;
use Extranet\PersonnelBundle\Form\QualificationType;

/**
 * Qualification controller.
 *
 * @Route("/qualification")
 */
class QualificationController extends Controller
{

    /**
     * Lists all Qualification entities.
     *
     * @Route("/", name="qualification")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ExtranetPersonnelBundle:Qualification')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Qualification entity.
     *
     * @Route("/", name="qualification_create")
     * @Method("POST")
     * @Template("ExtranetPersonnelBundle:Qualification:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Qualification();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('qualification_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Qualification entity.
    *
    * @param Qualification $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Qualification $entity)
    {
        $form = $this->createForm(new QualificationType(), $entity, array(
            'action' => $this->generateUrl('qualification_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Qualification entity.
     *
     * @Route("/new", name="qualification_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Qualification();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Qualification entity.
     *
     * @Route("/{id}", name="qualification_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExtranetPersonnelBundle:Qualification')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Qualification entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Qualification entity.
     *
     * @Route("/{id}/edit", name="qualification_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExtranetPersonnelBundle:Qualification')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Qualification entity.');
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
    * Creates a form to edit a Qualification entity.
    *
    * @param Qualification $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Qualification $entity)
    {
        $form = $this->createForm(new QualificationType(), $entity, array(
            'action' => $this->generateUrl('qualification_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Qualification entity.
     *
     * @Route("/{id}", name="qualification_update")
     * @Method("PUT")
     * @Template("ExtranetPersonnelBundle:Qualification:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExtranetPersonnelBundle:Qualification')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Qualification entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('qualification_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Qualification entity.
     *
     * @Route("/{id}", name="qualification_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ExtranetPersonnelBundle:Qualification')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Qualification entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('qualification'));
    }

    /**
     * Creates a form to delete a Qualification entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('qualification_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
