<?php

namespace Extranet\DiversBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Extranet\DiversBundle\Entity\Entete;
use Extranet\DiversBundle\Form\EnteteType;

/**
 * Entete controller.
 *
 * @Route("/entete")
 */
class EnteteController extends Controller
{

    /**
     * Lists all Entete entities.
     *
     * @Route("/", name="entete")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ExtranetDiversBundle:Entete')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Entete entity.
     *
     * @Route("/", name="entete_create")
     * @Method("POST")
     * @Template("ExtranetDiversBundle:Entete:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Entete();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('entete_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Entete entity.
    *
    * @param Entete $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Entete $entity)
    {
        $form = $this->createForm(new EnteteType(), $entity, array(
            'action' => $this->generateUrl('entete_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Entete entity.
     *
     * @Route("/new", name="entete_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Entete();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Entete entity.
     *
     * @Route("/{id}", name="entete_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExtranetDiversBundle:Entete')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Entete entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Entete entity.
     *
     * @Route("/{id}/edit", name="entete_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExtranetDiversBundle:Entete')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Entete entity.');
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
    * Creates a form to edit a Entete entity.
    *
    * @param Entete $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Entete $entity)
    {
        $form = $this->createForm(new EnteteType(), $entity, array(
            'action' => $this->generateUrl('entete_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Entete entity.
     *
     * @Route("/{id}", name="entete_update")
     * @Method("PUT")
     * @Template("ExtranetDiversBundle:Entete:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExtranetDiversBundle:Entete')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Entete entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('entete_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Entete entity.
     *
     * @Route("/{id}", name="entete_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ExtranetDiversBundle:Entete')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Entete entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('entete'));
    }

    /**
     * Creates a form to delete a Entete entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('entete_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
