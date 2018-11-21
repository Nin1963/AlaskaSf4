<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CommentFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

            $comment = new Comment();
            $comment->setAuthor('Jules');
            $comment->setContent('Très belle description!');
            $comment->setChapter($chapter);
            
            $manager->persist($comment);
            $manager->flush();
    }
}
