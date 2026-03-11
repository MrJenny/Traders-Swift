<?php
// Load recommendations from JSON file
$json_file = '373-AR-KW09_6W_Equity.json';
$recommendations = [];

if (file_exists($json_file)) {
    $json_content = file_get_contents($json_file);
    $data = json_decode($json_content, true);
    
    // Symbol to Name mapping for better UX
    $name_mapping = [
        'RIG' => 'Transocean Ltd.',
        'GERN' => 'Geron Corporation',
        'KOS' => 'Kosmos Energy Ltd.',
        'GLW' => 'Corning Incorporated',
        'VRT' => 'Vertiv Holdings Co',
        'XPO' => 'XPO, Inc.',
        'NE' => 'Noble Corporation plc',
        'ABB' => 'ABB Ltd',
        'BKD' => 'Brookdale Senior Living Inc.',
        'VIAV' => 'Viavi Solutions Inc.',
        'CHX' => 'ChampionX Corporation',
        'ALXO' => 'ALX Oncology Holdings Inc.',
        'SOND' => 'Sonder Holdings Inc.',
        'PRTS' => 'CarParts.com, Inc.',
        'STKL' => 'SunOpta Inc.',
        'DVA' => 'DaVita Inc.',
        'UCTT' => 'Ultra Clean Holdings, Inc.',
        'TPH' => 'Tri Pointe Homes, Inc.',
        'OIS' => 'Oil States International, Inc.',
        'NS' => 'NuStar Energy L.P.',
        'MOD' => 'Modine Manufacturing Company',
        'LITE' => 'Lumentum Holdings Inc.',
        'HCP' => 'HashiCorp, Inc.',
        'RRX' => 'Regal Rexnord Corporation',
        'ERAS' => 'Erasca, Inc.',
        'CGNX' => 'Cognex Corporation',
        'VAL' => 'Valaris Limited',
        'TER' => 'Teradyne, Inc.',
        'CIEN' => 'Ciena Corporation',
        'PLX' => 'Protalix BioTherapeutics, Inc.',
        'GNRC' => 'Generac Holdings Inc.'
    ];

    if (isset($data['SYMBOLS'])) {
        foreach ($data['SYMBOLS'] as $s) {
            $recommendations[] = [
                'symbol' => $s['SYM'],
                'volume' => (int)$s['VOL'],
                'stdDev' => (float)$s['STD_DIV'],
                'ramp' => (float)$s['RAMP_GT_per_month'],
                'mtj' => (float)$s['MTJRating'],
                'tra' => (float)$s['TransActionRamp'],
                'name' => isset($name_mapping[$s['SYM']]) ? $name_mapping[$s['SYM']] : $s['SYM']
            ];
        }
    }
} else {
    // Fallback mock data if file is missing
    $recommendations = [
        ["symbol" => "VNET", "volume" => 1057945, "stdDev" => 8.4, "ramp" => 101.5, "mtj" => 3970, "tra" => 1.77, "name" => "VNET Group, Inc.", "industry" => "Internet Services"],
        ["symbol" => "ZH", "volume" => 8177501, "stdDev" => 9.5, "ramp" => 62.2, "mtj" => 1866, "tra" => 3.14, "name" => "Zhihu Inc.", "industry" => "Internet Content"],
        ["symbol" => "BABA", "volume" => 42067674, "stdDev" => 3.9, "ramp" => 49.3, "mtj" => 1214, "tra" => 1.99, "name" => "Alibaba Group Holding Ltd", "industry" => "E-commerce"],
    ];
}

header('Content-Type: application/json');
echo json_encode($recommendations);
?>
