@extends('layouts.app')
@section('content')

<main class="main-content">
        <h1 class="page-title">Dashboard</h1>

        <!-- Portfolio Section -->
        <section class="portfolio-section">
            <div class="portfolio-header">Real Portfolio</div>
            <div class="portfolio-balance">
                ${{ number_format(auth()->user()->wallet_balance, 2) }}
            </div>

            <div class="portfolio-change">↗ 1.41%</div>
            <div class="portfolio-actions">
            <button class="btn-deposit" onclick="location.href='/deposit'">Deposit</button>
                <button class="btn-withdraw">Withdraw</button>
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
                <div class="price" id="eth-price">$3596.51</div>
                <div class="change negative" id="eth-change">↓ -1.39%</div>
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
                <div class="price" id="btc-price">$118478.70</div>
                <div class="change positive" id="btc-change">↑ 0.17%</div>
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
                <div class="price" id="usdc-price">$1.00</div>
                <div class="change positive" id="usdc-change">↑ 0.00%</div>
            </div>
        </div>
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
                    <div class="crypto-card-change positive" id="your-btc-change">+0.16%</div>
                </div>
                <div class="crypto-card-price" id="your-btc-price">$118478.71</div>
                <div class="crypto-card-details">Amount: 0.01 BTC</div>
                <div class="crypto-card-value" id="your-btc-value">Value: $1184.79</div>
                <div class="crypto-card-footer">
                    <button class="trade-btn">📈 Trade</button>
                    <div class="last-updated" id="btc-updated">Last updated: <span class="update-time"></span></div>
                </div>
            </div>

            <div class="crypto-card" data-coin="ETH" data-amount="0.25">
                <div class="crypto-card-header">
                    <div class="crypto-card-icon eth">ETH</div>
                    <div class="crypto-card-change negative" id="your-eth-change">-1.98%</div>
                </div>
                <div class="crypto-card-price" id="your-eth-price">$3597.06</div>
                <div class="crypto-card-details">Amount: 0.25 ETH</div>
                <div class="crypto-card-value" id="your-eth-value">Value: $899.26</div>
                <div class="crypto-card-footer">
                    <button class="trade-btn">📈 Trade</button>
                    <div class="last-updated" id="eth-updated">Last updated: <span class="update-time"></span></div>
                </div>
            </div>

            <div class="crypto-card" data-coin="BNB" data-amount="1.5">
                <div class="crypto-card-header">
                    <div class="crypto-card-icon bnb">BNB</div>
                    <div class="crypto-card-change negative" id="your-bnb-change">-4.16%</div>
                </div>
                <div class="crypto-card-price" id="your-bnb-price">$760.11</div>
                <div class="crypto-card-details">Amount: 1.5 BNB</div>
                <div class="crypto-card-value" id="your-bnb-value">Value: $1140.16</div>
                <div class="crypto-card-footer">
                    <button class="trade-btn">📈 Trade</button>
                    <div class="last-updated" id="bnb-updated">Last updated: <span class="update-time"></span></div>
                </div>
            </div>

            <div class="crypto-card" data-coin="SOL" data-amount="2.5">
                <div class="crypto-card-header">
                    <div class="crypto-card-icon sol">SOL</div>
                    <div class="crypto-card-change negative" id="your-sol-change">-7.38%</div>
                </div>
                <div class="crypto-card-price" id="your-sol-price">$184.20</div>
                <div class="crypto-card-details">Amount: 2.5 SOL</div>
                <div class="crypto-card-value" id="your-sol-value">Value: $460.50</div>
                <div class="crypto-card-footer">
                    <button class="trade-btn">📈 Trade</button>
                    <div class="last-updated" id="sol-updated">Last updated: <span class="update-time"></span></div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
// Real-time price updates
document.addEventListener('DOMContentLoaded', function() {
    // Initial prices
    const initialPrices = {
        BTC: 118478.70,
        ETH: 3596.51,
        USDC: 1.00,
        BNB: 760.11,
        SOL: 184.20
    };

    // Current prices (will be updated)
    let currentPrices = {...initialPrices};

    // Update all prices every second
    setInterval(updatePrices, 1000);

    function updatePrices() {
        // Get current time for last updated
        const now = new Date();
        const timeString = now.toLocaleTimeString();
        
        // Update each coin
        ['BTC', 'ETH', 'USDC', 'BNB', 'SOL'].forEach(coin => {
            // Generate random price change (-1% to +1% for most coins, 0% for USDC)
            let changePercent;
            if (coin === 'USDC') {
                changePercent = 0;
            } else {
                changePercent = (Math.random() * 2 - 1); // -1% to +1%
            }
            
            // Calculate new price
            const newPrice = currentPrices[coin] * (1 + changePercent / 100);
            currentPrices[coin] = newPrice;
            
            // Format price
            const formattedPrice = new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'USD',
                minimumFractionDigits: coin === 'USDC' ? 2 : 2,
                maximumFractionDigits: coin === 'USDC' ? 2 : 2
            }).format(newPrice);
            
            // Format change percentage
            const changeFormatted = changePercent.toFixed(2);
            const isPositive = changePercent >= 0;
            const changeElement = isPositive ? 
                `↑ +${changeFormatted}%` : `↓ ${changeFormatted}%`;
            
            // Update watchlist
            if (coin === 'BTC' || coin === 'ETH' || coin === 'USDC') {
                document.getElementById(`${coin.toLowerCase()}-price`).textContent = formattedPrice;
                const changeElement = document.getElementById(`${coin.toLowerCase()}-change`);
                changeElement.textContent = isPositive ? `↑ +${changeFormatted}%` : `↓ ${changeFormatted}%`;
                changeElement.className = isPositive ? 'change positive' : 'change negative';
            }
            
            // Update "Your Crypto" section
            if (coin === 'BTC' || coin === 'ETH' || coin === 'BNB' || coin === 'SOL') {
                const amount = parseFloat(document.querySelector(`.crypto-card[data-coin="${coin}"]`).getAttribute('data-amount'));
                const value = newPrice * amount;
                
                document.getElementById(`your-${coin.toLowerCase()}-price`).textContent = formattedPrice;
                const changeElement = document.getElementById(`your-${coin.toLowerCase()}-change`);
                changeElement.textContent = isPositive ? `+${changeFormatted}%` : `${changeFormatted}%`;
                changeElement.className = `crypto-card-change ${isPositive ? 'positive' : 'negative'}`;
                
                document.getElementById(`your-${coin.toLowerCase()}-value`).textContent = 
                    `Value: ${new Intl.NumberFormat('en-US', {
                        style: 'currency',
                        currency: 'USD',
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }).format(value)}`;
                
                // Update timestamp
                document.querySelectorAll(`#${coin.toLowerCase()}-updated .update-time`).forEach(el => {
                    el.textContent = timeString;
                });
            }
        });
    }
    
    // Initial update
    updatePrices();
});
</script>
    </main>
    @endsection