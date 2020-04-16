<?php

namespace App\EventSubscriber;

use App\Entity\User;
use DateTime;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

class UserFailureSubscriber implements EventSubscriber
{
    public function getSubscribedEvents()
    {
        return [
        Events::prePersist
        ];
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $object = $args->getObject();

        if ($object instanceof User) {
        $object->setFailedAuth(0);
        }
    }
}