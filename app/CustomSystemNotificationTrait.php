<?php

namespace App;

use App\Notifications\CustomSystemNotification;

trait CustomSystemNotificationTrait
{
    /**
     * Déclencher une notification pour plusieurs utilisateurs selon le cas
     *
     * @param mixed $object
     * @param string $modelType
     * @param string $title
     * @param string $message
     * @param array $users
     * @param mixed $url
     * @return void
     */

    public function triggerNotification($object, $modelType, $title, $message, $url, $users)
    {
        //Générer une url dynamique pour l'objet déclencheur de la notification
        foreach ($users as $user) {
            $user->notify(new CustomSystemNotification($object, $modelType, $title, $message, $url));
        }
    }
}
