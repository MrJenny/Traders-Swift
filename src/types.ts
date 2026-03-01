export interface StockRecommendation {
  symbol: string;
  volume: number;
  stdDev: number;
  ramp: number;
  mtj: number;
  tra: number;
  name: string;
  industry: string;
}

export interface NavItem {
  label: string;
  href: string;
}
