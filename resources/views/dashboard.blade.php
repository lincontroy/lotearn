@extends('layouts.app')
@section('content')

<main class="main-content">
    <h1 class="page-title">Dashboard</h1>

    <!-- Portfolio Section -->
    <section class="portfolio-section">
        <div class="portfolio-header">Real Portfolio</div>
        <div class="portfolio-balance" id="portfolio-balance">
            ${{ number_format(auth()->user()->wallet_balance, 2) }}
        </div>
        <div class="portfolio-change" id="portfolio-change">↗ 0.00%</div>
        <div class="portfolio-actions">
            <button class="btn-deposit" onclick="location.href='/deposit'">Deposit</button>
            <button class="btn-withdraw" onclick="location.href='/withdraw'">Withdraw</button>
        </div>
    </section>

    <!-- Dashboard Grid -->
    <div class="dashboard-grid">
        <!-- Watchlist Section -->
        <section class="section">
            <div class="section-header">
                <h2 class="section-title">Watchlist</h2>
                <a href="#" class="see-all">See All →</a>
            </div>
            
            <div class="watchlist-item" data-coin="ETH">
                <div class="crypto-info">
                    <div class="crypto-icon eth">ETH</div>
                    <div class="crypto-details">
                        <h4>ETH</h4>
                        <p>Ethereum</p>
                    </div>
                </div>
                <div class="crypto-price">
                    <div class="price" id="eth-price">Loading...</div>
                    <div class="change" id="eth-change">-</div>
                </div>
            </div>

            <div class="watchlist-item" data-coin="BTC">
                <div class="crypto-info">
                    <div class="crypto-icon btc">BTC</div>
                    <div class="crypto-details">
                        <h4>BTC</h4>
                        <p>Bitcoin</p>
                    </div>
                </div>
                <div class="crypto-price">
                    <div class="price" id="btc-price">Loading...</div>
                    <div class="change" id="btc-change">-</div>
                </div>
            </div>

            <div class="watchlist-item" data-coin="USDC">
                <div class="crypto-info">
                    <div class="crypto-icon usdc">USD</div>
                    <div class="crypto-details">
                        <h4>USDC</h4>
                        <p>USDC</p>
                    </div>
                </div>
                <div class="crypto-price">
                    <div class="price" id="usdc-price">Loading...</div>
                    <div class="change" id="usdc-change">-</div>
                </div>
            </div>
            
            <div class="api-status">
                <span id="api-status">Using: CoinGecko</span>
            </div>
            <button class="refresh-btn" id="refresh-watchlist">Refresh Prices</button>
        </section>

        <!-- Your Crypto Section -->
        <section class="section">
            <div class="section-header">
                <h2 class="section-title">Your Crypto</h2>
            </div>
            
            <div class="crypto-grid">
                <div class="crypto-card" data-coin="BTC" data-amount="0.01">
                    <div class="crypto-card-header">
                        <div class="crypto-card-icon btc">BTC</div>
                        <div class="crypto-card-change" id="your-btc-change">Loading...</div>
                    </div>
                    <div class="crypto-card-price" id="your-btc-price">-</div>
                    <div class="crypto-card-details">Amount: 0.01 BTC</div>
                    <div class="crypto-card-value" id="your-btc-value">Value: -</div>
                    <div class="crypto-card-footer">
                        <button class="trade-btn">📈 Trade</button>
                        <div class="last-updated" id="btc-updated">Last updated: <span class="update-time">-</span></div>
                    </div>
                </div>

                <div class="crypto-card" data-coin="ETH" data-amount="0.25">
                    <div class="crypto-card-header">
                        <div class="crypto-card-icon eth">ETH</div>
                        <div class="crypto-card-change" id="your-eth-change">Loading...</div>
                    </div>
                    <div class="crypto-card-price" id="your-eth-price">-</div>
                    <div class="crypto-card-details">Amount: 0.25 ETH</div>
                    <div class="crypto-card-value" id="your-eth-value">Value: -</div>
                    <div class="crypto-card-footer">
                        <button class="trade-btn">📈 Trade</button>
                        <div class="last-updated" id="eth-updated">Last updated: <span class="update-time">-</span></div>
                    </div>
                </div>

                <div class="crypto-card" data-coin="BNB" data-amount="1.5">
                    <div class="crypto-card-header">
                        <div class="crypto-card-icon bnb">BNB</div>
                        <div class="crypto-card-change" id="your-bnb-change">Loading...</div>
                    </div>
                    <div class="crypto-card-price" id="your-bnb-price">-</div>
                    <div class="crypto-card-details">Amount: 1.5 BNB</div>
                    <div class="crypto-card-value" id="your-bnb-value">Value: -</div>
                    <div class="crypto-card-footer">
                        <button class="trade-btn">📈 Trade</button>
                        <div class="last-updated" id="bnb-updated">Last updated: <span class="update-time">-</span></div>
                    </div>
                </div>

                <div class="crypto-card" data-coin="SOL" data-amount="2.5">
                    <div class="crypto-card-header">
                        <div class="crypto-card-icon sol">SOL</div>
                        <div class="crypto-card-change" id="your-sol-change">Loading...</div>
                    </div>
                    <div class="crypto-card-price" id="your-sol-price">-</div>
                    <div class="crypto-card-details">Amount: 2.5 SOL</div>
                    <div class="crypto-card-value" id="your-sol-value">Value: -</div>
                    <div class="crypto-card-footer">
                        <button class="trade-btn">📈 Trade</button>
                        <div class="last-updated" id="sol-updated">Last updated: <span class="update-time">-</span></div>
                    </div>
                </div>
            </div>
            
            <button class="refresh-btn" id="refresh-crypto">Refresh All Prices</button>
        </section>
    </div>
