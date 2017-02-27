<?php

namespace AppBundle\Controller;

use AppBundle\Entity\user;
use AppBundle\Entity\category;
use AppBundle\Entity\film;
use AppBundle\Entity\informatique;
use AppBundle\Entity\jeuxsocial;
use AppBundle\Entity\definations;
use AppBundle\Entity\culinaores;
use AppBundle\Entity\Serialtv;
use AppBundle\Entity\siglesfrancais;
use AppBundle\Entity\guess;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Session\Session;

class QuizController extends Controller
{
    /**
     * @Route("/film", name="filmpage")
     */
    public function filmAction(Request $request)
    { 
        $quizs = $this->getDoctrine()->getRepository('AppBundle:film')->findAll();

        $score = 0;
      
        return $this->render('default/quiz.html.twig', array(
            'quizs' => $quizs,
            'score' => $score
        ));
    }

    /**
     * @Route("/informatique", name="informatiquepage")
     */
    public function informatiqueAction(Request $request)
    { 
        $quizs = $this->getDoctrine()->getRepository('AppBundle:informatique')->findAll();
        $score = 0;
        
        return $this->render('default/quiz.html.twig', array(
            'quizs' => $quizs,
            'score' => $score
            ));
    }

    /**
     * @Route("/jeuxsocial", name="jeuxsocialpage")
     */
    public function jeuxsocialAction(Request $request)
    { 
        $quizs = $this->getDoctrine()->getRepository('AppBundle:jeuxsocial')->findAll();
        $score = 0;
        
        return $this->render('default/quiz.html.twig', array(
            'quizs' => $quizs,
            'score' => $score
            ));
    }

    /**
     * @Route("/Serial tv", name="Serialtvpage")
     */
    public function SerialtvAction(Request $request)
    { 
        $quizs = $this->getDoctrine()->getRepository('AppBundle:Serialtv')->findAll();
        $score = 0;
        
        return $this->render('default/quiz.html.twig', array(
            'quizs' => $quizs,
            'score' => $score
            ));
    }

    /**
     * @Route("/sigles francais", name="siglesfrancaispage")
     */
    public function siglesfrancaisAction(Request $request)
    { 
        $quizs = $this->getDoctrine()->getRepository('AppBundle:siglesfrancais')->findAll();
        $score = 0;
        
        return $this->render('default/quiz.html.twig', array(
            'quizs' => $quizs,
            'score' => $score
            ));
    }

    /**
     * @Route("/definitions", name="definitionspage")
     */
    public function definitionsAction(Request $request)
    { 
        $quizs = $this->getDoctrine()->getRepository('AppBundle:definations')->findAll();
        $score = 0;
        
        return $this->render('default/quiz.html.twig', array(
            'quizs' => $quizs,
            'score' => $score
            ));
    }

    /**
     * @Route("/culinaires", name="culinairespage")
     */
    public function culinairesAction(Request $request)
    { 
        $quizs = $this->getDoctrine()->getRepository('AppBundle:culinaires')->findAll();
        $score = 0;
        
        return $this->render('default/quiz.html.twig', array(
            'quizs' => $quizs,
            'score' => $score
            ));
    }


    /**
     * @Route("/createnew", name="createnewspage")
     */
    public function createnewAction(Request $request)
    { 
        $quiz = new category;
        $form = $this->createFormBuilder($quiz)
            ->add('name', TextType::class, array('attr' => array('class' => 'form-control','style' => 'margin-bottom:15px')))
            ->add('save', SubmitType::class, array( 'label' => 'submit', 'attr' => array('class' => 'btn btn-primary','style' => 'margin-bottom:15px')))
            ->getForm();

        $form->handleRequest($request);
        $session = $request->getSession();
        if($form->isSubmitted() && $form->isValid()){
            $name = $form['name']->getData();
            $userid = $session->get('user')[0]->getId();
            $now = new\DateTime('now');

            $quiz->setName($name);
            $quiz->setUserid($userid);
            $quiz->setCreated($now);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($quiz);
            $em->flush();

        }
        return $this->render('default/create.html.twig', array(
                'form' => $form->createView()
        ));
    }

    /**
     * @Route("/newquiz", name="newquizpage")
     */
    public function newquizAction(Request $request)
    { 
        $quiz = new guess;

        $form = $this->createFormBuilder($quiz)
            ->add('name', TextType::class, array('attr' => array('class' => 'form-control','style' => 'margin-bottom:15px')))
            ->add('question', TextType::class, array('attr' => array('class' => 'form-control','style' => 'margin-bottom:15px')))
            ->add('answer', TextType::class, array('attr' => array('class' => 'form-control','style' => 'margin-bottom:25px')))
            ->add('wrong', TextType::class, array('attr' => array('class' => 'form-control','style' => 'margin-bottom:25px')))
            ->add('wrong2', TextType::class, array('attr' => array('class' => 'form-control','style' => 'margin-bottom:25px')))
            ->add('save', SubmitType::class, array( 'label' => 'submit', 'attr' => array('class' => 'btn btn-primary','style' => 'margin-bottom:15px')))
            ->getForm();

        $form->handleRequest($request);
        $session = $request->getSession();

        if($form->isSubmitted() && $form->isValid()){
            $name = $form['name']->getData();
            $question = $form['question']->getData();
            $answer = $form['answer']->getData();
            $wrong = $form['wrong']->getData();
            $wrong2 = $form['wrong2']->getData();
            $userid =  $session->get('user')[0]->getId();

            $now = new\DateTime('now');

            $quiz->setName($name);
            $quiz->setQuestion($question);
            $quiz->setAnswer($answer);
            $quiz->setWrong($wrong);
            $quiz->setWrong2($wrong2);
            $quiz->setCreated($now);
            $em = $this->getDoctrine()->getManager();
            $em->persist($quiz);
            $em->flush();

        }
        return $this->render('default/create.html.twig', array(
                'form' => $form->createView()
        ));
    }


    /**
     * @Route("/{guess}", name="{guess}page")
     */
    public function guessAction($guess, Request $request)
    { 
        $quizs = $this->getDoctrine()->getRepository('AppBundle:guess')->findAll();
        $score = 0;
        
        return $this->render('default/quiz.html.twig', array(
            'quizs' => $quizs,
            'score' => $score
            ));
    }
}