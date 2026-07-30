<?php // config/horizon.php

return [
    'environments' => [
        'production' => [
            'supervisor-1' => [
                'connection' => 'redis',
                'queue' => ['default'],
                'balance' => 'simple',
                'processes' => 10,
                'tries' => 3,
            ],
        ],

        // Add a scheduler process for scheduling tasks
        'scheduler' => [
            'connection' => 'redis',
            'queue' => ['default'],
            'balance' => 'simple',
            'processes' => 1,
            'tries' => 3,
            'schedule' => [
                // Define your scheduled tasks here
                \App\Jobs\ProcessSettlementsJob::class => '* * * * *', // Run every minute as an example
            ],
        ],
    ],
];
