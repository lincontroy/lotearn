<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Withdrawal Request</title>
    <style>
        /* Reset styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f5f5f5;
            padding: 20px;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #4f46e5, #3730a3);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .header h1 {
            font-size: 24px;
            font-weight: 600;
            margin: 0;
        }

        .content {
            padding: 40px 30px;
        }

        .section {
            margin-bottom: 30px;
        }

        .section-title {
            color: #4f46e5;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f0f0f0;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 15px;
            margin-bottom: 10px;
        }

        .info-label {
            font-weight: 600;
            color: #666;
        }

        .info-value {
            color: #333;
            font-weight: 500;
        }

        .highlight-box {
            background: linear-gradient(135deg, #1e3a8a, #3730a3);
            color: white;
            padding: 25px;
            border-radius: 10px;
            margin: 25px 0;
            text-align: center;
        }

        .highlight-box h3 {
            font-size: 20px;
            margin-bottom: 15px;
            color: white;
        }

        .highlight-box p {
            font-size: 16px;
            opacity: 0.9;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 16px;
            background: #f59e0b;
            color: white;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
        }

        .crypto-icon {
            display: inline-block;
            width: 24px;
            height: 24px;
            border-radius: 6px;
            color: white;
            text-align: center;
            line-height: 24px;
            font-weight: bold;
            margin-right: 8px;
        }

        .bitcoin-icon { background: #f7931a; }
        .usdt-icon { background: #26a17b; }
        .ethereum-icon { background: #627eea; }

        .wallet-address {
            background: #f8f9fa;
            padding: 12px;
            border-radius: 8px;
            font-family: monospace;
            word-break: break-all;
            border: 1px solid #e9ecef;
            margin-top: 5px;
        }

        .instructions {
            background: #f0f9ff;
            border-left: 4px solid #4f46e5;
            padding: 20px;
            border-radius: 8px;
            margin: 25px 0;
        }

        .instructions h4 {
            color: #4f46e5;
            margin-bottom: 10px;
        }

        .instructions ul {
            padding-left: 20px;
        }

        .instructions li {
            margin-bottom: 8px;
        }

        .contact-info {
            text-align: center;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            margin-top: 30px;
        }

        .footer {
            text-align: center;
            padding: 25px;
            background: #f8f9fa;
            color: #666;
            font-size: 14px;
            border-top: 1px solid #e9ecef;
        }

        .footer a {
            color: #4f46e5;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 600px) {
            .content {
                padding: 25px 20px;
            }
            
            .info-grid {
                grid-template-columns: 1fr;
                gap: 10px;
            }
            
            .header {
                padding: 25px 15px;
            }
            
            .header h1 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <div class="logo">{{ config('app.name') }}</div>
            <h1>Withdrawal Request Submitted</h1>
        </div>

        <div class="content">
            <div class="section">
                <h2 class="section-title">Hello, {{ $user->name }}!</h2>
                <p>Your withdrawal request has been submitted successfully and is currently being processed.</p>
            </div>

            <div class="section">
                <h2 class="section-title">Withdrawal Details</h2>
                <div class="info-grid">
                    <div class="info-label">Transaction ID:</div>
                    <div class="info-value">{{ $withdrawal->id }}</div>
                    
                    <div class="info-label">Date & Time:</div>
                    <div class="info-value">{{ $withdrawal->created_at->format('F j, Y \a\t g:i A') }}</div>
                    
                    <div class="info-label">Withdrawal Method:</div>
                    <div class="info-value">
                        @if($withdrawal->method == 'crypto')
                            @if($withdrawal->details['crypto_type'] == 'bitcoin')
                                <span class="crypto-icon bitcoin-icon">₿</span> Bitcoin
                            @elseif($withdrawal->details['crypto_type'] == 'usdt')
                                <span class="crypto-icon usdt-icon">₮</span> USDT
                            @elseif($withdrawal->details['crypto_type'] == 'ethereum')
                                <span class="crypto-icon ethereum-icon">Ξ</span> Ethereum
                            @endif
                        @else
                            {{ ucfirst($withdrawal->method) }}
                        @endif
                    </div>
                    
                    <div class="info-label">Amount:</div>
                    <div class="info-value" style="font-weight: bold; color: #4f46e5; font-size: 18px;">
                        ${{ number_format($withdrawal->amount, 2) }}
                    </div>
                    
                    <div class="info-label">Status:</div>
                    <div class="info-value">
                        <span class="status-badge">Pending</span>
                    </div>
                    
                    @if($withdrawal->method == 'crypto')
                        <div class="info-label">Wallet Address:</div>
                        <div class="info-value">
                            <div class="wallet-address">
                                {{ $withdrawal->details['wallet_address'] }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="highlight-box">
                <h3>⚠️ Important: Verification Required</h3>
                <p>A withdrawal verification code has been sent to the administrator.</p>
                <p style="margin-top: 10px;"><strong>Contact the admin for the verification code to allow funds to be credited to your account.</strong></p>
            </div>

            <div class="instructions">
                <h4>📋 Next Steps</h4>
                <ul>
                    <li>Contact the administrator via the contact details below</li>
                    <li>Provide your withdrawal ID: <strong>{{ $withdrawal->id }}</strong></li>
                    <li>Request the verification code from the admin</li>
                    <li>Once verified, your withdrawal will be processed within 24-48 hours</li>
                </ul>
            </div>

            <div class="contact-info">
                <h4>📞 Contact Support</h4>
                <p>If you have any questions or need assistance, please contact our support team:</p>
                <p>
                    <strong>Email:</strong> {{ config('mail.support_email', 'info@lotearn.com') }}<br>
                    <strong>Support Hours:</strong> Monday - Friday, 9 AM - 6 PM
                </p>
            </div>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            <p>
                <a href="{{ url('/dashboard') }}">View Dashboard</a> | 
                <a href="{{ url('/contact') }}">Contact Us</a> | 
                <a href="{{ url('/help/withdrawals') }}">Help Center</a>
            </p>
            <p style="font-size: 12px; margin-top: 10px; color: #999;">
                This is an automated email. Please do not reply to this message.
            </p>
        </div>
    </div>
</body>
</html>