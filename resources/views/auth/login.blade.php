<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Premium | SEKAI TECH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-900: #06070D;
            --primary-500: #1A1C2E;
            --accent-400: #7C4DFF;
            --accent-300: #9A79FF;
            --neon-effect: 0 0 15px rgba(124, 77, 255, 0.4);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background: var(--primary-900);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .cosmic-wrapper {
            position: fixed;
            width: 100vw;
            height: 100vh;
            background: 
                radial-gradient(circle at 10% 20%, var(--accent-400) 0%, transparent 30%),
                radial-gradient(circle at 90% 80%, var(--accent-300) 0%, transparent 30%);
            animation: cosmic-flow 20s linear infinite alternate;
            z-index: 0;
        }

        @keyframes cosmic-flow {
            0% { background-position: 0% 0%; }
            100% { background-position: 100% 100%; }
        }

        .auth-container {
            position: relative;
            width: 100%;
            max-width: 480px;
            background: rgba(10, 12, 25, 0.95);
            backdrop-filter: blur(24px);
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: var(--neon-effect), 0 24px 48px rgba(0, 0, 0, 0.25);
            padding: 3rem;
            transform: translateY(0);
            transition: transform 0.6s cubic-bezier(0.23, 1, 0.32, 1);
            z-index: 2;
            overflow: hidden;
        }

        .auth-container:hover {
            transform: translateY(-8px);
        }

        .auth-container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: conic-gradient(
                transparent 20deg,
                var(--accent-400) 180deg,
                transparent 200deg
            );
            animation: rotate-border 18s linear infinite;
            z-index: -1;
        }

        @keyframes rotate-border {
            100% { transform: rotate(360deg); }
        }

        .auth-header {
            text-align: center;
            margin-bottom: 2.5rem;
            position: relative;
        }

        .auth-title {
            color: #FFF;
            font-size: 2.2rem;
            font-weight: 700;
            letter-spacing: -0.5px;
            margin-bottom: 0.5rem;
            background: linear-gradient(45deg, #FFF 65%, var(--accent-300));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .auth-subtitle {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.9rem;
            font-weight: 400;
        }

        .input-group {
            position: relative;
            margin-bottom: 2rem;
        }

        .input-field {
            width: 100%;
            padding: 1.2rem;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            color: #FFF;
            font-size: 1rem;
            transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .input-field:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.05);
            border-color: var(--accent-400);
            box-shadow: 0 0 0 3px rgba(124, 77, 255, 0.2);
        }

        .input-label {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.4);
            pointer-events: none;
            transition: all 0.3s ease;
        }

        .input-field:focus ~ .input-label,
        .input-field:not(:placeholder-shown) ~ .input-label {
            top: -10px;
            left: 0.8rem;
            font-size: 0.8rem;
            color: var(--accent-300);
        }

        .submit-btn {
            width: 100%;
            padding: 1.2rem;
            background: linear-gradient(135deg, var(--accent-400), var(--accent-300));
            border: none;
            border-radius: 12px;
            color: #FFF;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
            position: relative;
            overflow: hidden;
        }

        .submit-btn::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                45deg,
                transparent 20%,
                rgba(255, 255, 255, 0.1) 50%,
                transparent 80%
            );
            transform: rotate(45deg);
            animation: btn-shine 3s infinite;
        }

        @keyframes btn-shine {
            0% { transform: translateX(-100%) rotate(45deg); }
            100% { transform: translateX(100%) rotate(45deg); }
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(124, 77, 255, 0.3);
        }

        .error-message {
            background: rgba(255, 72, 72, 0.1);
            border: 1px solid rgba(255, 72, 72, 0.2);
            color: #FF4848;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            backdrop-filter: blur(4px);
            animation: error-shake 0.4s ease;
        }

        @keyframes error-shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(8px); }
            75% { transform: translateX(-8px); }
        }

        .particle-network {
            position: fixed;
            width: 100vw;
            height: 100vh;
            z-index: 1;
        }
    </style>
</head>
<body>
    <div class="cosmic-wrapper"></div>
    
    <div class="particle-network"></div>

    <div class="auth-container" data-aos="zoom-in" data-aos-duration="800">
        <div class="auth-header">
            <h1 class="auth-title">Acceso Privilegiado</h1>
            <p class="auth-subtitle">Sistema de Gestión SEKAI TECH</p>
        </div>

        @if ($errors->any())
            <div class="error-message">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="input-group">
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    class="input-field" 
                    placeholder=" "
                    required
                >
                <label class="input-label">Correo institucional</label>
            </div>

            <div class="input-group">
                <input 
                    type="password" 
                    name="password" 
                    id="password" 
                    class="input-field" 
                    placeholder=" "
                    required
                >
                <label class="input-label">Clave de acceso</label>
            </div>

            <button type="submit" class="submit-btn">
                <span class="btn-text">Verificar Identidad</span>
            </button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            disable: 'mobile'
        });

        // Efecto de partículas dinámico
        class ParticleNetwork {
            constructor() {
                this.canvas = document.createElement('canvas');
                document.querySelector('.particle-network').appendChild(this.canvas);
                this.ctx = this.canvas.getContext('2d');
                this.particles = [];
                this.resize();
                this.init();
                
                window.addEventListener('resize', () => this.resize());
            }

            resize() {
                this.width = window.innerWidth;
                this.height = window.innerHeight;
                this.canvas.width = this.width;
                this.canvas.height = this.height;
            }

            init() {
                // Inicializar partículas
                for(let i = 0; i < 100; i++) {
                    this.particles.push({
                        x: Math.random() * this.width,
                        y: Math.random() * this.height,
                        size: Math.random() * 2 + 1,
                        speedX: (Math.random() - 0.5) * 0.2,
                        speedY: (Math.random() - 0.5) * 0.2
                    });
                }
                this.animate();
            }

            animate() {
                this.ctx.clearRect(0, 0, this.width, this.height);
                
                this.ctx.fillStyle = `rgba(124, 77, 255, 0.5)`;
                this.particles.forEach(particle => {
                    particle.x += particle.speedX;
                    particle.y += particle.speedY;

                    if(particle.x < 0 || particle.x > this.width) particle.speedX *= -1;
                    if(particle.y < 0 || particle.y > this.height) particle.speedY *= -1;

                    this.ctx.beginPath();
                    this.ctx.arc(particle.x, particle.y, particle.size, 0, Math.PI * 2);
                    this.ctx.fill();
                });

                requestAnimationFrame(() => this.animate());
            }
        }

        new ParticleNetwork();
    </script>
</body>
</html>