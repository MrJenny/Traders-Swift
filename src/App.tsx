import React, { useState } from 'react';
import { motion, AnimatePresence } from 'motion/react';
import { 
  TrendingUp, 
  ShieldCheck, 
  Zap, 
  Clock, 
  ArrowUpRight, 
  Info, 
  ChevronRight, 
  Mail, 
  Copy, 
  CheckCircle2,
  BarChart3,
  Activity,
  Target
} from 'lucide-react';
import { 
  LineChart, 
  Line, 
  XAxis, 
  YAxis, 
  CartesianGrid, 
  Tooltip, 
  ResponsiveContainer,
  AreaChart,
  Area
} from 'recharts';
import { MOCK_RECOMMENDATIONS, PROMO_CODE, REFERRAL_EMAIL } from './constants';
import { StockRecommendation } from './types';

const Header = () => (
  <header className="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-md border-b border-black/5">
    <div className="max-w-7xl mx-auto px-4 h-16 flex items-center justify-between">
      <div className="flex items-center gap-2">
        <div className="w-8 h-8 bg-black rounded-lg flex items-center justify-center">
          <Zap className="text-white w-5 h-5" />
        </div>
        <span className="font-serif text-xl font-bold tracking-tight">Traders-Swift</span>
      </div>
      <nav className="hidden md:flex items-center gap-8 text-sm font-medium opacity-70">
        <a href="#how-it-works" className="hover:opacity-100 transition-opacity">Wie es funktioniert</a>
        <a href="#algorithm" className="hover:opacity-100 transition-opacity">Algorithmus</a>
        <a href="#recommendations" className="hover:opacity-100 transition-opacity">Empfehlungen</a>
        <a href="#referral" className="hover:opacity-100 transition-opacity">Empfehlung</a>
      </nav>
      <div className="flex items-center gap-4">
        <span className="hidden sm:inline-block text-xs font-mono bg-emerald-100 text-emerald-700 px-2 py-1 rounded">PILOT PHASE</span>
        <button className="bg-black text-white px-4 py-2 rounded-full text-sm font-medium hover:bg-black/80 transition-colors">
          Premium Zugang
        </button>
      </div>
    </div>
  </header>
);

const Hero = () => (
  <section className="pt-32 pb-20 px-4 overflow-hidden">
    <div className="max-w-7xl mx-auto">
      <div className="grid lg:grid-cols-2 gap-12 items-center">
        <motion.div 
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.6 }}
        >
          <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-bold mb-6">
            <Activity className="w-3 h-3" />
            <span>WÖCHENTLICHE US-MARKT ANALYSE</span>
          </div>
          <h1 className="text-6xl md:text-7xl font-serif font-bold leading-[1.1] mb-6">
            Präzise Investitionen durch <span className="italic text-emerald-600">MTJ-Faktor</span>.
          </h1>
          <p className="text-lg text-black/60 max-w-lg mb-8 leading-relaxed">
            Traders-Swift scannt den US-Markt nach Titeln mit geringster Volatilität bei gleichzeitigem stabilen Wachstum. Maximale Sicherheit in einem dynamischen Markt.
          </p>
          <div className="flex flex-wrap gap-4">
            <a href="#recommendations" className="bg-black text-white px-8 py-4 rounded-full font-medium flex items-center gap-2 hover:gap-3 transition-all">
              Aktuelle Liste ansehen <ArrowUpRight className="w-4 h-4" />
            </a>
            <a href="#how-it-works" className="px-8 py-4 rounded-full font-medium border border-black/10 hover:bg-black/5 transition-colors">
              Mehr erfahren
            </a>
          </div>
        </motion.div>
        
        <motion.div 
          initial={{ opacity: 0, scale: 0.9 }}
          animate={{ opacity: 1, scale: 1 }}
          transition={{ duration: 0.8, delay: 0.2 }}
          className="relative"
        >
          <div className="glass-card p-6 relative z-10">
            <div className="flex items-center justify-between mb-6">
              <div>
                <h3 className="font-bold text-lg">MTJ Performance Index</h3>
                <p className="text-xs text-black/40">Aggregierte Pilot-Daten (2025-2026)</p>
              </div>
              <div className="text-right">
                <span className="text-emerald-500 font-mono font-bold text-xl">+12.4%</span>
                <p className="text-[10px] text-black/40 uppercase tracking-wider">Ø Monatlich</p>
              </div>
            </div>
            <div className="h-64 w-full">
              <ResponsiveContainer width="100%" height="100%">
                <AreaChart data={[
                  { name: 'Jan', val: 100 },
                  { name: 'Feb', val: 112 },
                  { name: 'Mar', val: 108 },
                  { name: 'Apr', val: 125 },
                  { name: 'May', val: 138 },
                  { name: 'Jun', val: 132 },
                  { name: 'Jul', val: 145 },
                  { name: 'Aug', val: 160 },
                ]}>
                  <defs>
                    <linearGradient id="colorVal" x1="0" y1="0" x2="0" y2="1">
                      <stop offset="5%" stopColor="#10b981" stopOpacity={0.3}/>
                      <stop offset="95%" stopColor="#10b981" stopOpacity={0}/>
                    </linearGradient>
                  </defs>
                  <CartesianGrid strokeDasharray="3 3" vertical={false} stroke="#00000010" />
                  <XAxis dataKey="name" axisLine={false} tickLine={false} tick={{ fontSize: 10, fill: '#00000040' }} />
                  <YAxis hide />
                  <Tooltip 
                    contentStyle={{ borderRadius: '12px', border: 'none', boxShadow: '0 10px 15px -3px rgb(0 0 0 / 0.1)' }}
                  />
                  <Area type="monotone" dataKey="val" stroke="#10b981" strokeWidth={3} fillOpacity={1} fill="url(#colorVal)" />
                </AreaChart>
              </ResponsiveContainer>
            </div>
          </div>
          <div className="absolute -top-6 -right-6 w-32 h-32 bg-emerald-400/20 rounded-full blur-3xl animate-pulse" />
          <div className="absolute -bottom-10 -left-10 w-48 h-48 bg-blue-400/10 rounded-full blur-3xl" />
        </motion.div>
      </div>
    </div>
  </section>
);

