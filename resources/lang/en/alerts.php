<?php

return [
    'general' => [
        'success' => [
            'created' => 'Successfully created.',
            'deleted' => 'Successfully deleted.',
            'updated' => 'Successfully updated.',
            'restore' => 'Successfully restore.',
            'leave' => 'Successfully leave.',
            'send_point' => 'Send point successful!'
        ],
        'errors' => [
            'created' => 'Create failed.',
            'deleted' => 'Delete failed.',
            'updated' => 'Update failed.',
        ],
        'confirm' => [
            'delete' => 'Are you sure?',
            'restore' => 'Are you sure?',
            'send_point' => 'Are you want send point?'
        ]
    ],
    'categories' => [
        'errors' => [
            'name-required' => 'You have not entered a name',
            'description-required' => 'You have not entered a description',
            'name-max-255' => 'The name you entered is longer than 255 characters',
            'description-max-255' => 'The description you entered is longer than 255 characters',
            'code-required' => 'You have not entered a code',
            'code-max-20' => 'The code you entered is longer than 20 characters',
        ]
    ],
    'offers' => [
        'errors' => [
            'desired-option-required' => 'Please enter your desired date and time.',
            'desired-content-required' => 'Please enter your desired meeting place.',
            'point_enough' => 'You do not have enough points.'
        ]
    ],
    'upload' => [
        'accept_extension_video' => 'You can upload only .mp4, .mkv, .avi files',
        'accept_extension_image' => 'You can upload only .jpeg, .jpg, .png, .gif files'
    ]
];
