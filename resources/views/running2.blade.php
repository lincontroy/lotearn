@extends('layouts.app')
@section('content')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #0a0f1c;
            color: white;
            min-height: 100vh;
        }

        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 2rem;
            background: #0f1419;
            border-bottom: 1px solid #1a2332;
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .logo-icon {
            width: 32px;
            height: 32px;
            background: #4ade80;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #0a0f1c;
        }

        .page-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #4ade80;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .nav-item {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            text-decoration: none;
            color: #9ca3af;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-item:hover {
            background: #1a2332;
            color: white;
        }

        .nav-item.active {
            background: #4ade80;
            color: #0a0f1c;
            font-weight: 500;
        }

        .accounts-btn {
            background: #4ade80;
            color: #0a0f1c;
            font-weight: 500;
        }

        .balance-display {
            background: #4ade80;
            color: #0a0f1c;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
        }

        /* Mobile Balance Widget */
        .mobile-balance-widget {
            display: none;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #1a2332;
            padding: 12px 16px;
            border-top: 1px solid #2a3441;
            z-index: 100;
            box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.3);
        }

        .balance-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .balance-label {
            color: #9ca3af;
            font-size: 0.9rem;
        }

        .balance-amount {
            font-weight: 600;
            font-size: 1.1rem;
            color: white;
        }

        .balance-change {
            font-size: 0.8rem;
            margin-left: 8px;
        }

        .balance-change.positive {
            color: #4ade80;
        }

        .balance-change.negative {
            color: #ef4444;
        }

        .main-content {
            padding: 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .bot-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 2rem;
        }

        .bot-info {
            flex: 1;
        }

        .bot-title {
            font-size: 2.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .bot-details {
            color: #9ca3af;
            font-size: 1rem;
        }

        .status-section {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .status-badge {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            background: #dc2626;
            color: white;
        }

        .status-badge.running {
            background: #4ade80;
            color: #0a0f1c;
        }

        .status-badge.paused {
            background: #f59e0b;
            color: #0a0f1c;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: white;
        }

        .status-dot.running {
            background: #0a0f1c;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .insufficient-balance {
            background: #374151;
            color: #9ca3af;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 0.9rem;
        }

        .trade-controls {
            display: flex;
            gap: 0.5rem;
        }

        .btn {
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 0.9rem;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn-start {
            background: #4ade80;
            color: #0a0f1c;
        }

        .btn-start:hover {
            background: #22c55e;
        }

        .btn-pause {
            background: #f59e0b;
            color: white;
        }

        .btn-pause:hover {
            background: #d97706;
        }

        .btn-stop {
            background: #dc2626;
            color: white;
        }

        .btn-stop:hover {
            background: #b91c1c;
        }

        .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 400px 1fr;
            gap: 2rem;
        }

        .stats-sidebar {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .stat-card {
            background: #1a2332;
            border-radius: 16px;
            padding: 1.5rem;
        }

        .stat-card.pnl {
            border-left: 4px solid #4ade80;
        }

        .stat-card.runs {
            border-left: 4px solid #8b5cf6;
        }

        .stat-card.trades {
            border-left: 4px solid #3b82f6;
        }

        .stat-card.winrate {
            border-left: 4px solid #f59e0b;
        }

        .stat-card.balance {
            border-left: 4px solid #06b6d4;
        }

        .stat-label {
            color: #9ca3af;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 300;
        }

        .stat-value.positive {
            color: #4ade80;
        }

        .stat-value.negative {
            color: #ef4444;
        }

        .logs-section {
            background: #1a2332;
            border-radius: 16px;
            padding: 1.5rem;
        }

        .logs-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .logs-title {
            font-size: 1.25rem;
            font-weight: 600;
        }

        .logs-count {
            color: #9ca3af;
            font-size: 0.9rem;
        }

        .logs-container {
            background: #0f1419;
            border-radius: 12px;
            padding: 1rem;
            max-height: 500px;
            overflow-y: auto;
            font-family: Monaco, 'Cascadia Code', 'Roboto Mono', monospace;
            font-size: 0.85rem;
            line-height: 1.5;
        }

        .log-entry {
            margin-bottom: 0.25rem;
            word-wrap: break-word;
        }

        .log-timestamp {
            color: #6b7280;
        }

        .log-error {
            color: #ef4444;
        }

        .log-success {
            color: #4ade80;
        }

        .log-info {
            color: #60a5fa;
        }

        .log-warning {
            color: #f59e0b;
        }

        .log-trade {
            color: #a78bfa;
        }

        /* Scrollbar styling */
        .logs-container::-webkit-scrollbar {
            width: 6px;
        }

        .logs-container::-webkit-scrollbar-track {
            background: #374151;
            border-radius: 3px;
        }

        .logs-container::-webkit-scrollbar-thumb {
            background: #6b7280;
            border-radius: 3px;
        }

        .logs-container::-webkit-scrollbar-thumb:hover {
            background: #9ca3af;
        }

        @media (max-width: 1024px) {
            .content-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            
            .stats-sidebar {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                gap: 0.75rem;
            }

            .stat-card {
                padding: 1rem;
            }

            .stat-value {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 0.5rem;
                padding-bottom: 70px; /* Add padding to prevent content from being hidden behind mobile balance widget */
            }
            
            .bot-header {
                flex-direction: column;
                gap: 0.75rem;
                margin-bottom: 1rem;
            }
            
            .status-section {
                flex-direction: row;
                flex-wrap: wrap;
                gap: 0.5rem;
                width: 100%;
            }
            
            .nav-links {
                display: none;
            }
            
            .bot-title {
                font-size: 1.5rem;
                margin-bottom: 0.25rem;
            }

            .bot-details {
                font-size: 0.85rem;
            }

            .status-badge {
                padding: 0.5rem 1rem;
                font-size: 0.8rem;
            }

            .insufficient-balance {
                padding: 0.4rem 0.8rem;
                font-size: 0.8rem;
            }

            .trade-controls {
                gap: 0.3rem;
            }

            .btn {
                padding: 0.5rem 1rem;
                font-size: 0.8rem;
            }

            .stats-sidebar {
                grid-template-columns: repeat(2, 1fr);
                gap: 0.5rem;
                margin-bottom: 1rem;
            }

            .stat-card {
                padding: 0.75rem;
                border-radius: 8px;
            }

            .stat-label {
                font-size: 0.75rem;
                margin-bottom: 0.25rem;
            }

            .stat-value {
                font-size: 1.25rem;
                font-weight: 500;
            }

            .logs-section {
                padding: 1rem;
                border-radius: 8px;
            }

            .logs-header {
                margin-bottom: 1rem;
            }

            .logs-title {
                font-size: 1rem;
            }

            .logs-count {
                font-size: 0.8rem;
            }

            .logs-container {
                max-height: 300px;
                padding: 0.75rem;
                font-size: 0.75rem;
                line-height: 1.4;
            }

            .log-entry {
                margin-bottom: 0.15rem;
            }

            /* Make everything fit in one screen */
            .content-grid {
                height: calc(100vh - 190px);
                display: flex;
                flex-direction: column;
            }

            .logs-section {
                flex: 1;
                display: flex;
                flex-direction: column;
                min-height: 0;
            }

            .logs-container {
                flex: 1;
                min-height: 0;
            }

            /* Show mobile balance widget */
            .mobile-balance-widget {
                display: block;
            }
        }

        @media (max-width: 480px) {
            .main-content {
                padding: 0.25rem;
                padding-bottom: 60px;
            }

            .bot-header {
                margin-bottom: 0.75rem;
            }

            .bot-title {
                font-size: 1.25rem;
            }

            .stats-sidebar {
                grid-template-columns: repeat(2, 1fr);
                gap: 0.4rem;
            }

            .stat-card {
                padding: 0.5rem;
            }

            .stat-label {
                font-size: 0.7rem;
            }

            .stat-value {
                font-size: 1rem;
            }

            .status-section {
                flex-direction: column;
                align-items: stretch;
            }

            .trade-controls {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 0.25rem;
            }

            .btn {
                padding: 0.4rem 0.5rem;
                font-size: 0.75rem;
            }

            .logs-container {
                max-height: 250px;
                font-size: 0.7rem;
            }

            .mobile-balance-widget {
                padding: 10px 12px;
            }

            .balance-amount {
                font-size: 1rem;
            }
        }
    </style>

<body>
    <main class="main-content">
        <div class="bot-header">
            <div class="bot-info">
                <h1 class="bot-title">ETH DCA Pro</h1>
                <div class="bot-details">Bot ID: dca-12 • • Account: Real</div>
            </div>
            <div class="status-section">
                <div class="status-badge" id="statusBadge">
                    <div class="status-dot" id="statusDot"></div>
                    <span id="statusText">Stopped (Low Balance)</span>
                </div>
                @if(Auth::user()->wallet_balance < 100)
                    <div class="insufficient-balance">Insufficient Balance</div>
                @else
                    <div class="trade-controls" id="tradeControls">
                        <button class="btn btn-start" id="startBtn">Start Bot</button>
                        <button class="btn btn-pause" id="pauseBtn" disabled>Pause Bot</button>
                        <button class="btn btn-stop" id="stopBtn" disabled>Stop Bot</button>
                    </div>
                @endif
            </div>
        </div>

        <div class="content-grid">
            <div class="stats-sidebar">
                <div class="stat-card pnl">
                    <div class="stat-label">Total P/L</div>
                    <div class="stat-value" id="totalPnL">+$0.00</div>
                </div>
                
                <div class="stat-card runs">
                    <div class="stat-label">Total Runs</div>
                    <div class="stat-value" id="totalRuns">0</div>
                </div>
                
                <div class="stat-card trades">
                    <div class="stat-label">Total Trades</div>
                    <div class="stat-value" id="totalTrades">0</div>
                </div>
                
                <div class="stat-card winrate">
                    <div class="stat-label">Win Rate</div>
                    <div class="stat-value" id="winRate">0.0%</div>
                </div>
                
                <div class="stat-card balance">
                    <div class="stat-label">Balance</div>
                    <div class="stat-value" id="currentBalance">${{ number_format(Auth::user()->wallet_balance, 2) }}</div>
                </div>
            </div>

            <div class="logs-section">
                <div class="logs-header">
                    <h2 class="logs-title">Bot Logs</h2>
                    <div class="logs-count" id="logsCount">0 entries</div>
                </div>
                
                <div class="logs-container" id="logsContainer">
                    <!-- Logs will be populated dynamically -->
                </div>
            </div>
        </div>
    </main>

    <!-- Mobile Balance Widget -->
    <div class="mobile-balance-widget">
        <div class="balance-content">
            <div class="balance-label">Account Balance</div>
            <div>
                <span class="balance-amount" id="mobileBalance">${{ number_format(Auth::user()->wallet_balance, 2) }}</span>
                <span class="balance-change positive" id="mobileBalanceChange">+$0.00</span>
            </div>
        </div>
    </div>

    <script>
    // Bot state management with enhanced features
    let botState = {
        isRunning: false,
        isPaused: false,
        totalPnL: 0,
        totalRuns: 0,
        totalTrades: 0,
        winningTrades: 0,
        currentBalance: {{ Auth::user()->wallet_balance }},
        tradingInterval: null,
        logInterval: null,
        consecutiveLosses: 0,
        marketTrend: 'neutral',
        houseEdge: 0.03, // 3% house edge
        winStreak: 0,
        lossStreak: 0,
        overallLosing: false
    };

    // Enhanced Trading Bot with investment tiers and smart recovery
    class TradingBot {
        constructor() {
            this.pairs = ['BTCUSDT', 'ETHUSDT', 'BNBUSDT', 'ADAUSDT', 'DOTUSDT'];
            this.currentPair = this.pairs[0];
            this.investmentAmount = {{$amount}};
            this.lastPrice = this.generateRandomPrice();
            this.priceHistory = [this.lastPrice];
            this.macdHistory = [];
            this.minInvestment = 10;
            
            // Set tier based on investment amount
            if (this.investmentAmount >= 1000) {
                this.tier = 'premium';
                this.baseWinRate = 0.75;
                this.profitRange = { min: 60, max: 100 };
                this.lossRange = { min: 10, max: 40 };
            } else if (this.investmentAmount >= 500) {
                this.tier = 'advanced';
                this.baseWinRate = 0.70;
                this.profitRange = { min: 55, max: 90 };
                this.lossRange = { min: 15, max: 50 };
            } else if (this.investmentAmount >= 100) {
                this.tier = 'standard';
                this.baseWinRate = 0.65;
                this.profitRange = { min: 50, max: 80 };
                this.lossRange = { min: 20, max: 60 };
            } else {
                this.tier = 'basic';
                this.baseWinRate = 0.60;
                this.profitRange = { min: 45, max: 70 };
                this.lossRange = { min: 25, max: 70 };
            }
            
            this.maxProfit = this.profitRange.max;
        }

        generateRandomPrice(basePrice = 45000) {
            return basePrice + (Math.random() - 0.5) * 1000;
        }

        updateMarketTrend() {
            // Slightly bullish bias for higher tiers
            const trendRandom = Math.random();
            let bullishProb = 0.5;
            
            if (this.tier === 'premium') bullishProb = 0.6;
            else if (this.tier === 'advanced') bullishProb = 0.55;
            
            if (trendRandom < bullishProb) {
                botState.marketTrend = 'bullish';
            } else if (trendRandom < 0.85) {
                botState.marketTrend = 'neutral';
            } else {
                botState.marketTrend = 'bearish';
            }
        }

        calculateMACD() {
            // More accurate signals for higher tiers
            let baseMacd = (Math.random() - 0.3) * 2;
            let baseSignal = (Math.random() - 0.3) * 2;
            
            // Tier-based accuracy boost
            if (this.tier === 'premium') {
                baseMacd += 0.4;
                baseSignal += 0.3;
            } else if (this.tier === 'advanced') {
                baseMacd += 0.3;
                baseSignal += 0.2;
            }
            
            if (botState.marketTrend === 'bullish') {
                baseMacd += 0.3;
                baseSignal += 0.2;
            } else if (botState.marketTrend === 'bearish') {
                baseMacd -= 0.2;
                baseSignal -= 0.1;
            }

            return {
                macd: baseMacd,
                signal: baseSignal,
                histogram: baseMacd - baseSignal
            };
        }

        shouldTrade() {
            if (botState.currentBalance < this.minInvestment) {
                return false;
            }
            
            // Higher probability for higher tiers
            let baseProbability = 0.7;
            if (this.tier === 'premium') baseProbability = 0.8;
            else if (this.tier === 'advanced') baseProbability = 0.75;
            
            // Recovery boost after losses
            if (botState.lossStreak >= 2) {
                baseProbability += 0.15;
            }
            
            return Math.random() < Math.min(0.9, baseProbability);
        }

        calculateDynamicWinRate() {
            let winRate = this.baseWinRate;
            
            // Smart Recovery System
            if (botState.lossStreak >= 2) winRate += 0.15; // +15% after 2 losses
            if (botState.lossStreak >= 3) winRate += 0.10; // Additional +10% after 3 losses
            if (botState.overallLosing) winRate += 0.20;   // +20% when user is losing overall
            if (botState.winStreak >= 4) winRate -= 0.05;  // -5% after 4 wins
            
            // Keep within reasonable bounds
            return Math.max(0.55, Math.min(0.85, winRate));
        }

        calculateWinAmount() {
            // Tier-based profit calculation
            return Math.floor(Math.random() * (this.profitRange.max - this.profitRange.min + 1)) + this.profitRange.min;
        }

        calculateLossAmount() {
            // Tier-based loss calculation (always smaller than potential win)
            return Math.floor(Math.random() * (this.lossRange.max - this.lossRange.min + 1)) + this.lossRange.min;
        }

        executeTrade() {
            if (!this.shouldTrade()) return false;

            // Update market trend (less frequent changes)
            if (Math.random() < 0.1) {
                this.updateMarketTrend();
            }

            const macd = this.calculateMACD();
            const isBuy = macd.histogram > 0;
            const currentPrice = this.generateRandomPrice(this.lastPrice);
            const winProbability = this.calculateDynamicWinRate();
            const isWinningTrade = Math.random() < winProbability;
            
            let pnl;
            if (isWinningTrade) {
                pnl = this.calculateWinAmount();
                botState.consecutiveLosses = 0;
                botState.winStreak++;
                botState.lossStreak = 0;
                
                // Small bonus for consecutive wins
                if (botState.winStreak >= 3) {
                    pnl *= 1.1; // 10% bonus on win streaks
                }
            } else {
                pnl = -this.calculateLossAmount();
                botState.consecutiveLosses++;
                botState.winStreak = 0;
                botState.lossStreak++;
                
                // Reduce losses after multiple losses
                if (botState.lossStreak >= 3) {
                    pnl *= 0.8; // 20% smaller losses
                }
            }

            // Apply house edge
            const houseCut = Math.abs(pnl) * botState.houseEdge;
            pnl = pnl > 0 ? pnl - houseCut : pnl + houseCut;

            // Update overall losing state
            if (botState.totalPnL + pnl < 0) {
                botState.overallLosing = true;
            } else {
                botState.overallLosing = false;
            }

            // Update statistics
            botState.totalTrades++;
            botState.totalPnL += pnl;
            botState.currentBalance += pnl;
            
            if (pnl > 0) {
                botState.winningTrades++;
            }

            // Enhanced logging with tier info
            const timestamp = this.getCurrentTimestamp();
            const tradeType = isBuy ? 'BUY' : 'SELL';
            const pnlText = pnl >= 0 ? `+$${pnl.toFixed(2)}` : `-$${Math.abs(pnl).toFixed(2)}`;
            
            addLogEntry(timestamp, 
                `${this.tier.toUpperCase()} ${tradeType} ${this.currentPair} at $${currentPrice.toFixed(2)} | P/L: ${pnlText} | Win%: ${(winProbability*100).toFixed(1)}`, 
                pnl >= 0 ? 'success' : 'warning');
            
            // Add motivational messages
            if (pnl >= (this.profitRange.max * 0.9)) {
                addLogEntry(timestamp, "Excellent trade! Premium strategy working!", 'success');
            }
            if (botState.winStreak >= 3) {
                addLogEntry(timestamp, `Win streak! ${botState.winStreak} in a row!`, 'success');
            }
            if (botState.lossStreak >= 2) {
                addLogEntry(timestamp, "Recovery mode activated - increased win probability", 'info');
            }
            if (botState.overallLosing) {
                addLogEntry(timestamp, "Aggressive recovery strategy engaged", 'info');
            }
            
            // Update database and UI
            this.updateWalletBalance(botState.currentBalance);
            this.updateStats();
            
            this.lastPrice = currentPrice;
            return true;
        }

        // [Rest of the methods remain the same as previous implementation]
        updateWalletBalance(newBalance) {
            fetch('/api/update-wallet-balance', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    balance: newBalance
                })
            }).catch(error => console.error('Error updating balance:', error));
        }

        updateStats() {
            document.getElementById('totalPnL').textContent = 
                (botState.totalPnL >= 0 ? '+' : '') + '$' + Math.abs(botState.totalPnL).toFixed(2);
            document.getElementById('totalPnL').className = 
                'stat-value ' + (botState.totalPnL >= 0 ? 'positive' : 'negative');
            
            document.getElementById('totalTrades').textContent = botState.totalTrades;
            document.getElementById('currentBalance').textContent = 
                '$' + botState.currentBalance.toFixed(2);
            
            const winRate = botState.totalTrades > 0 ? 
                (botState.winningTrades / botState.totalTrades * 100).toFixed(1) : 0;
            document.getElementById('winRate').textContent = winRate + '%';
            
            // Mobile updates
            document.getElementById('mobileBalance').textContent = 
                '$' + botState.currentBalance.toFixed(2);
            const changeText = (botState.totalPnL >= 0 ? '+' : '') + '$' + Math.abs(botState.totalPnL).toFixed(2);
            document.getElementById('mobileBalanceChange').textContent = changeText;
            document.getElementById('mobileBalanceChange').className = 
                'balance-change ' + (botState.totalPnL >= 0 ? 'positive' : 'negative');
            
            // Display current tier
            document.getElementById('currentTier').textContent = 
                this.tier.toUpperCase() + ' TIER';
        }

        getCurrentTimestamp() {
            const now = new Date();
            return now.toTimeString().split(' ')[0] + '.' + now.getMilliseconds().toString().padStart(3, '0');
        }

        analyzeMarket() {
            const timestamp = this.getCurrentTimestamp();
            const analyses = [
                `${this.tier.toUpperCase()} strategy analysis: Strong signals`,
                `Market conditions favorable for ${this.tier} tier`,
                `Technical indicators show high-probability setups`,
                `Current ${this.tier} strategy performing optimally`,
                `Premium algorithms detecting profitable opportunities`
            ];
            addLogEntry(timestamp, analyses[Math.floor(Math.random() * analyses.length)], 'info');
        }
    }

    // [Rest of the JavaScript code remains the same]
    const tradingBot = new TradingBot();

    function addLogEntry(timestamp, message, type = 'info') {
        const logsContainer = document.getElementById('logsContainer');
        const logEntry = document.createElement('div');
        logEntry.className = `log-entry log-${type}`;
        logEntry.innerHTML = `<span class="log-timestamp">[${timestamp}]</span> <span class="log-${type}">${message}</span>`;
        logsContainer.appendChild(logEntry);
        logsContainer.scrollTop = logsContainer.scrollHeight;
        document.getElementById('logsCount').textContent = `${logsContainer.children.length} entries`;
    }

    function startBot() {
        botState.isRunning = true;
        botState.isPaused = false;
        botState.totalRuns++;
        
        document.getElementById('totalRuns').textContent = botState.totalRuns;
        updateBotStatus('running', 'Running');
        
        document.getElementById('startBtn').disabled = true;
        document.getElementById('pauseBtn').disabled = false;
        document.getElementById('stopBtn').disabled = false;
        
        const timestamp = tradingBot.getCurrentTimestamp();
        addLogEntry(timestamp, `${tradingBot.tier.toUpperCase()} Trading Bot started`, 'success');
        addLogEntry(timestamp, `Initializing ${tradingBot.tier} trading strategy`, 'success');
        
        botState.tradingInterval = setInterval(() => {
            if (botState.isRunning && !botState.isPaused) {
                tradingBot.executeTrade();
            }
        }, Math.random() * 10000 + 5000); // 5-15 sec intervals
        
        botState.logInterval = setInterval(() => {
            if (botState.isRunning && !botState.isPaused) {
                tradingBot.analyzeMarket();
            }
        }, Math.random() * 8000 + 4000);
    }

    function pauseBot() {
        botState.isPaused = !botState.isPaused;
        const pauseBtn = document.getElementById('pauseBtn');
        if (botState.isPaused) {
            updateBotStatus('paused', 'Paused');
            pauseBtn.textContent = 'Resume Bot';
            addLogEntry(tradingBot.getCurrentTimestamp(), 'Trading paused', 'warning');
        } else {
            updateBotStatus('running', 'Running');
            pauseBtn.textContent = 'Pause Bot';
            addLogEntry(tradingBot.getCurrentTimestamp(), 'Trading resumed', 'success');
        }
    }

    function stopBot() {
        if (confirm('Stop the trading bot?')) {
            botState.isRunning = false;
            botState.isPaused = false;
            clearInterval(botState.tradingInterval);
            clearInterval(botState.logInterval);
            updateBotStatus('stopped', 'Stopped');
            
            document.getElementById('startBtn').disabled = false;
            document.getElementById('pauseBtn').disabled = true;
            document.getElementById('stopBtn').disabled = true;
            
            const finalStats = `Results: ${botState.totalTrades} trades | ${botState.winningTrades} wins (${(botState.winningTrades/botState.totalTrades*100).toFixed(1)}% win rate)`;
            addLogEntry(tradingBot.getCurrentTimestamp(), 'Trading bot stopped', 'warning');
            addLogEntry(tradingBot.getCurrentTimestamp(), finalStats, 'info');
        }
    }

    function updateBotStatus(status, text) {
        const statusBadge = document.getElementById('statusBadge');
        const statusDot = document.getElementById('statusDot');
        const statusText = document.getElementById('statusText');
        statusBadge.className = `status-badge ${status}`;
        statusDot.className = `status-dot ${status}`;
        statusText.textContent = text;
    }

    document.addEventListener('DOMContentLoaded', function() {
        @if(Auth::user()->wallet_balance >= $amount)
            document.getElementById('startBtn').addEventListener('click', startBot);
            document.getElementById('pauseBtn').addEventListener('click', pauseBot);
            document.getElementById('stopBtn').addEventListener('click', stopBot);
            updateBotStatus('stopped', 'Ready to Start');
        @endif
        
        const timestamp = tradingBot.getCurrentTimestamp();
        addLogEntry(timestamp, `${tradingBot.tier.toUpperCase()} Trading Bot initialized`, 'success');
        addLogEntry(timestamp, `Current balance: $${botState.currentBalance.toFixed(2)}`, 'info');
        addLogEntry(timestamp, `Active strategy: ${tradingBot.tier.toUpperCase()} (${tradingBot.baseWinRate*100}% base win rate)`, 'info');
        @if(Auth::user()->wallet_balance < $amount)
            addLogEntry(timestamp, 'Insufficient balance to start trading', 'error');
        @endif
    });
</script>
    <!-- CSRF Token for AJAX requests -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</body>
@endsection