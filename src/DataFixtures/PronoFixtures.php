<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Prono;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PronoFixtures extends Fixture
{
    const PRONO_COUNT = 10;

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $types = array(
            'Simple',
            'Conbiné',
        );

        for($i = 0; $i < self::PRONO_COUNT; $i++) {
            $prono = new Prono();
            $prono->setEquip1($faker->lastName);
            $prono->setEquip2($faker->firstName);
            $prono->setConfiance(rand(0, 100));
            $prono->setDate(new \DateTime());
            $prono->setLigue($faker->firstName);
            $key = array_rand($types);
            $prono->setType($types[$key]);
            
            $this->addReference('prono'.$i, $prono);
            $manager->persist($prono);
        }

        $manager->flush();
    }
}
