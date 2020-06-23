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
        $users = UserFixtures::USERS;
        $themes = ThemeFixtures::THEMES;
        $faker = Factory::create('fr_FR');
        foreach (range(1,10) as $i) {
            $article = new Article();
            $article->setSubject($faker->words(3, true));
            $article->setTitle($faker->words(4, true));
            $article->setNbViews(0);
            $article->setContent($faker->paragraphs(3, true));
            $article->setState(true);
            $article->setImage('https://tmssl.akamaized.net/images/foto/normal/kevin-prince-boateng-besiktas-1587123285-36609.jpg');
            $article->setTheme($this->getReference('theme' . $faker->numberBetween(0, count($themes) - 1)));
            $this->addReference('article' . $i, $article);

            $manager->persist($article);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ThemeFixtures::class,
            UserFixtures::class,
        );
    }
}
