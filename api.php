<?php
// Mock data for the API
$recommendations = [
    ["symbol" => "VNET", "volume" => 1057945, "stdDev" => 8.4, "ramp" => 101.5, "mtj" => 3970, "tra" => 1.77, "name" => "VNET Group, Inc.", "industry" => "Internet Services"],
    ["symbol" => "ZH", "volume" => 8177501, "stdDev" => 9.5, "ramp" => 62.2, "mtj" => 1866, "tra" => 3.14, "name" => "Zhihu Inc.", "industry" => "Internet Content"],
    ["symbol" => "BABA", "volume" => 42067674, "stdDev" => 3.9, "ramp" => 49.3, "mtj" => 1214, "tra" => 1.99, "name" => "Alibaba Group Holding Ltd", "industry" => "E-commerce"],
    ["symbol" => "SRC", "volume" => 1186076, "stdDev" => 8.4, "ramp" => 54.6, "mtj" => 970, "tra" => 1.65, "name" => "Spirit Realty Capital", "industry" => "REITs"],
    ["symbol" => "TUYA", "volume" => 1188033, "stdDev" => 8.4, "ramp" => 54.6, "mtj" => 970, "tra" => 1.65, "name" => "Tuya Inc.", "industry" => "Software"],
    ["symbol" => "ACMR", "volume" => 1596081, "stdDev" => 5.5, "ramp" => 40.1, "mtj" => 917, "tra" => 2.27, "name" => "ACM Research, Inc.", "industry" => "Semiconductors"],
    ["symbol" => "SEDG", "volume" => 888309, "stdDev" => 8.5, "ramp" => 33.9, "mtj" => 717, "tra" => 2.49, "name" => "SolarEdge Technologies", "industry" => "Solar Energy"],
    ["symbol" => "SIFY", "volume" => 135375, "stdDev" => 7.9, "ramp" => 54.7, "mtj" => 696, "tra" => 1.43, "name" => "Sify Technologies Ltd", "industry" => "IT Services"],
    ["symbol" => "LUNG", "volume" => 635710, "stdDev" => 9.9, "ramp" => 45.9, "mtj" => 678, "tra" => 4.43, "name" => "Pulmonx Corporation", "industry" => "Medical Devices"]
];

header('Content-Type: application/json');
echo json_encode($recommendations);
?>