const Features = () => {
  const features = [
    { icon: <ShieldCheck className="w-6 h-6" />, title: "Transparenz", desc: "Dank mathematischer Modelle und klarer Standardabweichungen." },
    { icon: <Target className="w-6 h-6" />, title: "Risiko-Reduktion", desc: "Fokus auf hochvolumige Titel zur Vermeidung von Illiquidität." },
    { icon: <Zap className="w-6 h-6" />, title: "Trend-Erkennung", desc: "Neue Markttrends werden durch den TSA-Algorithmus automatisch erkannt." },
    { icon: <Clock className="w-6 h-6" />, title: "Zeitersparnis", desc: "Automatisierte Scans ersparen Ihnen stundenlange manuelle Recherche." },
  ];

  return (
    <section id="how-it-works" className="py-20 bg-white">
      <div className="max-w-7xl mx-auto px-4">
        <div className="text-center max-w-2xl mx-auto mb-16">
          <h2 className="text-4xl font-bold mb-4">Wie funktioniert Traders-Swift?</h2>
          <p className="text-black/60">
            Das Anlageuniversum ist groß. In diesem Pool an Möglichkeiten die richtigen und schwankungsarmen Titel zu finden ist manuell kaum möglich.
          </p>
        </div>
        <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
          {features.map((f, i) => (
            <motion.div 
              key={i}
              whileHover={{ y: -5 }}
              className="p-8 rounded-2xl border border-black/5 hover:border-emerald-500/20 hover:bg-emerald-50/30 transition-all"
            >
              <div className="w-12 h-12 bg-black text-white rounded-xl flex items-center justify-center mb-6">
                {f.icon}
              </div>
              <h3 className="text-xl font-bold mb-3">{f.title}</h3>
              <p className="text-sm text-black/50 leading-relaxed">{f.desc}</p>
            </motion.div>
          ))}
        </div>
      </div>
    </section>
  );
};

