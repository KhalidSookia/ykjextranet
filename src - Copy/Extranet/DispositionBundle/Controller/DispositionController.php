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

        $wkdateRepository = $em->getRepository('ExtranetDispositionBundle:Wkdate');
        $wkdate = $wkdateRepository->findOneBy(array(), array('id' => 'DESC'));

        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'taux'   => $taux,
            'wkdate' => $wkdate,
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

            return $this->redirect($this->generateUrl('disposition_edit', array('id' => $id)));
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

    public function getEntity($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExtranetDispositionBundle:Disposition')->find($id);

        return $entity;
    }

    public function getEntete()
    {
        $em = $this->getDoctrine()->getManager();

        $entete = $em->getRepository('ExtranetDiversBundle:Entete')->findOneBy(array('active' => true));

        return $entete;
    }

    public function getConditions()
    {
        $em = $this->getDoctrine()->getManager();

        $conditions = $em->getRepository('ExtranetDiversBundle:Conditions')->findOneBy(array('active' => true));

        return $conditions;
    }

    public function getPied()
    {
        $em = $this->getDoctrine()->getManager();

        $pied = $em->getRepository('ExtranetDiversBundle:Pied')->findOneBy(array('active' => true));

        return $pied;
    }

    public function getPdfPath($id)
    {
        $pdfFile = $this->getRequest()->getUriForPath('/../docs/pdf/miseadisposition/' . $id . '.pdf');

        return $pdfFile;
    }

    public function generateDispositionAction($id)
    {
        $section_retour = "<div class='section_retour'>
            <a href='" . $this->generateUrl('disposition') . "' title='Retour à la gestion des mises a disposition'>Retour &agrave; la gestion des mises à disposition</a>
            
            <a href='" . $this->generateUrl('extranet_app_homepage') . "' title='Retour au tableau de bord'>Retour au tableau de bord</a>
        </div>";

        $download_link = '<a href=" ' . $this->generateUrl('download_disposition', array('id' => $id)) . ' ">Visualiser le PDF</a>';
        
        $entity = $this->getEntity($id);
        $conditions = $this->getConditions();
        $entete = $this->getEntete();
        $pied = $this->getPied();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Disposition entity.');
        }

        $urlDisposition = $this->generateUrl('mail_disposition', array('id' => $id));


        return $this->render('ExtranetDispositionBundle:Disposition:disposition.html.twig', array(
            'entity' => $entity,
            'conditions' => $conditions,
            'pied' => $pied,
            'entete' => $entete,
            'section_retour' => $section_retour,
            'email' => "<a href='$urlDisposition' class='safe a_bloc'>Envoyer par mail</a>",
            'download' => $download_link
        ));
    }

    public function generatePdf($id)
    {
        $pdfFile = $this->getPdfPath($id);
        $entity = $this->getEntity($id);
        $conditions = $this->getConditions();
        $entete = $this->getEntete();
        $pied = $this->getPied();


        if(!file_exists($pdfFile)){
            $this->get('knp_snappy.pdf')->generateFromHtml(
                $this->renderView(
                    "ExtranetDispositionBundle:Disposition:disposition.html.twig", array(
                        'entete' => $entete,
                        'entity' => $entity,
                        'conditions' => $conditions,
                        'pied' => $pied,
                        'section_retour' => '',
                        'email' => '',
                        'download' => ''
                    )
                ), "docs/pdf/miseadisposition/$id.pdf"
            );
        }

        return;
    }

    public function removePdf($id)
    {
        unlink(__DIR__ . '/../../../../web/docs/pdf/miseadisposition/' . $id . '.pdf');
    }

    public function mailDispositionAction($id)
    {
        $pdfFile = $this->generatePdf($id);
        $entity = $this->getEntity($id);
        $conditions = $this->getConditions();
        $entete = $this->getEntete();
        $pied = $this->getPied();


        if($entity->getPersonnel()->getCivilite() == false){
            $civilite = 'Mme.';
        }else{
            $civilite = 'Mr.';
        }

        $disposition = "Bonjour. <br>Merci de trouver ci-joint la mise à disposition de " . $civilite . ' ' . $entity->getPersonnel()->getNom() . ' ' . $entity->getPersonnel()->getPrenom() . "<br><br>Très Coridalement<br><br>YKJ Services";

        $mailer = $this->get('mailer');

        $message = \Swift_Message::newInstance()
        ->setSubject("Mise à disposition de " . $civilite . ' ' . $entity->getPersonnel()->getNom() . ' ' . $entity->getPersonnel()->getPrenom())
        ->setFrom('contact@ykjservices.com')
        ->setTo($entity->getUtilisateur()->getEmail())
        ->setBody($disposition, 'text/html')
        ->attach(\Swift_Attachment::fromPath("docs/pdf/miseadisposition/$id.pdf"))
        ;
        //$mailer->send($message);

        $this->get('session')->getFlashBag()->add('info', 'Votre mise à disposition à bien été envoyé.');

        $this->removePdf($id);


        return $this->redirect($this->generateUrl('extranet_app_homepage'));
    }

    public function downloadDispositionAction($id)
    {
        $this->generatePdf($id);
        $pdfPath = $this->getPdfPath($id);
              
        $response = new Response();
        $response->setContent(file_get_contents($pdfPath));
        $response->headers->set('Content-Type', 'application/PDF');

        $this->removePdf($id);
              
        return $response;

    }
}