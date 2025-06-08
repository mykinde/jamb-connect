
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
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
        }

        @keyframes gradient {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        .nav-links {
            display: flex;
            gap: 1rem;
        }

        .nav-link {
            padding: 0.5rem 1.5rem;
            text-decoration: none;
            color: white;
            border-radius: 50px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .nav-link.primary {
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4);
            color: white;
            font-weight: 600;
        }

        .nav-link.secondary {
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
        }

        .nav-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }

        .nav-link.secondary:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.4);
        }

        /* Hero Section */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 2rem;
            position: relative;
        }

        .hero-content {
            max-width: 800px;
            animation: fadeInUp 1s ease-out;
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

        .hero-title {
            font-size: clamp(3rem, 8vw, 6rem);
            font-weight: 800;
            margin-bottom: 1.5rem;
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4, #45b7d1, #96ceb4);
            background-size: 400% 400%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: gradientShift 4s ease infinite;
            line-height: 1.1;
        }

        @keyframes gradientShift {
            0%, 100% { background-position: 0% 50%; }
            25% { background-position: 100% 50%; }
            50% { background-position: 100% 100%; }
            75% { background-position: 0% 100%; }
        }

        .hero-subtitle {
            font-size: 1.3rem;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 3rem;
            font-weight: 300;
            line-height: 1.6;
            animation: fadeInUp 1s ease-out 0.2s both;
        }

        .cta-buttons {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            flex-wrap: wrap;
            animation: fadeInUp 1s ease-out 0.4s both;
        }

        .cta-btn {
            padding: 1rem 2.5rem;
            font-size: 1.1rem;
            font-weight: 600;
            text-decoration: none;
            border-radius: 50px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            display: inline-block;
        }

        .cta-btn.primary {
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4);
            color: white;
            box-shadow: 0 10px 30px rgba(255, 107, 107, 0.3);
        }

        .cta-btn.secondary {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
        }

        .cta-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        }

        .cta-btn.primary:hover {
            box-shadow: 0 15px 40px rgba(255, 107, 107, 0.4);
        }

        .cta-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .cta-btn:hover::before {
            left: 100%;
        }

        /* Floating elements */
        .floating-element {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(45deg, rgba(255, 107, 107, 0.1), rgba(78, 205, 196, 0.1));
            animation: floatElement 6s ease-in-out infinite;
        }

        .floating-element:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .floating-element:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 60%;
            right: 15%;
            animation-delay: 2s;
        }

        .floating-element:nth-child(3) {
            width: 60px;
            height: 60px;
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }

        @keyframes floatElement {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        /* Footer */
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(15, 15, 35, 0.8);
            backdrop-filter: blur(20px);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 1rem 2rem;
            text-align: center;
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.9rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-container {
                padding: 1rem;
            }
            
            .nav-links {
                gap: 0.5rem;
            }
            
            .nav-link {
                padding: 0.4rem 1rem;
                font-size: 0.9rem;
            }
            
            .hero {
                padding: 1rem;
            }
            
            .cta-buttons {
                flex-direction: column;
                align-items: center;
                gap: 1rem;
            }
            
            .cta-btn {
                width: 100%;
                max-width: 300px;
                text-align: center;
            }
        }

        /* Glowing cursor effect */
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
            <div class="logo">{{ config('app.name', 'Laravel') }}</div>
            <div class="nav-links">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="nav-link secondary">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="nav-link secondary">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="nav-link primary">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <main class="hero">
        <!-- Floating elements -->
        <div class="floating-element"></div>
        <div class="floating-element"></div>
        <div class="floating-element"></div>
        
        <div class="hero-content">
            <h1 class="hero-title">{{ config('app.name', 'Laravel') }}</h1>
            <p class="hero-subtitle">
                Experience the power of modern web development with elegant code, 
                expressive syntax, and developer happiness at its core.
            </p>
            <div class="cta-buttons">
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="cta-btn primary">Get Started</a>
                @endif
                @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="cta-btn secondary">Sign In</a>
                @endif
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.</p>
    </footer>

    <script>
        // Create floating particles
        function createParticles() {
            const container = document.getElementById('particles');
            const particleCount = 50;
            
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

        // Header scroll effect
        function initHeaderScroll() {
            const header = document.querySelector('.header');
            let lastScrollY = window.scrollY;
            
            window.addEventListener('scroll', () => {
                const currentScrollY = window.scrollY;
                
                if (currentScrollY > 50) {
                    header.style.background = 'rgba(15, 15, 35, 0.95)';
                } else {
                    header.style.background = 'rgba(15, 15, 35, 0.8)';
                }
                
                lastScrollY = currentScrollY;
            });
        }

        // Initialize all effects
        document.addEventListener('DOMContentLoaded', () => {
            createParticles();
            initCursorGlow();
            initHeaderScroll();
        });
    </script>
</body>
</html>