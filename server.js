import express from 'express';
import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const app = express();
const PORT = 3000;

// Mock data for PHP simulation
const promo_code = 'KBG6KJ';
const referral_email = 'm_jenny@bluewin.ch';
const recommendations = [
    { symbol: 'VNET', volume: 1057945, stdDev: 8.4, ramp: 101.5, mtj: 3970, tra: 1.77, name: 'VNET Group, Inc.' },
    { symbol: 'ZH', volume: 8177501, stdDev: 9.5, ramp: 62.2, mtj: 1866, tra: 3.14, name: 'Zhihu Inc.' },
    { symbol: 'BABA', volume: 42067674, stdDev: 3.9, ramp: 49.3, mtj: 1214, tra: 1.99, name: 'Alibaba Group Holding Ltd' },
    { symbol: 'SRC', volume: 1186076, stdDev: 8.4, ramp: 54.6, mtj: 970, tra: 1.65, name: 'Spirit Realty Capital' },
    { symbol: 'TUYA', volume: 1188033, stdDev: 8.4, ramp: 54.6, mtj: 970, tra: 1.65, name: 'Tuya Inc.' },
    { symbol: 'ACMR', volume: 1596081, stdDev: 5.5, ramp: 40.1, mtj: 917, tra: 2.27, name: 'ACM Research, Inc.' },
    { symbol: 'SEDG', volume: 888309, stdDev: 8.5, ramp: 33.9, mtj: 717, tra: 2.49, name: 'SolarEdge Technologies' },
    { symbol: 'SIFY', volume: 135375, stdDev: 7.9, ramp: 54.7, mtj: 696, tra: 1.43, name: 'Sify Technologies Ltd' },
    { symbol: 'LUNG', volume: 635710, stdDev: 9.9, ramp: 45.9, mtj: 678, tra: 4.43, name: 'Pulmonx Corporation' },
];

app.get('/', (req, res) => {
    let content = fs.readFileSync(path.join(__dirname, 'index.php'), 'utf8');

    // Simple PHP simulation (regex based)
    // Remove the data definition block at the top
    content = content.replace(/<\?php[\s\S]*?\$recommendations = \[[\s\S]*?\];[\s\S]*?\?>/, '');

    // Replace simple echo variables
    content = content.replace(/<\?php echo \$promo_code; \?>/g, promo_code);
    content = content.replace(/<\?php echo \$referral_email; \?>/g, referral_email);

    // Replace the foreach loop
    const loopRegex = /<\?php foreach \(\$recommendations as \$stock\): \?>([\s\S]*?)<\?php endforeach; \?>/;
    const match = content.match(loopRegex);
    if (match) {
        const template = match[1];
        const renderedRows = recommendations.map(stock => {
            let row = template;
            row = row.replace(/<\?php echo \$stock\['symbol'\]; \?>/g, stock.symbol);
            row = row.replace(/<\?php echo \$stock\['name'\]; \?>/g, stock.name);
            row = row.replace(/<\?php echo number_format\(\$stock\['volume'\]\); \?>/g, stock.volume.toLocaleString());
            row = row.replace(/<\?php echo \$stock\['stdDev'\]; \?>/g, stock.stdDev);
            row = row.replace(/<\?php echo \$stock\['ramp'\]; \?>/g, stock.ramp);
            row = row.replace(/<\?php echo \$stock\['mtj'\]; \?>/g, stock.mtj);
            row = row.replace(/<\?php echo \$stock\['tra'\]; \?>/g, stock.tra);
            return row;
        }).join('');
        content = content.replace(loopRegex, renderedRows);
    }

    res.send(content);
});

app.listen(PORT, '0.0.0.0', () => {
    console.log(`Server running on http://localhost:${PORT}`);
});
