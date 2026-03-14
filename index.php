<?php
/**
 * Traders-Swift | MTJ-Faktor Investment
 * PHP Version for traditional webspaces
 */

// Configuration & Mock Data
$promo_code = 'KBG6KJ';
$referral_email = 'm_jenny@bluewin.ch';

// Load recommendations from JSON file
$json_file = './renders/373-AR-KW09_6W_Equity.json';
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
        ['symbol' => 'VNET', 'volume' => 1057945, 'stdDev' => 8.4, 'ramp' => 101.5, 'mtj' => 3970, 'tra' => 1.77, 'name' => 'VNET Group, Inc.'],
        ['symbol' => 'ZH', 'volume' => 8177501, 'stdDev' => 9.5, 'ramp' => 62.2, 'mtj' => 1866, 'tra' => 3.14, 'name' => 'Zhihu Inc.'],
        ['symbol' => 'BABA', 'volume' => 42067674, 'stdDev' => 3.9, 'ramp' => 49.3, 'mtj' => 1214, 'tra' => 1.99, 'name' => 'Alibaba Group Holding Ltd'],
    ];
}
?>
<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Traders-Swift | MTJ-Faktor Investment</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,700;1,700&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        serif: ['Playfair Display', 'serif'],
                        mono: ['JetBrains Mono', 'monospace'],
                    },
                    colors: {
                        brand: {
                            bg: '#F9F9F7',
                            primary: '#141414',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @layer components {
            .glass-card {
                @apply bg-white/40 backdrop-blur-xl border border-white/20 rounded-3xl shadow-sm;
            }
            .data-grid-row {
                @apply grid grid-cols-6 gap-4 py-4 border-b border-black/5 items-center hover:bg-black/[0.02] transition-colors;
            }
        }
        body {
            background-color: #F9F9F7;
        }
    </style>
</head>
<body class="text-brand-primary font-sans antialiased">
    <header class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-md border-b border-black/5">
        <div class="max-w-7xl mx-auto px-4 h-16 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-black rounded-lg flex items-center justify-center">
                    <i data-lucide="zap" class="text-white w-5 h-5"></i>
                </div>
                <span class="font-serif text-xl font-bold tracking-tight">Traders-Swift</span>
            </div>
            <nav class="hidden md:flex items-center gap-8 text-sm font-medium opacity-70">
                <a href="#how-it-works" class="hover:opacity-100 transition-opacity">Wie es funktioniert</a>
                <a href="#algorithm" class="hover:opacity-100 transition-opacity">Algorithmus</a>
                <a href="#recommendations" class="hover:opacity-100 transition-opacity">Empfehlungen</a>
                <a href="#referral" class="hover:opacity-100 transition-opacity">Empfehlung</a>
            </nav>
            <div class="flex items-center gap-4">
                <span class="hidden sm:inline-block text-xs font-mono bg-emerald-100 text-emerald-700 px-2 py-1 rounded">PILOT PHASE</span>
                <button onclick="openPremiumModal()" class="bg-black text-white px-4 py-2 rounded-full text-sm font-medium hover:bg-black/80 transition-colors">
                    Premium Zugang
                </button>
            </div>
        </div>
    </header>

    <main>
        <section class="pt-32 pb-20 px-4 overflow-hidden">
            <div class="max-w-7xl mx-auto">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div id="hero-content">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-bold mb-6">
                            <i data-lucide="activity" class="w-3 h-3"></i>
                            <span>WÖCHENTLICHE US-MARKT ANALYSE</span>
                        </div>
                        <h1 class="text-6xl md:text-7xl font-serif font-bold leading-[1.1] mb-6">
                            Präzise Investitionen durch <span class="italic text-emerald-600">MTJ-Faktor</span>.
                        </h1>
                        <p class="text-lg text-black/60 max-w-lg mb-8 leading-relaxed">
                            Traders-Swift scannt den US-Markt nach Titeln mit geringster Volatilität bei gleichzeitigem stabilen Wachstum. Maximale Sicherheit in einem dynamischen Markt.
                        </p>
                        <div class="flex flex-wrap gap-4">
                            <a href="#recommendations" class="bg-black text-white px-8 py-4 rounded-full font-medium flex items-center gap-2 hover:gap-3 transition-all">
                                Aktuelle Liste ansehen <i data-lucide="arrow-up-right" class="w-4 h-4"></i>
                            </a>
                            <a href="#how-it-works" class="px-8 py-4 rounded-full font-medium border border-black/10 hover:bg-black/5 transition-colors">
                                Mehr erfahren
                            </a>
                        </div>
                    </div>
                    
                    <div class="relative">
                        <div class="glass-card p-6 relative z-10">
                            <div class="flex items-center justify-between mb-6">
                                <div>
                                    <h3 class="font-bold text-lg">MTJ Performance Index</h3>
                                    <p class="text-xs text-black/40">Aggregierte Pilot-Daten (2025-2026)</p>
                                </div>
                                <div class="text-right">
                                    <span class="text-emerald-500 font-mono font-bold text-xl">+12.4%</span>
                                    <p class="text-[10px] text-black/40 uppercase tracking-wider">Ø Monatlich</p>
                                </div>
                            </div>
                            <div id="performance-chart" class="h-64 w-full"></div>
                        </div>
                        <div class="absolute -top-6 -right-6 w-32 h-32 bg-emerald-400/20 rounded-full blur-3xl animate-pulse"></div>
                        <div class="absolute -bottom-10 -left-10 w-48 h-48 bg-blue-400/10 rounded-full blur-3xl"></div>
                    </div>
                </div>
            </div>
        </section>

        <section id="how-it-works" class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 text-center">
                <div class="max-w-2xl mx-auto mb-16">
                    <h2 class="text-4xl font-bold mb-4">Wie funktioniert Traders-Swift?</h2>
                    <p class="text-black/60">
                        Das Anlageuniversum ist groß. In diesem Pool an Möglichkeiten die richtigen und schwankungsarmen Titel zu finden ist manuell kaum möglich.
                    </p>
                </div>
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 text-left">
                    <div class="feature-card p-8 rounded-2xl border border-black/5 hover:border-emerald-500/20 hover:bg-emerald-50/30 transition-all">
                        <div class="w-12 h-12 bg-black text-white rounded-xl flex items-center justify-center mb-6">
                            <i data-lucide="shield-check" class="w-6 h-6"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Transparenz</h3>
                        <p class="text-sm text-black/50 leading-relaxed">Dank mathematischer Modelle und klarer Standardabweichungen.</p>
                    </div>
                    <div class="feature-card p-8 rounded-2xl border border-black/5 hover:border-emerald-500/20 hover:bg-emerald-50/30 transition-all">
                        <div class="w-12 h-12 bg-black text-white rounded-xl flex items-center justify-center mb-6">
                            <i data-lucide="target" class="w-6 h-6"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Risiko-Reduktion</h3>
                        <p class="text-sm text-black/50 leading-relaxed">Fokus auf hochvolumige Titel zur Vermeidung von Illiquidität.</p>
                    </div>
                    <div class="feature-card p-8 rounded-2xl border border-black/5 hover:border-emerald-500/20 hover:bg-emerald-50/30 transition-all">
                        <div class="w-12 h-12 bg-black text-white rounded-xl flex items-center justify-center mb-6">
                            <i data-lucide="zap" class="w-6 h-6"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Trend-Erkennung</h3>
                        <p class="text-sm text-black/50 leading-relaxed">Neue Markttrends werden durch den TSA-Algorithmus automatisch erkannt.</p>
                    </div>
                    <div class="feature-card p-8 rounded-2xl border border-black/5 hover:border-emerald-500/20 hover:bg-emerald-50/30 transition-all">
                        <div class="w-12 h-12 bg-black text-white rounded-xl flex items-center justify-center mb-6">
                            <i data-lucide="clock" class="w-6 h-6"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Zeitersparnis</h3>
                        <p class="text-sm text-black/50 leading-relaxed">Automatisierte Scans ersparen Ihnen stundenlange manuelle Recherche.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="algorithm" class="py-20 bg-brand-bg">
            <div class="max-w-7xl mx-auto px-4">
                <div class="grid lg:grid-cols-2 gap-16 items-center">
                    <div>
                        <h2 class="text-4xl font-bold mb-6">Der Traders Swift Algorithmus (TSA)</h2>
                        <div class="space-y-6 text-black/70">
                            <p>
                                Der TSA sucht ein Modell aus den vielen Möglichkeiten des US Aktienmarktes und ETFs. Um das Investment so sicher wie möglich zu machen, konzentriert sich der TSA auf großvolumige Aktien oder ETFs.
                            </p>
                            <p>
                                Er sucht nach Titeln, die stabil sind und einen klaren Aufwärtstrend haben. Diese beiden Parameter sind gegenläufig: Der Wertzuwachs steigt, während die Volatilität sinkt.
                            </p>
                            <div class="p-6 bg-black text-white rounded-2xl">
                                <div class="flex items-center gap-4 mb-4">
                                    <div class="w-10 h-10 rounded-full bg-emerald-500 flex items-center justify-center font-bold">MTJ</div>
                                    <span class="font-mono text-sm uppercase tracking-widest opacity-60">Berechnungs-Formel</span>
                                </div>
                                <p class="text-2xl font-serif italic">
                                    Hoher Wertzuwachs + Geringe Volatilität = Hoher MTJ Wert
                                </p>
                            </div>
                            <p class="text-sm italic">
                                Zusammengefasst sind dies viele mathematische Formeln, die aus historischen Daten und Wertetabellen zu einer Prognose führen.
                            </p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-4">
                            <div class="glass-card p-4 aspect-square flex flex-col justify-between">
                                <i data-lucide="bar-chart-3" class="w-8 h-8 text-emerald-500"></i>
                                <div>
                                    <p class="text-[10px] uppercase font-bold text-black/40">Linear Regression</p>
                                    <p class="text-xs">Trend-Bestätigung</p>
                                </div>
                            </div>
                            <div class="glass-card p-4 aspect-square flex flex-col justify-between bg-black text-white">
                                <i data-lucide="trending-up" class="w-8 h-8 text-emerald-400"></i>
                                <div>
                                    <p class="text-[10px] uppercase font-bold opacity-40">Growth Factor</p>
                                    <p class="text-xs">Wachstums-Rate</p>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-4 pt-8">
                            <div class="glass-card p-4 aspect-square flex flex-col justify-between">
                                <i data-lucide="shield-check" class="w-8 h-8 text-blue-500"></i>
                                <div>
                                    <p class="text-[10px] uppercase font-bold text-black/40">Standard Deviation</p>
                                    <p class="text-xs">Risiko-Analyse</p>
                                </div>
                            </div>
                            <div class="glass-card p-4 aspect-square flex flex-col justify-between">
                                <i data-lucide="activity" class="w-8 h-8 text-purple-500"></i>
                                <div>
                                    <p class="text-[10px] uppercase font-bold text-black/40">Volatility Scan</p>
                                    <p class="text-xs">Markt-Rauschen</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="recommendations" class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
                    <div class="max-w-2xl">
                        <h2 class="text-4xl font-bold mb-4">Aktuelle Pilot-Liste</h2>
                        <p class="text-black/60">
                            Sortiert nach MTJ-Faktor. Diese Liste wird wöchentlich erneuert und basiert auf der Fortsetzung aktueller Markttrends.
                        </p>
                    </div>
                    <div class="bg-emerald-50 p-4 rounded-2xl border border-emerald-100 flex items-center gap-4">
                        <div class="text-emerald-700">
                            <p class="text-[10px] font-bold uppercase tracking-wider">Nächstes Update</p>
                            <p class="font-mono font-bold">In 4 Tagen, 12h</p>
                        </div>
                        <div class="w-px h-8 bg-emerald-200"></div>
                        <button class="text-emerald-700 font-bold text-sm flex items-center gap-1 hover:underline">
                            Erinnern <i data-lucide="chevron-right" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <div class="min-w-[800px]">
                        <div class="grid grid-cols-6 gap-4 px-8 py-4 bg-black text-white rounded-t-2xl text-[10px] font-bold uppercase tracking-widest">
                            <span>Symbol / Name</span>
                            <span class="text-right">Volumen</span>
                            <span class="text-right">StdDev</span>
                            <span class="text-right">Ramp</span>
                            <span class="text-right text-emerald-400">MTJ Factor</span>
                            <span class="text-right">TRA</span>
                        </div>
                        <div id="recommendations-list" class="border-x border-b border-black/5 rounded-b-2xl overflow-hidden">
                            <?php foreach ($recommendations as $stock): ?>
                                <div class="data-grid-row px-8">
                                    <div class="flex flex-col">
                                        <span class="font-bold font-mono"><?php echo $stock['symbol']; ?></span>
                                        <span class="text-[10px] text-black/40 truncate"><?php echo $stock['name']; ?></span>
                                    </div>
                                    <span class="text-right font-mono text-sm"><?php echo number_format($stock['volume']); ?></span>
                                    <span class="text-right font-mono text-sm"><?php echo $stock['stdDev']; ?></span>
                                    <span class="text-right font-mono text-sm"><?php echo $stock['ramp']; ?></span>
                                    <span class="text-right font-mono text-sm font-bold text-emerald-600"><?php echo $stock['mtj']; ?></span>
                                    <span class="text-right font-mono text-sm"><?php echo $stock['tra']; ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <div class="mt-12 grid md:grid-cols-2 gap-8">
                    <div class="p-8 rounded-2xl bg-brand-bg border border-black/5">
                        <h3 class="text-xl font-bold mb-4 flex items-center gap-2">
                            <i data-lucide="info" class="w-5 h-5 text-blue-500"></i>
                            Umgang mit den Daten
                        </h3>
                        <ul class="space-y-4 text-sm text-black/70">
                            <li class="flex gap-3">
                                <div class="w-5 h-5 rounded-full bg-black text-white flex-shrink-0 flex items-center justify-center text-[10px]">1</div>
                                <span>Suchen Sie sich 2-5 Titel aus und streuen Sie Ihr Risiko.</span>
                            </li>
                            <li class="flex gap-3">
                                <div class="w-5 h-5 rounded-full bg-black text-white flex-shrink-0 flex items-center justify-center text-[10px]">2</div>
                                <span>Bei +10% Gewinn innerhalb einer Woche: Verkauf (Realisation) oder Halten prüfen.</span>
                            </li>
                            <li class="flex gap-3">
                                <div class="w-5 h-5 rounded-full bg-black text-white flex-shrink-0 flex items-center justify-center text-[10px]">3</div>
                                <span>Stop-Loss: Falls ein Titel unter -5% bis -8% fällt, sollte dieser verkauft werden.</span>
                            </li>
                        </ul>
                    </div>
                    <div class="p-8 rounded-2xl bg-emerald-900 text-white relative overflow-hidden">
                        <div class="relative z-10">
                            <h3 class="text-xl font-bold mb-4">Premium Lizenz</h3>
                            <p class="text-emerald-100/70 text-sm mb-6">
                                In Zukunft wird es möglich sein, eine Premium Lizenz zu erwerben. Erhalten Sie 4x im Monat die aktuellsten Scans direkt in Ihr Postfach.
                            </p>
                            <div class="flex items-end gap-2 mb-8">
                                <span class="text-4xl font-serif font-bold">50.-</span>
                                <span class="text-sm opacity-60 pb-1">CHF / Monat</span>
                            </div>
                            <button onclick="openPremiumModal()" class="w-full py-4 bg-emerald-500 hover:bg-emerald-400 text-white rounded-full font-bold transition-colors">
                                Jetzt Premium sichern
                            </button>
                        </div>
                        <i data-lucide="zap" class="absolute -bottom-10 -right-10 w-48 h-48 text-white/5 rotate-12"></i>
                    </div>
                </div>
            </div>
        </section>

        <section id="referral" class="py-20 bg-brand-bg">
            <div class="max-w-7xl mx-auto px-4">
                <div class="glass-card p-8 md:p-12 flex flex-col md:flex-row items-center gap-12">
                    <div class="flex-1">
                        <h2 class="text-4xl font-bold mb-6">Gewinne 50.- CHF durch Empfehlung</h2>
                        <p class="text-black/60 mb-8 leading-relaxed">
                            Wir freuen uns, wenn Sie uns weiterempfehlen. Wir honorieren Ihren Einsatz mit einer Gutschrift von CHF 50.- für jeden geworbenen Premium-Kunden.
                        </p>
                        <div class="flex flex-wrap gap-4 items-center">
                            <div class="bg-white border border-black/10 px-6 py-3 rounded-full flex items-center gap-4">
                                <span class="text-xs font-bold uppercase tracking-widest opacity-40">PromoCode</span>
                                <span id="promo-code-display" class="font-mono font-bold text-lg"><?php echo $promo_code; ?></span>
                                <button id="copy-promo-btn" class="text-black/40 hover:text-black transition-colors">
                                    <i data-lucide="copy" class="w-5 h-5"></i>
                                </button>
                            </div>
                            <a id="referral-mail-link" href="mailto:<?php echo $referral_email; ?>?subject=Traders-Swift Tipp&body=Hallo Kollege, habe eben diese Liste erhalten. Das sieht noch vielversprechend aus. PromoCode:<?php echo $promo_code; ?> für 10% Rabatt." class="bg-black text-white px-8 py-3 rounded-full font-medium flex items-center gap-2 hover:bg-black/80 transition-colors">
                                <i data-lucide="mail" class="w-4 h-4"></i> Kollegen einladen
                            </a>
                        </div>
                    </div>
                    <div class="w-full md:w-1/3 aspect-square bg-emerald-500 rounded-3xl flex items-center justify-center relative group overflow-hidden">
                        <div class="text-white text-center p-8 relative z-10">
                            <span class="text-6xl font-serif font-bold mb-2 block">50.-</span>
                            <span class="text-sm font-bold uppercase tracking-widest opacity-80">CHF Provision</span>
                        </div>
                        <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors"></div>
                        <div class="absolute inset-0 border-4 border-white/20 border-dashed rounded-full scale-125 animate-[spin_20s_linear_infinite]"></div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="py-12 bg-white border-t border-black/5">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid md:grid-cols-4 gap-12 mb-12">
                <div class="col-span-2">
                    <div class="flex items-center gap-2 mb-6">
                        <div class="w-6 h-6 bg-black rounded flex items-center justify-center">
                            <i data-lucide="zap" class="text-white w-4 h-4"></i>
                        </div>
                        <span class="font-serif text-lg font-bold">Traders-Swift</span>
                    </div>
                    <p class="text-sm text-black/40 max-w-sm italic">
                        "Mit dem Erhalt dieser Daten verpflichtet sich der Kunde, diese Informationen ausschließlich für sich selbst zu nutzen. Die Daten dürfen nicht an Dritte weitergegeben werden."
                    </p>
                </div>
                <div>
                    <h4 class="font-bold mb-6">Plattform</h4>
                    <ul class="space-y-4 text-sm text-black/60">
                        <li><a href="#" class="hover:text-black transition-colors">Über uns</a></li>
                        <li><a href="#" class="hover:text-black transition-colors">Methodik</a></li>
                        <li><a href="#" class="hover:text-black transition-colors">Preise</a></li>
                        <li><a href="#" class="hover:text-black transition-colors">Kontakt</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-6">Rechtliches</h4>
                    <ul class="space-y-4 text-sm text-black/60">
                        <li><a href="#" class="hover:text-black transition-colors">Impressum</a></li>
                        <li><a href="#" class="hover:text-black transition-colors">Datenschutz</a></li>
                        <li><a href="#" class="hover:text-black transition-colors">Haftungsausschluss</a></li>
                    </ul>
                </div>
            </div>
            <div class="pt-12 border-t border-black/5 flex flex-col md:flex-row justify-between items-center gap-6 text-[10px] font-bold uppercase tracking-widest text-black/30">
                <span>© 2026 Traders-Swift.ch - Alle Rechte vorbehalten.</span>
                <div class="flex gap-8">
                    <span>Entwickelt von M. Jenny</span>
                    <span>US-Markt Fokus</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Premium Modal -->
    <div id="premium-modal" class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closePremiumModal()"></div>
        <div class="glass-card w-full max-w-lg bg-white relative z-10 overflow-hidden animate-in fade-in zoom-in duration-300">
            <button onclick="closePremiumModal()" class="absolute top-6 right-6 text-black/40 hover:text-black transition-colors">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>

            <!-- Step 1: Registration -->
            <div id="step-registration" class="p-8 md:p-12">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold mb-2">Premium Zugang</h2>
                    <p class="text-black/60">Registrieren Sie sich für wöchentliche Analysen.</p>
                </div>
                
                <form onsubmit="handleRegistration(event)" class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-xs font-bold uppercase tracking-widest opacity-40">Vorname</label>
                            <input type="text" required name="firstname" class="w-full px-4 py-3 rounded-xl border border-black/10 focus:border-emerald-500 outline-none transition-colors" placeholder="Max">
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold uppercase tracking-widest opacity-40">Name</label>
                            <input type="text" required name="lastname" class="w-full px-4 py-3 rounded-xl border border-black/10 focus:border-emerald-500 outline-none transition-colors" placeholder="Mustermann">
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold uppercase tracking-widest opacity-40">E-Mail Adresse</label>
                        <input type="email" required name="email" class="w-full px-4 py-3 rounded-xl border border-black/10 focus:border-emerald-500 outline-none transition-colors" placeholder="max@beispiel.ch">
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold uppercase tracking-widest opacity-40">Passwort</label>
                        <input type="password" required name="password" class="w-full px-4 py-3 rounded-xl border border-black/10 focus:border-emerald-500 outline-none transition-colors" placeholder="••••••••">
                    </div>
                    
                    <div class="pt-4">
                        <button type="submit" class="w-full py-4 bg-black text-white rounded-full font-bold hover:bg-black/80 transition-colors flex items-center justify-center gap-2">
                            Weiter zur Zahlung <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Step 2: Payment -->
            <div id="step-payment" class="p-8 md:p-12 hidden">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold mb-2">Zahlung</h2>
                    <p class="text-black/60">Wählen Sie Ihre bevorzugte Zahlungsmethode.</p>
                </div>

                <div class="bg-emerald-50 p-4 rounded-2xl border border-emerald-100 mb-8 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-widest text-emerald-700 opacity-60">Abonnement</p>
                        <p class="font-bold">Premium Lizenz (4-8 Listen/Monat)</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xl font-bold">50.-</p>
                        <p class="text-[10px] text-emerald-700/60 uppercase font-bold">CHF / Monat</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <button onclick="handlePayment('paypal')" class="w-full p-4 rounded-2xl border border-black/10 hover:border-blue-500 hover:bg-blue-50 transition-all flex items-center justify-between group">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                                <i data-lucide="wallet" class="text-blue-600 w-6 h-6"></i>
                            </div>
                            <div class="text-left">
                                <p class="font-bold">PayPal</p>
                                <p class="text-xs text-black/40">Sicher und schnell bezahlen</p>
                            </div>
                        </div>
                        <i data-lucide="chevron-right" class="w-5 h-5 text-black/20 group-hover:text-blue-500 transition-colors"></i>
                    </button>

                    <button onclick="handlePayment('visa')" class="w-full p-4 rounded-2xl border border-black/10 hover:border-emerald-500 hover:bg-emerald-50 transition-all flex items-center justify-between group">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                                <i data-lucide="credit-card" class="text-emerald-600 w-6 h-6"></i>
                            </div>
                            <div class="text-left">
                                <p class="font-bold">Visa / Kreditkarte</p>
                                <p class="text-xs text-black/40">Alle gängigen Karten akzeptiert</p>
                            </div>
                        </div>
                        <i data-lucide="chevron-right" class="w-5 h-5 text-black/20 group-hover:text-emerald-500 transition-colors"></i>
                    </button>
                </div>

                <button onclick="showStep('registration')" class="mt-8 text-sm text-black/40 hover:text-black transition-colors flex items-center gap-2">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i> Zurück zur Registrierung
                </button>
            </div>

            <!-- Step 3: Success -->
            <div id="step-success" class="p-8 md:p-12 hidden text-center">
                <div class="w-20 h-20 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-8">
                    <i data-lucide="check-circle" class="w-10 h-10"></i>
                </div>
                <h2 class="text-3xl font-bold mb-4">Willkommen bei Premium!</h2>
                <p class="text-black/60 mb-8 leading-relaxed">
                    Vielen Dank für Ihr Vertrauen. Sie erhalten in Kürze eine Bestätigungs-E-Mail mit Ihren Zugangsdaten.
                </p>
                <button onclick="closePremiumModal()" class="w-full py-4 bg-black text-white rounded-full font-bold hover:bg-black/80 transition-colors">
                    Zum Dashboard
                </button>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://d3js.org/d3.v7.min.js"></script>
    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Render Performance Chart using D3
        const renderChart = () => {
            const container = document.getElementById('performance-chart');
            if (!container) return;

            const data = [
                { name: 'Jan', val: 100 },
                { name: 'Feb', val: 112 },
                { name: 'Mar', val: 108 },
                { name: 'Apr', val: 125 },
                { name: 'May', val: 138 },
                { name: 'Jun', val: 132 },
                { name: 'Jul', val: 145 },
                { name: 'Aug', val: 160 },
            ];

            const width = container.clientWidth;
            const height = container.clientHeight;
            const margin = { top: 20, right: 20, bottom: 30, left: 0 };

            const svg = d3.select('#performance-chart')
                .append('svg')
                .attr('width', width)
                .attr('height', height)
                .append('g')
                .attr('transform', `translate(${margin.left},${margin.top})`);

            const x = d3.scalePoint()
                .domain(data.map(d => d.name))
                .range([0, width - margin.right]);

            const y = d3.scaleLinear()
                .domain([0, d3.max(data, d => d.val) || 0])
                .range([height - margin.top - margin.bottom, 0]);

            // Add gradient
            const gradient = svg.append('defs')
                .append('linearGradient')
                .attr('id', 'area-gradient')
                .attr('x1', '0%').attr('y1', '0%')
                .attr('x2', '0%').attr('y2', '100%');

            gradient.append('stop')
                .attr('offset', '0%')
                .attr('stop-color', '#10b981')
                .attr('stop-opacity', 0.3);

            gradient.append('stop')
                .attr('offset', '100%')
                .attr('stop-color', '#10b981')
                .attr('stop-opacity', 0);

            // Add area
            const area = d3.area()
                .x(d => x(d.name) || 0)
                .y0(height - margin.top - margin.bottom)
                .y1(d => y(d.val))
                .curve(d3.curveMonotoneX);

            svg.append('path')
                .datum(data)
                .attr('fill', 'url(#area-gradient)')
                .attr('d', area);

            // Add line
            const line = d3.line()
                .x(d => x(d.name) || 0)
                .y(d => y(d.val))
                .curve(d3.curveMonotoneX);

            svg.append('path')
                .datum(data)
                .attr('fill', 'none')
                .attr('stroke', '#10b981')
                .attr('stroke-width', 3)
                .attr('d', line);

            // Add X axis
            svg.append('g')
                .attr('transform', `translate(0,${height - margin.top - margin.bottom})`)
                .call(d3.axisBottom(x).tickSize(0).tickPadding(10))
                .call(g => g.select('.domain').remove())
                .call(g => g.selectAll('text').attr('fill', '#00000040').style('font-size', '10px'));

            // Add grid lines
            svg.append('g')
                .attr('class', 'grid')
                .attr('stroke', '#00000010')
                .attr('stroke-dasharray', '3,3')
                .call(d3.axisLeft(y)
                    .ticks(5)
                    .tickSize(-(width - margin.right))
                    .tickFormat(() => '')
                )
                .call(g => g.select('.domain').remove());
        };

        // Initialize Referral Section
        const initReferral = () => {
            const promoCode = '<?php echo $promo_code; ?>';
            const copyBtn = document.getElementById('copy-promo-btn');

            if (copyBtn) {
                copyBtn.addEventListener('click', () => {
                    navigator.clipboard.writeText(promoCode);
                    const icon = copyBtn.querySelector('i');
                    if (icon) {
                        icon.setAttribute('data-lucide', 'check-circle-2');
                        icon.classList.add('text-emerald-500');
                        lucide.createIcons();
                        setTimeout(() => {
                            icon.setAttribute('data-lucide', 'copy');
                            icon.classList.remove('text-emerald-500');
                            lucide.createIcons();
                        }, 2000);
                    }
                });
            }
        };

        // Run on load
        window.addEventListener('DOMContentLoaded', () => {
            renderChart();
            initReferral();
        });

        // Premium Modal Logic
        const openPremiumModal = () => {
            const modal = document.getElementById('premium-modal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            showStep('registration');
            document.body.style.overflow = 'hidden';
            lucide.createIcons();
        };

        const closePremiumModal = () => {
            const modal = document.getElementById('premium-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = '';
        };

        const showStep = (step) => {
            ['registration', 'payment', 'success'].forEach(s => {
                document.getElementById(`step-${s}`).classList.add('hidden');
            });
            document.getElementById(`step-${step}`).classList.remove('hidden');
            lucide.createIcons();
        };

        const handleRegistration = async (e) => {
            e.preventDefault();
            const formData = new FormData(e.target);
            const data = Object.fromEntries(formData.entries());
            
            const submitBtn = e.target.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i data-lucide="loader-2" class="w-4 h-4 animate-spin"></i> Verarbeitung...';
            lucide.createIcons();

            try {
                console.log('Sending registration data:', data);
                const response = await fetch('register_api.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });
                
                const responseText = await response.text();
                console.log('Raw server response:', responseText);
                
                let result;
                try {
                    result = JSON.parse(responseText);
                } catch (e) {
                    console.error('Failed to parse JSON response:', e);
                    throw new Error('Server hat keine gültige JSON-Antwort gesendet. Prüfen Sie die Browser-Konsole.');
                }
                
                if (result.success) {
                    console.log('Registration successful:', result);
                    showStep('payment');
                } else {
                    console.warn('Registration failed:', result);
                    let errorMsg = result.message || 'Ein Fehler ist aufgetreten';
                    if (result.debug_error) errorMsg += '\n\nDebug: ' + result.debug_error;
                    alert(errorMsg);
                }
            } catch (error) {
                console.error('Registration error:', error);
                alert('Verbindungsfehler: ' + error.message);
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
                lucide.createIcons();
            }
        };

        const handlePayment = (method) => {
            console.log(`Processing payment via ${method}`);
            // Simulate payment processing
            const stepPayment = document.getElementById('step-payment');
            stepPayment.style.opacity = '0.5';
            stepPayment.style.pointerEvents = 'none';
            
            setTimeout(() => {
                stepPayment.style.opacity = '1';
                stepPayment.style.pointerEvents = 'auto';
                showStep('success');
            }, 1500);
        };
    </script>
</body>
</html>
