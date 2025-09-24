<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lotearn - Your trusted platform for cryptocurrency trading</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 500px;
            text-align: center;
        }

        .header {
            margin-bottom: 40px;
        }

        .header h1 {
            font-size: 2.5rem;
            font-weight: 600;
            margin-bottom: 12px;
            letter-spacing: -0.5px;
        }

        .header p {
            color: #a0a0a0;
            font-size: 1rem;
            font-weight: 400;
        }

        .auth-buttons {
            display: flex;
            margin-bottom: 30px;
            border-radius: 8px;
            overflow: hidden;
            background: #2a2a3e;
        }

        .auth-button {
            flex: 1;
            padding: 14px 20px;
            border: none;
            background: #2a2a3e;
            color: #888;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .auth-button.active {
            background: #4ade80;
            color: white;
        }

        .auth-button:hover:not(.active) {
            background: #3a3a4e;
            color: #ccc;
        }

        .form-container {
            background: rgba(42, 42, 62, 0.8);
            border-radius: 12px;
            padding: 30px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .form-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 8px;
            text-align: left;
        }

        .form-subtitle {
            color: #a0a0a0;
            font-size: 0.9rem;
            margin-bottom: 25px;
            text-align: left;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #e0e0e0;
        }

        .form-input {
            width: 100%;
            padding: 14px 16px;
            background: #1a1a2e;
            border: 1px solid #333;
            border-radius: 8px;
            color: white;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-input::placeholder {
            color: #666;
        }

        .form-input:focus {
            outline: none;
            border-color: #4ade80;
            box-shadow: 0 0 0 3px rgba(74, 222, 128, 0.1);
        }

        .phone-input {
            display: flex;
            gap: 12px;
        }

        .country-code {
            background: #1a1a2e;
            border: 1px solid #333;
            border-radius: 8px;
            color: white;
            padding: 14px 16px;
            font-size: 1rem;
            min-width: 80px;
        }

        .phone-number {
            flex: 1;
        }

        .country-select {
            position: relative;
        }

        .country-input {
            padding-left: 40px;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>');
            background-repeat: no-repeat;
            background-position: 12px center;
        }

        .dropdown-arrow {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            color: #666;
        }

        .password-input {
            position: relative;
        }

        .password-dots {
            color: #666;
            letter-spacing: 4px;
            font-size: 1.2rem;
        }

        .submit-btn {
            width: 100%;
            padding: 14px 20px;
            background: #4ade80;
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .form-errors {
            background-color: #ffe6e6;
            border: 1px solid #ff6b6b;
            color: #ff6b6b;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .form-errors ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .form-errors li {
            margin-bottom: 10px;
        }

        .submit-btn:hover {
            background: #22c55e;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(74, 222, 128, 0.3);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .signup-only {
            transition: all 0.3s ease;
        }

        /* Responsive design */
        @media (max-width: 600px) {
            .header h1 {
                font-size: 2rem;
            }
            
            .form-container {
                padding: 25px 20px;
            }
        }

        /* Flag icon for Kenya */
        .country-flag {
            display: inline-block;
            width: 20px;
            height: 14px;
            background: linear-gradient(to bottom, #000 0%, #000 33%, #ff0000 33%, #ff0000 66%, #00ff00 66%, #00ff00 100%);
            margin-right: 8px;
            border-radius: 2px;
        }

        /* Animation for smooth transitions */
        .signup-only {
            opacity: 1;
            max-height: 200px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .signup-only.hidden {
            opacity: 0;
            max-height: 0;
            margin-bottom: 0;
            padding-top: 0;
            padding-bottom: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Welcome to Lotearn</h1>
            <p>Your trusted platform for cryptocurrency trading</p>
        </div>

        <div class="auth-buttons">
            <button class="auth-button active" id="loginBtn">Login</button>
            <button class="auth-button" id="signupBtn">Sign Up</button>
        </div>

        @if ($errors->any())
            <div class="form-errors" id="form-errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-container">
            <h2 class="form-title" id="formTitle">Welcome back</h2>
            <p class="form-subtitle" id="formSubtitle">Enter your credentials to access your account</p>

            <form method="POST" action="{{ route('login') }}" id="authForm">
                @csrf
                <div class="form-group signup-only hidden" id="nameGroup">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-input" placeholder="John Doe" />
                </div>

                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" required class="form-input" placeholder="your@email.com" />
                </div>

                <div class="form-group signup-only hidden" id="phoneGroup">
                    <label class="form-label">Phone Number</label>
                    <div class="phone-input">
                        <select class="country-code" name="country_code" required>
                            <option value="+93">🇦🇫 Afghanistan (+93)</option>
                            <option value="+355">🇦🇱 Albania (+355)</option>
                            <option value="+213">🇩🇿 Algeria (+213)</option>
                            <option value="+376">🇦🇩 Andorra (+376)</option>
                            <option value="+244">🇦🇴 Angola (+244)</option>
                            <option value="+1-268">🇦🇬 Antigua & Barbuda (+1-268)</option>
                            <option value="+54">🇦🇷 Argentina (+54)</option>
                            <option value="+374">🇦🇲 Armenia (+374)</option>
                            <option value="+61">🇦🇺 Australia (+61)</option>
                            <option value="+43">🇦🇹 Austria (+43)</option>
                            <option value="+994">🇦🇿 Azerbaijan (+994)</option>
                            <option value="+973">🇧🇭 Bahrain (+973)</option>
                            <option value="+880">🇧🇩 Bangladesh (+880)</option>
                            <option value="+1-246">🇧🇧 Barbados (+1-246)</option>
                            <option value="+375">🇧🇾 Belarus (+375)</option>
                            <option value="+32">🇧🇪 Belgium (+32)</option>
                            <option value="+229">🇧🇯 Benin (+229)</option>
                            <option value="+975">🇧🇹 Bhutan (+975)</option>
                            <option value="+591">🇧🇴 Bolivia (+591)</option>
                            <option value="+387">🇧🇦 Bosnia & Herzegovina (+387)</option>
                            <option value="+267">🇧🇼 Botswana (+267)</option>
                            <option value="+55">🇧🇷 Brazil (+55)</option>
                            <option value="+673">🇧🇳 Brunei (+673)</option>
                            <option value="+359">🇧🇬 Bulgaria (+359)</option>
                            <option value="+226">🇧🇫 Burkina Faso (+226)</option>
                            <option value="+257">🇧🇮 Burundi (+257)</option>
                            <option value="+855">🇰🇭 Cambodia (+855)</option>
                            <option value="+237">🇨🇲 Cameroon (+237)</option>
                            <option value="+1">🇨🇦 Canada (+1)</option>
                            <option value="+238">🇨🇻 Cape Verde (+238)</option>
                            <option value="+236">🇨🇫 Central African Republic (+236)</option>
                            <option value="+235">🇹🇩 Chad (+235)</option>
                            <option value="+56">🇨🇱 Chile (+56)</option>
                            <option value="+86">🇨🇳 China (+86)</option>
                            <option value="+57">🇨🇴 Colombia (+57)</option>
                            <option value="+269">🇰🇲 Comoros (+269)</option>
                            <option value="+243">🇨🇩 Congo, Dem. Rep. (+243)</option>
                            <option value="+242">🇨🇬 Congo, Rep. (+242)</option>
                            <option value="+506">🇨🇷 Costa Rica (+506)</option>
                            <option value="+225">🇨🇮 Côte d’Ivoire (+225)</option>
                            <option value="+385">🇭🇷 Croatia (+385)</option>
                            <option value="+53">🇨🇺 Cuba (+53)</option>
                            <option value="+357">🇨🇾 Cyprus (+357)</option>
                            <option value="+420">🇨🇿 Czech Republic (+420)</option>
                            <option value="+45">🇩🇰 Denmark (+45)</option>
                            <option value="+253">🇩🇯 Djibouti (+253)</option>
                            <option value="+1-767">🇩🇲 Dominica (+1-767)</option>
                            <option value="+1-809">🇩🇴 Dominican Republic (+1-809)</option>
                            <option value="+593">🇪🇨 Ecuador (+593)</option>
                            <option value="+20">🇪🇬 Egypt (+20)</option>
                            <option value="+503">🇸🇻 El Salvador (+503)</option>
                            <option value="+240">🇬🇶 Equatorial Guinea (+240)</option>
                            <option value="+291">🇪🇷 Eritrea (+291)</option>
                            <option value="+372">🇪🇪 Estonia (+372)</option>
                            <option value="+251">🇪🇹 Ethiopia (+251)</option>
                            <option value="+679">🇫🇯 Fiji (+679)</option>
                            <option value="+358">🇫🇮 Finland (+358)</option>
                            <option value="+33">🇫🇷 France (+33)</option>
                            <option value="+241">🇬🇦 Gabon (+241)</option>
                            <option value="+220">🇬🇲 Gambia (+220)</option>
                            <option value="+995">🇬🇪 Georgia (+995)</option>
                            <option value="+49">🇩🇪 Germany (+49)</option>
                            <option value="+233">🇬🇭 Ghana (+233)</option>
                            <option value="+30">🇬🇷 Greece (+30)</option>
                            <option value="+1-473">🇬🇩 Grenada (+1-473)</option>
                            <option value="+502">🇬🇹 Guatemala (+502)</option>
                            <option value="+224">🇬🇳 Guinea (+224)</option>
                            <option value="+245">🇬🇼 Guinea-Bissau (+245)</option>
                            <option value="+592">🇬🇾 Guyana (+592)</option>
                            <option value="+509">🇭🇹 Haiti (+509)</option>
                            <option value="+504">🇭🇳 Honduras (+504)</option>
                            <option value="+36">🇭🇺 Hungary (+36)</option>
                            <option value="+354">🇮🇸 Iceland (+354)</option>
                            <option value="+91">🇮🇳 India (+91)</option>
                            <option value="+62">🇮🇩 Indonesia (+62)</option>
                            <option value="+98">🇮🇷 Iran (+98)</option>
                            <option value="+964">🇮🇶 Iraq (+964)</option>
                            <option value="+353">🇮🇪 Ireland (+353)</option>
                            <option value="+972">🇮🇱 Israel (+972)</option>
                            <option value="+39">🇮🇹 Italy (+39)</option>
                            <option value="+1-876">🇯🇲 Jamaica (+1-876)</option>
                            <option value="+81">🇯🇵 Japan (+81)</option>
                            <option value="+962">🇯🇴 Jordan (+962)</option>
                            <option value="+7">🇰🇿 Kazakhstan (+7)</option>
                            <option value="+254">🇰🇪 Kenya (+254)</option>
                            <option value="+686">🇰🇮 Kiribati (+686)</option>
                            <option value="+965">🇰🇼 Kuwait (+965)</option>
                            <option value="+996">🇰🇬 Kyrgyzstan (+996)</option>
                            <option value="+856">🇱🇦 Laos (+856)</option>
                            <option value="+371">🇱🇻 Latvia (+371)</option>
                            <option value="+961">🇱🇧 Lebanon (+961)</option>
                            <option value="+266">🇱🇸 Lesotho (+266)</option>
                            <option value="+231">🇱🇷 Liberia (+231)</option>
                            <option value="+218">🇱🇾 Libya (+218)</option>
                            <option value="+423">🇱🇮 Liechtenstein (+423)</option>
                            <option value="+370">🇱🇹 Lithuania (+370)</option>
                            <option value="+352">🇱🇺 Luxembourg (+352)</option>
                            <option value="+261">🇲🇬 Madagascar (+261)</option>
                            <option value="+265">🇲🇼 Malawi (+265)</option>
                            <option value="+60">🇲🇾 Malaysia (+60)</option>
                            <option value="+960">🇲🇻 Maldives (+960)</option>
                            <option value="+223">🇲🇱 Mali (+223)</option>
                            <option value="+356">🇲🇹 Malta (+356)</option>
                            <option value="+692">🇲🇭 Marshall Islands (+692)</option>
                            <option value="+222">🇲🇷 Mauritania (+222)</option>
                            <option value="+230">🇲🇺 Mauritius (+230)</option>
                            <option value="+52">🇲🇽 Mexico (+52)</option>
                            <option value="+691">🇫🇲 Micronesia (+691)</option>
                            <option value="+373">🇲🇩 Moldova (+373)</option>
                            <option value="+377">🇲🇨 Monaco (+377)</option>
                            <option value="+976">🇲🇳 Mongolia (+976)</option>
                            <option value="+382">🇲🇪 Montenegro (+382)</option>
                            <option value="+212">🇲🇦 Morocco (+212)</option>
                            <option value="+258">🇲🇿 Mozambique (+258)</option>
                            <option value="+95">🇲🇲 Myanmar (+95)</option>
                            <option value="+264">🇳🇦 Namibia (+264)</option>
                            <option value="+674">🇳🇷 Nauru (+674)</option>
                            <option value="+977">🇳🇵 Nepal (+977)</option>
                            <option value="+31">🇳🇱 Netherlands (+31)</option>
                            <option value="+64">🇳🇿 New Zealand (+64)</option>
                            <option value="+505">🇳🇮 Nicaragua (+505)</option>
                            <option value="+227">🇳🇪 Niger (+227)</option>
                            <option value="+234">🇳🇬 Nigeria (+234)</option>
                            <option value="+47">🇳🇴 Norway (+47)</option>
                            <option value="+968">🇴🇲 Oman (+968)</option>
                            <option value="+92">🇵🇰 Pakistan (+92)</option>
                            <option value="+680">🇵🇼 Palau (+680)</option>
                            <option value="+970">🇵🇸 Palestine (+970)</option>
                            <option value="+507">🇵🇦 Panama (+507)</option>
                            <option value="+675">🇵🇬 Papua New Guinea (+675)</option>
                            <option value="+595">🇵🇾 Paraguay (+595)</option>
                            <option value="+51">🇵🇪 Peru (+51)</option>
                            <option value="+63">🇵🇭 Philippines (+63)</option>
                            <option value="+48">🇵🇱 Poland (+48)</option>
                            <option value="+351">🇵🇹 Portugal (+351)</option>
                            <option value="+974">🇶🇦 Qatar (+974)</option>
                            <option value="+40">🇷🇴 Romania (+40)</option>
                            <option value="+7">🇷🇺 Russia (+7)</option>
                            <option value="+250">🇷🇼 Rwanda (+250)</option>
                            <option value="+966">🇸🇦 Saudi Arabia (+966)</option>
                            <option value="+221">🇸🇳 Senegal (+221)</option>
                            <option value="+381">🇷🇸 Serbia (+381)</option>
                            <option value="+248">🇸🇨 Seychelles (+248)</option>
                            <option value="+232">🇸🇱 Sierra Leone (+232)</option>
                            <option value="+65">🇸🇬 Singapore (+65)</option>
                            <option value="+421">🇸🇰 Slovakia (+421)</option>
                            <option value="+386">🇸🇮 Slovenia (+386)</option>
                            <option value="+677">🇸🇧 Solomon Islands (+677)</option>
                            <option value="+252">🇸🇴 Somalia (+252)</option>
                            <option value="+27">🇿🇦 South Africa (+27)</option>
                            <option value="+82">🇰🇷 South Korea (+82)</option>
                            <option value="+34">🇪🇸 Spain (+34)</option>
                            <option value="+94">🇱🇰 Sri Lanka (+94)</option>
                            <option value="+249">🇸🇩 Sudan (+249)</option>
                            <option value="+597">🇸🇷 Suriname (+597)</option>
                            <option value="+268">🇸🇿 Eswatini (+268)</option>
                            <option value="+46">🇸🇪 Sweden (+46)</option>
                            <option value="+41">🇨🇭 Switzerland (+41)</option>
                            <option value="+963">🇸🇾 Syria (+963)</option>
                            <option value="+886">🇹🇼 Taiwan (+886)</option>
                            <option value="+992">🇹🇯 Tajikistan (+992)</option>
                            <option value="+255">🇹🇿 Tanzania (+255)</option>
                            <option value="+66">🇹🇭 Thailand (+66)</option>
                            <option value="+228">🇹🇬 Togo (+228)</option>
                            <option value="+676">🇹🇴 Tonga (+676)</option>
                            <option value="+1-868">🇹🇹 Trinidad & Tobago (+1-868)</option>
                            <option value="+216">🇹🇳 Tunisia (+216)</option>
                            <option value="+90">🇹🇷 Turkey (+90)</option>
                            <option value="+993">🇹🇲 Turkmenistan (+993)</option>
                            <option value="+256">🇺🇬 Uganda (+256)</option>
                            <option value="+380">🇺🇦 Ukraine (+380)</option>
                            <option value="+971">🇦🇪 United Arab Emirates (+971)</option>
                            <option value="+44">🇬🇧 United Kingdom (+44)</option>
                            <option value="+1" selected> 🇺🇸 United States (+1)</option>
                            <option value="+598">🇺🇾 Uruguay (+598)</option>
                            <option value="+998">🇺🇿 Uzbekistan (+998)</option>
                            <option value="+678">🇻🇺 Vanuatu (+678)</option>
                            <option value="+379">🇻🇦 Vatican City (+379)</option>
                            <option value="+58">🇻🇪 Venezuela (+58)</option>
                            <option value="+84">🇻🇳 Vietnam (+84)</option>
                            <option value="+967">🇾🇪 Yemen (+967)</option>
                            <option value="+260">🇿🇲 Zambia (+260)</option>
                            <option value="+263">🇿🇼 Zimbabwe (+263)</option>
                        </select>
                        <input type="tel" name="phone_number" class="form-input phone-number" placeholder="123456789" required />
                    </div>
                </div>
                
                <div class="form-group signup-only hidden" id="countryGroup">
                    <label class="form-label">Country</label>
                    <div class="country-select">
                        <select class="form-input country-input" name="country" required>
                            <option value="Afghanistan">Afghanistan</option>
                            <option value="Albania">Albania</option>
                            <option value="Algeria">Algeria</option>
                            <option value="Andorra">Andorra</option>
                            <option value="Angola">Angola</option>
                            <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                            <option value="Argentina">Argentina</option>
                            <option value="Armenia">Armenia</option>
                            <option value="Australia">Australia</option>
                            <option value="Austria">Austria</option>
                            <option value="Azerbaijan">Azerbaijan</option>
                            <option value="Bahamas">Bahamas</option>
                            <option value="Bahrain">Bahrain</option>
                            <option value="Bangladesh">Bangladesh</option>
                            <option value="Barbados">Barbados</option>
                            <option value="Belarus">Belarus</option>
                            <option value="Belgium">Belgium</option>
                            <option value="Belize">Belize</option>
                            <option value="Benin">Benin</option>
                            <option value="Bhutan">Bhutan</option>
                            <option value="Bolivia">Bolivia</option>
                            <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                            <option value="Botswana">Botswana</option>
                            <option value="Brazil">Brazil</option>
                            <option value="Brunei">Brunei</option>
                            <option value="Bulgaria">Bulgaria</option>
                            <option value="Burkina Faso">Burkina Faso</option>
                            <option value="Burundi">Burundi</option>
                            <option value="Cambodia">Cambodia</option>
                            <option value="Cameroon">Cameroon</option>
                            <option value="Canada">Canada</option>
                            <option value="Cape Verde">Cape Verde</option>
                            <option value="Central African Republic">Central African Republic</option>
                            <option value="Chad">Chad</option>
                            <option value="Chile">Chile</option>
                            <option value="China">China</option>
                            <option value="Colombia">Colombia</option>
                            <option value="Comoros">Comoros</option>
                            <option value="Congo, Democratic Republic">Congo, Democratic Republic</option>
                            <option value="Congo, Republic">Congo, Republic</option>
                            <option value="Costa Rica">Costa Rica</option>
                            <option value="Côte d’Ivoire">Côte d’Ivoire</option>
                            <option value="Croatia">Croatia</option>
                            <option value="Cuba">Cuba</option>
                            <option value="Cyprus">Cyprus</option>
                            <option value="Czech Republic">Czech Republic</option>
                            <option value="Denmark">Denmark</option>
                            <option value="Djibouti">Djibouti</option>
                            <option value="Dominica">Dominica</option>
                            <option value="Dominican Republic">Dominican Republic</option>
                            <option value="Ecuador">Ecuador</option>
                            <option value="Egypt">Egypt</option>
                            <option value="El Salvador">El Salvador</option>
                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                            <option value="Eritrea">Eritrea</option>
                            <option value="Estonia">Estonia</option>
                            <option value="Ethiopia">Ethiopia</option>
                            <option value="Fiji">Fiji</option>
                            <option value="Finland">Finland</option>
                            <option value="France">France</option>
                            <option value="Gabon">Gabon</option>
                            <option value="Gambia">Gambia</option>
                            <option value="Georgia">Georgia</option>
                            <option value="Germany">Germany</option>
                            <option value="Ghana">Ghana</option>
                            <option value="Greece">Greece</option>
                            <option value="Grenada">Grenada</option>
                            <option value="Guatemala">Guatemala</option>
                            <option value="Guinea">Guinea</option>
                            <option value="Guinea-Bissau">Guinea-Bissau</option>
                            <option value="Guyana">Guyana</option>
                            <option value="Haiti">Haiti</option>
                            <option value="Honduras">Honduras</option>
                            <option value="Hungary">Hungary</option>
                            <option value="Iceland">Iceland</option>
                            <option value="India">India</option>
                            <option value="Indonesia">Indonesia</option>
                            <option value="Iran">Iran</option>
                            <option value="Iraq">Iraq</option>
                            <option value="Ireland">Ireland</option>
                            <option value="Israel">Israel</option>
                            <option value="Italy">Italy</option>
                            <option value="Jamaica">Jamaica</option>
                            <option value="Japan">Japan</option>
                            <option value="Jordan">Jordan</option>
                            <option value="Kazakhstan">Kazakhstan</option>
                            <option value="Kenya">Kenya</option>
                            <option value="Kiribati">Kiribati</option>
                            <option value="Kuwait">Kuwait</option>
                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                            <option value="Laos">Laos</option>
                            <option value="Latvia">Latvia</option>
                            <option value="Lebanon">Lebanon</option>
                            <option value="Lesotho">Lesotho</option>
                            <option value="Liberia">Liberia</option>
                            <option value="Libya">Libya</option>
                            <option value="Liechtenstein">Liechtenstein</option>
                            <option value="Lithuania">Lithuania</option>
                            <option value="Luxembourg">Luxembourg</option>
                            <option value="Madagascar">Madagascar</option>
                            <option value="Malawi">Malawi</option>
                            <option value="Malaysia">Malaysia</option>
                            <option value="Maldives">Maldives</option>
                            <option value="Mali">Mali</option>
                            <option value="Malta">Malta</option>
                            <option value="Marshall Islands">Marshall Islands</option>
                            <option value="Mauritania">Mauritania</option>
                            <option value="Mauritius">Mauritius</option>
                            <option value="Mexico">Mexico</option>
                            <option value="Micronesia">Micronesia</option>
                            <option value="Moldova">Moldova</option>
                            <option value="Monaco">Monaco</option>
                            <option value="Mongolia">Mongolia</option>
                            <option value="Montenegro">Montenegro</option>
                            <option value="Morocco">Morocco</option>
                            <option value="Mozambique">Mozambique</option>
                            <option value="Myanmar">Myanmar</option>
                            <option value="Namibia">Namibia</option>
                            <option value="Nauru">Nauru</option>
                            <option value="Nepal">Nepal</option>
                            <option value="Netherlands">Netherlands</option>
                            <option value="New Zealand">New Zealand</option>
                            <option value="Nicaragua">Nicaragua</option>
                            <option value="Niger">Niger</option>
                            <option value="Nigeria">Nigeria</option>
                            <option value="Norway">Norway</option>
                            <option value="Oman">Oman</option>
                            <option value="Pakistan">Pakistan</option>
                            <option value="Palau">Palau</option>
                            <option value="Palestine">Palestine</option>
                            <option value="Panama">Panama</option>
                            <option value="Papua New Guinea">Papua New Guinea</option>
                            <option value="Paraguay">Paraguay</option>
                            <option value="Peru">Peru</option>
                            <option value="Philippines">Philippines</option>
                            <option value="Poland">Poland</option>
                            <option value="Portugal">Portugal</option>
                            <option value="Qatar">Qatar</option>
                            <option value="Romania">Romania</option>
                            <option value="Russia">Russia</option>
                            <option value="Rwanda">Rwanda</option>
                            <option value="Saudi Arabia">Saudi Arabia</option>
                            <option value="Senegal">Senegal</option>
                            <option value="Serbia">Serbia</option>
                            <option value="Seychelles">Seychelles</option>
                            <option value="Sierra Leone">Sierra Leone</option>
                            <option value="Singapore">Singapore</option>
                            <option value="Slovakia">Slovakia</option>
                            <option value="Slovenia">Slovenia</option>
                            <option value="Solomon Islands">Solomon Islands</option>
                            <option value="Somalia">Somalia</option>
                            <option value="South Africa">South Africa</option>
                            <option value="South Korea">South Korea</option>
                            <option value="Spain">Spain</option>
                            <option value="Sri Lanka">Sri Lanka</option>
                            <option value="Sudan">Sudan</option>
                            <option value="Suriname">Suriname</option>
                            <option value="Swaziland">Swaziland</option>
                            <option value="Sweden">Sweden</option>
                            <option value="Switzerland">Switzerland</option>
                            <option value="Syria">Syria</option>
                            <option value="Taiwan">Taiwan</option>
                            <option value="Tajikistan">Tajikistan</option>
                            <option value="Tanzania">Tanzania</option>
                            <option value="Thailand">Thailand</option>
                            <option value="Togo">Togo</option>
                            <option value="Tonga">Tonga</option>
                            <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                            <option value="Tunisia">Tunisia</option>
                            <option value="Turkey">Turkey</option>
                            <option value="Turkmenistan">Turkmenistan</option>
                            <option value="Uganda">Uganda</option>
                            <option value="Ukraine">Ukraine</option>
                            <option value="United Arab Emirates">United Arab Emirates</option>
                            <option value="United Kingdom">United Kingdom</option>
                            <option value="United States" selected>United States</option>
                            <option value="Uruguay">Uruguay</option>
                            <option value="Uzbekistan">Uzbekistan</option>
                            <option value="Vanuatu">Vanuatu</option>
                            <option value="Vatican City">Vatican City</option>
                            <option value="Venezuela">Venezuela</option>
                            <option value="Vietnam">Vietnam</option>
                            <option value="Yemen">Yemen</option>
                            <option value="Zambia">Zambia</option>
                            <option value="Zimbabwe">Zimbabwe</option>
                        </select>
                    </div>
                </div>
                
                

                <div class="form-group">
                    <label class="form-label">Password</label>
                    <div class="password-input">
                        <input type="password" name="password" required class="form-input" placeholder="Enter your password" />
                    </div>
                </div>

                <div class="form-group signup-only hidden" id="confirmPasswordGroup">
                    <label class="form-label">Confirm Password</label>
                    <div class="password-input">
                        <input type="password" name="password_confirmation" class="form-input" placeholder="Confirm your password" />
                    </div>
                </div>

                <button type="submit" class="submit-btn" id="submitBtn">
                    <span class="login-text">Login</span>
                    <span class="signup-text" style="display: none;">Create Account</span>
                </button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginBtn = document.getElementById('loginBtn');
            const signupBtn = document.getElementById('signupBtn');
            const formTitle = document.getElementById('formTitle');
            const formSubtitle = document.getElementById('formSubtitle');
            const authForm = document.getElementById('authForm');
            const submitBtn = document.getElementById('submitBtn');
            const signupOnlyFields = document.querySelectorAll('.signup-only');
            const signupText = document.querySelector('.signup-text');
            const loginText = document.querySelector('.login-text');

            // Check URL parameters to determine which tab to show
            const urlParams = new URLSearchParams(window.location.search);
            const tab = urlParams.get('tab');
            
            // If coming from logout or tab=login, show login tab
            if (tab === 'login' || window.location.search.includes('logout')) {
                showLoginForm();
            } else {
                // Default to login form (changed from signup)
                showLoginForm();
            }

            function showLoginForm() {
                // Update button states
                loginBtn.classList.add('active');
                signupBtn.classList.remove('active');
                
                // Hide signup fields
                signupOnlyFields.forEach(field => {
                    field.classList.add('hidden');
                    const inputs = field.querySelectorAll('input, select');
                    inputs.forEach(input => {
                        input.removeAttribute('required');
                        input.disabled = true;
                    });
                });
                
                // Update form content
                formTitle.textContent = 'Welcome back';
                formSubtitle.textContent = 'Enter your credentials to access your account';
                authForm.action = "{{ route('login') }}";
                
                // Update button text
                loginText.style.display = 'block';
                signupText.style.display = 'none';
            }

            function showSignupForm() {
                // Update button states
                signupBtn.classList.add('active');
                loginBtn.classList.remove('active');
                
                // Show signup fields
                signupOnlyFields.forEach(field => {
                    field.classList.remove('hidden');
                    const inputs = field.querySelectorAll('input, select');
                    inputs.forEach(input => {
                        input.disabled = false;
                        // Add required attribute back for signup fields
                        if (input.name === 'name' || input.name === 'country' || input.name === 'password_confirmation') {
                            input.setAttribute('required', 'required');
                        }
                    });
                });
                
                // Update form content
                formTitle.textContent = 'Create an account';
                formSubtitle.textContent = 'Enter your details to create a new account';
                authForm.action = "{{ route('register') }}";
                
                // Update button text
                signupText.style.display = 'block';
                loginText.style.display = 'none';
            }
            
            loginBtn.addEventListener('click', showLoginForm);
            signupBtn.addEventListener('click', showSignupForm);

            // Add focus effects
            const inputs = document.querySelectorAll('.form-input');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'translateY(-2px)';
                    this.parentElement.style.transition = 'transform 0.2s ease';
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'translateY(0)';
                });
            });

            // Handle form errors - if there are validation errors, show appropriate form
            const formErrors = document.getElementById('form-errors');
            if (formErrors) {
                // Check if errors are related to signup fields
                const errorText = formErrors.textContent.toLowerCase();
                if (errorText.includes('name') || errorText.includes('phone') || errorText.includes('country') || errorText.includes('confirmation')) {
                    showSignupForm();
                } else {
                    showLoginForm();
                }
            }
        });
    </script>
</body>
</html>