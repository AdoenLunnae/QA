<?php

namespace App\DataFixtures;

use App\Entity\Answer;
use App\Entity\Question;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $question = new Question();
        $question->setDescription('como morir sin dolor');

        $answer = new Answer();
        $answer->setDescription('perish');
        $answer->setQuestion($question);

        $answer2 = new Answer();
        $answer2->setDescription('just fucking die');
        $answer2->setQuestion($question);

        $manager->persist($question);
        $manager->persist($answer);
        $manager->persist($answer2);
        $manager->flush();
    }
}
