<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        foreach (range(1,10) as $i) {
            $article = new Article();
            $article->setArticleSubject($faker->words(3, true));
            $article->setArticleTitle($faker->words(4, true));
            $article->setArticleNbViews(0);
            $article->setArticleContent($faker->paragraphs(3, true));
            $article->setArticleState(true);
            $this->addReference('article' . $i, $article);

            $manager->persist($article);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
        );
    }
}