const AlgorithmSection = () => (
  <section id="algorithm" className="py-20 bg-brand-bg">
    <div className="max-w-7xl mx-auto px-4">
      <div className="grid lg:grid-cols-2 gap-16 items-center">
        <div>
          <h2 className="text-4xl font-bold mb-6">Der Traders Swift Algorithmus (TSA)</h2>
          <div className="space-y-6 text-black/70">
            <p>
              Der TSA sucht ein Modell aus den vielen Möglichkeiten des US Aktienmarktes und ETFs. Um das Investment so sicher wie möglich zu machen, konzentriert sich der TSA auf großvolumige Aktien oder ETFs.
            </p>
            <p>
              Er sucht nach Titeln, die stabil sind und einen klaren Aufwärtstrend haben. Diese beiden Parameter sind gegenläufig: Der Wertzuwachs steigt, während die Volatilität sinkt.
            </p>
            <div className="p-6 bg-black text-white rounded-2xl">
              <div className="flex items-center gap-4 mb-4">
                <div className="w-10 h-10 rounded-full bg-emerald-500 flex items-center justify-center font-bold">MTJ</div>
                <span className="font-mono text-sm uppercase tracking-widest opacity-60">Berechnungs-Formel</span>
              </div>
              <p className="text-2xl font-serif italic">
                Hoher Wertzuwachs + Geringe Volatilität = Hoher MTJ Wert
              </p>
            </div>
            <p className="text-sm italic">
              Zusammengefasst sind dies viele mathematische Formeln, die aus historischen Daten und Wertetabellen zu einer Prognose führen.
            </p>
          </div>
        </div>
        <div className="grid grid-cols-2 gap-4">
          <div className="space-y-4">
            <div className="glass-card p-4 aspect-square flex flex-col justify-between">
              <BarChart3 className="w-8 h-8 text-emerald-500" />
              <div>
                <p className="text-[10px] uppercase font-bold text-black/40">Linear Regression</p>
                <p className="text-xs">Trend-Bestätigung</p>
              </div>
            </div>
            <div className="glass-card p-4 aspect-square flex flex-col justify-between bg-black text-white">
              <TrendingUp className="w-8 h-8 text-emerald-400" />
              <div>
                <p className="text-[10px] uppercase font-bold opacity-40">Growth Factor</p>
                <p className="text-xs">Wachstums-Rate</p>
              </div>
            </div>
          </div>
          <div className="space-y-4 pt-8">
            <div className="glass-card p-4 aspect-square flex flex-col justify-between">
              <ShieldCheck className="w-8 h-8 text-blue-500" />
              <div>
                <p className="text-[10px] uppercase font-bold text-black/40">Standard Deviation</p>
                <p className="text-xs">Risiko-Analyse</p>
              </div>
            </div>
            <div className="glass-card p-4 aspect-square flex flex-col justify-between">
              <Activity className="w-8 h-8 text-purple-500" />
              <div>
                <p className="text-[10px] uppercase font-bold text-black/40">Volatility Scan</p>
                <p className="text-xs">Markt-Rauschen</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
);

