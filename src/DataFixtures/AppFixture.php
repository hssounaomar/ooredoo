<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 26/06/2018
 * Time: 11:56
 */

namespace App\DataFixtures;


use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixture extends Fixture implements ContainerAwareInterface
{
    private $container;
    public function setContainer(ContainerInterface $container=null){
        $this->container=$container;
    }
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $user=new User();

        $user->setEmail("omar@hsouna.com");
        $user->addRole("ROLE_ADMIN");
        $user->addRole("ROLE_TEST");

        $user->setUsername("omar");
        $encoder = $this->container->get('security.password_encoder');
        $password = $encoder->encodePassword($user, "omar");
        $user->setPassword($password);
        $manager->persist($user);
        $manager->flush();
    }
    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 1;
    }
}