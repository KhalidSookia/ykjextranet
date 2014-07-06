<?php

namespace Extranet\DiversBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Extranet\DiversBundle\Entity\Pied;
use Extranet\DiversBundle\Form\PiedType;

/**
 * Pied controller.
 *
 * @Route("/pied")
 */
class PiedController extends Controller
{

    /**
     * Lists all Pied entities.
     *
     * @Route("/", name="pied")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ExtranetDiversBundle:Pied')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Pied entity.
     *
     * @Route("/", name="pied_create")
     * @Method("POST")
     * @Template("ExtranetDiversBundle:Pied:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Pied();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pied_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Pied entity.
    *
    * @param Pied $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Pied $entity)
    {
        $form = $this->createForm(new PiedType(), $entity, array(
            'action' => $this->generateUrl('pied_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Pied entity.
     *
     * @Route("/new", name="pied_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Pied();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Pied entity.
     *
     * @Route("/{id}", name="pied_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExtranetDiversBundle:Pied')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pied entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Pied entity.
     *
     * @Route("/{id}/edit", name="pied_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExtranetDiversBundle:Pied')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pied entity.');
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
    * Creates a form to edit a Pied entity.
    *
    * @param Pied $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Pied $entity)
    {
        $form = $this->createForm(new PiedType(), $entity, array(
            'action' => $this->generateUrl('pied_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Pied entity.
     *
     * @Route("/{id}", name="pied_update")
     * @Method("PUT")
     * @Template("ExtranetDiversBundle:Pied:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExtranetDiversBundle:Pied')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pied entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('pied_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Pied entity.
     *
     * @Route("/{id}", name="pied_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ExtranetDiversBundle:Pied')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Pied entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('pied'));
    }

    /**
     * Creates a form to delete a Pied entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pied_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
