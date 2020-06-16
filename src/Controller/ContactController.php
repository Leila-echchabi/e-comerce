<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, \Swift_Mailer $swift_Mailer)
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

            $message = (new \Swift_Message('Nouveau Contact'))
                ->setFrom($contact['email'])
                ->setTo('josephwatch@outlook.fr')
                ->setBody(
                    $this->renderView(
                        'emails/emailContact.html.twig', compact('contact')
                    ),
                    'text/html'
                )
            ;

            $swift_Mailer->send($message);

            $this->addFlash('message', 'Votre message a été transmis, nous vous répondrons dans les meilleurs délais.');

        }
        return $this->render('contact/contact.html.twig',['contactForm' => $form->createView()]);
    }

}
