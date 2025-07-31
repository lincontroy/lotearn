@extends('layouts.app')
@section('content')
    <style>
       

        .main-content {
            padding: 30px;
            max-width: 1400px;
            margin: 0 auto;
        }
        .market-tabs {
            display: flex;
            gap: 16px;
            margin-bottom: 30px;
            border-bottom: 1px solid #2a3441;
            padding-bottom: 12px;
        }

        .market-tab {
            color: #9ca3af;
            font-weight: 600;
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .market-tab.active {
            color: white;
            background: rgba(74, 222, 128, 0.1);
        }

        .market-tab:hover {
            color: white;
            background: rgba(74, 222, 128, 0.05);
        }

        .market-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .market-item {
            background: #1a1f2e;
            border-radius: 12px;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .market-item:hover {
            border-color: rgba(74, 222, 128, 0.3);
            transform: translateY(-2px);
        }

        .coin-info {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .coin-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 18px;
        }

        .coin-icon.eth {
            background: linear-gradient(135deg, #627eea, #4f46e5);
        }

        .coin-icon.btc {
            background: linear-gradient(135deg, #f7931a, #ff9500);
        }

        .coin-icon.usdc {
            background: linear-gradient(135deg, #2775ca, #1d4ed8);
        }

        .coin-name h3 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .coin-name p {
            color: #9ca3af;
            font-size: 14px;
        }

        .coin-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            text-align: right;
            width: 60%;
        }

        .stat-group h4 {
            color: #9ca3af;
            font-size: 12px;
            font-weight: 500;
            margin-bottom: 4px;
        }

        .stat-group p {
            font-size: 16px;
            font-weight: 600;
        }

        .stat-group .positive {
            color: #22c55e;
        }

        .footer {
            margin-top: 30px;
            color: #9ca3af;
            font-size: 14px;
            text-align: center;
        }

        @media (max-width: 768px) {
            body {
                padding: 20px;
            }
            
            .coin-stats {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }
            
            .market-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;
            }
            
            .coin-stats {
                width: 100%;
                text-align: left;
            }
        }
    </style>
</head>
<body>
<main class="main-content">
    <div class="header">
        <h1>Markets</h1>
       
    </div>

    <div class="market-tabs">
        <div class="market-tab active">All</div>
        <div class="market-tab">Favorites</div>
        <div class="market-tab">Gainers</div>
    </div>

    <div class="market-list">
        <!-- ETH Market Item -->
        <div class="market-item">
            <div class="coin-info">
                <div class="coin-icon eth">ETH</div>
                <div class="coin-name">
                    <h3>ETH</h3>
                    <p>Ethereum</p>
                </div>
            </div>
            <div class="coin-stats">
                <div class="stat-group">
                    <h4>Price</h4>
                    <p>$3,754.24</p>
                </div>
                <div class="stat-group">
                    <h4>24h High</h4>
                    <p>$3,754.24</p>
                </div>
                <div class="stat-group">
                    <h4>24h Change</h4>
                    <p class="positive">+4.08%</p>
                </div>
                <div class="stat-group">
                    <h4>24h Volume</h4>
                    <p>$2,927.81M</p>
                </div>
            </div>
        </div>

        <!-- BTC Market Item -->
        <div class="market-item">
            <div class="coin-info">
                <div class="coin-icon btc">BTC</div>
                <div class="coin-name">
                    <h3>BTC</h3>
                    <p>Bitcoin</p>
                </div>
            </div>
            <div class="coin-stats">
                <div class="stat-group">
                    <h4>Price</h4>
                    <p>$11,913.75</p>
                </div>
                <div class="stat-group">
                    <h4>24h High</h4>
                    <p>$11,913.75</p>
                </div>
                <div class="stat-group">
                    <h4>24h Change</h4>
                    <p class="positive">+1.03%</p>
                </div>
                <div class="stat-group">
                    <h4>24h Volume</h4>
                    <p>$2,025.38M</p>
                </div>
            </div>
        </div>

        <!-- USDC Market Item -->
        <div class="market-item">
            <div class="coin-info">
                <div class="coin-icon usdc">USDC</div>
                <div class="coin-name">
                    <h3>USDC</h3>
                    <p>USDC</p>
                </div>
            </div>
            <div class="coin-stats">
                <div class="stat-group">
                    <h4>Price</h4>
                    <p>$1.00</p>
                </div>
                <div class="stat-group">
                    <h4>24h High</h4>
                    <p>$1.00</p>
                </div>
                <div class="stat-group">
                    <h4>24h Change</h4>
                    <p class="positive">+0.00%</p>
                </div>
                <div class="stat-group">
                    <h4>24h Volume</h4>
                    <p>$1,834.51M</p>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        30 Coins
    </div>

    <script>
        // Tab functionality
        document.querySelectorAll('.market-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.market-tab').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Add hover effects
        document.querySelectorAll('.market-item').forEach(item => {
            item.addEventListener('mouseenter', function() {
                this.style.boxShadow = '0 8px 30px rgba(0, 0, 0, 0.3)';
            });
            
            item.addEventListener('mouseleave', function() {
                this.style.boxShadow = 'none';
            });
        });
    </script>
</main>
@endsection