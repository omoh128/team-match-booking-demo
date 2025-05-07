<?php

// inc/Init.php
namespace Inc;

final class Init {
    public static function getServices() {
        return [
            Base\Activate::class,
            Base\Deactivate::class,
            PostTypes\TeamPostType::class,
            PostTypes\FixturePostType::class,
            PostTypes\ChallengePostType::class,
            Forms\RegisterTeamForm::class,
            Forms\ChallengeForm::class,
            Forms\AvailabilityForm::class,  // Added AvailabilityForm
            Match\FixtureHandler::class, // Added Match fixture handler
            Handlers\ChallengeHandler::class,

        ];
    }

    public static function registerServices() {
        foreach (self::getServices() as $class) {
            if (class_exists($class)) {
                $service = new $class();
                if (method_exists($service, 'register')) {
                    $service->register();
                }
            }
        }
    }
}

