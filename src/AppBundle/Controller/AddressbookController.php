<?php

namespace AppBundle\Controller;
use AppBundle\Entity\Address;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;





class AddressbookController extends Controller
{
    /**
     * @Route("/", name="address_book")
     */
    public function bookAction()
    {
        $addresses =$this->getDoctrine()
        ->getRepository('AppBundle:Address')
        ->findAll();
        
        // replace this example code with whatever you need
        return $this->render('address/index.html.twig', array(
            'addresses' => $addresses
        ));
    }
    /**
     * @Route("/address/create", name="address_create")
     */
     public function createAction(Request $request)
     {
         $address = new Address;
         $form =$this ->createFormBuilder($address)
         ->add('firstName', TextType::class,array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
         ->add('lastName', TextType::class,array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
         ->add('streetNo', TextType::class,array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
         ->add('zip', NumberType::class,array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
         ->add('city', TextType::class,array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
         ->add('country', TextType::class,array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
         ->add('phoneNumber', NumberType::class,array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
         ->add('birthday', DateType::class,array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
         ->add('emailAddress', EmailType::class,array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
         //->add('picture', FileType::class,array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
         ->add('save', SubmitType::class,array('label' => 'Create Address',  'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom:15px')))
         
         ->getForm();
         
         $form->handleRequest($request);
         if($form->isSubmitted() && $form->isValid()){
             $firstName=$form['firstName']->getData(); 
             $lastName=$form['lastName']->getData(); 
             $streetNo=$form['streetNo']->getData(); 
             $zip=$form['zip']->getData(); 
             $city=$form['city']->getData(); 
             $country=$form['country']->getData(); 
             $phoneNumber=$form['phoneNumber']->getData(); 
             $birthday=$form['birthday']->getData(); 
             $emailAddress=$form['emailAddress']->getData();  
            // $picture=$form['picture']->getData();
             
          
             
             $address->setFirstName($firstName);
             $address->setLastName($lastName);
             $address->setStreetNo($streetNo);
             $address->setZip($zip);
             $address->setCity($city);
             $address->setCountry($country);
             $address->setPhoneNumber($phoneNumber);
             $address->setBirthday($birthday);
             $address->setEmailAddress($emailAddress);
            // $address->setPicture($picture);
            // $address->setCreateBirthday($now);
             


             $em =$this->getDoctrine()->getManager();
             $em->persist($address);
             $em->flush();

             $this->addFlash(
                 'notice',
                 'Address Added'
             );

             return $this->redirectToRoute('address_book');

            }
            

         // replace this example code with whatever you need
         return $this->render('address/create.html.twig', array(
             'form' => $form->createView()
         ));
     }

   

     /**
     * @Route("/address/edit/{id}", name="address_edit")
     */
    public function editAction($id, Request $request)
    {
        $address = $this->getDoctrine()
        ->getRepository('AppBundle:Address')
        ->find($id);

        $address->setFirstName($address->getFirstName());
        $address->setLastName($address->getLastName());
        $address->setStreetNo($address->getStreetNo());
        $address->setZip($address->getZip());
        $address->setCity($address->getCity());
        $address->setCountry($address->getCountry());
        $address->setPhoneNumber($address->getPhoneNumber());
        $address->setBirthday($address->getBirthday());
        $address->setEmailAddress($address->getEmailAddress());
        //$address->setPicture($address->getPicture());
      

       
        $form =$this ->createFormBuilder($address)
        ->add('firstName', TextType::class,array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
        ->add('lastName', TextType::class,array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
        ->add('streetNo', TextType::class,array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
        ->add('zip', NumberType::class,array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
        ->add('city', TextType::class,array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
        ->add('country', TextType::class,array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
        ->add('phoneNumber', TextType::class,array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
        ->add('birthday', DateType::class,array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
        ->add('emailAddress', EmailType::class,array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
        //->add('picture', FileType::class,array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
        ->add('save', SubmitType::class,array('label' => 'Update Address',  'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom:15px')))
        
        ->getForm();
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $firstName=$form['firstName']->getData(); 
            $lastName=$form['lastName']->getData(); 
            $streetNo=$form['streetNo']->getData(); 
            $zip=$form['zip']->getData(); 
            $city=$form['city']->getData(); 
            $country=$form['country']->getData(); 
            $phoneNumber=$form['phoneNumber']->getData(); 
            $birthday=$form['birthday']->getData(); 
            $emailAddress=$form['emailAddress']->getData();  
            //$picture=$form['picture']->getData();
            
           

            $em =$this->getDoctrine()->getManager();
            $address = $em->getRepository('AppBundle:Address')->find($id);
                    

           // $now = new\Date('now');
            
            $address->setFirstName($firstName);
            $address->setLastName($lastName);
            $address->setStreetNo($streetNo);
            $address->setZip($zip);
            $address->setCity($city);
            $address->setCountry($country);
            $address->setPhoneNumber($phoneNumber);
            $address->setBirthday($birthday);
            $address->setEmailAddress($emailAddress);
            //$address->setPicture($picture);
         
            
            
            $em->flush();

            $this->addFlash(
                'message',
                'Address Updated Successfully'
            );

            return $this->redirectToRoute('address_book');
        }

        
        // replace this example code with whatever you need
        return $this->render('address/edit.html.twig', array(
           // 'addresses' => $addresses,
            'form' => $form->createView()
));
    }

    /**
     * @Route("/address/details/{id}", name="address_details")
     */
     public function detailsAction($id)
     {
         
         // replace this example code with whatever you need
         return $this->render('address/details.html.twig');
     }

     
}
