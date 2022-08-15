<?php

/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return [
    /**
     * Settings for storing files.
     */
    'storage' => [
        'storage_dir' => 'public/data',
        'public_dir' => 'data',
        'dir_mode' => 0o770,
    ],

    /*
     * Settings for Monolog logger
     */
    'logging' => [
        'logfile_path' => 'data/logs/gewisdb.log',
        'max_rotate_file_count' => 10,
        'minimal_log_level' => 'INFO',
    ],
];
