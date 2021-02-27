<?php

return [
    /*
     * The disk where the exports will be stored by default.
     */
    'disk' => 'personal-data-exports',

    /*
     * The amount of days the exports will be available.
     */
    'delete_after_days' => 5,

    /*
     * Determines whether the user should be logged in to be able
     * to access the export.
     */
    'authentication_required' => false,

    /*
     * The notification which will be sent to the user when the export
     * has been created.
     */
    'notification' => \App\Notifications\ExportPersonnalDataNotification::class,

    /*
     * Configure the queue and connection used by `CreatePersonalDataExportJob`
     * which will create the export.
     */
    'job' => [
        'queue' => null,
        'connection' => null,
    ],
];
