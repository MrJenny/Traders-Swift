import './index.css';
import * as d3 from 'd3';
import { createIcons, Zap, Activity, ArrowUpRight, ShieldCheck, Target, Clock, BarChart3, TrendingUp, Info, ChevronRight, Copy, Mail, CheckCircle2 } from 'lucide';
import { MOCK_RECOMMENDATIONS, PROMO_CODE, REFERRAL_EMAIL } from './constants';

// Initialize Lucide icons
createIcons({
  icons: {
    Zap,
    Activity,
    ArrowUpRight,
    ShieldCheck,
    Target,
    Clock,
    BarChart3,
    TrendingUp,
    Info,
    ChevronRight,
    Copy,
    Mail,
    CheckCircle2
  }
});

// Render Recommendations Table
const renderRecommendations = () => {
  const listContainer = document.getElementById('recommendations-list');
  if (!listContainer) return;

  MOCK_RECOMMENDATIONS.forEach((stock) => {
    const row = document.createElement('div');
    row.className = 'data-grid-row mx-4 my-2';
    row.innerHTML = `
      <div class="flex flex-col">
        <span class="font-bold font-mono">${stock.symbol}</span>
        <span class="text-[10px] text-black/40 truncate">${stock.name}</span>
      </div>
      <span class="text-right font-mono text-sm">${stock.volume.toLocaleString()}</span>
      <span class="text-right font-mono text-sm">${stock.stdDev}</span>
      <span class="text-right font-mono text-sm">${stock.ramp}</span>
      <span class="text-right font-mono text-sm font-bold text-emerald-600">${stock.mtj}</span>
      <span class="text-right font-mono text-sm">${stock.tra}</span>
    `;
    listContainer.appendChild(row);
  });
};

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
  const area = d3.area<any>()
    .x(d => x(d.name) || 0)
    .y0(height - margin.top - margin.bottom)
    .y1(d => y(d.val))
    .curve(d3.curveMonotoneX);

  svg.append('path')
    .datum(data)
    .attr('fill', 'url(#area-gradient)')
    .attr('d', area);

  // Add line
  const line = d3.line<any>()
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
  const promoCodeDisplay = document.getElementById('promo-code-display');
  const copyBtn = document.getElementById('copy-promo-btn');
  const mailLink = document.getElementById('referral-mail-link') as HTMLAnchorElement;

  if (promoCodeDisplay) promoCodeDisplay.textContent = PROMO_CODE;

  if (copyBtn) {
    copyBtn.addEventListener('click', () => {
      navigator.clipboard.writeText(PROMO_CODE);
      const icon = copyBtn.querySelector('i');
      if (icon) {
        icon.setAttribute('data-lucide', 'check-circle-2');
        icon.classList.add('text-emerald-500');
        createIcons({ icons: { CheckCircle2 } });
        setTimeout(() => {
          icon.setAttribute('data-lucide', 'copy');
          icon.classList.remove('text-emerald-500');
          createIcons({ icons: { Copy } });
        }, 2000);
      }
    });
  }

  if (mailLink) {
    mailLink.href = `mailto:${REFERRAL_EMAIL}?subject=Traders-Swift Tipp&body=Hallo Kollege, habe eben diese Liste erhalten. Das sieht noch vielversprechend aus. PromoCode:${PROMO_CODE} für 10% Rabatt.`;
  }
};

// Run on load
window.addEventListener('DOMContentLoaded', () => {
  renderRecommendations();
  renderChart();
  initReferral();
});
