<x-guest-layout>
    <div class="auth-wrapper">
        <div class="login-card-enhanced">
            <div class="card-top-accent"></div>

            <div class="login-header">
                <div class="brand-circle">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                        stroke="#367bf4" style="margin-right: 5px;" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 8v-2a2 2 0 0 1 2 -2h7a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-2" />
                        <path d="M3 12h13l-3 -3" />
                        <path d="M13 15l3 -3" />
                    </svg>
                </div>
                <h1>Welcome Back</h1>
                <p>Access your clinic dashboard</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="auth-form">
                @csrf

                <div class="input-group-custom">
                    <label for="email">Email Address</label>
                    <div class="input-field">
                        <i class="far fa-envelope"></i>
                        <input id="email" type="email" name="email" :value="old('email')" required autofocus
                            placeholder="name@gmail.com">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="error-text" />
                </div>

                <div class="input-group-custom mt-4">
                    <label for="password">Password</label>
                    <div class="input-field">
                        <i class="fas fa-shield-alt"></i>
                        <input id="password" type="password" name="password" required placeholder="••••••••">
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="error-text" />
                </div>

                <div class="auth-utilities">
                    <label class="checkbox-container">
                        <input type="checkbox" name="remember">
                        <span class="checkmark"></span>
                        <span class="label-text">Remember me</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-link">Forgot password?</a>
                    @endif
                </div>

                <button type="submit" class="btn-submit-enhanced">
                    <span>Sign In</span>
                    <i class="fas fa-arrow-right"></i>
                </button>
            </form>
        </div>
    </div>

    <style>
        /* Container Background */
        .auth-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #f4f7fa;
        }

        /* Main Card */
        .login-card-enhanced {
            position: relative;
            background: #ffffff;
            width: 100%;
            max-width: 440px;
            padding: 50px 40px;
            border-radius: 24px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.04);
            overflow: hidden;
            border: 1px solid rgba(0, 0, 0, 0.02);
        }

        /* Blue Accent Top */
        .card-top-accent {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, #2563eb, #3b82f6);
        }

        /* Header & Icon */
        .login-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .brand-circle {
            width: 64px;
            height: 64px;
            background: #eff6ff;
            color: #2563eb;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 1.5rem;
        }

        .login-header h1 {
            font-size: 1.75rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .login-header p {
            color: #64748b;
            font-size: 0.95rem;
        }

        /* Input Fields */
        .input-group-custom label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: #334155;
            margin-bottom: 8px;
        }

        .input-field {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-field i {
            position: absolute;
            left: 16px;
            color: #94a3b8;
            transition: color 0.3s;
        }

        .input-field input {
            width: 100%;
            padding: 14px 16px 14px 9px;
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background: #fcfdfe;
        }

        .input-field input:focus {
            outline: none;
            border-color: #3b82f6;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }

        .input-field input:focus+i {
            color: #3b82f6;
        }

        /* Utilities */
        .auth-utilities {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px 0 30px;
        }

        .checkbox-container {
            display: flex;
            align-items: center;
            cursor: pointer;
            font-size: 0.85rem;
            color: #64748b;
        }

        .forgot-link {
            font-size: 0.85rem;
            color: #2563eb;
            text-decoration: none;
            font-weight: 600;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }

        /* Button */
        .btn-submit-enhanced {
            width: 100%;
            background: #2563eb;
            color: white;
            padding: 14px;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            font-size: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            cursor: pointer;
            transition: transform 0.2s, background 0.3s;
        }

        .btn-submit-enhanced:hover {
            background: #1d4ed8;
            transform: translateY(-2px);
        }

        .btn-submit-enhanced:active {
            transform: translateY(0);
        }
    </style>
</x-guest-layout>
