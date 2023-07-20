<?php

namespace App\EventSubscriber;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class PasswordUpdateSuscriberSubscriber implements EventSubscriberInterface
{

    public function __construct(protected UserPasswordHasherInterface $passwordHasher)
    {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            BeforeEntityPersistedEvent::class => 'onBeforeEntityPersistedEvent',
            BeforeEntityUpdatedEvent::class => 'onBeforeEntityPersistedEvent'
        ];
    }
    public function onBeforeEntityPersistedEvent(BeforeEntityUpdatedEvent|BeforeEntityPersistedEvent $event): void
    {
        $entity = $event->getEntityInstance();

        if (!$entity instanceof User) {
            return;
        }

        if (is_null($entity->getPlainPassword()) && '' != $entity->getPlainPassword()) {
            $entity->setPassword(
                $this->passwordHasher->hashPassword($entity, $entity->getPlainPassword())
            );
        }
    }
}
