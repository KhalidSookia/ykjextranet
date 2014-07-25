<?php

namespace Extranet\DispositionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Extranet\DispositionBundle\Entity\Disposition;
use Extranet\DispositionBundle\Entity\Wkdate;
use Extranet\DispositionBundle\Form\DispositionType;
use Extranet\DiversBundle\Entity\Taux;

/**
 * Disposition controller.
 *
 * @Route("/disposition")
 */
class DispositionController extends Controller
{
    /**
     * Lists all Disposition entities.
     *
     * @Route("/", name="disposition")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ExtranetDispositionBundle:Disposition')->findBy(array(),array('id' => 'DESC'));


        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Disposition entity.
     *
     * @Route("/", name="disposition_create")
     * @Method("POST")
     * @Template("ExtranetDispositionBundle:Disposition:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Disposition();
        //$entity->addWkdate(new WkDate());

        $em = $this->getDoctrine()->getManager();

        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('generate_disposition', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Disposition entity.
    *
    * @param Disposition $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Disposition $entity)
    {       
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new DispositionType(), $entity, array(
            'action' => $this->generateUrl('disposition_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Disposition entity.
     *
     * @Route("/new", name="disposition_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Disposition();


        $em = $this->getDoctrine()->getManager();


        $tauxRepository = $em->getRepository('ExtranetDiversBundle:Taux');
        $taux = $tauxRepository->findOneBy(array(), array('id' => 'DESC'));

        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'taux'   => $taux,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Disposition entity.
     *
     * @Route("/{id}", name="disposition_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExtranetDispositionBundle:Disposition')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Disposition entity.');
        }

        return array(
            'entity'      => $entity,
            //'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Disposition entity.
     *
     * @Route("/{id}/edit", name="disposition_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExtranetDispositionBundle:Disposition')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Disposition entity.');
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
    * Creates a form to edit a Disposition entity.
    *
    * @param Disposition $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Disposition $entity)
    {
        $form = $this->createForm(new DispositionType(), $entity, array(
            'action' => $this->generateUrl('disposition_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Disposition entity.
     *
     * @Route("/{id}", name="disposition_update")
     * @Method("PUT")
     * @Template("ExtranetDispositionBundle:Disposition:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExtranetDispositionBundle:Disposition')->find($id);

        $entity->setUpdatedAt(new \Datetime());

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Disposition entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();


            return $this->redirect($this->generateUrl('generate_disposition', array('id' => $entity->getId())));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Disposition entity.
     *
     * @Route("/{id}", name="disposition_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ExtranetDispositionBundle:Disposition')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Disposition entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('disposition'));
    }

    /**
     * Creates a form to delete a Disposition entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('disposition_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}