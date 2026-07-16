@extends('layouts.frontend')

@section('styles')
<style>
    /* ============================================
       DYNAMIC COLOR-CHANGING GRADIENT KEYFRAMES
    ============================================ */
    @keyframes gradientFlow {
        0%   { background-position: 0% 50%; }
        25%  { background-position: 50% 100%; }
        50%  { background-position: 100% 50%; }
        75%  { background-position: 50% 0%; }
        100% { background-position: 0% 50%; }
    }

    @keyframes gradientText {
        0%   { background-position: 0% 50%; }
        50%  { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    @keyframes heroOrb1 {
        0%   { transform: translate(0px, 0px) scale(1); opacity: 0.6; }
        33%  { transform: translate(80px, -60px) scale(1.2); opacity: 0.8; }
        66%  { transform: translate(-40px, 40px) scale(0.9); opacity: 0.5; }
        100% { transform: translate(0px, 0px) scale(1); opacity: 0.6; }
    }

    @keyframes heroOrb2 {
        0%   { transform: translate(0px, 0px) scale(1); }
        33%  { transform: translate(-60px, 50px) scale(1.15); }
        66%  { transform: translate(50px, -30px) scale(0.85); }
        100% { transform: translate(0px, 0px) scale(1); }
    }

    @keyframes heroOrb3 {
        0%   { transform: translate(0px, 0px) scale(1); }
        50%  { transform: translate(30px, 60px) scale(1.1); }
        100% { transform: translate(0px, 0px) scale(1); }
    }

    @keyframes floatY {
        0%, 100% { transform: translateY(0); }
        50%       { transform: translateY(-20px); }
    }

    @keyframes rotateSlow {
        from { transform: rotate(0deg); }
        to   { transform: rotate(360deg); }
    }

    @keyframes pulseGlow {
        0%, 100% { box-shadow: 0 0 0 0 rgba(224,12,132,0.4); }
        50%       { box-shadow: 0 0 0 18px rgba(224,12,132,0); }
    }

    @keyframes countUp {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    @keyframes slideInUp {
        from { opacity: 0; transform: translateY(50px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    @keyframes shimmer {
        0%   { background-position: -200% center; }
        100% { background-position: 200% center; }
    }

    @keyframes dotPulse {
        0%, 100% { transform: scale(1); opacity: 1; }
        50%       { transform: scale(1.4); opacity: 0.6; }
    }

    @keyframes statsGradient {
        0%   { background-position: 0% 50%; }
        50%  { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* ============================================
       HERO SECTION — Full Width Cinematic
    ============================================ */
    .vm-hero {
        position: relative;
        min-height: 100vh;
        display: flex;
        align-items: center;
        overflow: hidden;
        background: #080412;
    }

    /* Dynamic shifting base gradient */
    .vm-hero-bg {
        position: absolute;
        inset: 0;
        background: linear-gradient(
            135deg,
            #080412 0%,
            #1a0630 20%,
            #3b0764 40%,
            #6d1b7b 55%,
            #a90771 70%,
            #e00c84 85%,
            #ff6b9d 100%
        );
        background-size: 400% 400%;
        animation: gradientFlow 12s ease infinite;
        opacity: 0.85;
        z-index: 0;
    }

    /* Grid overlay */
    .vm-hero-grid {
        position: absolute;
        inset: 0;
        background-image:
            linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
        background-size: 70px 70px;
        z-index: 1;
    }

    /* Floating Orbs */
    .orb {
        position: absolute;
        border-radius: 50%;
        filter: blur(60px);
        z-index: 1;
        pointer-events: none;
    }

    .orb-1 {
        width: 500px; height: 500px;
        background: radial-gradient(circle, rgba(224,12,132,0.45), transparent 70%);
        top: -100px; right: -80px;
        animation: heroOrb1 18s ease-in-out infinite;
    }

    .orb-2 {
        width: 400px; height: 400px;
        background: radial-gradient(circle, rgba(109,27,123,0.5), transparent 70%);
        bottom: -80px; left: -60px;
        animation: heroOrb2 22s ease-in-out infinite;
    }

    .orb-3 {
        width: 300px; height: 300px;
        background: radial-gradient(circle, rgba(255,107,157,0.3), transparent 70%);
        top: 40%; right: 20%;
        animation: heroOrb3 15s ease-in-out infinite;
    }

    .orb-4 {
        width: 200px; height: 200px;
        background: radial-gradient(circle, rgba(251,191,36,0.2), transparent 70%);
        top: 15%; left: 30%;
        animation: heroOrb1 25s ease-in-out infinite reverse;
    }

    .vm-hero-content {
        position: relative;
        z-index: 3;
        padding: 100px 0 80px;
    }

    /* Hero Badge */
    .vm-hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(255,255,255,0.18);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        padding: 8px 22px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        color: #fce7f3;
        margin-bottom: 30px;
        animation: slideInUp 0.8s ease both;
    }

    .vm-hero-badge .live-dot {
        width: 8px; height: 8px;
        background: #4ade80;
        border-radius: 50%;
        box-shadow: 0 0 0 0 rgba(74,222,128,0.4);
        animation: dotPulse 2s infinite;
    }

    /* Dynamic Headline */
    .vm-hero-title {
        font-family: 'Playfair Display', serif;
        font-size: clamp(40px, 6vw, 80px);
        font-weight: 900;
        color: #fff;
        line-height: 1.05;
        margin-bottom: 16px;
        animation: slideInUp 0.9s ease 0.1s both;
    }

    .vm-hero-title .dyn-gradient {
        background: linear-gradient(
            270deg,
            #fbbf24, #f472b6, #e00c84, #a855f7, #60a5fa, #f472b6, #fbbf24
        );
        background-size: 400% 400%;
        animation: gradientText 4s ease infinite;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .vm-hero-tamil {
        font-size: clamp(16px, 2vw, 22px);
        font-weight: 700;
        color: rgba(255,255,255,0.75);
        margin-bottom: 24px;
        animation: slideInUp 1s ease 0.2s both;
        letter-spacing: 0.4px;
    }

    .vm-hero-desc {
        font-size: clamp(15px, 1.8vw, 17px);
        color: rgba(255,255,255,0.65);
        line-height: 1.8;
        max-width: 640px;
        margin: 0 auto 40px;
        animation: slideInUp 1s ease 0.3s both;
    }

    /* Hero CTA Buttons */
    .vm-hero-ctas {
        display: flex;
        gap: 16px;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
        margin-bottom: 50px;
        animation: slideInUp 1s ease 0.4s both;
    }

    .btn-hero-register {
        padding: 16px 40px;
        border-radius: 16px;
        font-size: 16px;
        font-weight: 800;
        color: #fff;
        border: none;
        cursor: pointer;
        background: linear-gradient(135deg, #e00c84, #a90771, #5d0156, #e00c84);
        background-size: 300% 300%;
        animation: gradientFlow 4s ease infinite;
        box-shadow: 0 10px 30px rgba(224,12,132,0.4);
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        letter-spacing: 0.3px;
    }

    .btn-hero-register:hover {
        transform: translateY(-4px);
        box-shadow: 0 18px 40px rgba(224,12,132,0.6);
        color: #fff;
    }

    .btn-hero-login {
        padding: 15px 36px;
        border-radius: 16px;
        font-size: 16px;
        font-weight: 700;
        color: #fff;
        border: 2px solid rgba(255,255,255,0.25);
        background: rgba(255,255,255,0.06);
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
    }

    .btn-hero-login:hover {
        background: rgba(255,255,255,0.15);
        border-color: rgba(255,255,255,0.5);
        transform: translateY(-3px);
        color: #fff;
    }

    /* Trust Chips Row */
    .hero-trust-chips {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: center;
        animation: slideInUp 1s ease 0.5s both;
    }

    .trust-chip {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 8px 18px;
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 50px;
        font-size: 13px;
        font-weight: 600;
        color: rgba(255,255,255,0.8);
        backdrop-filter: blur(6px);
        transition: all 0.3s ease;
    }

    .trust-chip:hover {
        background: rgba(255,255,255,0.12);
        border-color: rgba(255,255,255,0.25);
        transform: translateY(-2px);
    }

    .trust-chip i { color: #f472b6; }

    /* Floating couple cards (decorative) */
    .hero-floating-cards {
        position: absolute;
        right: 3%;
        top: 50%;
        transform: translateY(-50%);
        z-index: 3;
        display: flex;
        flex-direction: column;
        gap: 14px;
        pointer-events: none;
    }

    .hfc {
        background: rgba(255,255,255,0.07);
        border: 1px solid rgba(255,255,255,0.1);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        border-radius: 20px;
        padding: 16px 20px;
        display: flex;
        align-items: center;
        gap: 12px;
        color: #fff;
        min-width: 220px;
    }

    .hfc:nth-child(1) { animation: floatY 5s ease-in-out infinite; }
    .hfc:nth-child(2) { animation: floatY 5s ease-in-out infinite 1.5s; }
    .hfc:nth-child(3) { animation: floatY 5s ease-in-out infinite 3s; }

    .hfc-icon {
        width: 42px; height: 42px;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 18px; flex-shrink: 0;
    }

    .hfc-text strong { display: block; font-size: 14px; font-weight: 700; }
    .hfc-text span { font-size: 12px; color: rgba(255,255,255,0.55); }

    /* ============================================
       STATS SECTION — Dynamic Gradient
    ============================================ */
    .vm-stats {
        position: relative;
        padding: 70px 0;
        background: linear-gradient(
            270deg,
            #5d0156, #a90771, #e00c84, #c2185b, #880e4f, #5d0156
        );
        background-size: 400% 400%;
        animation: statsGradient 8s ease infinite;
        overflow: hidden;
    }

    .vm-stats::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }

    .vm-stat-box {
        text-align: center;
        padding: 10px 30px;
        position: relative;
        z-index: 1;
    }

    .vm-stat-box + .vm-stat-box::before {
        content: '';
        position: absolute;
        left: 0; top: 50%;
        transform: translateY(-50%);
        width: 1px; height: 60px;
        background: rgba(255,255,255,0.15);
    }

    .vm-stat-num {
        font-family: 'Playfair Display', serif;
        font-size: 46px;
        font-weight: 900;
        color: #fff;
        line-height: 1;
        text-shadow: 0 4px 20px rgba(0,0,0,0.2);
    }

    .vm-stat-label { font-size: 14px; color: rgba(255,255,255,0.7); font-weight: 500; margin-top: 6px; }
    .vm-stat-ta { font-size: 11px; color: rgba(255,255,255,0.4); margin-top: 3px; }

    /* ============================================
       SECTION SHARED STYLES
    ============================================ */
    .section-tag {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 11.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 14px;
    }

    .tag-pink { background: #fdf2f8; color: #a90771; border: 1px solid #fce7f3; }
    .tag-purple { background: #f5f3ff; color: #7c3aed; border: 1px solid #ede9fe; }
    .tag-blue { background: #eff6ff; color: #2563eb; border: 1px solid #dbeafe; }
    .tag-gold { background: #fffbeb; color: #b45309; border: 1px solid #fef3c7; }

    .vm-section-title {
        font-family: 'Playfair Display', serif;
        font-size: clamp(28px, 4vw, 42px);
        font-weight: 900;
        color: #0f172a;
        line-height: 1.15;
        margin-bottom: 14px;
    }

    .vm-section-title .hl {
        background: linear-gradient(135deg, #a90771, #e00c84);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* ============================================
       HOW IT WORKS SECTION
    ============================================ */
    .how-section { background: #fff; padding: 100px 0; }

    .step-connector {
        display: none;
    }

    @media (min-width: 992px) {
        .step-connector {
            display: block;
            position: absolute;
            top: 45px;
            left: calc(50% + 40px);
            width: calc(100% - 80px);
            height: 2px;
            background: linear-gradient(90deg, #fce7f3, #e00c84, #fce7f3);
            background-size: 200% 200%;
            animation: gradientFlow 3s ease infinite;
            z-index: 0;
        }
    }

    .step-col { position: relative; z-index: 1; }

    .step-card-v2 {
        background: #fff;
        border: 1px solid #f1f5f9;
        border-radius: 24px;
        padding: 40px 28px 36px;
        text-align: center;
        transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .step-card-v2::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, #fdf2f8 0%, #fff 50%, #f5f3ff 100%);
        opacity: 0;
        transition: opacity 0.35s ease;
        z-index: 0;
    }

    .step-card-v2:hover::after { opacity: 1; }

    .step-card-v2:hover {
        transform: translateY(-14px);
        box-shadow: 0 25px 50px rgba(169,7,113,0.12);
        border-color: rgba(169,7,113,0.15);
    }

    .step-card-v2 > * { position: relative; z-index: 1; }

    .step-num-badge {
        width: 52px; height: 52px;
        border-radius: 16px;
        background: linear-gradient(135deg, #fdf2f8, #fce7f3);
        color: #a90771;
        font-size: 20px;
        font-weight: 900;
        font-family: 'Playfair Display', serif;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 20px;
        transition: all 0.3s ease;
    }

    .step-card-v2:hover .step-num-badge {
        background: linear-gradient(135deg, #e00c84, #a90771);
        color: #fff;
        box-shadow: 0 8px 20px rgba(169,7,113,0.35);
    }

    .step-icon-large {
        font-size: 36px;
        color: #a90771;
        margin-bottom: 18px;
        display: block;
        transition: all 0.3s ease;
    }

    .step-card-v2:hover .step-icon-large {
        color: #e00c84;
        transform: scale(1.15) rotate(-5deg);
    }

    .step-card-v2 h4 { font-size: 18px; font-weight: 700; color: #0f172a; margin-bottom: 10px; }
    .step-card-v2 p { font-size: 14px; color: #64748b; line-height: 1.65; margin: 0; }

    /* ============================================
       FEATURE SECTION with Dynamic BG
    ============================================ */
    .features-v2 {
        padding: 100px 0;
        background: linear-gradient(
            135deg,
            #faf5ff 0%, #fdf2f8 25%, #f0f9ff 50%, #f0fdf4 75%, #fffbeb 100%
        );
        background-size: 400% 400%;
        animation: gradientFlow 15s ease infinite;
    }

    .feature-pill {
        background: #fff;
        border-radius: 20px;
        padding: 28px 26px;
        display: flex;
        align-items: flex-start;
        gap: 18px;
        border: 1px solid rgba(0,0,0,0.05);
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        transition: all 0.3s ease;
    }

    .feature-pill:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(169,7,113,0.1);
        border-color: rgba(169,7,113,0.12);
    }

    .fp-icon {
        width: 52px; height: 52px;
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
        transition: all 0.3s ease;
    }

    .feature-pill:hover .fp-icon { transform: scale(1.12) rotate(-6deg); }

    .feature-pill h5 { font-size: 16px; font-weight: 700; color: #0f172a; margin-bottom: 6px; }
    .feature-pill p { font-size: 13.5px; color: #64748b; line-height: 1.6; margin: 0; }

    /* ============================================
       TESTIMONIALS with Animated Border
    ============================================ */
    .testimonials-section { background: #0f0a1e; padding: 100px 0; }

    .testimonials-section .vm-section-title { color: #fff; }
    .testimonials-section .vm-section-title .hl {
        background: linear-gradient(135deg, #f9a8d4, #fbbf24, #f472b6);
        background-size: 200% 200%;
        animation: gradientText 3s ease infinite;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .testi-v2 {
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 24px;
        padding: 36px 30px;
        height: 100%;
        position: relative;
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .testi-v2::before {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 24px;
        padding: 1px;
        background: linear-gradient(135deg, rgba(224,12,132,0.4), rgba(251,191,36,0.2), rgba(168,85,247,0.3));
        -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .testi-v2:hover::before { opacity: 1; }
    .testi-v2:hover {
        background: rgba(255,255,255,0.07);
        transform: translateY(-8px);
    }

    .testi-stars { color: #fbbf24; font-size: 13px; margin-bottom: 14px; }

    .testi-quote {
        font-size: 60px;
        color: rgba(224,12,132,0.3);
        font-family: Georgia, serif;
        line-height: 0.7;
        margin-bottom: 16px;
        display: block;
        font-weight: 900;
    }

    .testi-v2 p { font-size: 14.5px; color: rgba(255,255,255,0.65); line-height: 1.75; font-style: italic; margin-bottom: 24px; }

    .testi-author-row { display: flex; align-items: center; gap: 12px; }

    .testi-av {
        width: 46px; height: 46px;
        border-radius: 50%;
        background: linear-gradient(135deg, #e00c84, #7c3aed);
        display: flex; align-items: center; justify-content: center;
        font-size: 18px; color: #fff; font-weight: 800;
        flex-shrink: 0;
    }

    .testi-av-info strong { display: block; font-size: 15px; font-weight: 700; color: #fff; }
    .testi-av-info span { font-size: 12.5px; color: rgba(255,255,255,0.45); }

    /* ============================================
       COMMITMENT SECTION
    ============================================ */
    .commitment-v2 {
        padding: 100px 0;
        background: #fff;
    }

    .commitment-card {
        background: linear-gradient(135deg, #0f0a1e, #3b0764, #6d1b7b);
        background-size: 300% 300%;
        animation: gradientFlow 10s ease infinite;
        border-radius: 28px;
        padding: 60px 50px;
        color: #fff;
        position: relative;
        overflow: hidden;
    }

    .commitment-card::before {
        content: '';
        position: absolute;
        width: 400px; height: 400px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(224,12,132,0.2), transparent 65%);
        top: -100px; right: -80px;
        pointer-events: none;
    }

    .commitment-card::after {
        content: '';
        position: absolute;
        width: 300px; height: 300px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(251,191,36,0.12), transparent 65%);
        bottom: -60px; left: -60px;
        pointer-events: none;
    }

    .commitment-card > * { position: relative; z-index: 1; }
    .commitment-card .vm-section-title { color: #fff; }
    .commitment-card .vm-section-title .hl {
        background: linear-gradient(135deg, #fbbf24, #f472b6, #fbbf24);
        background-size: 200% 200%;
        animation: gradientText 4s ease infinite;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .commitment-point {
        display: flex; align-items: flex-start; gap: 14px;
        padding: 16px 0;
        border-bottom: 1px solid rgba(255,255,255,0.08);
    }

    .commitment-point:last-child { border-bottom: none; }

    .cp-icon {
        width: 42px; height: 42px;
        border-radius: 12px;
        background: rgba(255,255,255,0.1);
        display: flex; align-items: center; justify-content: center;
        font-size: 17px; color: #f472b6; flex-shrink: 0;
        transition: all 0.3s ease;
    }

    .commitment-point:hover .cp-icon {
        background: rgba(224,12,132,0.3);
        transform: scale(1.1);
    }

    .cp-text strong { display: block; font-size: 15px; font-weight: 700; color: #fff; margin-bottom: 3px; }
    .cp-text span { font-size: 13.5px; color: rgba(255,255,255,0.55); line-height: 1.5; }

    /* ============================================
       FINAL CTA SECTION
    ============================================ */
    .final-cta {
        padding: 120px 0;
        background: linear-gradient(
            270deg,
            #080412, #1a0630, #3b0764, #6d1b7b, #a90771,
            #e00c84, #a90771, #6d1b7b, #3b0764, #1a0630
        );
        background-size: 400% 400%;
        animation: gradientFlow 10s ease infinite;
        position: relative;
        overflow: hidden;
        text-align: center;
    }

    .final-cta::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image: linear-gradient(rgba(255,255,255,0.025) 1px, transparent 1px),
                          linear-gradient(90deg, rgba(255,255,255,0.025) 1px, transparent 1px);
        background-size: 60px 60px;
    }

    .cta-v2-title {
        font-family: 'Playfair Display', serif;
        font-size: clamp(32px, 5vw, 60px);
        font-weight: 900;
        color: #fff;
        line-height: 1.1;
        margin-bottom: 20px;
    }

    .cta-v2-title .shimmer-text {
        background: linear-gradient(
            90deg,
            #fbbf24 0%, #f472b6 25%, #fff 50%, #f9a8d4 75%, #fbbf24 100%
        );
        background-size: 200% auto;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: shimmer 3s linear infinite;
    }

    .cta-mini-stats {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
        margin-top: 50px;
    }

    .cta-mini-stat {
        background: rgba(255,255,255,0.07);
        border: 1px solid rgba(255,255,255,0.1);
        backdrop-filter: blur(10px);
        border-radius: 18px;
        padding: 24px 30px;
        text-align: center;
        min-width: 140px;
        transition: all 0.3s ease;
    }

    .cta-mini-stat:hover {
        background: rgba(255,255,255,0.12);
        transform: translateY(-5px);
    }

    .cta-mini-stat-num {
        font-size: 32px; font-weight: 900; color: #fbbf24;
        font-family: 'Playfair Display', serif; line-height: 1;
    }

    .cta-mini-stat-label { font-size: 12px; color: rgba(255,255,255,0.55); margin-top: 6px; }

    /* ============================================
       REGISTRATION POPUP MODAL
    ============================================ */
    .vm-modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        z-index: 9999;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .vm-modal-overlay.active { display: flex; }

    .vm-modal-backdrop {
        position: absolute;
        inset: 0;
        background: rgba(8, 4, 18, 0.85);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
    }

    .vm-modal-box {
        position: relative;
        z-index: 2;
        width: 100%;
        max-width: 520px;
        background: #fff;
        border-radius: 28px;
        overflow: hidden;
        box-shadow: 0 40px 80px rgba(0,0,0,0.4);
        animation: slideInUp 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) both;
        max-height: 90vh;
        overflow-y: auto;
    }

    .vm-modal-header {
        background: linear-gradient(135deg, #080412, #3b0764, #a90771, #e00c84);
        background-size: 300% 300%;
        animation: gradientFlow 6s ease infinite;
        padding: 36px 36px 30px;
        color: #fff;
        position: relative;
        text-align: center;
    }

    .vm-modal-header .modal-icon {
        width: 65px; height: 65px;
        background: rgba(255,255,255,0.12);
        border: 2px solid rgba(255,255,255,0.2);
        border-radius: 20px;
        display: flex; align-items: center; justify-content: center;
        font-size: 26px;
        margin: 0 auto 16px;
        animation: pulseGlow 3s infinite;
    }

    .vm-modal-header h3 {
        font-family: 'Playfair Display', serif;
        font-size: 24px;
        font-weight: 800;
        margin-bottom: 6px;
    }

    .vm-modal-header p { font-size: 14px; color: rgba(255,255,255,0.7); margin: 0; }

    .vm-modal-close {
        position: absolute;
        top: 16px; right: 16px;
        width: 36px; height: 36px;
        border-radius: 12px;
        border: none;
        background: rgba(255,255,255,0.1);
        color: #fff;
        font-size: 16px;
        cursor: pointer;
        display: flex; align-items: center; justify-content: center;
        transition: all 0.2s ease;
    }

    .vm-modal-close:hover { background: rgba(255,255,255,0.2); transform: rotate(90deg); }

    .vm-modal-body { padding: 32px 36px 36px; }

    /* Modal Form */
    .mf-group { margin-bottom: 16px; }

    .mf-group label {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 11.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.7px;
        color: #475569;
        margin-bottom: 7px;
    }

    .mf-group label i { font-size: 11px; color: #a90771; }

    .mf-group input,
    .mf-group select {
        width: 100%;
        height: 46px;
        background: #f8fafc;
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        padding: 10px 16px;
        font-size: 14.5px;
        font-weight: 500;
        color: #0f172a;
        transition: all 0.25s ease;
        outline: none;
        font-family: 'Inter', sans-serif;
    }

    .mf-group input::placeholder { color: #94a3b8; }

    .mf-group input:focus,
    .mf-group select:focus {
        background: #fff;
        border-color: #a90771;
        box-shadow: 0 0 0 4px rgba(169,7,113,0.1);
    }

    .mf-pw-wrap { position: relative; }

    .mf-pw-wrap .mf-eye {
        position: absolute;
        right: 14px; top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        cursor: pointer;
        color: #94a3b8;
        font-size: 15px;
        z-index: 5;
        transition: color 0.2s;
    }

    .mf-pw-wrap .mf-eye:hover { color: #a90771; }

    .btn-modal-register {
        width: 100%;
        height: 52px;
        border: none;
        border-radius: 14px;
        font-size: 16px;
        font-weight: 800;
        color: #fff;
        cursor: pointer;
        background: linear-gradient(135deg, #e00c84, #a90771, #5d0156, #e00c84);
        background-size: 300% 300%;
        animation: gradientFlow 4s ease infinite;
        box-shadow: 0 8px 25px rgba(169,7,113,0.35);
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        letter-spacing: 0.3px;
        font-family: 'Inter', sans-serif;
    }

    .btn-modal-register:hover {
        transform: translateY(-2px);
        box-shadow: 0 14px 35px rgba(169,7,113,0.55);
    }

    .modal-divider {
        display: flex; align-items: center; gap: 12px;
        margin: 18px 0;
        color: #94a3b8; font-size: 12px; font-weight: 600;
    }

    .modal-divider::before, .modal-divider::after {
        content: ''; flex: 1;
        height: 1px; background: #e2e8f0;
    }

    /* ============================================
       RESPONSIVE
    ============================================ */
    @media (max-width: 1200px) {
        .hero-floating-cards { display: none; }
    }

    @media (max-width: 768px) {
        .vm-hero-content { padding: 80px 0 60px; }
        .vm-stat-box + .vm-stat-box::before { display: none; }
        .commitment-card { padding: 40px 30px; }
        .vm-modal-body { padding: 28px 24px 30px; }
        .vm-modal-header { padding: 28px 24px 22px; }
    }

    /* Scrollbar for modal */
    .vm-modal-box::-webkit-scrollbar { width: 5px; }
    .vm-modal-box::-webkit-scrollbar-track { background: #f1f5f9; }
    .vm-modal-box::-webkit-scrollbar-thumb { background: #a90771; border-radius: 4px; }
</style>
@endsection

@section('content')

{{-- ============================================================
     HERO SECTION — Full Width, Dynamic, No Registration Card
============================================================= --}}
<section class="vm-hero" id="hero">
    <div class="vm-hero-bg"></div>
    <div class="vm-hero-grid"></div>
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>
    <div class="orb orb-4"></div>

    <div class="container vm-hero-content text-center">
        <div class="vm-hero-badge">
            <span class="live-dot"></span>
            Trusted by Tamil Families Worldwide
        </div>

        <h1 class="vm-hero-title">
            Find Your Perfect<br>
            <span class="dyn-gradient">Tamil Life Partner</span>
        </h1>

        <div class="vm-hero-tamil">
            🙏 வணக்கம். தங்கள் வருகைக்கு மனமார்ந்த மகிழ்ச்சி
        </div>

        <p class="vm-hero-desc mx-auto">
            உலகெங்கும் வாழும் தமிழ் மக்களின் வரன் தேடும் முயற்சிகளை ஒரே நம்பகமான வலைத்தளத்தின் மூலம் ஒன்றிணைத்து, உயரிய திருமண பந்தத்தை எளிதாகவும் தெளிவாகவும் தேர்ந்தெடுக்க உதவுவதே <strong style="color:#f9a8d4;">ஸ்ரீ வாராஹி மேட்ரிமோனி</strong>யின் உன்னத நோக்கமாகும்.
        </p>

        <div class="vm-hero-ctas">
            <button class="btn-hero-register" onclick="openRegisterModal()">
                <i class="fa-solid fa-user-plus"></i>
                Register Free — இலவச பதிவு
            </button>
            <a href="{{ route('login') }}" class="btn-hero-login">
                <i class="fa-regular fa-circle-user"></i>
                Login to Account
            </a>
        </div>

        <div class="hero-trust-chips">
            <span class="trust-chip"><i class="fa-solid fa-shield-halved"></i> 100% Verified Profiles</span>
            <span class="trust-chip"><i class="fa-solid fa-lock"></i> Fully Secure & Private</span>
            <span class="trust-chip"><i class="fa-solid fa-ban"></i> Zero Broker Commission</span>
            <span class="trust-chip"><i class="fa-solid fa-id-card"></i> Aadhaar Verified</span>
            <span class="trust-chip"><i class="fa-solid fa-heart"></i> 3,500+ Success Stories</span>
        </div>
    </div>

    {{-- Floating Decorative Cards --}}
    <div class="hero-floating-cards">
        <div class="hfc">
            <div class="hfc-icon" style="background:rgba(74,222,128,0.15);color:#4ade80;">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <div class="hfc-text">
                <strong>New Match Found!</strong>
                <span>Verified profile — just now</span>
            </div>
        </div>
        <div class="hfc">
            <div class="hfc-icon" style="background:rgba(251,191,36,0.15);color:#fbbf24;">
                <i class="fa-solid fa-heart"></i>
            </div>
            <div class="hfc-text">
                <strong>Engagement Confirmed 🎉</strong>
                <span>2 families connected today</span>
            </div>
        </div>
        <div class="hfc">
            <div class="hfc-icon" style="background:rgba(224,12,132,0.2);color:#f472b6;">
                <i class="fa-solid fa-users"></i>
            </div>
            <div class="hfc-text">
                <strong>10,000+ Members</strong>
                <span>Active Tamil profiles</span>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     STATS COUNTER SECTION
============================================================= --}}
<section class="vm-stats">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-center align-items-center">
            <div class="vm-stat-box">
                <div class="vm-stat-num">10,000+</div>
                <div class="vm-stat-label">Registered Members</div>
                <div class="vm-stat-ta">பதிவு செய்த உறுப்பினர்கள்</div>
            </div>
            <div class="vm-stat-box">
                <div class="vm-stat-num">3,500+</div>
                <div class="vm-stat-label">Successful Marriages</div>
                <div class="vm-stat-ta">வெற்றிகரமான திருமணங்கள்</div>
            </div>
            <div class="vm-stat-box">
                <div class="vm-stat-num">100%</div>
                <div class="vm-stat-label">Verified Profiles</div>
                <div class="vm-stat-ta">சரிபார்க்கப்பட்ட சுயவிவரங்கள்</div>
            </div>
            <div class="vm-stat-box">
                <div class="vm-stat-num">₹0</div>
                <div class="vm-stat-label">Broker Commission</div>
                <div class="vm-stat-ta">புரோக்கர் கட்டணம் இல்லை</div>
            </div>
            <div class="vm-stat-box">
                <div class="vm-stat-num">15+</div>
                <div class="vm-stat-label">Years of Trust</div>
                <div class="vm-stat-ta">நம்பகமான சேவை ஆண்டுகள்</div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     HOW IT WORKS SECTION
============================================================= --}}
<section class="how-section">
    <div class="container">
        <div class="text-center mb-5">
            <div class="section-tag tag-pink"><i class="fa-solid fa-route"></i> Simple 4-Step Process</div>
            <h2 class="vm-section-title">How Sri Vaarahi Matrimony <span class="hl">Works</span></h2>
            <p style="font-size:16px;color:#64748b;max-width:520px;margin:0 auto;">
                வெறும் 4 எளிய படிகளில் உங்கள் ஆயுள் துணையை கண்டுபிடியுங்கள்.
            </p>
        </div>

        <div class="row g-4 position-relative">
            @php
                $steps = [
                    ['num' => '01', 'icon' => 'fa-solid fa-user-plus', 'title' => 'Free Registration', 'desc' => 'Create your profile in minutes. Share details, add photos and horoscope information to stand out.'],
                    ['num' => '02', 'icon' => 'fa-solid fa-shield-halved', 'title' => 'Profile Verification', 'desc' => 'Our expert team manually verifies your Aadhaar & details to ensure 100% authentic profiles.'],
                    ['num' => '03', 'icon' => 'fa-solid fa-magnifying-glass', 'title' => 'Discover Matches', 'desc' => 'Browse by caste, education, income, raasi, star & location. Auto-match based on your preferences.'],
                    ['num' => '04', 'icon' => 'fa-solid fa-ring', 'title' => 'Connect & Marry', 'desc' => 'Express interest, connect with families, and step into a beautiful lifelong journey together.'],
                ];
            @endphp
            @foreach($steps as $step)
                <div class="col-lg-3 col-md-6 step-col">
                    <div class="step-card-v2">
                        <div class="step-num-badge">{{ $step['num'] }}</div>
                        <i class="{{ $step['icon'] }} step-icon-large"></i>
                        <h4>{{ $step['title'] }}</h4>
                        <p>{{ $step['desc'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================================
     FEATURES — WHY CHOOSE US (Dynamic Gradient BG)
============================================================= --}}
<section class="features-v2">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-5">
                <div class="section-tag tag-purple"><i class="fa-solid fa-star"></i> Why Choose Us</div>
                <h2 class="vm-section-title">Everything You Need to Find <span class="hl">Your Soul Mate</span></h2>
                <p style="font-size:15.5px;color:#475569;line-height:1.75;margin-bottom:30px;">
                    ஸ்ரீ வாராஹி மேட்ரிமோனி உங்களுக்கு பாதுகாப்பான, நம்பகமான, மற்றும் எளிதான திருமண வரன் தேடும் அனுபவத்தை வழங்குகிறது.
                </p>
                <button class="btn-hero-register" style="font-size:14px;padding:14px 30px;display:inline-flex;" onclick="openRegisterModal()">
                    <i class="fa-solid fa-sparkles"></i> Start for Free Today
                </button>
            </div>

            <div class="col-lg-7">
                <div class="row g-3">
                    @php
                        $features = [
                            ['icon' => 'fa-solid fa-id-card-clip', 'ic' => '#a90771', 'ib' => '#fdf2f8', 'title' => 'Aadhaar Verified Profiles', 'desc' => 'Every profile is manually reviewed and Aadhaar verified. Zero fake profiles — guaranteed.'],
                            ['icon' => 'fa-solid fa-lock', 'ic' => '#16a34a', 'ib' => '#f0fdf4', 'title' => '100% Privacy & Security', 'desc' => 'Contact details, photos & personal info shared only with your explicit consent.'],
                            ['icon' => 'fa-solid fa-brain', 'ic' => '#2563eb', 'ib' => '#eff6ff', 'title' => 'Smart Auto Matching', 'desc' => 'Set partner preferences and get profiles auto-matched to your exact expectations.'],
                            ['icon' => 'fa-solid fa-indian-rupee-sign', 'ic' => '#ea580c', 'ib' => '#fff7ed', 'title' => 'Zero Broker Commission', 'desc' => 'No middlemen, no hidden fees. Only transparent, affordable registration charges.'],
                            ['icon' => 'fa-solid fa-star-and-crescent', 'ic' => '#9333ea', 'ib' => '#fdf4ff', 'title' => 'Astrology Compatibility', 'desc' => 'Filter by Raasi, Star, Gothram, and other traditional compatibility factors.'],
                            ['icon' => 'fa-solid fa-globe-asia', 'ic' => '#0d9488', 'ib' => '#f0fdfa', 'title' => 'Global Tamil Network', 'desc' => 'Connecting Tamil families across India, UK, USA, Canada, Australia & worldwide.'],
                        ];
                    @endphp
                    @foreach($features as $f)
                        <div class="col-sm-6">
                            <div class="feature-pill">
                                <div class="fp-icon" style="background:{{ $f['ib'] }};color:{{ $f['ic'] }};">
                                    <i class="{{ $f['icon'] }}"></i>
                                </div>
                                <div>
                                    <h5>{{ $f['title'] }}</h5>
                                    <p>{{ $f['desc'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     COMMITMENT / ABOUT SECTION
============================================================= --}}
<section class="commitment-v2">
    <div class="container">
        <div class="commitment-card">
            <div class="row align-items-center g-5">
                <div class="col-lg-5">
                    <div class="section-tag" style="background:rgba(255,255,255,0.1);color:#fce7f3;border-color:rgba(255,255,255,0.15);">
                        <i class="fa-solid fa-temple-hindu"></i> எங்கள் உறுதிமொழி
                    </div>
                    <h2 class="vm-section-title mt-2">Our <span class="hl">Sacred Commitment</span><br>To Tamil Families</h2>
                    <p style="font-size:15.5px;color:rgba(255,255,255,0.65);line-height:1.8;margin-bottom:28px;">
                        ஸ்ரீ வாராஹி அம்மனின் திருவருளால், இங்கு பதிவு செய்யப்படும் அனைத்து ஜாதகங்களுக்கும் மிகச் சிறந்ததும், முழுமையான பொருத்தமுடையதுமான வரன்களைத் தேர்வு செய்ய எங்களால் முடிந்தவரை நேர்மையுடன் உதவுகிறோம்.
                    </p>
                    <button onclick="openRegisterModal()" class="btn-hero-register" style="font-size:14px;padding:14px 28px;display:inline-flex;">
                        <i class="fa-solid fa-arrow-right"></i> Join Us Free
                    </button>
                </div>

                <div class="col-lg-7">
                    @php
                        $points = [
                            ['icon' => 'fa-solid fa-handshake', 'title' => 'Honest & Ethical Matchmaking', 'desc' => 'We follow completely transparent practices. No misleading claims or hidden broker fees — ever.'],
                            ['icon' => 'fa-solid fa-family', 'title' => 'Family-Oriented Tamil Values', 'desc' => 'We uphold traditional Tamil family values while leveraging modern technology for the best match.'],
                            ['icon' => 'fa-solid fa-certificate', 'title' => '100% Genuine Profiles Only', 'desc' => 'Every single profile is screened and approved by our dedicated verification team before publishing.'],
                            ['icon' => 'fa-solid fa-headset', 'title' => 'Dedicated Personal Support', 'desc' => 'Our expert team is available Mon–Sat, 9 AM–7 PM IST to personally assist you at every step.'],
                        ];
                    @endphp
                    @foreach($points as $pt)
                        <div class="commitment-point">
                            <div class="cp-icon"><i class="{{ $pt['icon'] }}"></i></div>
                            <div class="cp-text">
                                <strong>{{ $pt['title'] }}</strong>
                                <span>{{ $pt['desc'] }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     TESTIMONIALS SECTION (Dark BG)
============================================================= --}}
<section class="testimonials-section">
    <div class="container">
        <div class="text-center mb-5">
            <div class="section-tag" style="background:rgba(255,255,255,0.06);color:#f9a8d4;border-color:rgba(255,255,255,0.1);">
                <i class="fa-solid fa-quote-left"></i> Success Stories
            </div>
            <h2 class="vm-section-title mt-2">Real Couples, Real <span class="hl">Love Stories</span></h2>
            <p style="font-size:16px;color:rgba(255,255,255,0.45);max-width:500px;margin:0 auto;">
                Testimonials from Tamil families who found their perfect match through Sri Vaarahi Matrimony.
            </p>
        </div>

        <div class="row g-4">
            @php
                $testis = [
                    [
                        'txt' => 'Sri Vaarahi Matrimony helped us find the perfect groom for our daughter within 3 months of registration. The profiles are genuine and the team was very supportive throughout. We highly recommend it!',
                        'name' => 'Meenakshi & Rajan Family',
                        'loc' => 'Chennai, Tamil Nadu',
                        'init' => 'M',
                    ],
                    [
                        'txt' => 'The advanced matching system is excellent. I set my partner preferences and the auto match feature showed me exactly the profiles I was looking for. Got engaged within 6 months — so grateful!',
                        'name' => 'Karthikeyan Pillai',
                        'loc' => 'Singapore',
                        'init' => 'K',
                    ],
                    [
                        'txt' => 'Very trustworthy platform. No broker commissions, no fake profiles. Our daughter found a wonderful match through Sri Vaarahi. The Aadhaar verification process gives complete confidence.',
                        'name' => 'Saraswathi & Murugesan',
                        'loc' => 'Coimbatore, Tamil Nadu',
                        'init' => 'S',
                    ],
                ];
            @endphp
            @foreach($testis as $t)
                <div class="col-lg-4 col-md-6">
                    <div class="testi-v2">
                        <div class="testi-stars">
                            @for($i=0;$i<5;$i++)<i class="fa-solid fa-star"></i>@endfor
                        </div>
                        <span class="testi-quote">"</span>
                        <p>{{ $t['txt'] }}</p>
                        <div class="testi-author-row">
                            <div class="testi-av">{{ $t['init'] }}</div>
                            <div class="testi-av-info">
                                <strong>{{ $t['name'] }}</strong>
                                <span><i class="fa-solid fa-location-dot me-1" style="color:#e00c84;font-size:10px;"></i>{{ $t['loc'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================================
     FINAL CTA — Dynamic Animated Gradient
============================================================= --}}
<section class="final-cta" id="get-started">
    <div class="container position-relative" style="z-index:2;">
        <div class="cta-v2-title">
            Begin Your Love Story<br>
            <span class="shimmer-text">Today — It's 100% Free!</span>
        </div>
        <p style="font-size:18px;color:rgba(255,255,255,0.65);max-width:560px;margin:0 auto 36px;line-height:1.7;">
            Join over 10,000+ Tamil families. Set your expectations, browse verified profiles, and find the one destined for you.<br><br>
            <em style="font-size:15px;color:rgba(255,255,255,0.45);">ஸ்ரீ வாராஹி அம்மனின் ஆசியில் உங்கள் திருமணம் சிறப்பாக அமையட்டும்! 🙏</em>
        </p>

        <div class="d-flex flex-wrap gap-3 justify-content-center">
            <button onclick="openRegisterModal()" class="btn-hero-register" style="font-size:16px;padding:16px 44px;">
                <i class="fa-solid fa-user-plus"></i> Register Free Now
            </button>
            <a href="{{ route('contact') }}" class="btn-hero-login" style="font-size:16px;padding:15px 40px;">
                <i class="fa-solid fa-phone"></i> Contact Us
            </a>
        </div>

        <div class="cta-mini-stats">
            @php
                $miniStats = [
                    ['n' => '10,000+', 'l' => 'Active Members'],
                    ['n' => '3,500+',  'l' => 'Happy Couples'],
                    ['n' => '100%',    'l' => 'Verified Profiles'],
                    ['n' => '₹0',      'l' => 'Broker Fee'],
                    ['n' => '24/7',    'l' => 'Profile Browse'],
                ];
            @endphp
            @foreach($miniStats as $ms)
                <div class="cta-mini-stat">
                    <div class="cta-mini-stat-num">{{ $ms['n'] }}</div>
                    <div class="cta-mini-stat-label">{{ $ms['l'] }}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================================
     REGISTRATION POPUP MODAL
============================================================= --}}
<div class="vm-modal-overlay" id="registerModal">
    <div class="vm-modal-backdrop" onclick="closeRegisterModal()"></div>
    <div class="vm-modal-box" id="registerModalBox">

        <div class="vm-modal-header">
            <button class="vm-modal-close" onclick="closeRegisterModal()" title="Close">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <div class="modal-icon">
                <i class="fa-solid fa-heart"></i>
            </div>
            <h3>Create Your Free Account</h3>
            <p>Join thousands of Tamil families finding love</p>
        </div>

        <div class="vm-modal-body">
            @if ($errors->any())
                <div class="alert alert-danger py-2 px-3 mb-3 rounded-3 border-0" style="font-size:13px;background:#fef2f2;color:#dc2626;">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="register_form" method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mf-group">
                    <label><i class="fa-solid fa-users"></i> Profile For / வரன் யாருக்கு</label>
                    <select name="onbehalf" required>
                        <option value="">— Select Relation —</option>
                        @foreach($onbehalfs as $r)
                            <option value="{{ $r->id }}" {{ old('onbehalf') == $r->id ? 'selected' : '' }}>{{ $r->onbehalf }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="row g-3">
                    <div class="col-12">
                        <div class="mf-group mb-0">
                            <label><i class="fa-solid fa-user"></i> Full Name / முழு பெயர்</label>
                            <input name="name" type="text" placeholder="Enter full name" value="{{ old('name') }}" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mf-group mb-0">
                            <label><i class="fa-solid fa-venus-mars"></i> Gender / பாலினம்</label>
                            <select name="gender" required>
                                <option value="">— Select —</option>
                                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male / ஆண்</option>
                                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female / பெண்</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mf-group mb-0">
                            <label><i class="fa-solid fa-phone"></i> Mobile / தொலைபேசி</label>
                            <input type="text" name="mobileno" id="mobileno" maxlength="10"
                                onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                placeholder="10-digit number" value="{{ old('mobileno') }}" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mf-group mb-0">
                            <label><i class="fa-solid fa-envelope"></i> Email / மின்னஞ்சல்</label>
                            <input name="email" type="email" placeholder="Enter email address" value="{{ old('email') }}" required autocomplete="off">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mf-group mb-0">
                            <label><i class="fa-solid fa-key"></i> Password / கடவுச்சொல்</label>
                            <div class="mf-pw-wrap">
                                <input type="password" name="password" id="modalPassword" placeholder="Min 8 characters" required autocomplete="new-password">
                                <button type="button" class="mf-eye" onclick="toggleModalPassword()">
                                    <i class="fa-regular fa-eye-slash" id="modalEyeIcon"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-3 mb-4 d-flex align-items-start gap-2" style="font-size:12.5px;color:#64748b;line-height:1.5;">
                    <input type="checkbox" name="radio-1" value="Yes" checked style="margin-top:3px;accent-color:#a90771;flex-shrink:0;">
                    <span>By registering, I agree to the <a href="{{ route('terms') }}" style="color:#a90771;font-weight:700;">Terms & Conditions</a> and <a href="{{ route('privacy') }}" style="color:#a90771;font-weight:700;">Privacy Policy</a> of Sri Vaarahi Matrimony.</span>
                </div>

                <button class="btn-modal-register" type="submit">
                    <i class="fa-solid fa-sparkles"></i> Create My Free Profile
                </button>

                <div class="modal-divider">Already have an account?</div>

                <a href="{{ route('login') }}" style="display:block;text-align:center;padding:12px;border:1.5px solid #e2e8f0;border-radius:12px;font-size:14.5px;font-weight:700;color:#475569;transition:all 0.25s ease;text-decoration:none;"
                   onmouseover="this.style.borderColor='#a90771';this.style.color='#a90771';"
                   onmouseout="this.style.borderColor='#e2e8f0';this.style.color='#475569';">
                    <i class="fa-regular fa-circle-user me-2"></i>Login to My Account
                </a>
            </form>
        </div>
    </div>
</div>

<script>
// ---- Modal Open / Close ----
function openRegisterModal() {
    const modal = document.getElementById('registerModal');
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
    document.getElementById('registerModalBox').style.animation = 'none';
    requestAnimationFrame(() => {
        document.getElementById('registerModalBox').style.animation = 'slideInUp 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) both';
    });
}

function closeRegisterModal() {
    document.getElementById('registerModal').classList.remove('active');
    document.body.style.overflow = '';
}

// Close on ESC
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeRegisterModal();
});

// Toggle password
function toggleModalPassword() {
    const pw = document.getElementById('modalPassword');
    const icon = document.getElementById('modalEyeIcon');
    if (pw.type === 'password') {
        pw.type = 'text';
        icon.className = 'fa-regular fa-eye';
    } else {
        pw.type = 'password';
        icon.className = 'fa-regular fa-eye-slash';
    }
}

// Auto-open modal if validation errors exist
@if($errors->any())
    document.addEventListener('DOMContentLoaded', function() {
        openRegisterModal();
    });
@endif
</script>

@endsection