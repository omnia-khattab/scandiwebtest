<?php

// autoload_classmap.php @generated by Composer

$vendorDir = dirname(__DIR__);
$baseDir = dirname($vendorDir);

return array(
    'App\\Controllers\\ProductController' => $baseDir . '/app/Controllers/ProductController.php',
    'App\\Factories\\ProductFactory' => $baseDir . '/app/Factories/ProductFactory.php',
    'App\\Models\\Product' => $baseDir . '/app/Models/Product.php',
    'App\\Models\\ProductTypes\\Book' => $baseDir . '/app/Models/ProductTypes/Book.php',
    'App\\Models\\ProductTypes\\DVD' => $baseDir . '/app/Models/ProductTypes/DVD.php',
    'App\\Models\\ProductTypes\\Furniture' => $baseDir . '/app/Models/ProductTypes/Furniture.php',
    'Composer\\InstalledVersions' => $vendorDir . '/composer/InstalledVersions.php',
    'Database\\ProductTable' => $baseDir . '/database/ProductTable.php',
    'Routes\\Router' => $baseDir . '/routes/Router.php',
    'Utils\\Connection' => $baseDir . '/utils/Connection.php',
    'Validations\\Rules\\IsNumber' => $baseDir . '/validations/Rules/IsNumber.php',
    'Validations\\Rules\\IsString' => $baseDir . '/validations/Rules/IsString.php',
    'Validations\\Rules\\max' => $baseDir . '/validations/Rules/max.php',
    'Validations\\Rules\\min' => $baseDir . '/validations/Rules/min.php',
    'Validations\\Rules\\required' => $baseDir . '/validations/Rules/required.php',
    'Validations\\ValidationInterface' => $baseDir . '/validations/ValidationInterface.php',
    'Validations\\Validator' => $baseDir . '/validations/Validator.php',
);