<?php
/**
 * Created by PhpStorm.
 * User: mkuhn
 * Date: 8/23/17
 * Time: 12:48 PM
 */

namespace UserApiBundle\Security\User;


use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Trivago\Jade\Application\JsonApi\Request\CollectionRequest;
use Trivago\Jade\Application\JsonApi\Request\CreateRequest;
use Trivago\Jade\Application\JsonApi\Request\DeleteRequest;
use Trivago\Jade\Application\JsonApi\Request\EntityRequest;
use Trivago\Jade\Application\JsonApi\Request\UpdateRequest;
use Trivago\Jade\Application\Listener\ManipulationListener;
use Trivago\Jade\Application\Listener\RequestListener;
use UserApiBundle\Entity\User;

class UserPasswordManipulationLister implements RequestListener
{

    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }


    /**
     */
    public function beforeCreate($entity)
    {
        $entity->ensurePasswordEncoded(function ($plainPassword) use ($entity) {
            return $this->encoder->encodePassword($entity, $plainPassword);
        });
    }

    /**
     */
    public function beforeUpdate($entity)
    {
        $entity->ensurePasswordEncoded(function ($plainPassword) use ($entity) {
            return $this->encoder->encodePassword($entity, $plainPassword);
        });
    }
    /**
     * @param User $entity
     */
    public function beforeDelete($entity)
    {
        // TODO: Implement beforeDelete() method.
    }

    /**
     * @param User $entity
     */
    public function afterCreate($entity)
    {
        // TODO: Implement afterCreate() method.
    }

    /**
     * @param User $entity
     */
    public function afterUpdate($entity)
    {

    }

    /**
     * @param mixed $entityId
     */
    public function afterDelete($entityId)
    {
        // TODO: Implement afterDelete() method.
    }

    /**
     * @param string $resourceName
     * @return bool
     */
    public function supports($resourceName)
    { return true || $resourceName === 'users'; }

    /**
     * @param EntityRequest $request
     * @return EntityRequest
     */
    public function onGetEntityRequest(EntityRequest $request)
    {
        $a = 0;
    }

    /**
     * @param CollectionRequest $request
     * @return CollectionRequest
     */
    public function onGetCollectionRequest(CollectionRequest $request)
    {
        $a = 0;
    }

    /**
     * @param CreateRequest $request
     * @return CreateRequest
     */
    public function onCreateRequest(CreateRequest $request)
    {
        // TODO: Implement onCreateRequest() method.
    }

    /**
     * @param UpdateRequest $request
     * @return UpdateRequest
     */
    public function onUpdateRequest(UpdateRequest $request)
    {
        // TODO: Implement onUpdateRequest() method.
    }

    /**
     * @param DeleteRequest $request
     * @return DeleteRequest
     */
    public function onDeleteRequest(DeleteRequest $request)
    {
        // TODO: Implement onDeleteRequest() method.
    }
}