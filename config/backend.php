<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Registration
    |--------------------------------------------------------------------------
    |
    | Here you can change the behavior of the registration functionality.
    | The FILAMENT_REGISTRATION_ENABLED environment variable controls whether
    | registration is enabled.
    |
    */
    'registration' => [
        'enabled' => env('FILAMENT_REGISTRATION_ENABLED', false),
    ],

    /*
    |--------------------------------------------------------------------------
    | Invitation
    |--------------------------------------------------------------------------
    |
    | Here you can change the behavior of the invitation functionality.
    | The FILAMENT_INVITATION_EXPIRY_IN_HOURS environment variable controls
    | how long an invitation is valid in hours.
    |
    */
    'invitation' => [
        'expiry_in_hours' => env('FILAMENT_INVITATION_EXPIRY_IN_HOURS', 48),
    ],

    'locales' => explode(',', env('FILAMENT_LOCALES', 'en')),
];
