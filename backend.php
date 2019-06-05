<?php
require './vendor/autoload.php';

$data = json_decode(file_get_contents('php://input'));

// Validate
$validator = new JsonSchema\Validator;
$validator->validate($data, (object)['$ref' => 'file://' . realpath('object-validation.json')]);

if ($validator->isValid()) {
    echo "The supplied JSON validates against the schema.\n";
} else {
    echo "JSON does not validate. Violations:\n";
    foreach ($validator->getErrors() as $error) {
        echo sprintf("[%s] %s\n", $error['property'], $error['message']);
    }
}