const RecommendationTable = () => {
  const [copied, setCopied] = useState(false);

  const handleCopy = () => {
    navigator.clipboard.writeText(PROMO_CODE);
    setCopied(true);
    setTimeout(() => setCopied(false), 2000);
  };

  return (
    <section id="recommendations" className="py-20 bg-white">
      <div className="max-w-7xl mx-auto px-4">
        <div className="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
          <div className="max-w-2xl">
            <h2 className="text-4xl font-bold mb-4">Aktuelle Pilot-Liste</h2>
            <p className="text-black/60">
              Sortiert nach MTJ-Faktor. Diese Liste wird wöchentlich erneuert und basiert auf der Fortsetzung aktueller Markttrends.
            </p>
          </div>
          <div className="bg-emerald-50 p-4 rounded-2xl border border-emerald-100 flex items-center gap-4">
            <div className="text-emerald-700">
              <p className="text-[10px] font-bold uppercase tracking-wider">Nächstes Update</p>
              <p className="font-mono font-bold">In 4 Tagen, 12h</p>
            </div>
            <div className="w-px h-8 bg-emerald-200" />
            <button className="text-emerald-700 font-bold text-sm flex items-center gap-1 hover:underline">
              Erinnern <ChevronRight className="w-4 h-4" />
            </button>
          </div>
        </div>

        <div className="overflow-x-auto">
          <div className="min-w-[800px]">
            <div className="grid grid-cols-6 gap-4 px-8 py-4 bg-black text-white rounded-t-2xl text-[10px] font-bold uppercase tracking-widest">
              <span>Symbol / Name</span>
              <span className="text-right">Volumen</span>
              <span className="text-right">StdDev</span>
              <span className="text-right">Ramp</span>
              <span className="text-right text-emerald-400">MTJ Factor</span>
              <span className="text-right">TRA</span>
            </div>
            <div className="border-x border-b border-black/5 rounded-b-2xl overflow-hidden">
              {MOCK_RECOMMENDATIONS.map((stock, i) => (
                <motion.div 
                  key={stock.symbol}
                  initial={{ opacity: 0, x: -10 }}
                  whileInView={{ opacity: 1, x: 0 }}
                  transition={{ delay: i * 0.05 }}
                  className="data-grid-row mx-4 my-2"
                >
                  <div className="flex flex-col">
                    <span className="font-bold font-mono">{stock.symbol}</span>
                    <span className="text-[10px] text-black/40 truncate">{stock.name}</span>
                  </div>
                  <span className="text-right font-mono text-sm">{stock.volume.toLocaleString()}</span>
                  <span className="text-right font-mono text-sm">{stock.stdDev}</span>
                  <span className="text-right font-mono text-sm">{stock.ramp}</span>
                  <span className="text-right font-mono text-sm font-bold text-emerald-600">{stock.mtj}</span>
                  <span className="text-right font-mono text-sm">{stock.tra}</span>
                </motion.div>
              ))}
            </div>
          </div>
        </div>

        <div className="mt-12 grid md:grid-cols-2 gap-8">
          <div className="p-8 rounded-2xl bg-brand-bg border border-black/5">
            <h3 className="text-xl font-bold mb-4 flex items-center gap-2">
              <Info className="w-5 h-5 text-blue-500" />
              Umgang mit den Daten
            </h3>
            <ul className="space-y-4 text-sm text-black/70">
              <li className="flex gap-3">
                <div className="w-5 h-5 rounded-full bg-black text-white flex-shrink-0 flex items-center justify-center text-[10px]">1</div>
                <span>Suchen Sie sich 2-5 Titel aus und streuen Sie Ihr Risiko.</span>
              </li>
              <li className="flex gap-3">
                <div className="w-5 h-5 rounded-full bg-black text-white flex-shrink-0 flex items-center justify-center text-[10px]">2</div>
                <span>Bei +10% Gewinn innerhalb einer Woche: Verkauf (Realisation) oder Halten prüfen.</span>
              </li>
              <li className="flex gap-3">
                <div className="w-5 h-5 rounded-full bg-black text-white flex-shrink-0 flex items-center justify-center text-[10px]">3</div>
                <span>Stop-Loss: Falls ein Titel unter -5% bis -8% fällt, sollte dieser verkauft werden.</span>
              </li>
            </ul>
          </div>
          <div className="p-8 rounded-2xl bg-emerald-900 text-white relative overflow-hidden">
            <div className="relative z-10">
              <h3 className="text-xl font-bold mb-4">Premium Lizenz</h3>
              <p className="text-emerald-100/70 text-sm mb-6">
                In Zukunft wird es möglich sein, eine Premium Lizenz zu erwerben. Erhalten Sie 4x im Monat die aktuellsten Scans direkt in Ihr Postfach.
              </p>
              <div className="flex items-end gap-2 mb-8">
                <span className="text-4xl font-serif font-bold">~80.-</span>
                <span className="text-sm opacity-60 pb-1">CHF / Monat</span>
              </div>
              <button className="w-full py-4 bg-emerald-500 hover:bg-emerald-400 text-white rounded-full font-bold transition-colors">
                Auf Warteliste setzen
              </button>
            </div>
            <Zap className="absolute -bottom-10 -right-10 w-48 h-48 text-white/5 rotate-12" />
          </div>
        </div>
      </div>
    </section>
  );
};

