@extends('layouts.app')
@section('content')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial, sans-serif;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #1a1a2e 100%);
            color: white;
            height: 100vh;
            overflow: hidden;
        }

        .container {
            display: flex;
            height: 100vh;
        }

        .main-content {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .title-section h1 {
            font-size: 32px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .bot-info {
            font-size: 14px;
            color: #888;
        }

        .controls {
            display: flex;
            gap: 12px;
        }

        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-paused {
            background: #ff9500;
            color: white;
        }

        .btn-resume {
            background: #007bff;
            color: white;
        }

        .btn-stop {
            background: #dc3545;
            color: white;
        }

        .btn:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }

        .dashboard {
            display: flex;
            gap: 20px;
            height: calc(100vh - 140px);
        }

        .stats-panel {
            display: flex;
            flex-direction: column;
            gap: 15px;
            min-width: 280px;
        }

        .stat-card {
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        .profit-card {
            background: linear-gradient(135deg, #2d5a27 0%, #4a7c59 100%);
        }

        .runs-card {
            background: linear-gradient(135deg, #3a2d5a 0%, #5a4a7c 100%);
        }

        .trades-card {
            background: linear-gradient(135deg, #2d3a5a 0%, #4a5a7c 100%);
        }

        .winrate-card {
            background: linear-gradient(135deg, #5a4527 0%, #7c6a4a 100%);
        }

        .balance-card {
            background: linear-gradient(135deg, #2d4a5a 0%, #4a6a7c 100%);
        }

        .stat-label {
            font-size: 13px;
            color: #ccc;
            margin-bottom: 8px;
        }

        .stat-value {
            font-size: 28px;
            font-weight: 700;
        }

        .logs-panel {
            flex: 1;
            background: rgba(20, 20, 40, 0.8);
            border-radius: 12px;
            padding: 20px;
            overflow: hidden;
        }

        .logs-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #333;
        }

        .logs-title {
            font-size: 18px;
            font-weight: 600;
        }

        .logs-count {
            font-size: 12px;
            color: #888;
        }

        .logs-content {
            height: calc(100% - 60px);
            overflow-y: auto;
            font-family: 'Monaco', 'Menlo', monospace;
            font-size: 12px;
            line-height: 1.5;
        }

        .log-entry {
            margin-bottom: 4px;
            white-space: nowrap;
        }

        .timestamp {
            color: #666;
        }

        .log-sentiment { color: #4dabf7; }
        .log-scanning { color: #9775fa; }
        .log-success { color: #51cf66; }
        .log-connection { color: #4dabf7; }
        .log-config { color: #4dabf7; }
        .log-data { color: #4dabf7; }
        .log-market { color: #4dabf7; }
        .log-balance { color: #4dabf7; }
        .log-account { color: #4dabf7; }
        .log-investment { color: #4dabf7; }
        .log-bot { color: #4dabf7; }
        .log-demo { color: #fd7e14; }

        .logs-content::-webkit-scrollbar {
            width: 6px;
        }

        .logs-content::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 3px;
        }

        .logs-content::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
        }
    </style>

<body>
    <div class="container">
        <div class="main-content">
            <div class="header">
                <div class="title-section">
                    <h1>Bollinger Bands Trading Bot</h1>
                    <div class="bot-info">Bot ID: dca-3 • Investment: $100 • Account: Demo</div>
                </div>
                <div class="controls">
                    <button class="btn btn-paused">⏸ Paused</button>
                    <button class="btn btn-resume">Resume Bot</button>
                    <button class="btn btn-stop">Stop Bot</button>
                </div>
            </div>

            <div class="dashboard">
                <div class="stats-panel">
                    <div class="stat-card profit-card">
                        <div class="stat-label">Total P/L</div>
                        <div class="stat-value">+$70.00</div>
                    </div>
                    
                    <div class="stat-card runs-card">
                        <div class="stat-label">Total Runs</div>
                        <div class="stat-value">1</div>
                    </div>
                    
                    <div class="stat-card trades-card">
                        <div class="stat-label">Total Trades</div>
                        <div class="stat-value">1</div>
                    </div>
                    
                    <div class="stat-card winrate-card">
                        <div class="stat-label">Win Rate</div>
                        <div class="stat-value">100.0%</div>
                    </div>
                    
                    <div class="stat-card balance-card">
                        <div class="stat-label">Balance</div>
                        <div class="stat-value">$10370.00</div>
                    </div>
                </div>

                <div class="logs-panel">
                    <div class="logs-header">
                        <div class="logs-title">Bot Logs</div>
                        <div class="logs-count">43 entries</div>
                    </div>
                    <div class="logs-content">
                        <div class="log-entry">
                            <span class="timestamp">[13:45:55.296]</span> <span class="log-sentiment">Sentiment analysis for FDUSD: Bullish</span>
                        </div>
                        <div class="log-entry">
                            <span class="timestamp">[13:45:54.796]</span> <span class="log-scanning">Scanning for potential flash crash opportunities</span>
                        </div>
                        <div class="log-entry">
                            <span class="timestamp">[13:45:51.295]</span> <span class="log-success">API connection established successfully</span>
                        </div>
                        <div class="log-entry">
                            <span class="timestamp">[13:45:51.295]</span> <span class="log-connection">Establishing connection to exchange APIs...</span>
                        </div>
                        <div class="log-entry">
                            <span class="timestamp">[13:45:51.295]</span> <span class="log-config">Bollinger Bands bot configuration loaded successfully</span>
                        </div>
                        <div class="log-entry">
                            <span class="timestamp">[13:45:51.295]</span> <span class="log-data">Loading historical data for technical analysis...</span>
                        </div>
                        <div class="log-entry">
                            <span class="timestamp">[13:45:51.295]</span> <span class="log-market">Scanning market for trading opportunities in BTCUSDT, ETHUSDT</span>
                        </div>
                        <div class="log-entry">
                            <span class="timestamp">[13:45:51.295]</span> <span class="log-balance">Current demo balance: $10300.00</span>
                        </div>
                        <div class="log-entry">
                            <span class="timestamp">[13:45:51.295]</span> <span class="log-account">Account type: Demo</span>
                        </div>
                        <div class="log-entry">
                            <span class="timestamp">[13:45:51.295]</span> <span class="log-investment">Investment amount configured: $100</span>
                        </div>
                        <div class="log-entry">
                            <span class="timestamp">[13:45:51.295]</span> <span class="log-bot">Bot ID dca-3 started - Bollinger Bands strategy initialized</span>
                        </div>
                        <div class="log-entry">
                            <span class="timestamp">[13:45:50.885]</span> <span class="log-demo">Demo account: Using standard trading parameters</span>
                        </div>
                        <div class="log-entry">
                            <span class="timestamp">[13:45:50.353]</span> <span class="log-success">API connection established successfully</span>
                        </div>
                        <div class="log-entry">
                            <span class="timestamp">[13:45:50.353]</span> <span class="log-connection">Establishing connection to exchange APIs...</span>
                        </div>
                        <div class="log-entry">
                            <span class="timestamp">[13:45:50.353]</span> <span class="log-config">Bollinger Bands bot configuration loaded successfully</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add some interactivity to buttons
        document.querySelectorAll('.btn').forEach(btn => {
            btn.addEventListener('click', function() {
                if (this.textContent.includes('Paused')) {
                    this.textContent = '▶ Running';
                    this.className = 'btn btn-resume';
                } else if (this.textContent.includes('Resume')) {
                    document.querySelector('.btn-paused').textContent = '▶ Running';
                    document.querySelector('.btn-paused').className = 'btn btn-resume';
                }
            });
        });

        // Auto-scroll logs to bottom
        const logsContent = document.querySelector('.logs-content');
        logsContent.scrollTop = logsContent.scrollHeight;

        // Simulate real-time log updates
        const logEntries = [
            { time: '13:45:56.123', message: 'Market volatility detected: 2.3%', class: 'log-market' },
            { time: '13:45:57.456', message: 'Bollinger Band upper limit: $42,150.00', class: 'log-data' },
            { time: '13:45:58.789', message: 'Price action within normal parameters', class: 'log-scanning' }
        ];

        let logIndex = 0;
        setInterval(() => {
            if (logIndex < logEntries.length) {
                const entry = logEntries[logIndex];
                const logDiv = document.createElement('div');
                logDiv.className = 'log-entry';
                logDiv.innerHTML = `<span class="timestamp">[${entry.time}]</span> <span class="${entry.class}">${entry.message}</span>`;
                logsContent.appendChild(logDiv);
                logsContent.scrollTop = logsContent.scrollHeight;
                logIndex++;
                
                // Update entry count
                const currentCount = parseInt(document.querySelector('.logs-count').textContent);
                document.querySelector('.logs-count').textContent = `${currentCount + 1} entries`;
            }
        }, 3000);
    </script>
</body>
@endsection