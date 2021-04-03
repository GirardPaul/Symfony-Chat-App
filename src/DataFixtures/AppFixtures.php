<?php

namespace App\DataFixtures;

use App\Entity\Conversations;
use App\Entity\Messages;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\User;
use DateTime;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoderInterface)
    {
        $this->encoder = $userPasswordEncoderInterface;
        
    }
    public function load(ObjectManager $manager)
    {

        $faker = Factory::create('fr_FR');

        $user1 = new User();
        $user1->setEmail($faker->email)
            ->setPassword($this->encoder->encodePassword($user1, "password"))
            ->setFirstname($faker->firstName)
            ->setLastname($faker->lastName);
        $manager->persist($user1);
        $user2 = new User();
        $user2->setEmail($faker->email)
            ->setPassword($this->encoder->encodePassword($user2, "password"))
            ->setFirstname($faker->firstName)
            ->setLastname($faker->lastName);
        $manager->persist($user2);
        $user3 = new User();
        $user3->setEmail($faker->email)
            ->setPassword($this->encoder->encodePassword($user3, "password"))
            ->setFirstname($faker->firstName)
            ->setLastname($faker->lastName);
        $manager->persist($user3);
        $user4 = new User();
        $user4->setEmail($faker->email)
            ->setPassword($this->encoder->encodePassword($user4, "password"))
            ->setFirstname($faker->firstName)
            ->setLastname($faker->lastName);
        $manager->persist($user4);
        $user5 = new User();
        $user5->setEmail($faker->email)
            ->setPassword($this->encoder->encodePassword($user5, "password"))
            ->setFirstname($faker->firstName)
            ->setLastname($faker->lastName);
        $manager->persist($user5);

        $conversation1 = new Conversations();
        $conversation1->addUser($user1)
            ->addUser($user2);
        $manager->persist($conversation1);
        $conversation2 = new Conversations();
        $conversation2->addUser($user2)
            ->addUser($user3);
        $manager->persist($conversation2);
        $conversation3 = new Conversations();
        $conversation3->addUser($user3)
            ->addUser($user4);
        $manager->persist($conversation3);
        $conversation4 = new Conversations();
        $conversation4->addUser($user4)
            ->addUser($user5);
        $manager->persist($conversation4);
        $conversation5 = new Conversations();
        $conversation5->addUser($user1)
            ->addUser($user5);
        $manager->persist($conversation5);


        $message1 = new Messages();
            $message1->setConversation($conversation1)
            ->setMessage($faker->word)
            ->setUser($user1)
            ->setPostedAt(new DateTime('now'));
        $conversation1->setLastMessage($message1->getMessage())
        ->setLastMessageDate(new DateTime('now'));
        $manager->persist($message1);

        $message2 = new Messages();
            $message2->setConversation($conversation1)
            ->setMessage($faker->word)
            ->setUser($user2)
            ->setPostedAt(new DateTime('now'));
        $conversation1->setLastMessage($message2->getMessage())
        ->setLastMessageDate(new DateTime('now'));
        $manager->persist($message2);

        $message3 = new Messages();
            $message3->setConversation($conversation2)
            ->setMessage($faker->word)
            ->setUser($user2)
            ->setPostedAt(new DateTime('now'));

        $conversation2->setLastMessage($message3->getMessage())
        ->setLastMessageDate(new DateTime('now'));
        $manager->persist($message3);

        $message4 = new Messages();
            $message4->setConversation($conversation2)
            ->setMessage($faker->word)
            ->setUser($user3)
            ->setPostedAt(new DateTime('now'));
        
        $conversation2->setLastMessage($message4->getMessage())
        ->setLastMessageDate(new DateTime('now'));
        $manager->persist($message4);

        $manager->persist($conversation1);
        $manager->persist($conversation2);

        $manager->flush();
    }
}
