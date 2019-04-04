<?php

namespace App\Controller;

use App\Entity\Answer;
use App\Entity\Question;
use App\Form\AnswerType;
use App\Repository\AnswerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AnswerController extends AbstractController
{
    /**
     * @Route("/question/{id}/answer/new")
    */
    public function new(Question $question, Request $request)
    {
        $answer = new Answer();
        $form = $this->createForm(AnswerType::class, $answer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {

            $entityManager = $this->getDoctrine()->getManager();
            $answer->setQuestion($question);

            $entityManager->persist($answer);
            $entityManager->flush();

            return $this->redirectToRoute('question_show', ['id' => $answer->getQuestion()->getId()]);
        }
        return $this->render('answer/new.html.twig', [
            'form' => $form->createView(),
            'question' => $answer->getQuestion()
        ]);
    }

    /**
     * @Route("/answer/{id}", name = answer_edit)
     */
    public function edit(Answer $answer, Request $request)
    {
        $form = $this->createForm(AnswerType::class, $answer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($answer);
            $entityManager->flush();

            return $this->redirectToRoute('question_show', ['id' => $answer->getQuestion()->getId()]);
        }
        return $this->render('answer/new.html.twig', [
            'form' => $form->createView(),
            'question' => $answer->getQuestion()
        ]);
    }

    public function remove()
    {
        return;
    }
}
