<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benedick Cadiz | Web Developer & Video Editor</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome for Social Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* --- RESET & VARIABLES --- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* --- THEME DEFINITIONS --- */
        
        /* 1. Dark Cyan (Default) */
        :root, body[data-theme="dark-cyan"] {
            --bg-dark: #0b0f19;
            --bg-card: rgba(30, 41, 59, 0.6);
            --accent-glow: #00d2ff;
            --accent-gradient: linear-gradient(135deg, #00d2ff 0%, #3a7bd5 100%);
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --glass-bg: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.1);
            --blob-opacity: 0.15;
            --grid-color: rgba(255, 255, 255, 0.04);
        }

        /* 2. Light Mode */
        body[data-theme="light"] {
            --bg-dark: #f8f9fa;
            --bg-card: rgba(255, 255, 255, 0.8);
            --accent-glow: #1abc9c;
            --accent-gradient: linear-gradient(135deg, #1abc9c 0%, #16a085 100%);
            --text-main: #2c3e50;
            --text-muted: #6c757d;
            --glass-bg: rgba(0, 0, 0, 0.03);
            --glass-border: rgba(0, 0, 0, 0.08);
            --blob-opacity: 0.1;
            --grid-color: rgba(0, 0, 0, 0.05);
        }

        /* 3. Purple Haze */
        body[data-theme="purple"] {
            --bg-dark: #1a0b2e;
            --bg-card: rgba(45, 20, 80, 0.6);
            --accent-glow: #c084fc;
            --accent-gradient: linear-gradient(135deg, #c084fc 0%, #9333ea 100%);
            --text-main: #f3e8ff;
            --text-muted: #b8a3d9;
            --glass-bg: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.1);
            --blob-opacity: 0.2;
            --grid-color: rgba(255, 255, 255, 0.04);
        }

        /* 4. Emerald Night */
        body[data-theme="emerald"] {
            --bg-dark: #061a14;
            --bg-card: rgba(10, 40, 30, 0.6);
            --accent-glow: #34d399;
            --accent-gradient: linear-gradient(135deg, #34d399 0%, #059669 100%);
            --text-main: #ecfdf5;
            --text-muted: #9cb8b0;
            --glass-bg: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.1);
            --blob-opacity: 0.15;
            --grid-color: rgba(255, 255, 255, 0.04);
        }

        /* --- BASE STYLES --- */
        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-main);
            background-color: var(--bg-dark);
            overflow-x: hidden;
            position: relative;
            transition: background-color 0.5s ease, color 0.5s ease;
            cursor: none;
        }
        a, button, .color-opt { cursor: none; }
        a { text-decoration: none; color: inherit; }
        ul { list-style: none; }

        /* --- SCROLL PROGRESS BAR --- */
        .scroll-progress {
            position: fixed;
            top: 0;
            left: 0;
            height: 4px;
            background: var(--accent-gradient);
            z-index: 10000;
            width: 0%;
            transition: width 0.1s ease-out;
            box-shadow: 0 0 10px var(--accent-glow);
        }

        /* --- CUSTOM GLOWING CURSOR --- */
        .cursor {
            width: 20px;
            height: 20px;
            border: 2px solid var(--accent-glow);
            border-radius: 50%;
            position: fixed;
            pointer-events: none;
            z-index: 9999;
            transition: width 0.2s ease, height 0.2s ease, background 0.2s ease;
            transform: translate(-50%, -50%);
            box-shadow: 0 0 15px var(--accent-glow);
        }
        .cursor.hovering {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-color: var(--text-main);
        }

        /* --- CLICK RIPPLE EFFECT --- */
        .ripple {
            position: fixed;
            border-radius: 50%;
            border: 2px solid var(--accent-glow);
            pointer-events: none;
            z-index: 9998;
            transform: translate(-50%, -50%) scale(0);
            opacity: 1;
            animation: rippleAnim 0.6s ease-out forwards;
        }
        @keyframes rippleAnim {
            0% { transform: translate(-50%, -50%) scale(0); opacity: 1; }
            100% { transform: translate(-50%, -50%) scale(4); opacity: 0; }
        }

        /* --- ANIMATED BACKGROUND EFFECTS --- */
        .bg-effects {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: -1;
            overflow: hidden;
            pointer-events: none;
        }

        #particleCanvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -2;
        }

        .bg-grid {
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background-image:
                linear-gradient(to right, var(--grid-color) 1px, transparent 1px),
                linear-gradient(to bottom, var(--grid-color) 1px, transparent 1px);
            background-size: 60px 60px;
            animation: gridMove 20s linear infinite;
            mask-image: radial-gradient(circle at center, black 20%, transparent 70%);
            -webkit-mask-image: radial-gradient(circle at center, black 20%, transparent 70%);
            transition: background-image 0.5s ease;
        }
        @keyframes gridMove {
            0% { transform: translate(0, 0); }
            100% { transform: translate(60px, 60px); }
        }

        .aurora {
            position: absolute;
            bottom: -20%;
            left: 0;
            width: 100%;
            height: 60%;
            background: radial-gradient(ellipse at bottom, var(--accent-glow) 0%, transparent 70%);
            opacity: 0.1;
            filter: blur(80px);
            animation: auroraPulse 10s infinite alternate ease-in-out;
        }
        @keyframes auroraPulse {
            0% { transform: scale(1) translateY(0); opacity: 0.05; }
            100% { transform: scale(1.3) translateY(-50px); opacity: 0.15; }
        }

        .meteor {
            position: absolute;
            width: 2px;
            height: 100px;
            background: linear-gradient(to bottom, transparent, var(--accent-glow), #fff);
            border-radius: 50%;
            box-shadow: 0 0 10px var(--accent-glow);
            transform: rotate(-45deg);
            opacity: 0;
        }
        @keyframes meteorFall {
            0% { transform: translate(0, 0) rotate(-45deg); opacity: 1; }
            100% { transform: translate(-80vw, 80vh) rotate(-45deg); opacity: 0; }
        }

        .code-snippet {
            position: absolute;
            color: var(--accent-glow);
            font-family: 'Courier New', monospace;
            font-weight: bold;
            opacity: 0.05;
            animation: floatCode linear infinite;
            user-select: none;
        }
        @keyframes floatCode {
            0% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
            10% { opacity: 0.08; }
            90% { opacity: 0.08; }
            100% { transform: translateY(-100px) rotate(360deg); opacity: 0; }
        }

        .shape {
            position: absolute;
            border: 1px solid var(--accent-glow);
            opacity: 0.05;
            animation: spin linear infinite;
        }
        .shape.triangle {
            width: 0; height: 0;
            border-left: 25px solid transparent;
            border-right: 25px solid transparent;
            border-bottom: 43px solid var(--accent-glow);
            background: transparent;
        }
        .shape.square {
            width: 35px; height: 35px;
            border-radius: 4px;
        }
        .shape.circle {
            width: 25px; height: 25px;
            border-radius: 50%;
        }
        @keyframes spin {
            0% { transform: rotate(0deg) translateY(0) scale(1); }
            100% { transform: rotate(360deg) translateY(-30px) scale(1.1); }
        }

        .blob-1 {
            position: absolute;
            top: -10%;
            left: -10%;
            width: 50vw;
            height: 50vw;
            background: radial-gradient(circle, var(--accent-glow) 0%, transparent 70%);
            opacity: var(--blob-opacity);
            border-radius: 50%;
            filter: blur(100px);
            animation: float1 10s infinite alternate ease-in-out;
            transition: background 0.5s ease, opacity 0.5s ease;
        }
        .blob-2 {
            position: absolute;
            bottom: -10%;
            right: -10%;
            width: 60vw;
            height: 60vw;
            background: radial-gradient(circle, var(--accent-glow) 0%, transparent 70%);
            opacity: var(--blob-opacity);
            border-radius: 50%;
            filter: blur(100px);
            animation: float2 14s infinite alternate-reverse ease-in-out;
            transition: background 0.5s ease, opacity 0.5s ease;
        }
        @keyframes float1 { 0% { transform: translate(0, 0) scale(1); } 100% { transform: translate(80px, 100px) scale(1.1); } }
        @keyframes float2 { 0% { transform: translate(0, 0) scale(1); } 100% { transform: translate(-80px, -100px) scale(1.2); } }

        /* --- STICKY HEADER --- */
        header {
            position: fixed;
            top: 0;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 30px 8%;
            z-index: 100;
            transition: background 0.4s ease, padding 0.4s ease, border-bottom 0.4s ease, backdrop-filter 0.4s ease;
            border-bottom: 1px solid transparent;
        }
        header.scrolled {
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--glass-border);
            padding: 15px 8%;
        }
        .logo { font-weight: 700; font-size: 1.2rem; color: var(--text-main); transition: color 0.3s ease; }
        .logo span { color: var(--accent-glow); }
        nav ul { display: flex; gap: 30px; }
        nav a { font-weight: 500; font-size: 0.9rem; color: var(--text-muted); transition: color 0.3s ease; }
        nav a:hover { color: var(--accent-glow); }
        nav a.active { color: var(--accent-glow); border-bottom: 2px solid var(--accent-glow); padding-bottom: 2px; }

        /* --- HERO SECTION --- */
        .hero { display: flex; height: 100vh; position: relative; }
        .hero-left {
            width: 55%; display: flex; flex-direction: column; justify-content: center; padding: 0 8%; position: relative; z-index: 10;
        }
        .hero-left h2 { color: var(--accent-glow); font-weight: 600; font-size: 1.5rem; margin-bottom: 10px; animation: fadeInUp 0.8s ease forwards; transition: color 0.3s ease; }
        
        .hero-left h1 { 
            font-size: 4rem; font-weight: 700; color: var(--text-main); margin-bottom: 10px; animation: fadeInUp 0.8s ease 0.2s forwards; opacity: 0; transition: color 0.3s ease; 
            animation: fadeInUp 0.8s ease 0.2s forwards, textGlow 4s infinite alternate ease-in-out;
        }
        @keyframes textGlow {
            0% { text-shadow: 0 0 10px rgba(0, 210, 255, 0.2); }
            100% { text-shadow: 0 0 30px var(--accent-glow), 0 0 50px var(--accent-glow); }
        }

        .hero-static-role {
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--accent-glow);
            margin-bottom: 5px;
            animation: fadeInUp 0.8s ease 0.3s forwards;
            opacity: 0;
            transition: color 0.3s ease;
        }
        
        .hero-left h3 { font-size: 1.1rem; font-weight: 400; color: var(--text-muted); margin-bottom: 20px; animation: fadeInUp 0.8s ease 0.4s forwards; opacity: 0; transition: color 0.3s ease; min-height: 30px; }
        .typed-cursor { opacity: 1; animation: blink 0.7s infinite; color: var(--accent-glow); font-weight: 700; }
        @keyframes blink { 0%, 100% { opacity: 1; } 50% { opacity: 0; } }

        .hero-left p { font-size: 0.95rem; line-height: 1.6; color: var(--text-muted); margin-bottom: 40px; max-width: 450px; animation: fadeInUp 0.8s ease 0.6s forwards; opacity: 0; transition: color 0.3s ease; }
        
        .btn {
            display: inline-block; background: var(--accent-gradient); color: white; padding: 14px 35px; border-radius: 8px; font-weight: 600; font-size: 0.9rem; border: none; transition: all 0.3s ease; width: fit-content; animation: fadeInUp 0.8s ease 0.8s forwards; opacity: 0; box-shadow: 0 4px 15px rgba(0, 210, 255, 0.2);
        }
        .btn:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(0, 210, 255, 0.5); color: #ffffff; }

        /* --- SCROLL DOWN INDICATOR --- */
        .scroll-down {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            color: var(--text-muted);
            font-size: 0.75rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            z-index: 10;
            transition: opacity 0.5s ease, transform 0.5s ease;
        }
        .scroll-down.hidden {
            opacity: 0;
            transform: translateX(-50%) translateY(20px);
            pointer-events: none;
        }
        .mouse {
            width: 24px;
            height: 40px;
            border: 2px solid var(--accent-glow);
            border-radius: 12px;
            position: relative;
            animation: bounce 2s infinite;
        }
        .mouse::before {
            content: '';
            position: absolute;
            top: 6px;
            left: 50%;
            transform: translateX(-50%);
            width: 4px;
            height: 8px;
            background: var(--accent-glow);
            border-radius: 2px;
            animation: scrollWheel 1.5s infinite;
        }
        @keyframes scrollWheel {
            0% { transform: translate(-50%, 0); opacity: 1; }
            100% { transform: translate(-50%, 15px); opacity: 0; }
        }
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-10px); }
            60% { transform: translateY(-5px); }
        }

        /* --- SOCIAL SIDEBAR --- */
        .social-sidebar {
            position: absolute; left: 2%; top: 50%; transform: translateY(-50%); display: flex; flex-direction: column; gap: 20px; border: 1px solid var(--glass-border); border-radius: 30px; padding: 20px 10px; z-index: 100; background: var(--glass-bg); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); transition: border 0.3s ease, background 0.3s ease;
        }
        .social-sidebar a { color: var(--text-muted); font-size: 1rem; transition: all 0.3s ease; }
        .social-sidebar a:hover { color: var(--accent-glow); transform: scale(1.2); text-shadow: 0 0 10px var(--accent-glow); }

        /* --- HERO RIGHT --- */
        .hero-right { width: 45%; position: relative; overflow: hidden; display: flex; align-items: flex-end; justify-content: center; }
        .hero-right::before { content: ''; position: absolute; top: 0; left: -100px; width: 200px; height: 100%; background: linear-gradient(to right, var(--bg-dark), transparent); transform: skewX(-15deg); z-index: 5; transition: background 0.5s ease; }
        .hero-right img { max-height: 90%; max-width: 100%; object-fit: contain; z-index: 10; position: relative; filter: drop-shadow(0 0 30px rgba(0, 210, 255, 0.2)); transition: filter 0.3s ease; }

        /* --- ENHANCED SCROLL REVEAL ANIMATIONS --- */
        .reveal { opacity: 0; transform: translateY(60px) scale(0.95); transition: all 1s cubic-bezier(0.5, 0, 0, 1); }
        .reveal.active { opacity: 1; transform: translateY(0) scale(1); }

        @keyframes fadeInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }

        /* --- ABOUT SECTION --- */
        .about { display: flex; padding: 100px 8%; align-items: center; position: relative; z-index: 10; }
        .about-left { width: 50%; position: relative; display: flex; justify-content: center; }
        .about-left img { width: 80%; max-width: 400px; height: auto; position: relative; z-index: 2; display: block; filter: drop-shadow(0 0 20px rgba(0, 210, 255, 0.15)); transition: filter 0.3s ease; }
        .about-left::before { content: ''; position: absolute; bottom: -20px; left: 10%; width: 80%; height: 80%; border: 3px solid var(--accent-glow); opacity: 0.4; border-radius: 10px; z-index: 1; box-shadow: 0 0 20px rgba(0, 210, 255, 0.1); transition: border 0.3s ease; }
        .about-right { width: 50%; padding-left: 50px; }
        .about-right h4 { color: var(--accent-glow); font-weight: 600; font-size: 1.1rem; margin-bottom: 10px; transition: color 0.3s ease; }
        .about-right h2 { font-size: 2.5rem; font-weight: 700; margin-bottom: 20px; color: var(--text-main); transition: color 0.3s ease; }
        .about-right p { color: var(--text-muted); line-height: 1.8; margin-bottom: 20px; font-size: 0.95rem; transition: color 0.3s ease; }

        /* --- SKILLS & EDUCATION --- */
        .details-section { padding: 80px 8%; display: flex; gap: 50px; position: relative; z-index: 10; perspective: 1000px; }
        .details-box {
            flex: 1; background: var(--bg-card); padding: 40px; border-radius: 16px; border: 1px solid var(--glass-border); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2); transition: transform 0.1s ease, box-shadow 0.3s ease, background 0.5s ease, border 0.3s ease; transform-style: preserve-3d;
        }
        .details-box:hover { box-shadow: 0 12px 40px rgba(0, 210, 255, 0.15); border-color: var(--accent-glow); }
        .details-box h3 { font-size: 1.5rem; margin-bottom: 25px; color: var(--text-main); border-bottom: 2px solid var(--accent-glow); display: inline-block; padding-bottom: 5px; transition: color 0.3s ease, border 0.3s ease; }
        .details-box ul { display: flex; flex-wrap: wrap; gap: 12px; margin-bottom: 20px; transform: translateZ(20px); }
        .details-box ul li { background: var(--glass-bg); padding: 8px 18px; border-radius: 20px; font-size: 0.85rem; color: var(--text-main); font-weight: 500; border: 1px solid var(--glass-border); transition: background 0.3s ease, color 0.3s ease, border 0.3s ease; }
        .details-box ul li:hover { background: var(--accent-gradient); color: white; border-color: transparent; }
        .details-box p { color: var(--text-muted); margin-bottom: 10px; font-size: 0.95rem; transition: color 0.3s ease; transform: translateZ(20px); }
        .details-box strong { color: var(--text-main); transition: color 0.3s ease; }

        /* --- THEME SWITCHER UI --- */
        .theme-switcher { position: fixed; bottom: 30px; right: 30px; z-index: 999; display: flex; flex-direction: column; align-items: center; gap: 15px; }
        .theme-btn { width: 55px; height: 55px; border-radius: 50%; background: var(--bg-card); border: 1px solid var(--glass-border); color: var(--text-main); font-size: 1.3rem; cursor: pointer; backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); transition: all 0.3s ease; display: flex; justify-content: center; align-items: center; box-shadow: 0 4px 15px rgba(0,0,0,0.2); }
        .theme-btn:hover { transform: scale(1.1) rotate(15deg); color: var(--accent-glow); border-color: var(--accent-glow); }
        .theme-options { display: none; flex-direction: column; gap: 12px; background: var(--bg-card); padding: 18px 12px; border-radius: 30px; border: 1px solid var(--glass-border); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); animation: fadeInUp 0.3s ease; box-shadow: 0 4px 15px rgba(0,0,0,0.2); }
        .theme-options.show { display: flex; }
        .color-opt { width: 32px; height: 32px; border-radius: 50%; cursor: pointer; border: 3px solid transparent; transition: transform 0.2s ease, border-color 0.2s ease; box-shadow: 0 2px 8px rgba(0,0,0,0.3); }
        .color-opt:hover { transform: scale(1.15); }
        .color-opt.active { border-color: var(--text-main); }
        .color-opt.dark-cyan { background: linear-gradient(135deg, #0b0f19 50%, #00d2ff 50%); }
        .color-opt.light { background: linear-gradient(135deg, #f8f9fa 50%, #1abc9c 50%); }
        .color-opt.purple { background: linear-gradient(135deg, #1a0b2e 50%, #c084fc 50%); }
        .color-opt.emerald { background: linear-gradient(135deg, #061a14 50%, #34d399 50%); }

        /* --- RESPONSIVE --- */
        @media (max-width: 900px) {
            .hero { flex-direction: column; height: auto; }
            .hero-left { width: 100%; padding: 120px 8% 60px; }
            .hero-right { width: 100%; height: 400px; }
            .hero-right::before { display: none; }
            .social-sidebar { top: 20px; left: 50%; transform: translateX(-50%); flex-direction: row; padding: 10px 20px; border-radius: 30px; }
            .about { flex-direction: column; }
            .about-left, .about-right { width: 100%; padding: 0; }
            .about-left { margin-bottom: 50px; }
            .details-section { flex-direction: column; }
            .theme-switcher { bottom: 20px; right: 20px; }
            body { cursor: auto; }
            a, button { cursor: pointer; }
            .cursor { display: none; }
            #particleCanvas { display: none; }
            .scroll-down { display: none; } /* Hide scroll indicator on mobile */
        }
    </style>
</head>
<body data-theme="dark-cyan">

    <!-- SCROLL PROGRESS BAR -->
    <div class="scroll-progress" id="scrollProgress"></div>

    <!-- CUSTOM CURSOR -->
    <div class="cursor" id="cursor"></div>

    <!-- BACKGROUND EFFECTS -->
    <div class="bg-effects" id="bgEffects">
        <canvas id="particleCanvas"></canvas>
        <div class="bg-grid" id="bgGrid"></div>
        <div class="aurora" id="aurora"></div>
        <div class="blob-1" id="blob1"></div>
        <div class="blob-2" id="blob2"></div>
    </div>

    <!-- HEADER -->
    <header id="mainHeader">
        <div class="logo">Benedick<span>.</span></div>
        <nav>
            <ul>
                <li><a href="#" class="active">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#skills">Skills</a></li>
                <li><a href="#education">Education</a></li>
                <li><a href="#projects">Projects</a></li>
            </ul>
        </nav>
    </header>

    <!-- HERO SECTION -->
    <section class="hero">
        <div class="social-sidebar">
            <a href="https://www.facebook.com/bndck.cdz" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.instagram.com/benedickcadiz" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
            <a href="mailto:benedickcadiz6@gmail.com" title="Gmail"><i class="fab fa-google"></i></a>
        </div>

        <div class="hero-left">
            <h2>Hello I'm</h2>
            <h1>Benedick Cadiz</h1>
            
            <p class="hero-static-role">Web Developer & Video Editor</p>
            
            <h3><span id="typed-text"></span><span class="typed-cursor">|</span></h3>
            <p>I build responsive and user-friendly websites. Creating modern web solutions for businesses and organizations. Turning ideas into functional and efficient web applications.</p>
            <a href="#contact" class="btn">Hire Me</a>
        </div>
        
        <div class="hero-right">
            <img src="IMG_20261003_193449-removebg-preview.png" alt="Benedick Cadiz">
        </div>

        <!-- SCROLL DOWN INDICATOR -->
        <div class="scroll-down" id="scrollDownIndicator">
            <div class="mouse"></div>
            <span>Scroll Down</span>
        </div>
    </section>

    <!-- ABOUT SECTION -->
    <section class="about reveal" id="about">
        <div class="about-left">
            <img src="IMG_20261003_193457_1-removebg-preview.png" alt="Benedick Cadiz About">
        </div>
        <div class="about-right">
            <h4>About</h4>
            <h2>Why You Hire Me?</h2>
            <p>I am a student Web Developer with strong knowledge of web development and programming. I specialize in building responsive and database-driven web applications using PHP, HTML, CSS, JavaScript, and MySQL.</p>
            <p>Despite being a student, I have strong practical experience in developing complete web applications from design to deployment. I focus on writing clean code, creating user-friendly interfaces, and building reliable systems that meet user needs.</p>
            <p><strong>Video Editing Expertise:</strong> Beyond coding, I am also a skilled Video Editor. I have experience in cutting, sequencing, adding transitions, color grading, and audio syncing to create engaging visual stories. This dual skill set allows me to not only build the technical foundation of a website but also create compelling multimedia content for it.</p>
        </div>
    </section>

    <!-- SKILLS & EDUCATION SECTION -->
    <section class="details-section reveal" id="skills">
        <div class="details-box tilt-card">
            <h3>Skills</h3>
            <ul>
                <li>PHP</li>
                <li>JavaScript</li>
                <li>HTML5</li>
                <li>CSS3</li>
                <li>SQL</li>
                <li>MySQL</li>
                <li>Responsive Design</li>
                <li>Front-End</li>
                <li>Back-End</li>
                <li>CRUD</li>
                <li>Git & GitHub</li>
                <li>XAMPP</li>
                <li>VS Code</li>
                <li>Video Editing</li>
                <li>Color Grading</li>
                <li>Audio Syncing</li>
            </ul>
        </div>

        <div class="details-box tilt-card" id="projects">
            <h3>Projects</h3>
            <p>Here are some of the projects I have worked on.</p>
            <a href="#" class="btn" style="margin-bottom: 25px; font-size: 0.8rem; padding: 10px 20px; animation: none; opacity: 1;">View My Projects</a>
            
            <h3>Contact</h3>
            <p><i class="fas fa-envelope" style="color: var(--accent-glow);"></i> benedickcadiz6@gmail.com</p>
            <p><i class="fas fa-phone" style="color: var(--accent-glow);"></i> +63 992 370 3518</p>
            <p><i class="fas fa-map-marker-alt" style="color: var(--accent-glow);"></i> Mabasa, Dupax del Norte, Nueva Vizcaya</p>
        </div>
    </section>

    <!-- THEME SWITCHER -->
    <div class="theme-switcher">
        <div class="theme-options" id="themeMenu">
            <span class="color-opt dark-cyan active" onclick="setTheme('dark-cyan')" title="Dark Cyan"></span>
            <span class="color-opt light" onclick="setTheme('light')" title="Light Mode"></span>
            <span class="color-opt purple" onclick="setTheme('purple')" title="Purple Haze"></span>
            <span class="color-opt emerald" onclick="setTheme('emerald')" title="Emerald Night"></span>
        </div>
        <button class="theme-btn" onclick="toggleThemeMenu()"><i class="fas fa-palette"></i></button>
    </div>

    <!-- JAVASCRIPT -->
    <script>
        // --- GLOBAL VARIABLE FOR CANVAS COLOR ---
        let currentThemeColor = { r: 0, g: 210, b: 255 }; // Default Cyan

        function hexToRgb(hex) {
            let result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
            return result ? {
                r: parseInt(result[1], 16),
                g: parseInt(result[2], 16),
                b: parseInt(result[3], 16)
            } : { r: 0, g: 210, b: 255 };
        }

        // --- 1. THEME SWITCHER LOGIC ---
        function setTheme(themeName) {
            document.body.setAttribute('data-theme', themeName);
            localStorage.setItem('portfolio-theme', themeName);
            
            document.querySelectorAll('.color-opt').forEach(opt => opt.classList.remove('active'));
            document.querySelector(`.color-opt.${themeName}`).classList.add('active');

            const newColorHex = getComputedStyle(document.body).getPropertyValue('--accent-glow').trim();
            currentThemeColor = hexToRgb(newColorHex);
            
            if (typeof particlesArray !== 'undefined') {
                particlesArray.forEach(p => {
                    p.color = `rgb(${currentThemeColor.r}, ${currentThemeColor.g}, ${currentThemeColor.b})`;
                });
            }
        }

        window.onload = () => {
            const savedTheme = localStorage.getItem('portfolio-theme') || 'dark-cyan';
            setTheme(savedTheme);
        };

        function toggleThemeMenu() {
            const menu = document.getElementById('themeMenu');
            menu.classList.toggle('show');
        }

        document.addEventListener('click', function(event) {
            const menu = document.getElementById('themeMenu');
            const btn = document.querySelector('.theme-btn');
            if (!menu.contains(event.target) && !btn.contains(event.target)) {
                menu.classList.remove('show');
            }
        });

        // --- 2. CUSTOM CURSOR LOGIC ---
        const cursor = document.getElementById('cursor');
        document.addEventListener('mousemove', (e) => {
            cursor.style.left = e.clientX + 'px';
            cursor.style.top = e.clientY + 'px';
        });

        const interactiveElements = document.querySelectorAll('a, button, .color-opt, .details-box');
        interactiveElements.forEach(el => {
            el.addEventListener('mouseenter', () => cursor.classList.add('hovering'));
            el.addEventListener('mouseleave', () => cursor.classList.remove('hovering'));
        });

        // --- 3. CLICK RIPPLE EFFECT ---
        document.addEventListener('click', (e) => {
            const ripple = document.createElement('div');
            ripple.classList.add('ripple');
            ripple.style.left = e.clientX + 'px';
            ripple.style.top = e.clientY + 'px';
            ripple.style.width = '50px';
            ripple.style.height = '50px';
            document.body.appendChild(ripple);
            setTimeout(() => { ripple.remove(); }, 600);
        });

        // --- 4. TYPING EFFECT LOGIC ---
        const textElement = document.getElementById('typed-text');
        const words = ["Web Developer", "PHP Developer", "Front-End Designer", "Back-End Developer", "Video Editor"];
        let wordIndex = 0;
        let charIndex = 0;
        let isDeleting = false;

        function type() {
            const currentWord = words[wordIndex];
            if (isDeleting) {
                textElement.textContent = currentWord.substring(0, charIndex - 1);
                charIndex--;
            } else {
                textElement.textContent = currentWord.substring(0, charIndex + 1);
                charIndex++;
            }
            let typeSpeed = isDeleting ? 50 : 100;
            if (!isDeleting && charIndex === currentWord.length) {
                typeSpeed = 2000; isDeleting = true;
            } else if (isDeleting && charIndex === 0) {
                isDeleting = false; wordIndex = (wordIndex + 1) % words.length; typeSpeed = 500;
            }
            setTimeout(type, typeSpeed);
        }
        setTimeout(type, 1000);

        // --- 5. INTERACTIVE CONSTELLATION CANVAS ---
        const canvas = document.getElementById('particleCanvas');
        const ctx = canvas.getContext('2d');
        let particlesArray = [];
        let mouse = { x: null, y: null, radius: 150 };

        function resizeCanvas() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        }
        window.addEventListener('resize', resizeCanvas);
        resizeCanvas();

        window.addEventListener('mousemove', (e) => {
            mouse.x = e.clientX;
            mouse.y = e.clientY;
        });
        window.addEventListener('mouseout', () => {
            mouse.x = undefined; mouse.y = undefined;
        });

        class Particle {
            constructor(x, y, directionX, directionY, size) {
                this.x = x; this.y = y;
                this.directionX = directionX; this.directionY = directionY;
                this.size = size;
                this.color = `rgb(${currentThemeColor.r}, ${currentThemeColor.g}, ${currentThemeColor.b})`;
            }
            draw() {
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2, false);
                ctx.fillStyle = this.color;
                ctx.fill();
            }
            update() {
                if (this.x > canvas.width || this.x < 0) this.directionX = -this.directionX;
                if (this.y > canvas.height || this.y < 0) this.directionY = -this.directionY;
                let dx = mouse.x - this.x;
                let dy = mouse.y - this.y;
                let distance = Math.sqrt(dx * dx + dy * dy);
                if (distance < mouse.radius + this.size) {
                    if (mouse.x < this.x && this.x < canvas.width - this.size * 10) this.x += 2;
                    if (mouse.x > this.x && this.x > this.size * 10) this.x -= 2;
                    if (mouse.y < this.y && this.y < canvas.height - this.size * 10) this.y += 2;
                    if (mouse.y > this.y && this.y > this.size * 10) this.y -= 2;
                }
                this.x += this.directionX;
                this.y += this.directionY;
                this.draw();
            }
        }

        function initCanvas() {
            particlesArray = [];
            let numberOfParticles = (canvas.height * canvas.width) / 15000;
            for (let i = 0; i < numberOfParticles; i++) {
                let size = (Math.random() * 2) + 1;
                let x = (Math.random() * ((innerWidth - size * 2) - (size * 2)) + size * 2);
                let y = (Math.random() * ((innerHeight - size * 2) - (size * 2)) + size * 2);
                let directionX = (Math.random() * 0.4) - 0.2;
                let directionY = (Math.random() * 0.4) - 0.2;
                particlesArray.push(new Particle(x, y, directionX, directionY, size));
            }
        }

        function connectParticles() {
            for (let a = 0; a < particlesArray.length; a++) {
                for (let b = a; b < particlesArray.length; b++) {
                    let distance = ((particlesArray[a].x - particlesArray[b].x) * (particlesArray[a].x - particlesArray[b].x)) + 
                                   ((particlesArray[a].y - particlesArray[b].y) * (particlesArray[a].y - particlesArray[b].y));
                    if (distance < (canvas.width / 10) * (canvas.height / 10)) {
                        let opacityValue = 1 - (distance / 20000);
                        ctx.strokeStyle = `rgba(${currentThemeColor.r}, ${currentThemeColor.g}, ${currentThemeColor.b}, ${opacityValue})`;
                        ctx.lineWidth = 1;
                        ctx.beginPath();
                        ctx.moveTo(particlesArray[a].x, particlesArray[a].y);
                        ctx.lineTo(particlesArray[b].x, particlesArray[b].y);
                        ctx.stroke();
                    }
                }
            }
        }

        function animateCanvas() {
            requestAnimationFrame(animateCanvas);
            ctx.clearRect(0, 0, innerWidth, innerHeight);
            for (let i = 0; i < particlesArray.length; i++) {
                particlesArray[i].update();
            }
            connectParticles();
        }

        initCanvas();
        animateCanvas();

        // --- 6. FLOATING CODE SNIPPETS ---
        const bgEffects = document.getElementById('bgEffects');
        const codeSnippets = ['<div>', 'const', '=>', '{ }', 'function', '#include', 'SELECT *', 'async', 'return', 'npm', 'git', 'CSS', 'PHP', 'HTML', 'MySQL'];
        const codeCount = 20;
        for (let i = 0; i < codeCount; i++) {
            const snippet = document.createElement('div');
            snippet.classList.add('code-snippet');
            snippet.textContent = codeSnippets[Math.floor(Math.random() * codeSnippets.length)];
            snippet.style.left = `${Math.random() * 100}vw`;
            snippet.style.fontSize = `${Math.random() * 1 + 0.8}rem`;
            const duration = Math.random() * 20 + 15;
            snippet.style.animationDuration = `${duration}s`;
            snippet.style.animationDelay = `${Math.random() * -30}s`;
            bgEffects.appendChild(snippet);
        }

        // --- 7. METEOR SHOWER EFFECT ---
        const meteorCount = 8;
        for (let i = 0; i < meteorCount; i++) {
            const meteor = document.createElement('div');
            meteor.classList.add('meteor');
            meteor.style.left = `${Math.random() * 100}vw`;
            meteor.style.top = `${Math.random() * 50 - 20}vh`;
            const duration = Math.random() * 3 + 2; 
            meteor.style.animationDuration = `${duration}s`;
            meteor.style.animationDelay = `${Math.random() * 15}s`;
            meteor.style.animationName = 'meteorFall';
            meteor.style.animationIterationCount = 'infinite';
            meteor.style.animationTimingFunction = 'linear';
            bgEffects.appendChild(meteor);
        }

        // --- 8. FLOATING GEOMETRIC SHAPES ---
        const shapeTypes = ['triangle', 'square', 'circle'];
        const shapeCount = 15;
        for (let i = 0; i < shapeCount; i++) {
            const shape = document.createElement('div');
            const type = shapeTypes[Math.floor(Math.random() * shapeTypes.length)];
            shape.classList.add('shape', type);
            shape.style.left = `${Math.random() * 100}vw`;
            shape.style.top = `${Math.random() * 100}vh`;
            const duration = Math.random() * 20 + 10; 
            shape.style.animationDuration = `${duration}s`;
            shape.style.animationDelay = `${Math.random() * -20}s`; 
            bgEffects.appendChild(shape);
        }

        // --- 9. SCROLL EFFECTS ---
        const scrollProgress = document.getElementById('scrollProgress');
        const mainHeader = document.getElementById('mainHeader');
        const scrollDownIndicator = document.getElementById('scrollDownIndicator');

        window.addEventListener('scroll', () => {
            // 1. Scroll Progress Bar
            const scrollTop = window.scrollY;
            const docHeight = document.documentElement.scrollHeight - window.innerHeight;
            const scrollPercent = (scrollTop / docHeight) * 100;
            scrollProgress.style.width = scrollPercent + '%';

            // 2. Sticky Header
            if (window.scrollY > 50) {
                mainHeader.classList.add('scrolled');
            } else {
                mainHeader.classList.remove('scrolled');
            }

            // 3. Hide Scroll Down Indicator
            if (window.scrollY > 100) {
                scrollDownIndicator.classList.add('hidden');
            } else {
                scrollDownIndicator.classList.remove('hidden');
            }
        }, { passive: true });

        // --- 10. SCROLL REVEAL ANIMATION (IntersectionObserver) ---
        const revealElements = document.querySelectorAll('.reveal');
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, { threshold: 0.15 });
        revealElements.forEach(el => revealObserver.observe(el));

        // --- 11. 3D TILT EFFECT ON CARDS ---
        const tiltCards = document.querySelectorAll('.tilt-card');
        tiltCards.forEach(card => {
            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                const rotateX = ((y - centerY) / centerY) * -10;
                const rotateY = ((x - centerX) / centerX) * 10;
                card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(1.02)`;
            });
            card.addEventListener('mouseleave', () => {
                card.style.transform = `perspective(1000px) rotateX(0) rotateY(0) scale(1)`;
            });
        });

        // --- 12. MOUSE PARALLAX BACKGROUND EFFECT ---
        const bgGrid = document.getElementById('bgGrid');
        const blob1 = document.getElementById('blob1');
        const blob2 = document.getElementById('blob2');
        const aurora = document.getElementById('aurora');

        document.addEventListener('mousemove', (e) => {
            const x = (window.innerWidth / 2 - e.pageX) / 40;
            const y = (window.innerHeight / 2 - e.pageY) / 40;
            bgGrid.style.transform = `translate(${x}px, ${y}px)`;
            blob1.style.transform = `translate(${x * -1.5}px, ${y * -1.5}px) scale(1.1)`;
            blob2.style.transform = `translate(${x * 1.5}px, ${y * 1.5}px) scale(1.1)`;
            aurora.style.transform = `translate(${x * 0.5}px, ${y * 0.5}px)`;
        });
    </script>
</body>
</html>