</main>

<style>
    .main-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .page-title {
        font-size: 28px;
        margin-bottom: 30px;
        font-weight: 600;
        color: #1f2937;
    }

    /* Portfolio Section */
    .portfolio-section {
        background: linear-gradient(135deg, #1e293b, #334155);
        border-radius: 16px;
        padding: 24px;
        margin-bottom: 30px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        color: white;
    }

    .portfolio-header {
        font-size: 18px;
        color: #94a3b8;
        margin-bottom: 8px;
    }

    .portfolio-balance {
        font-size: 42px;
        font-weight: 700;
        margin-bottom: 12px;
    }

    .portfolio-change {
        font-size: 18px;
        color: #10b981;
        margin-bottom: 20px;
    }

    .portfolio-change.negative {
        color: #ef4444;
    }

    .portfolio-actions {
        display: flex;
        gap: 12px;
    }

    .btn-deposit, .btn-withdraw {
        padding: 12px 24px;
        border-radius: 8px;
        border: none;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-deposit {
        background-color: #3b82f6;
        color: white;
    }

    .btn-withdraw {
        background-color: #374151;
        color: white;
    }

    .btn-deposit:hover {
        background-color: #2563eb;
    }

    .btn-withdraw:hover {
        background-color: #4b5563;
    }

    /* Dashboard Grid */
    .dashboard-grid {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 24px;
    }

    @media (max-width: 968px) {
        .dashboard-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Section Styles */
    .section {
        background-color: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        border: 1px solid #e5e7eb;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .section-title {
        font-size: 20px;
        font-weight: 600;
        color: #1f2937;
    }

    .see-all {
        color: #3b82f6;
        text-decoration: none;
        font-weight: 500;
    }

    /* Watchlist */
    .watchlist-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 0;
        border-bottom: 1px solid #e5e7eb;
    }

    .watchlist-item:last-child {
        border-bottom: none;
    }

    .crypto-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .crypto-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 14px;
        color: white;
    }

    .btc {
        background-color: #f59e0b;
    }

    .eth {
        background-color: #8b5cf6;
    }

    .usdc {
        background-color: #2775ca;
    }

    .bnb {
        background-color: #f0b90b;
        color: #000;
    }

    .sol {
        background: linear-gradient(135deg, #9945FF, #14F195);
    }

    .crypto-details h4 {
        font-size: 16px;
        font-weight: 600;
        color: #1f2937;
    }

    .crypto-details p {
        font-size: 14px;
        color: #6b7280;
    }

    .crypto-price {
        text-align: right;
    }

    .price {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 4px;
        color: #1f2937;
    }

    .change {
        font-size: 14px;
    }

    .positive {
        color: #10b981;
    }

    .negative {
        color: #ef4444;
    }

    /* Crypto Grid */
    .crypto-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
    }

    .crypto-card {
        background-color: white;
        border-radius: 12px;
        padding: 20px;
        transition: transform 0.2s, box-shadow 0.2s;
        border: 1px solid #e5e7eb;
    }

    .crypto-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }

    .crypto-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }

    .crypto-card-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 14px;
        color: white;
    }

    .crypto-card-change {
        font-size: 14px;
        font-weight: 600;
        padding: 4px 8px;
        border-radius: 6px;
    }

    .crypto-card-price {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 8px;
        color: #1f2937;
    }

    .crypto-card-details {
        font-size: 14px;
        color: #6b7280;
        margin-bottom: 4px;
    }

    .crypto-card-value {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 16px;
        color: #1f2937;
    }

    .crypto-card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .trade-btn {
        background-color: #3b82f6;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 6px;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .trade-btn:hover {
        background-color: #2563eb;
    }

    .last-updated {
        font-size: 12px;
        color: #6b7280;
    }

    .update-time {
        color: #9ca3af;
    }

    .loading {
        opacity: 0.7;
        pointer-events: none;
    }

    .refresh-btn {
        background-color: #374151;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 6px;
        font-weight: 500;
        cursor: pointer;
        margin-top: 10px;
        transition: background-color 0.2s;
        width: 100%;
    }

    .refresh-btn:hover {
        background-color: #4b5563;
    }

    .api-status {
        font-size: 12px;
        color: #6b7280;
        text-align: center;
        margin: 10px 0;
        font-style: italic;
    }

    .api-fallback {
        background-color: #fef3c7;
        border: 1px solid #f59e0b;
        border-radius: 6px;
        padding: 8px;
        margin: 10px 0;
        font-size: 12px;
        color: #92400e;
        text-align: center;
    }
