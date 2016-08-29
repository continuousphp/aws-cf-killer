<?php

return [
    // AWS SDK config (credentials, etc...)
    'aws' =>
    [
        'version' => '2010-05-15'
    ],
    // 
    'tags' =>
    [],
    'statusList' =>
    [
        'CREATE_FAILED',
        'CREATE_COMPLETE',
        'ROLLBACK_FAILED',
        'ROLLBACK_COMPLETE',
        'DELETE_FAILED',
        'UPDATE_COMPLETE',
        'UPDATE_ROLLBACK_FAILED',
        'UPDATE_ROLLBACK_COMPLETE'
    ]
];