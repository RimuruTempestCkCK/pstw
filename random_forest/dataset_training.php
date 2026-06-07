<?php
require_once 'RandomForest.php';

function getTrainedModel() {
    $file = fopen(__DIR__ . '/training_data.csv', 'r');
    $data = [];
    $labels = [];

    while (($row = fgetcsv($file)) !== FALSE) {
        $labels[] = array_pop($row);
        $data[] = $row;
    }
    fclose($file);

    $rf = new RandomForest(15, 10, 2);
    $rf->train($data, $labels);

    return $rf;
}
?>
