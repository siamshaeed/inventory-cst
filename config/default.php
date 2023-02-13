<?php

return [
    'user_type' => [
        1 => 'Admin',
        2 => 'Workshop',
        3 => 'Customer',
    ],

    'roles' => [
        'admin' => 'admin',
        'workshop' => 'workshop',
        'customer' => 'customer',
    ],

    'request' => [
        'status' => [
            0 => 'Pending',
            1 => 'Approved',
            2 => 'Rejected',
            3 => 'Cancelled',
        ],

        'types' => [
            'pending' => 0,
            'approved' => 1,
            'rejected' => 2,
            'cancelled' => 3,
        ]
    ]
];
