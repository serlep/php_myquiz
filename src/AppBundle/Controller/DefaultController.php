<?php

namespace AppBundle\Controller;

use AppBundle\Entity\user;
use AppBundle\Entity\category;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Session\Session;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $categorys = $this->getDoctrine()->getRepository('AppBundle:category')->findAll();

        return $this->render('default/index.html.twig', array(
                'categorys' => $categorys
            ));
    }

    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
       
        $user = new user;
        $session = $request->getSession();
        $form = $this->createFormBuilder()
            ->add('name', TextType::class, array('attr' => array('class' => 'form-control','style' => 'margin-bottom:15px')))
            ->add('password', PasswordType::class, array('attr' => array('class' => 'form-control','style' => 'margin-bottom:25px')))
            ->add('save', SubmitType::class, array( 'label' => 'login', 'attr' => array('class' => 'btn btn-primary','style' => 'margin-bottom:15px')))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            
            $users = $form->getData();

            $repository = $this->getDoctrine()->getRepository('AppBundle:user');

            $user = $repository->findBy(array(
                "name" => $users["name"],                     
                "password" => $users["password"]
            ));      
            $session->set('user', $user);
            if(count($user)==0){ 
                return $this->render('default/login.html.twig', array(
                    'form' => $form->createView()
                ));
            }else{
                $session->set('user', $user);
                $categorys = $this->getDoctrine()->getRepository('AppBundle:category')->findAll();
                return $this->render('default/index.html.twig', array(
                'categorys' => $categorys
            ) );
            }
        }
        return $this->render('default/login.html.twig', array(
                    'form' => $form->createView()
                ));
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction(Request $request)
    {

            $session = $request->getSession();
            $session->remove('user');
            return $this->redirect('/login');
    }

   /**
     * @Route("/register", name="registerpage")
     */
    public function registerAction(Request $request)
    {
        $user = new user;

        $form = $this->createFormBuilder($user)
            ->add('name', TextType::class, array('attr' => array('class' => 'form-control','style' => 'margin-bottom:15px')))
            ->add('email', EmailType::class, array('attr' => array('class' => 'form-control','style' => 'margin-bottom:15px')))
            ->add('password', PasswordType::class, array('attr' => array('class' => 'form-control','style' => 'margin-bottom:25px')))
            ->add('save', SubmitType::class, array( 'label' => 'submit', 'attr' => array('class' => 'btn btn-primary','style' => 'margin-bottom:15px')))
            ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $name = $form['name']->getData();
            $email = $form['email']->getData();
            $password = $form['password']->getData();

            $now = new\DateTime('now');

            $user->setName($name);
            $user->setEmail($email);
            $user->setPassword($password);
            $user->setCreated($now);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('homepage');

        }
        return $this->render('default/register.html.twig', array(
                'form' => $form->createView()
        ));
    }

    /**
     * @Route("/update/{id}", name="update")
     */
    public function updateAction($id, Request $request)
    {
        $user = $this->getDoctrine()->getRepository('AppBundle:user')->find($id);

        $now = new\DateTime('now');

        $user->setName($user->getName());
        $user->setEmail($user->getEmail());
        $user->setPassword($user->getPassword());
        $user->setCreated($now);

        $session = $request->getSession();
        $form = $this->createFormBuilder($user)
            ->add('name', TextType::class, array('attr' => array('class' => 'form-control','style' => 'margin-bottom:15px')))
            ->add('email', EmailType::class, array('attr' => array('class' => 'form-control','style' => 'margin-bottom:15px')))
            ->add('password', PasswordType::class, array('attr' => array('class' => 'form-control','style' => 'margin-bottom:25px')))
            ->add('save', SubmitType::class, array( 'label' => 'confirm', 'attr' => array('class' => 'btn btn-primary','style' => 'margin-bottom:15px')))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $name = $form['name']->getData();
            $email = $form['email']->getData();
            $password = $form['password']->getData();   

            $em = $this->getDoctrine()->getManager();
            $user = $em ->getRepository('AppBundle:user')->find($id);
            $em->flush();

            $user->setName($name);
            $user->setEmail($email);
            $user->setPassword($password);
            $user->setCreated($now);
        }

        return $this->render('default/update.html.twig', array(
                'user' => $user,
                'form' => $form->createView()
        ));       
    }

     /**
     * @Route("/delete/{id}", name="delete")
     */
    public function deleteAction($id, Request $request)
    {
        $user = $this->getDoctrine()->getRepository('AppBundle:user')->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();
        $session = $request->getSession();
        $session->remove('user');
        return $this->redirect('/login');
    }
}
