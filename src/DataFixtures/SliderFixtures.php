<?php

namespace App\DataFixtures;

use DateTime;
use Faker\Factory;
use App\Entity\User;
use App\Entity\Slider;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SliderFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $slider = new Slider();
        $slider->setLogo("https://www.flaticon.com/svg/vstatic/svg/1099/1099672.svg?token=exp=1619005974~hmac=897dfdb6e6a8466649b74da8c7bfb905");
        $slider->setSld("https://images.unsplash.com/photo-1574629810360-7efbbe195018?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2912&q=80");

        $manager->persist($slider);


        $manager->flush();
    }
}