const ReferralSection = () => {
  const [copied, setCopied] = useState(false);

  const handleCopy = () => {
    navigator.clipboard.writeText(PROMO_CODE);
    setCopied(true);
    setTimeout(() => setCopied(false), 2000);
  };

  return (
    <section id="referral" className="py-20 bg-brand-bg">
      <div className="max-w-7xl mx-auto px-4">
        <div className="glass-card p-8 md:p-12 flex flex-col md:flex-row items-center gap-12">
          <div className="flex-1">
            <h2 className="text-4xl font-bold mb-6">Gewinne 50.- CHF durch Empfehlung</h2>
            <p className="text-black/60 mb-8 leading-relaxed">
              Wir freuen uns, wenn Sie uns weiterempfehlen. Wir honorieren Ihren Einsatz mit einer Gutschrift von CHF 50.- für jeden geworbenen Premium-Kunden.
            </p>
            <div className="flex flex-wrap gap-4 items-center">
              <div className="bg-white border border-black/10 px-6 py-3 rounded-full flex items-center gap-4">
                <span className="text-xs font-bold uppercase tracking-widest opacity-40">PromoCode</span>
                <span className="font-mono font-bold text-lg">{PROMO_CODE}</span>
                <button onClick={handleCopy} className="text-black/40 hover:text-black transition-colors">
                  {copied ? <CheckCircle2 className="w-5 h-5 text-emerald-500" /> : <Copy className="w-5 h-5" />}
                </button>
              </div>
              <a 
                href={`mailto:${REFERRAL_EMAIL}?subject=Traders-Swift Tipp&body=Hallo Kollege, habe eben diese Liste erhalten. Das sieht noch vielversprechend aus. PromoCode:${PROMO_CODE} für 10% Rabatt.`}
                className="bg-black text-white px-8 py-3 rounded-full font-medium flex items-center gap-2 hover:bg-black/80 transition-colors"
              >
                <Mail className="w-4 h-4" /> Kollegen einladen
              </a>
            </div>
          </div>
          <div className="w-full md:w-1/3 aspect-square bg-emerald-500 rounded-3xl flex items-center justify-center relative group overflow-hidden">
            <div className="text-white text-center p-8 relative z-10">
              <span className="text-6xl font-serif font-bold mb-2 block">50.-</span>
              <span className="text-sm font-bold uppercase tracking-widest opacity-80">CHF Provision</span>
            </div>
            <div className="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors" />
            <motion.div 
              animate={{ rotate: 360 }}
              transition={{ duration: 20, repeat: Infinity, ease: "linear" }}
              className="absolute inset-0 border-4 border-white/20 border-dashed rounded-full scale-125"
            />
          </div>
        </div>
      </div>
    </section>
  );
};

const Footer = () => (
  <footer className="py-12 bg-white border-t border-black/5">
    <div className="max-w-7xl mx-auto px-4">
      <div className="grid md:grid-cols-4 gap-12 mb-12">
        <div className="col-span-2">
          <div className="flex items-center gap-2 mb-6">
            <div className="w-6 h-6 bg-black rounded flex items-center justify-center">
              <Zap className="text-white w-4 h-4" />
            </div>
            <span className="font-serif text-lg font-bold">Traders-Swift</span>
          </div>
          <p className="text-sm text-black/40 max-w-sm italic">
            "Mit dem Erhalt dieser Daten verpflichtet sich der Kunde, diese Informationen ausschließlich für sich selbst zu nutzen. Die Daten dürfen nicht an Dritte weitergegeben werden."
          </p>
        </div>
        <div>
          <h4 className="font-bold mb-6">Plattform</h4>
          <ul className="space-y-4 text-sm text-black/60">
            <li><a href="#" className="hover:text-black transition-colors">Über uns</a></li>
            <li><a href="#" className="hover:text-black transition-colors">Methodik</a></li>
            <li><a href="#" className="hover:text-black transition-colors">Preise</a></li>
            <li><a href="#" className="hover:text-black transition-colors">Kontakt</a></li>
          </ul>
        </div>
        <div>
          <h4 className="font-bold mb-6">Rechtliches</h4>
          <ul className="space-y-4 text-sm text-black/60">
            <li><a href="#" className="hover:text-black transition-colors">Impressum</a></li>
            <li><a href="#" className="hover:text-black transition-colors">Datenschutz</a></li>
            <li><a href="#" className="hover:text-black transition-colors">Haftungsausschluss</a></li>
          </ul>
        </div>
      </div>
      <div className="pt-12 border-t border-black/5 flex flex-col md:flex-row justify-between items-center gap-6 text-[10px] font-bold uppercase tracking-widest text-black/30">
        <span>© 2026 Traders-Swift.ch - Alle Rechte vorbehalten.</span>
        <div className="flex gap-8">
          <span>Entwickelt von M. Jenny</span>
          <span>US-Markt Fokus</span>
        </div>
      </div>
    </div>
  </footer>
);

export default function App() {
  return (
    <div className="min-h-screen">
      <Header />
      <main>
        <Hero />
        <Features />
        <AlgorithmSection />
        <RecommendationTable />
        <ReferralSection />
      </main>
      <Footer />
    </div>
  );
}
