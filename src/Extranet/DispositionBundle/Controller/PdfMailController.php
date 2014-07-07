<?php

namespace Extranet\DispositionBundle\Controller;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Extranet\DispositionBundle\Controller\DispositionController;
use Extranet\DispositionBundle\Entity\Disposition;
use Extranet\DispositionBundle\Form\DispositionType;
use Extranet\DispositionBundle\Entity\Wkdate;
use Extranet\DispositionBundle\Form\WkdateType;

class PdfMailController extends DispositionController
{

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
        $mailer->send($message);

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