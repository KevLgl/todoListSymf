<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Project;
use App\Entity\Task;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;




    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }


    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('user1');
        $user->setPassword($this->passwordEncoder->encodePassword($user,'user1'));

        $manager->persist($user);
        $manager->flush();



        $user = new User();
        $user->setUsername('admin1');
        $user->setPassword($this->passwordEncoder->encodePassword($user,'admin1'));


        $manager->persist($user);
        $manager->flush();


        for($i =0 ; $i < 3 ; $i++){
            $project = new Project();

            $project->setTitle("Projet $i")
                ->setContent("Contenu $i")
                ->setCreationDate(new \DateTime())
                ->setDeadline(new \DateTime())
                ->setUser($user);
                $manager->persist($project);

        }
        $manager->flush();

        for($i =0 ; $i < 4 ; $i++){
            $task = new Task();

            $task->setTitle("Tache $i")
                ->setContent("Contenu $i")
                ->setCreationDate(new \DateTime())
                ->setDeadline(new \DateTime())
                ->setProject($project);
                $manager->persist($task);

        }
        $manager->flush();
        
    }
}
