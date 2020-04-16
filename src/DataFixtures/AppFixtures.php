<?php

namespace App\DataFixtures;

use App\Entity\Album;
use App\Entity\Artist;
use App\Entity\Style;
use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker;

class AppFixtures extends Fixture
{
    
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $styles = [];
        for ($i=0; $i < 10; $i++) { 
            $style = new Style();
            $style->setName($faker->word())
                ->setCreated(new DateTime());

            $manager->persist($style);
            $styles[] = $style;
        }

        $artists = [];
        for ($i=0; $i < 20; $i++) { 
            $artist = new Artist();
            $artist->setName($faker->name())
                ->setStartYear($faker->year())
                ->setCreated(new DateTime());

            $artists[] = $artist;

            $random = $faker->numberBetween(0, 5);
            for ($j=0; $j < $random; $j++) { 
                $artist->addStyle($styles[$faker->numberBetween(0, count($styles) -1)]);
            }
            $manager->persist($artist);
        }

        for ($i=0; $i < 50; $i++) { 
            $album = new Album();
            $album->setName($faker->word())
                ->setReleaseYear($faker->year())
                ->setArtist($artists[$faker->numberBetween(0, count($artists) -1)])
                ->setCreated(new DateTime());
            $manager->persist($album);
        }

        for ($i=0; $i < 10; $i++) { 
            $user = new User();

            $user->setEmail('test' . $i . '@test.com')
                ->setPassword($this->encoder->encodePassword($user, '1234'));

            $random = $faker->numberBetween(0, 5);
            for ($j=0; $j < $random; $j++) { 
                $user->addArtist($artists[$faker->numberBetween(0, count($artists) -1)]);
            }

            $manager->persist($user);
        }
        $user->setEmail('admin@admin.com')
                ->setPassword($this->encoder->encodePassword($user, '1234'))
                ->setRoles(['ROLE_ADMIN']);

        $manager->flush();
    }
}
