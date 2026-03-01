<?php
$promo_code = "KBG6KJ";
$referral_email = "m_jenny@bluewin.ch";
?>
<!doctype html>
<html lang="de">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Traders-Swift | PHP Version</title>
    <!-- We still use the same CSS and JS entry points, but served via PHP -->
    <script type="module" src="/src/main.ts"></script>
  </head>
  <body class="bg-brand-bg text-brand-primary font-sans antialiased">
    <header class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-md border-b border-black/5">
      <div class="max-w-7xl mx-auto px-4 h-16 flex items-center justify-between">
        <div class="flex items-center gap-2">
          <div class="w-8 h-8 bg-black rounded-lg flex items-center justify-center">
            <i data-lucide="zap" class="text-white w-5 h-5"></i>
          </div>
          <span class="font-serif text-xl font-bold tracking-tight">Traders-Swift (PHP)</span>
        </div>
        <nav class="hidden md:flex items-center gap-8 text-sm font-medium opacity-70">
          <a href="#how-it-works" class="hover:opacity-100 transition-opacity">Wie es funktioniert</a>
          <a href="#algorithm" class="hover:opacity-100 transition-opacity">Algorithmus</a>
          <a href="#recommendations" class="hover:opacity-100 transition-opacity">Empfehlungen</a>
          <a href="#referral" class="hover:opacity-100 transition-opacity">Empfehlung</a>
        </nav>
        <div class="flex items-center gap-4">
          <span class="hidden sm:inline-block text-xs font-mono bg-emerald-100 text-emerald-700 px-2 py-1 rounded">PILOT PHASE</span>
          <button class="bg-black text-white px-4 py-2 rounded-full text-sm font-medium hover:bg-black/80 transition-colors">
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

      <section id="recommendations" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4">
          <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
            <div class="max-w-2xl">
              <h2 class="text-4xl font-bold mb-4">Aktuelle Pilot-Liste (PHP)</h2>
              <p class="text-black/60">
                Sortiert nach MTJ-Faktor. Diese Liste wird wöchentlich erneuert und basiert auf der Fortsetzung aktueller Markttrends.
              </p>
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
                <!-- Recommendations will be injected here via JS from api.php -->
              </div>
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
                Wir freuen uns, wenn Sie uns weiterempfehlen. PromoCode: <strong><?php echo $promo_code; ?></strong>
              </p>
              <div class="flex flex-wrap gap-4 items-center">
                <div class="bg-white border border-black/10 px-6 py-3 rounded-full flex items-center gap-4">
                  <span class="text-xs font-bold uppercase tracking-widest opacity-40">PromoCode</span>
                  <span id="promo-code-display" class="font-mono font-bold text-lg"><?php echo $promo_code; ?></span>
                  <button id="copy-promo-btn" class="text-black/40 hover:text-black transition-colors">
                    <i data-lucide="copy" class="w-5 h-5"></i>
                  </button>
                </div>
                <a id="referral-mail-link" href="mailto:<?php echo $referral_email; ?>" class="bg-black text-white px-8 py-3 rounded-full font-medium flex items-center gap-2 hover:bg-black/80 transition-colors">
                  <i data-lucide="mail" class="w-4 h-4"></i> Kollegen einladen
                </a>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

    <footer class="py-12 bg-white border-t border-black/5">
      <div class="max-w-7xl mx-auto px-4 text-center text-[10px] font-bold uppercase tracking-widest text-black/30">
        <span>© 2026 Traders-Swift.ch - PHP Version</span>
      </div>
    </footer>
  </body>
</html>
