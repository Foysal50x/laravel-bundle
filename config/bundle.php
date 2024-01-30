<?php

// config for Faisal50x/Laravel-bundle
return [
    'repository' => [
        /**
         * Define your repository directory here
         * Default path is app/Repositories
         */
        'dir' => 'Repositories',
        /**
         * Define your repository contract path here
         * Default path is app/Repositories/Contracts
         */
        'contract' => [
            'dir' => 'Contracts',
        ],
        'modules' => [
            /**
             * module base direct
             * default path is modules inside your project root directory
             */
            'base_dir' => 'modules',
            /**
             * Module source directory
             * default module/app/Repositories
             */
            'src_dir' => 'app',
        ],
    ],
];
