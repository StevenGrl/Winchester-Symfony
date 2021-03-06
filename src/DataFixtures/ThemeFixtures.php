<?php


namespace App\DataFixtures;

use App\Entity\Theme;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ThemeFixtures extends Fixture
{
    public const THEMES = ['Jeux vidéo', 'Sport', 'Technologie', 'Politique'];

    public function load(ObjectManager $manager)
    {
        foreach (self::THEMES as $index => $value) {
            $theme = new Theme();
            $theme->setName($value);
            $manager->persist($theme);
            $this->addReference('theme' . $index, $theme);
        }

        $manager->flush();
    }
}
