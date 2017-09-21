<?php

namespace UserApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Encoder\EncoderAwareInterface;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Trivago\Jade\Application\Listener\ManipulationListener;


/**
 * User
 *
 * @ORM\MappedSuperclass
 */
class User implements UserInterface, \Serializable
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;





    public function __construct()
    {
    }

    /**
     * @param string $username
     * @param string $password
     * @param string $email
     * @param array $roles
     * @return User
     */
    public static function  create($username, $password, $email, $roles = ['ROLE_USER']) {
        $user = new User();
        $user->email = $email;
        $user->passwordPlain = $password;
        $user->username = $username;
        $user->setRoles($roles);
        return $user;
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }


    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->passwordPlain = $password;
        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->passwordHash;
    }


    /**
     * @return string[]
     */
    public function getRoles(){
        $roles =  array('ROLE_USER');
        if($this->roleAsInt | 2){
            array_push($roles, 'ROLE_HERO');
        }
        if($this->roleAsInt | 4){
            array_push($roles, 'ROLE_ADMIN');
        }
        return $roles;
    }

    /**
     * @param $roles string[]
     */
    public function setRoles($roles){
        $roleMap = array(
            'ROLE_USER' => 1,
            'ROLE_ADMIN' => 2
        );
        $this->roleAsInt = 0;
        foreach($roles as $role){
            if(key_exists($role, $roles))
                $this->roleAsInt |= $roleMap[$role];
        }
    }



    public function getRoleAsInt(){
        return $this->roleAsInt;
    }
    public function setRoleAsInt($roles = 1){
        $this->roleAsInt = $roles;
    }


    /**
     * String representation of object
     * @link http://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     * @since 5.1.0
     */
    public function serialize()
    {
        return json_encode(array(
            'id' =>  $this->id,
            'username' =>  $this->username,
            'email' =>  $this->email,
            'rolesAsInt' => $this->roleAsInt
        ));
    }

    /**
     * Constructs the object
     * @link http://php.net/manual/en/serializable.unserialize.php
     * @param string $serialized
     * @return void
     * @since 5.1.0
     */
    public function unserialize($serialized)
    {
        $obj = json_decode($serialized);
        $this->username = $obj->username;
        $this->email = $obj->email;
        $this->roleAsInt = $obj->roleAsInt;

    }


    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }


    /**
     *
     * @param callable $encode
     * @internal param PasswordEncoderInterface $encoder
     */
    public function ensurePasswordEncoded(callable $encode)
    {
        if($this->passwordPlain != null)
            $this->passwordHash = $encode($this->passwordPlain, $this->getSalt());
        $this->eraseCredentials();
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        $this->passwordPlain = null;
    }

    public function __toString(){
        return $this->serialize();
    }

}
