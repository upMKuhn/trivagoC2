<?php

namespace UserApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Encoder\EncoderAwareInterface;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Trivago\Jade\Application\Listener\ManipulationListener;


/**
 * User
 *
 * ORM\Table(name="advanced_user")
 * @ORM\Entity(repositoryClass="UserApiBundle\Repository\UserRepository")
 */
class AdvancedUser implements AdvancedUserInterface,  \Serializable
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Username", type="string", length=50)
     */
    private $username;

    /**
     * @var string
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;


    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $passwordHash;
    private $passwordPlain;

    /**
     * @var integer
     * @ORM\Column(name="roles", type="integer")
     */
    private $roleAsInt;


    /**
     * @var string
     *
     * @ORM\Column(name="api_key", type="string", length=100, nullable=true)
     */
    private $apiKey;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="api_key_expiry", type="datetime", nullable=true)
     */
    private $keyExpiry;

    /**
     * @var IssueSubscription []
     * @ORM\OneToMany(targetEntity="UserApiBundle\Entity\IssueSubscription", mappedBy="subscriber", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $issueSubscriptions = [];

    /**
     * @var FloorSubscription []
     * @ORM\OneToMany(targetEntity="UserApiBundle\Entity\FloorSubscription", mappedBy="subscriber", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $floorSubscriptions = [];

    /**
     * @param string $username
     * @param string $password
     * @param string $email
     * @param array $roles
     * @return AdvancedUser
     */
    public static function  create($username, $password, $email, $roles = ['ROLE_USER']) {
        $user = new AdvancedUser();
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
     * Get subscriptions
     *
     * @return FloorSubscription[]
     */
    public function getFloorSubscriptions()
    {
        return $this->floorSubscriptions;
    }
    /**
     * Get subscriptions
     *
     * @return IssueSubscription[]
     */
    public function getIssueSubscriptions()
    {
        return $this->issueSubscriptions;
    }

    public function get_ApiKey(){
        return $this->apiKey;
    }

    public function get_KeyExpiry(){
        return $this->keyExpiry;
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


    /**
     * Checks whether the user's account has expired.
     *
     * Internally, if this method returns false, the authentication system
     * will throw an AccountExpiredException and prevent login.
     *
     * @return bool true if the user's account is non expired, false otherwise
     *
     * @see AccountExpiredException
     */
    public function isAccountNonExpired()
    {
        return true;
    }

    /**
     * Checks whether the user is locked.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a LockedException and prevent login.
     *
     * @return bool true if the user is not locked, false otherwise
     *
     * @see LockedException
     */
    public function isAccountNonLocked()
    {
        return true;
    }

    /**
     * Checks whether the user's credentials (password) has expired.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a CredentialsExpiredException and prevent login.
     *
     * @return bool true if the user's credentials are non expired, false otherwise
     *
     * @see CredentialsExpiredException
     */
    public function isCredentialsNonExpired()
    {
        return true;
    }

    /**
     * Checks whether the user is enabled.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a DisabledException and prevent login.
     *
     * @return bool true if the user is enabled, false otherwise
     *
     * @see DisabledException
     */
    public function isEnabled()
    {
        return true;
    }

}