</style>

<script>
    // Multiple API endpoints for better reliability
    const API_ENDPOINTS = [
        {
            name: 'CoinGecko',
            url: 'https://api.coingecko.com/api/v3/simple/price?ids=bitcoin,ethereum,binancecoin,solana,usd-coin&vs_currencies=usd&include_24hr_change=true'
        },
        {
            name: 'Binance',
            url: 'https://api.binance.com/api/v3/ticker/24hr'
        },
        {
            name: 'CoinCap',
            url: 'https://api.coincap.io/v2/assets?ids=bitcoin,ethereum,binance-coin,solana,usd-coin'
        }
    ];

    const COIN_SYMBOLS = {
        'bitcoin': 'BTC',
        'ethereum': 'ETH', 
        'binancecoin': 'BNB',
        'binance-coin': 'BNB',
        'solana': 'SOL',
        'usd-coin': 'USDC'
    };

    const BINANCE_SYMBOLS = {
        'BTC': 'BTCUSDT',
        'ETH': 'ETHUSDT', 
        'BNB': 'BNBUSDT',
        'SOL': 'SOLUSDT',
        'USDC': 'USDCUSDT'
    };

    // Store current prices and API status
    let currentPrices = {};
    let previousPrices = {};
    let currentApi = 'CoinGecko';
    let apiFallbackUsed = false;

    // DOM elements
    const refreshWatchlistBtn = document.getElementById('refresh-watchlist');
    const refreshCryptoBtn = document.getElementById('refresh-crypto');
    const apiStatusElement = document.getElementById('api-status');

    // Format currency
    function formatCurrency(value, decimals = 2) {
        return new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD',
            minimumFractionDigits: decimals,
            maximumFractionDigits: decimals
        }).format(value);
    }

    // Format percentage
    function formatPercentage(value) {
        if (value === null || value === undefined) return '-';
        return `${value >= 0 ? '+' : ''}${value.toFixed(2)}%`;
    }

    // Calculate portfolio value and change
    function updatePortfolio() {
        const holdings = {
            'BTC': 0.01,
            'ETH': 0.25,
            'BNB': 1.5,
            'SOL': 2.5
        };
        
        let totalValue = 0;
        let totalChange = 0;
        
        Object.keys(holdings).forEach(coin => {
            if (currentPrices[coin] && currentPrices[coin].price) {
                totalValue += currentPrices[coin].price * holdings[coin];
                
                // Calculate weighted change
                if (previousPrices[coin]) {
                    const change = ((currentPrices[coin].price - previousPrices[coin]) / previousPrices[coin]) * 100;
                    totalChange += change * (currentPrices[coin].price * holdings[coin]);
                }
            }
        });
        
        // Update portfolio display
        // document.getElementById('portfolio-balance').textContent = formatCurrency(totalValue);
        
        if (totalValue > 0) {
            const portfolioChangePercent = (totalChange / totalValue).toFixed(2);
            const portfolioChangeElement = document.getElementById('portfolio-change');
            portfolioChangeElement.textContent = `${parseFloat(portfolioChangePercent) >= 0 ? '↗' : '↘'} ${formatPercentage(parseFloat(portfolioChangePercent))}`;
            portfolioChangeElement.className = `portfolio-change ${parseFloat(portfolioChangePercent) >= 0 ? 'positive' : 'negative'}`;
        }
    }

    // Update watchlist prices
    function updateWatchlistPrices() {
        Object.keys(currentPrices).forEach(symbol => {
            const coinData = currentPrices[symbol];
            
            if (document.getElementById(`${symbol.toLowerCase()}-price`)) {
                document.getElementById(`${symbol.toLowerCase()}-price`).textContent = formatCurrency(coinData.price);
                
                const changeElement = document.getElementById(`${symbol.toLowerCase()}-change`);
                if (coinData.change !== null) {
                    changeElement.textContent = formatPercentage(coinData.change);
                    changeElement.className = `change ${coinData.change >= 0 ? 'positive' : 'negative'}`;
                } else {
                    changeElement.textContent = '-';
                    changeElement.className = 'change';
                }
            }
        });
    }

    // Update crypto card prices
    function updateCryptoCards() {
        Object.keys(currentPrices).forEach(symbol => {
            if (symbol !== 'USDC' && document.getElementById(`your-${symbol.toLowerCase()}-price`)) {
                const coinData = currentPrices[symbol];
                const card = document.querySelector(`.crypto-card[data-coin="${symbol}"]`);
                const amount = parseFloat(card.getAttribute('data-amount'));
                const value = coinData.price * amount;
                
                document.getElementById(`your-${symbol.toLowerCase()}-price`).textContent = formatCurrency(coinData.price);
                
                const changeElement = document.getElementById(`your-${symbol.toLowerCase()}-change`);
                if (coinData.change !== null) {
                    changeElement.textContent = formatPercentage(coinData.change);
                    changeElement.className = `crypto-card-change ${coinData.change >= 0 ? 'positive' : 'negative'}`;
                } else {
                    changeElement.textContent = '-';
                    changeElement.className = 'crypto-card-change';
                }
                
                document.getElementById(`your-${symbol.toLowerCase()}-value`).textContent = `Value: ${formatCurrency(value)}`;
                
                // Update timestamp
                const now = new Date();
                document.querySelectorAll(`#${symbol.toLowerCase()}-updated .update-time`).forEach(el => {
                    el.textContent = now.toLocaleTimeString();
                });
            }
        });
        
        // Update USDC separately (stablecoin)
        if (document.getElementById('usdc-price')) {
            document.getElementById('usdc-price').textContent = formatCurrency(1);
            document.getElementById('usdc-change').textContent = formatPercentage(0);
            document.getElementById('usdc-change').className = 'change positive';
        }
    }

    // Parse CoinGecko API response
    function parseCoinGeckoData(data) {
        const prices = {};
        
        Object.keys(data).forEach(coinId => {
            const symbol = COIN_SYMBOLS[coinId];
            if (symbol) {
                prices[symbol] = {
                    price: data[coinId].usd,
                    change: data[coinId].usd_24h_change
                };
            }
        });
        
        return prices;
    }

    // Parse Binance API response
    function parseBinanceData(data) {
        const prices = {};
        
        data.forEach(ticker => {
            Object.keys(BINANCE_SYMBOLS).forEach(symbol => {
                if (ticker.symbol === BINANCE_SYMBOLS[symbol]) {
                    prices[symbol] = {
                        price: parseFloat(ticker.lastPrice),
                        change: parseFloat(ticker.priceChangePercent)
                    };
                }
            });
        });
        
        return prices;
    }

    // Parse CoinCap API response
    function parseCoinCapData(data) {
        const prices = {};
        
        data.data.forEach(asset => {
            const symbol = COIN_SYMBOLS[asset.id];
            if (symbol) {
                prices[symbol] = {
                    price: parseFloat(asset.priceUsd),
                    change: parseFloat(asset.changePercent24Hr)
                };
            }
        });
        
        return prices;
    }

    // Fallback to realistic mock data if APIs fail
    function getMockPrices() {
        const mockPrices = {
            'BTC': { price: 67500 + (Math.random() * 2000 - 1000), change: -0.5 + (Math.random() * 2 - 1) },
            'ETH': { price: 3500 + (Math.random() * 200 - 100), change: -0.3 + (Math.random() * 2 - 1) },
            'BNB': { price: 580 + (Math.random() * 20 - 10), change: 0.2 + (Math.random() * 2 - 1) },
            'SOL': { price: 170 + (Math.random() * 10 - 5), change: 1.2 + (Math.random() * 2 - 1) },
            'USDC': { price: 1.00, change: 0 }
        };
        
        return mockPrices;
    }

    // Fetch prices with fallback strategy
    async function fetchPrices() {
        let success = false;
        let apiIndex = 0;
        
        // Show loading state
        document.querySelectorAll('.price, .crypto-card-price').forEach(el => {
            el.classList.add('loading');
        });
        
        // Try each API endpoint until one works
        while (!success && apiIndex < API_ENDPOINTS.length) {
            const api = API_ENDPOINTS[apiIndex];
            
            try {
                apiStatusElement.textContent = `Fetching: ${api.name}...`;
                
                const response = await fetch(api.url);
                
                if (!response.ok) {
                    throw new Error(`HTTP ${response.status}`);
                }
                
                const data = await response.json();
                let newPrices = {};
                
                // Parse data based on API
                if (api.name === 'CoinGecko') {
                    newPrices = parseCoinGeckoData(data);
                } else if (api.name === 'Binance') {
                    newPrices = parseBinanceData(data);
                } else if (api.name === 'CoinCap') {
                    newPrices = parseCoinCapData(data);
                }
                
                // Store previous prices for change calculation
                Object.keys(newPrices).forEach(symbol => {
                    previousPrices[symbol] = currentPrices[symbol] ? currentPrices[symbol].price : newPrices[symbol].price;
                });
                
                currentPrices = newPrices;
                currentApi = api.name;
                success = true;
                apiFallbackUsed = false;
                
                apiStatusElement.textContent = `Using: ${api.name}`;
                
            } catch (error) {
                console.warn(`${api.name} failed:`, error);
                apiIndex++;
            }
        }
        
        // If all APIs fail, use mock data
        if (!success) {
            currentPrices = getMockPrices();
            currentApi = 'Mock Data';
            apiFallbackUsed = true;
            apiStatusElement.textContent = 'Using: Mock Data (APIs unavailable)';
            
            // Show fallback warning
            if (!document.querySelector('.api-fallback')) {
                const fallbackWarning = document.createElement('div');
                fallbackWarning.className = 'api-fallback';
                fallbackWarning.textContent = 'Using simulated data. Real-time prices temporarily unavailable.';
                document.querySelector('.section').insertBefore(fallbackWarning, refreshWatchlistBtn);
            }
        }
        
        // Update UI with new prices
        updateWatchlistPrices();
        updateCryptoCards();
        updatePortfolio();
        
        // Remove loading state
        document.querySelectorAll('.price, .crypto-card-price').forEach(el => {
            el.classList.remove('loading');
        });
    }

    // Event listeners
    document.addEventListener('DOMContentLoaded', function() {
        // Initial price fetch
        fetchPrices();
        
        // Set up refresh buttons
        refreshWatchlistBtn.addEventListener('click', fetchPrices);
        refreshCryptoBtn.addEventListener('click', fetchPrices);
        
        // Auto-refresh every 20 seconds (less frequent to avoid rate limits)
        setInterval(fetchPrices, 20000);
    });
</script>

@endsection