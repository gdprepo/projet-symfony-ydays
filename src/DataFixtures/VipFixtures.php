<?php

namespace App\DataFixtures;

use App\Entity\Vip;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class VipFixtures extends Fixture
{
    const VIP_COUNT = 10;

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');


        $vip = new Vip();

        $vip->setTitle("simple");
        $vip->setLogo("fas fa-rocket");
        $vip->setList(["Prono tous les jours", "accés aux analyse", "indice de confaince min 50"]);
        $vip->setPrice(rand(50, 100));
        $manager->persist($vip);

        for($i = 0; $i < self::VIP_COUNT; $i++) {
            $vip = new Vip();
            $vip->setPrice(rand(50, 100));
            $vip->setTitle($faker->title);
            $vip->setLogo("fas fa-rocket");
            $vip->setList(["Prono tous les jours", "accés aux analyse", "indice de confaince min 50"]);

            $manager->persist($vip);
        }

        $manager->flush();
    }
}
