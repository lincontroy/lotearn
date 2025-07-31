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

        .main-content {
            padding: 3rem 2rem;
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
        }

        .main-title {
            font-size: 2.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .main-subtitle {
            color: #9ca3af;
            font-size: 1.1rem;
            margin-bottom: 3rem;
        }

        .withdrawal-form {
            background: #1a2332;
            border-radius: 20px;
            padding: 2.5rem;
            max-width: 600px;
            margin: 0 auto;
        }

        .method-tabs {
            display: flex;
            background: #0f1419;
            border-radius: 12px;
            padding: 0.5rem;
            margin-bottom: 2rem;
        }

        .method-tab {
            flex: 1;
            padding: 1rem 1.5rem;
            border: none;
            background: transparent;
            color: #9ca3af;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
            font-weight: 500;
            font-size: 1.1rem;
        }

        .method-tab.active {
            background: #4f46e5;
            color: white;
        }

        .method-tab:not(.active):hover {
            background: #374151;
            color: white;
        }

        .crypto-options {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .crypto-option {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 1.5rem 1rem;
            background: #0f1419;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s;
            border: 2px solid transparent;
        }

        .crypto-option:hover {
            background: #374151;
        }

        .crypto-option.selected {
            border-color: #4f46e5;
            background: #1e1b4b;
        }

        .crypto-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .crypto-icon.bitcoin {
            background: #f7931a;
            color: white;
        }

        .crypto-icon.usdt {
            background: #26a17b;
            color: white;
        }

        .crypto-icon.ethereum {
            background: #627eea;
            color: white;
        }

        .crypto-name {
            font-size: 0.9rem;
            font-weight: 500;
        }

        .amount-section {
            margin-bottom: 2rem;
        }

        .amount-label {
            text-align: left;
            font-size: 0.9rem;
            color: #9ca3af;
            margin-bottom: 0.5rem;
        }

        .amount-input {
            width: 100%;
            padding: 1rem 1.5rem;
            background: #374151;
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 1.1rem;
            outline: none;
        }

        .amount-input:focus {
            background: #4b5563;
        }

        .wallet-section {
            margin-bottom: 2rem;
        }

        .wallet-label {
            text-align: left;
            font-size: 0.9rem;
            color: #9ca3af;
            margin-bottom: 0.5rem;
        }

        .wallet-input {
            width: 100%;
            padding: 1rem 1.5rem;
            background: #374151;
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 1.1rem;
            outline: none;
            margin-bottom: 1rem;
        }

        .wallet-input:focus {
            background: #4b5563;
        }

        .bank-details {
            margin-bottom: 2rem;
        }

        .bank-label {
            text-align: left;
            font-size: 0.9rem;
            color: #9ca3af;
            margin-bottom: 0.5rem;
        }

        .bank-input {
            width: 100%;
            padding: 1rem 1.5rem;
            background: #374151;
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 1.1rem;
            outline: none;
            margin-bottom: 1rem;
        }

        .bank-input:focus {
            background: #4b5563;
        }

        .mpesa-details {
            margin-bottom: 2rem;
        }

        .mpesa-label {
            text-align: left;
            font-size: 0.9rem;
            color: #9ca3af;
            margin-bottom: 0.5rem;
        }

        .mpesa-input {
            width: 100%;
            padding: 1rem 1.5rem;
            background: #374151;
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 1.1rem;
            outline: none;
        }

        .mpesa-input:focus {
            background: #4b5563;
        }

        .withdraw-btn {
            width: 100%;
            height: 50px;
            border-radius: 12px;
            background: #4ade80;
            border: none;
            color: #0a0f1c;
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.2s;
            font-weight: 600;
        }

        .withdraw-btn:hover {
            background: #22c55e;
            transform: translateY(-1px);
        }

        .withdraw-btn:disabled {
            background: #6b7280;
            cursor: not-allowed;
            transform: none;
        }

        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid #ffffff;
            border-radius: 50%;
            border-top-color: transparent;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .success-message, .error-message {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            text-align: center;
        }

        .success-message {
            background: #10b981;
            color: white;
        }

        .error-message {
            background: #ef4444;
            color: white;
        }

        .balance-info {
            background: #1e3a8a;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            text-align: center;
        }

        .balance-amount {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .balance-label {
            font-size: 1rem;
            color: #9ca3af;
        }

        @media (max-width: 768px) {
            .crypto-options {
                grid-template-columns: repeat(2, 1fr);
            }

            .method-tab {
                padding: 0.8rem 1rem;
                font-size: 1rem;
            }

            .withdrawal-form {
                padding: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .crypto-options {
                grid-template-columns: repeat(1, 1fr);
            }

            .method-tab {
                padding: 0.6rem 0.8rem;
                font-size: 0.9rem;
            }
        }
    </style>

<body>
    <main class="main-content">
        <h1 class="main-title">Withdraw Funds</h1>
        <p class="main-subtitle">Choose your preferred withdrawal method below</p>
        
        <div class="balance-info">
            <div class="balance-amount">${{ number_format(auth()->user()->wallet_balance, 2) }}</div>
            <div class="balance-label">Available Balance</div>
        </div>
        
        <div class="withdrawal-form">
            <div class="method-tabs">
                <button class="method-tab active" id="crypto-tab">💰 Crypto</button>
                <button class="method-tab" id="bank-tab">🏦 Bank</button>
                <button class="method-tab" id="mpesa-tab">📱 Mpesa</button>
            </div>
            
            <!-- Crypto withdrawal form -->
            <div id="crypto-withdrawal-form">
                <div class="crypto-options">
                    <div class="crypto-option selected" onclick="selectCrypto(this, 'bitcoin')">
                        <div class="crypto-icon bitcoin">₿</div>
                        <div class="crypto-name">Bitcoin</div>
                    </div>
                    <div class="crypto-option" onclick="selectCrypto(this, 'usdt')">
                        <div class="crypto-icon usdt">₮</div>
                        <div class="crypto-name">USDT</div>
                    </div>
                    <div class="crypto-option" onclick="selectCrypto(this, 'ethereum')">
                        <div class="crypto-icon ethereum">Ξ</div>
                        <div class="crypto-name">Ethereum</div>
                    </div>
                </div>
                
                <div class="amount-section">
                    <div class="amount-label">Amount (USD)</div>
                    <input type="number" class="amount-input" id="crypto-amount" placeholder="100" value="100" min="10" max="{{ auth()->user()->wallet_balance }}">
                </div>
                
                <div class="wallet-section">
                    <div class="wallet-label">Your {{ auth()->user()->default_crypto ?? 'Bitcoin' }} Wallet Address</div>
                    <input type="text" class="wallet-input" id="crypto-wallet" placeholder="1A1zP1eP5QGefi2DMPTfTL5SLmv7DivfNa" value="{{ auth()->user()->crypto_wallet ?? '' }}">
                </div>
                
                <div id="crypto-messages"></div>
                <button class="withdraw-btn" id="crypto-withdraw-btn" onclick="processCryptoWithdrawal()">Withdraw</button>
            </div>
            
            <!-- Bank withdrawal form -->
            <div id="bank-withdrawal-form" style="display: none;">
                <div id="bank-messages"></div>
                <div class="amount-section">
                    <div class="amount-label">Amount (USD)</div>
                    <input type="number" class="amount-input" id="bank-amount" placeholder="100" value="100" min="10" max="{{ auth()->user()->wallet_balance }}">
                </div>
                
                <div class="bank-details">
                    <div class="bank-label">Bank Name</div>
                    <input type="text" class="bank-input" id="bank-name" placeholder="e.g. Chase Bank" value="{{ auth()->user()->bank_name ?? '' }}">
                    
                    <div class="bank-label">Account Number</div>
                    <input type="text" class="bank-input" id="bank-account" placeholder="123456789" value="{{ auth()->user()->bank_account ?? '' }}">
                    
                    <div class="bank-label">Account Holder Name</div>
                    <input type="text" class="bank-input" id="bank-holder" placeholder="John Doe" value="{{ auth()->user()->name }}">
                    
                    <div class="bank-label">SWIFT/IBAN Code</div>
                    <input type="text" class="bank-input" id="bank-swift" placeholder="CHASUS33" value="{{ auth()->user()->bank_swift ?? '' }}">
                </div>
                <button class="withdraw-btn" id="bank-withdraw-btn" onclick="processBankWithdrawal()">Withdraw</button>
            </div>
            
            <!-- Mpesa withdrawal form -->
            <div id="mpesa-withdrawal-form" style="display: none;">
                <div id="mpesa-messages"></div>
                <div class="amount-section">
                    <div class="amount-label">Amount (KES)</div>
                    <input type="number" class="amount-input" id="mpesa-amount" placeholder="1000" value="1000" min="100" max="{{ auth()->user()->wallet_balance * 100 }}">
                </div>
                
                <div class="mpesa-details">
                    <div class="mpesa-label">Phone Number</div>
                    <input type="text" class="mpesa-input" id="mpesa-phone" placeholder="254712345678" maxlength="12" value="{{ auth()->user()->phone ?? '' }}">
                </div>
                <button class="withdraw-btn" id="mpesa-withdraw-btn" onclick="processMpesaWithdrawal()">Withdraw</button>
            </div>
        </div>
    </main>

    <script>
        // Current selected crypto method
        let selectedCrypto = 'bitcoin';
        
        function selectCrypto(element, cryptoType) {
            // Remove selected class from all options
            document.querySelectorAll('.crypto-option').forEach(option => {
                option.classList.remove('selected');
            });
            
            // Add selected class to clicked option
            element.classList.add('selected');
            selectedCrypto = cryptoType;
            
            // Update wallet placeholder based on crypto type
            const walletInput = document.getElementById('crypto-wallet');
            switch(cryptoType) {
                case 'bitcoin':
                    walletInput.placeholder = '1A1zP1eP5QGefi2DMPTfTL5SLmv7DivfNa';
                    break;
                case 'usdt':
                    walletInput.placeholder = 'TQn9Y2khEsLJW1ChVTQQugS4TnxaHm6Ft5';
                    break;
                case 'ethereum':
                    walletInput.placeholder = '0x71C7656EC7ab88b098defB751B7401B5f6d8976F';
                    break;
            }
        }

        function showMessage(containerId, message, type) {
            const container = document.getElementById(containerId);
            container.innerHTML = `<div class="${type}-message">${message}</div>`;
            setTimeout(() => {
                container.innerHTML = '';
            }, 5000);
        }

        // Phone number formatting for M-Pesa
        document.getElementById('mpesa-phone').addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^0-9]/g, '');
            if (value.startsWith('0')) {
                value = '254' + value.substring(1);
            }
            e.target.value = value;
        });

        async function processCryptoWithdrawal() {
            const amount = parseFloat(document.getElementById('crypto-amount').value);
            const walletAddress = document.getElementById('crypto-wallet').value.trim();
            const withdrawBtn = document.getElementById('crypto-withdraw-btn');
            const balance = parseFloat("{{ auth()->user()->wallet_balance }}");

            // Validation
            if (!amount || !walletAddress) {
                showMessage('crypto-messages', 'Please enter amount and wallet address', 'error');
                return;
            }

            if (amount < 10) {
                showMessage('crypto-messages', 'Minimum withdrawal is $10', 'error');
                return;
            }

            if (amount > balance) {
                showMessage('crypto-messages', 'Insufficient balance', 'error');
                return;
            }

            // Basic wallet validation
            if (selectedCrypto === 'bitcoin' && !/^[13][a-km-zA-HJ-NP-Z1-9]{25,34}$/.test(walletAddress)) {
                showMessage('crypto-messages', 'Please enter a valid Bitcoin address', 'error');
                return;
            }

            if (selectedCrypto === 'usdt' && !/^T[1-9A-HJ-NP-Za-km-z]{33}$/.test(walletAddress)) {
                showMessage('crypto-messages', 'Please enter a valid USDT (TRC20) address', 'error');
                return;
            }

            if (selectedCrypto === 'ethereum' && !/^0x[a-fA-F0-9]{40}$/.test(walletAddress)) {
                showMessage('crypto-messages', 'Please enter a valid Ethereum address', 'error');
                return;
            }

            // Show loading state
            withdrawBtn.disabled = true;
            withdrawBtn.innerHTML = '<span class="loading"></span> Processing...';

            try {
                const response = await fetch('/withdraw/crypto', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        crypto_type: selectedCrypto,
                        amount: amount,
                        wallet_address: walletAddress
                    })
                });

                const result = await response.json();

                if (response.ok) {
                    showMessage('crypto-messages', 'Withdrawal request submitted successfully!', 'success');
                    // Update balance display
                    document.querySelector('.balance-amount').textContent = '$' + (balance - amount).toFixed(2);
                    // Reset form
                    document.getElementById('crypto-amount').value = '100';
                } else {
                    showMessage('crypto-messages', result.message || 'Withdrawal failed. Please try again.', 'error');
                }
            } catch (error) {
                console.error('Withdrawal error:', error);
                showMessage('crypto-messages', 'Network error. Please try again.', 'error');
            } finally {
                withdrawBtn.disabled = false;
                withdrawBtn.innerHTML = 'Withdraw';
            }
        }

        async function processBankWithdrawal() {
            const amount = parseFloat(document.getElementById('bank-amount').value);
            const bankName = document.getElementById('bank-name').value.trim();
            const accountNumber = document.getElementById('bank-account').value.trim();
            const accountHolder = document.getElementById('bank-holder').value.trim();
            const swiftCode = document.getElementById('bank-swift').value.trim();
            const withdrawBtn = document.getElementById('bank-withdraw-btn');
            const balance = parseFloat("{{ auth()->user()->wallet_balance }}");

            // Validation
            if (!amount || !bankName || !accountNumber || !accountHolder) {
                showMessage('bank-messages', 'Please fill in all required fields', 'error');
                return;
            }

            if (amount < 10) {
                showMessage('bank-messages', 'Minimum withdrawal is $10', 'error');
                return;
            }

            if (amount > balance) {
                showMessage('bank-messages', 'Insufficient balance', 'error');
                return;
            }

            // Show loading state
            withdrawBtn.disabled = true;
            withdrawBtn.innerHTML = '<span class="loading"></span> Processing...';

            try {
                const response = await fetch('/withdraw/bank', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        amount: amount,
                        bank_name: bankName,
                        account_number: accountNumber,
                        account_holder: accountHolder,
                        swift_code: swiftCode
                    })
                });

                const result = await response.json();

                if (response.ok) {
                    showMessage('bank-messages', 'Bank withdrawal request submitted! Processing may take 2-3 business days.', 'success');
                    // Update balance display
                    document.querySelector('.balance-amount').textContent = '$' + (balance - amount).toFixed(2);
                    // Reset form
                    document.getElementById('bank-amount').value = '100';
                } else {
                    showMessage('bank-messages', result.message || 'Withdrawal failed. Please try again.', 'error');
                }
            } catch (error) {
                console.error('Bank withdrawal error:', error);
                showMessage('bank-messages', 'Network error. Please try again.', 'error');
            } finally {
                withdrawBtn.disabled = false;
                withdrawBtn.innerHTML = 'Withdraw';
            }
        }

        async function processMpesaWithdrawal() {
            const amount = parseFloat(document.getElementById('mpesa-amount').value);
            const phone = document.getElementById('mpesa-phone').value.trim();
            const withdrawBtn = document.getElementById('mpesa-withdraw-btn');
            const balance = parseFloat("{{ auth()->user()->wallet_balance }}");
            const maxKesAmount = balance * 100; // Assuming $1 = 100 KES

            // Validation
            if (!amount || !phone) {
                showMessage('mpesa-messages', 'Please enter amount and phone number', 'error');
                return;
            }

            if (amount < 100) {
                showMessage('mpesa-messages', 'Minimum withdrawal is KES 100', 'error');
                return;
            }

            if (amount > maxKesAmount) {
                showMessage('mpesa-messages', 'Insufficient balance', 'error');
                return;
            }

            if (phone.length !== 12 || !phone.startsWith('254')) {
                showMessage('mpesa-messages', 'Please enter a valid phone number (254XXXXXXXXX)', 'error');
                return;
            }

            // Show loading state
            withdrawBtn.disabled = true;
            withdrawBtn.innerHTML = '<span class="loading"></span> Processing...';

            try {
                const response = await fetch('/withdraw/mpesa', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        amount: amount,
                        phone: phone
                    })
                });

                const result = await response.json();

                if (response.ok) {
                    showMessage('mpesa-messages', 'M-Pesa withdrawal initiated! Funds should arrive within minutes.', 'success');
                    // Update balance display (convert KES back to USD for display)
                    const usdDeduction = amount / 100;
                    document.querySelector('.balance-amount').textContent = '$' + (balance - usdDeduction).toFixed(2);
                    // Reset form
                    document.getElementById('mpesa-amount').value = '1000';
                } else {
                    showMessage('mpesa-messages', result.message || 'Withdrawal failed. Please try again.', 'error');
                }
            } catch (error) {
                console.error('M-Pesa withdrawal error:', error);
                showMessage('mpesa-messages', 'Network error. Please try again.', 'error');
            } finally {
                withdrawBtn.disabled = false;
                withdrawBtn.innerHTML = 'Withdraw';
            }
        }

        // Tab switching functionality
        document.querySelectorAll('.method-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.method-tab').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                
                if (this.id === 'crypto-tab') {
                    document.getElementById('crypto-withdrawal-form').style.display = 'block';
                    document.getElementById('bank-withdrawal-form').style.display = 'none';
                    document.getElementById('mpesa-withdrawal-form').style.display = 'none';
                } else if (this.id === 'bank-tab') {
                    document.getElementById('crypto-withdrawal-form').style.display = 'none';
                    document.getElementById('bank-withdrawal-form').style.display = 'block';
                    document.getElementById('mpesa-withdrawal-form').style.display = 'none';
                } else if (this.id === 'mpesa-tab') {
                    document.getElementById('crypto-withdrawal-form').style.display = 'none';
                    document.getElementById('bank-withdrawal-form').style.display = 'none';
                    document.getElementById('mpesa-withdrawal-form').style.display = 'block';
                }
            });
        });

        // Initialize with Bitcoin selected
        selectCrypto(document.querySelector('.crypto-option.selected'), 'bitcoin');
    </script>
@endsection