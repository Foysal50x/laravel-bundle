<?php

// config for Faisal50x/Laravel-bundle
return [
    'model_dir' => 'Models',
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
    ],
    'modules' => [
        /**
         * module base direct
         * default path is modules inside your project root directory
         */
        'base_dir' => 'modules',
        /**
         * module root name space
         * default is Modules
         */
        'root_namespace' => null,
        /**
         * Module source directory
         * default module/app/Repositories
         */
        'src_dir' => 'app',
        'auto_load_map' => [
            '{{RootNamespace}}\\{{ModuleName}}\\' => '{{BaseDir}}/{{ModuleName}}/{{SrcDir}}/',
        ],
        'update_autoload_file' => true,
        'register_module' => true,
    ],
];
