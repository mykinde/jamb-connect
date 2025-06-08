<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('Log in') }} - {{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:100,200,300,400,500,600,700,800,900" rel="stylesheet" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0f0f23 0%, #1a1a2e 50%, #16213e 100%);
            color: white;
            overflow-x: hidden;
            min-height: 100vh;
        }

        /* Animated background particles */
        .bg-particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 15s infinite linear;
        }

        @keyframes float {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100px) rotate(360deg);
                opacity: 0;
            }
        }

        /* Header */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background: rgba(15, 15, 35, 0.8);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4, #45b7d1);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: gradient 3s ease infinite;
            text-decoration: none;
        }

        @keyframes gradient {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        .nav-link {
            padding: 0.5rem 1.5rem;
            text-decoration: none;
            color: white;
            border-radius: 50px;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
        }

        .nav-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.4);
        }

        /* Main Container */
        .main-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
            position: relative;
        }

        /* Login Card */
        .login-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 3rem;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
            animation: fadeInUp 0.8s ease-out;
            position: relative;
            overflow: hidden;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4, #45b7d1, #96ceb4);
            background-size: 400% 400%;
            border-radius: 24px;
            z-index: -1;
            animation: gradientShift 4s ease infinite;
            opacity: 0.3;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes gradientShift {
            0%, 100% { background-position: 0% 50%; }
            25% { background-position: 100% 50%; }
            50% { background-position: 100% 100%; }
            75% { background-position: 0% 100%; }
        }

        .login-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .login-title {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4, #45b7d1);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: gradient 3s ease infinite;
            margin-bottom: 0.5rem;
        }

        .login-subtitle {
            color: rgba(255, 255, 255, 0.7);
            font-size: 1rem;
            font-weight: 300;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
            font-size: 0.9rem;
        }

        .form-input {
            width: 100%;
            padding: 1rem 1.2rem;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            color: white;
            font-size: 1rem;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .form-input:focus {
            outline: none;
            border-color: #4ecdc4;
            box-shadow: 0 0 0 3px rgba(78, 205, 196, 0.1);
            background: rgba(255, 255, 255, 0.08);
        }

        .form-input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 2rem;
        }

        .checkbox {
            width: 18px;
            height: 18px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 4px;
            background: transparent;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .checkbox:checked {
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4);
            border-color: #4ecdc4;
        }

        .checkbox-label {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
            cursor: pointer;
            user-select: none;
        }

        .submit-btn {
            width: 100%;
            padding: 1rem 2rem;
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(255, 107, 107, 0.3);
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(255, 107, 107, 0.4);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .submit-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .submit-btn:hover::before {
            left: 100%;
        }

        .forgot-password {
            text-align: center;
            margin-top: 1.5rem;
        }

        .forgot-password a {
            color: #4ecdc4;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .forgot-password a:hover {
            color: #45b7d1;
        }

        .register-link {
            text-align: center;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .register-link p {
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 1rem;
        }

        .register-link a {
            display: inline-block;
            padding: 0.75rem 2rem;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .register-link a:hover {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.4);
            transform: translateY(-2px);
        }

        /* Error Messages */
        .error-message {
            color: #ff6b6b;
            font-size: 0.85rem;
            margin-top: 0.5rem;
            display: block;
        }

        .alert {
            background: rgba(255, 107, 107, 0.1);
            border: 1px solid rgba(255, 107, 107, 0.3);
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            color: #ff6b6b;
        }

        /* Floating elements */
        .floating-element {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(45deg, rgba(255, 107, 107, 0.1), rgba(78, 205, 196, 0.1));
            animation: floatElement 6s ease-in-out infinite;
        }

        .floating-element:nth-child(1) {
            width: 60px;
            height: 60px;
            top: 15%;
            left: 10%;
            animation-delay: 0s;
        }

        .floating-element:nth-child(2) {
            width: 80px;
            height: 80px;
            top: 70%;
            right: 15%;
            animation-delay: 2s;
        }

        .floating-element:nth-child(3) {
            width: 40px;
            height: 40px;
            bottom: 20%;
            left: 15%;
            animation-delay: 4s;
        }

        @keyframes floatElement {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(180deg); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-container {
                padding: 1rem;
            }
            
            .main-container {
                padding: 1rem;
            }
            
            .login-card {
                padding: 2rem 1.5rem;
                margin-top: 80px;
            }
            
            .login-title {
                font-size: 2rem;
            }
        }

        /* Cursor glow effect */
        .cursor-glow {
            position: fixed;
            width: 20px;
            height: 20px;
            background: radial-gradient(circle, rgba(78, 205, 196, 0.4) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
            z-index: 9999;
            transition: transform 0.1s ease;
        }
    </style>
</head>
<body>
    <!-- Animated background particles -->
    <div class="bg-particles" id="particles"></div>
    
    <!-- Cursor glow effect -->
    <div class="cursor-glow" id="cursorGlow"></div>

    <!-- Header -->
    <header class="header">
        <nav class="nav-container">
            <a href="/" class="logo">{{ config('app.name', 'Laravel') }}</a>
            <div>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="nav-link">Register</a>
                @endif
            </div>
        </nav>
    </header>

    <!-- Main Container -->
    <main class="main-container">
        <!-- Floating elements -->
        <div class="floating-element"></div>
        <div class="floating-element"></div>
        <div class="floating-element"></div>
        
        <div class="login-card">
            <div class="login-header">
                <h1 class="login-title">Welcome Back</h1>
                <p class="login-subtitle">Sign in to your account</p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                    <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="Enter your email">
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <input id="password" class="form-input" type="password" name="password" required autocomplete="current-password" placeholder="Enter your password">
                    @error('password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="checkbox-group">
                    <input id="remember_me" type="checkbox" class="checkbox" name="remember">
                    <label for="remember_me" class="checkbox-label">{{ __('Remember me') }}</label>
                </div>

                <button type="submit" class="submit-btn">
                    {{ __('Log in') }}
                </button>

                @if (Route::has('password.request'))
                    <div class="forgot-password">
                        <a href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    </div>
                @endif
            </form>

            @if (Route::has('register'))
                <div class="register-link">
                    <p>Don't have an account?</p>
                    <a href="{{ route('register') }}">Create Account</a>
                </div>
            @endif
        </div>
    </main>

    <script>
        // Create floating particles
        function createParticles() {
            const container = document.getElementById('particles');
            const particleCount = 30;
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.width = particle.style.height = Math.random() * 4 + 1 + 'px';
                particle.style.animationDuration = Math.random() * 10 + 10 + 's';
                particle.style.animationDelay = Math.random() * 15 + 's';
                container.appendChild(particle);
            }
        }

        // Cursor glow effect
        function initCursorGlow() {
            const cursorGlow = document.getElementById('cursorGlow');
            
            document.addEventListener('mousemove', (e) => {
                cursorGlow.style.left = e.clientX - 10 + 'px';
                cursorGlow.style.top = e.clientY - 10 + 'px';
            });
        }

        // Enhanced form interactions
        function initFormInteractions() {
            const inputs = document.querySelectorAll('.form-input');
            
            inputs.forEach(input => {
                // Add floating label effect
                input.addEventListener('focus', function() {
                    this.style.transform = 'scale(1.02)';
                });
                
                input.addEventListener('blur', function() {
                    this.style.transform = 'scale(1)';
                });
                
                // Add input validation feedback
                input.addEventListener('input', function() {
                    if (this.validity.valid) {
                        this.style.borderColor = '#4ecdc4';
                        this.style.boxShadow = '0 0 0 3px rgba(78, 205, 196, 0.1)';
                    } else if (this.value.length > 0) {
                        this.style.borderColor = '#ff6b6b';
                        this.style.boxShadow = '0 0 0 3px rgba(255, 107, 107, 0.1)';
                    }
                });
            });

            // Custom checkbox styling
            const checkboxes = document.querySelectorAll('.checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    if (this.checked) {
                        this.style.transform = 'scale(1.1)';
                        setTimeout(() => {
                            this.style.transform = 'scale(1)';
                        }, 150);
                    }
                });
            });
        }

        // Submit button loading effect
        function initSubmitButton() {
            const form = document.querySelector('form');
            const submitBtn = document.querySelector('.submit-btn');
            
            form.addEventListener('submit', function() {
                submitBtn.innerHTML = '<span style="opacity: 0.7;">Signing in...</span>';
                submitBtn.style.background = 'linear-gradient(45deg, #666, #888)';
                submitBtn.disabled = true;
            });
        }

        // Initialize all effects
        document.addEventListener('DOMContentLoaded', () => {
            createParticles();
            initCursorGlow();
            initFormInteractions();
            initSubmitButton();
        });
    </script>
</body>
</html>