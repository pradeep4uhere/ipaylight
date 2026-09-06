<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="{{env('APP_NAME')}} — modern payment infrastructure for businesses in India and globally.">
  <meta name="theme-color" content="#071b2b">
  <title>{{env('APP_NAME')}}</title>
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('twaritpay/css/style.css')}}">
</head>
<body>
<header class="site-header" id="siteHeader">
  <div class="container nav">
    <a class="logo" href="#top" aria-label="{{env('APP_NAME')}} home"><img src="{{asset('twaritpay/images/logo.png')}}" width="200px"></a>

    <button class="mobile-toggle" id="mobileToggle" aria-label="Open menu" aria-expanded="false" aria-controls="mainNav">☰</button>

    <nav class="main-nav" id="mainNav" aria-label="Main navigation">
      <a href="#solutions">Solutions</a>
      <a href="#payments">Payments</a>
      <a href="#industries">Industries</a>
      <a href="#global">Global</a>
      <a href="#about">About</a>
    </nav>

    <div class="nav-actions">
      <button class="btn btn-light" data-modal-open>Login</button>
      <button class="btn btn-primary" data-modal-open>Get started</button>
    </div>
  </div>
</header>

<main id="top">
  <section class="hero">
    <div class="container hero-grid">
      <div class="hero-copy reveal">
        <div class="eyebrow"><span></span> Global payment infrastructure</div>
        <h1>Move money.<br><em>Grow globally.</em></h1>
        <p>One powerful platform to accept payments, manage payouts and expand your business across India and international markets.</p>
        <div class="hero-actions">
          <button class="btn btn-primary btn-lg" data-modal-open>Start accepting payments <b>→</b></button>
          <a class="btn btn-light btn-lg" href="#solutions">Explore solutions</a>
        </div>
      </div>

      <div class="hero-visual reveal" aria-hidden="true">
        <div class="hero-glow"></div>
        <div class="globe">
          <div class="globe-lines line-1"></div>
          <div class="globe-lines line-2"></div>
          <div class="globe-shine"></div>
        </div>
        <div class="orbit orbit-a"></div>
        <div class="orbit orbit-b"></div>
        <div class="payment-card">
          <small>Payment received</small>
          <strong>₹24,500.00</strong>
          <div><span>Transaction status</span><b>✓ Successful</b></div>
        </div>
      </div>
    </div>
  </section>

  <section class="stats" aria-label="Platform statistics">
    <div class="container stats-grid">
      <div><strong>200+</strong><span>Locations</span></div>
      <div><strong>1,000+</strong><span>Payment methods</span></div>
      <div><strong>150+</strong><span>Currencies</span></div>
      <div><strong>99.9%</strong><span>Platform reliability</span></div>
    </div>
  </section>

  <section class="section" id="industries">
    <div class="container">
      <div class="section-heading reveal">
        <span class="kicker">Built for growth</span>
        <h2>Payment solutions for modern businesses</h2>
        <p>Designed for businesses that need reliable payment acceptance, better conversion and easy international expansion.</p>
      </div>

      <div class="card-grid">
        <article class="info-card reveal"><div class="icon">▣</div><h3>eCommerce</h3><p>Fast checkout with cards, UPI, wallets and local payment methods.</p></article>
        <article class="info-card reveal"><div class="icon">✈</div><h3>Travel & Hospitality</h3><p>Global payments and simpler settlement for travel businesses.</p></article>
        <article class="info-card reveal"><div class="icon">◉</div><h3>Gaming</h3><p>Monetize players globally with payment methods built for digital experiences.</p></article>
        <article class="info-card reveal"><div class="icon">↻</div><h3>Subscriptions</h3><p>Automate recurring payments with flexible plans that reduce churn.</p></article>
        <article class="info-card reveal"><div class="icon">⌁</div><h3>Transportation</h3><p>Power in-app payments, instant payouts and seamless rider experiences.</p></article>
        <article class="info-card reveal"><div class="icon">▶</div><h3>Entertainment</h3><p>Scale digital subscriptions while keeping the customer journey simple.</p></article>
      </div>
    </div>
  </section>

  <section class="section section-light" id="solutions">
    <div class="container split">
      <div class="reveal">
        <span class="kicker">One platform</span>
        <h2>Smarter payment processing</h2>
        <p class="lead">Connect local and global payment methods through a single integration and manage the payment lifecycle from one platform.</p>

        <div class="checks">
          <div><i>✓</i><span>UPI, cards, wallets, bank transfers and alternative payment methods</span></div>
          <div><i>✓</i><span>Fast onboarding with automated business verification</span></div>
          <div><i>✓</i><span>Secure infrastructure with fraud and risk controls</span></div>
          <div><i>✓</i><span>Flexible APIs designed for easy integration</span></div>
        </div>

        <button class="btn btn-primary" data-modal-open>Get started</button>
      </div>

      <div class="dashboard reveal" aria-label="Illustrative payment dashboard">
        <div class="dash-header"><b>Payment dashboard</b><span>LIVE</span></div>
        <div class="chart">
          <svg viewBox="0 0 600 220" preserveAspectRatio="none" role="img" aria-label="Illustrative payment growth chart">
            <defs>
              <linearGradient id="chartFill" x1="0" x2="0" y1="0" y2="1">
                <stop offset="0" stop-color="#1d65f0" stop-opacity=".22"/>
                <stop offset="1" stop-color="#1d65f0" stop-opacity="0"/>
              </linearGradient>
            </defs>
            <path d="M0 185 L65 160 L115 174 L175 115 L235 138 L295 80 L355 104 L420 58 L480 78 L535 30 L600 48 L600 220 L0 220 Z" fill="url(#chartFill)"/>
            <polyline points="0,185 65,160 115,174 175,115 235,138 295,80 355,104 420,58 480,78 535,30 600,48" fill="none" stroke="#1d65f0" stroke-width="5"/>
            <circle cx="535" cy="30" r="7" fill="#1d65f0"/>
          </svg>
        </div>
        <div class="mini-grid">
          <div><small>Processed</small><b>₹18.4Cr</b></div>
          <div><small>Success rate</small><b>98.7%</b></div>
          <div><small>Transactions</small><b>84.2K</b></div>
        </div>
      </div>
    </div>
  </section>

  <section class="section" id="payments">
    <div class="container">
      <div class="section-heading reveal">
        <span class="kicker">Payment methods</span>
        <h2>Let customers pay their way</h2>
        <p>Give customers familiar payment options while keeping your integration simple.</p>
      </div>
      <div class="methods">
        <div class="method reveal"><b>UPI</b><small>Fast local payments</small></div>
        <div class="method reveal"><b>Visa / Mastercard</b><small>Global card acceptance</small></div>
        <div class="method reveal"><b>RuPay</b><small>India card network</small></div>
        <div class="method reveal"><b>Net Banking</b><small>Bank transfers</small></div>
        <div class="method reveal"><b>Wallets</b><small>Popular digital wallets</small></div>
        <div class="method reveal"><b>Apple Pay</b><small>International checkout</small></div>
        <div class="method reveal"><b>Google Pay</b><small>Fast mobile payments</small></div>
        <div class="method reveal"><b>1,000+ APMs</b><small>Local payment methods</small></div>
      </div>
    </div>
  </section>

  <section class="section section-light" id="global">
    <div class="container split">
      <div class="coverage-card reveal">
        <div class="coverage-head"><b>Global coverage</b><span>150+ countries</span></div>
        <div class="coverage-map"><div class="map-dot d1"></div><div class="map-dot d2"></div><div class="map-dot d3"></div><div class="map-dot d4"></div><div class="map-dot d5"></div></div>
        <div class="mini-grid">
          <div><small>Countries</small><b>150+</b></div>
          <div><small>Currencies</small><b>150+</b></div>
          <div><small>Methods</small><b>1,000+</b></div>
        </div>
      </div>

      <div class="reveal">
        <span class="kicker">Global expansion</span>
        <h2>Start local. Scale globally.</h2>
        <p class="lead">Expand into new markets without rebuilding your payment stack every time. Use one integration and connect payment methods your customers already trust.</p>
        <div class="checks">
          <div><i>✓</i><span>Multi-currency payment acceptance</span></div>
          <div><i>✓</i><span>Local payment methods across key markets</span></div>
          <div><i>✓</i><span>Centralized reporting and reconciliation</span></div>
          <div><i>✓</i><span>Dedicated integration and payment support</span></div>
        </div>
      </div>
    </div>
  </section>

  <section class="cta" id="about">
    <div class="container cta-inner reveal">
      <div>
        <span class="kicker kicker-light">Ready to grow?</span>
        <h2>Build your payment stack for the next stage of growth.</h2>
        <p>Connect with our payment experts and find the right solution for your business.</p>
      </div>
      <button class="btn btn-primary btn-lg" data-modal-open>Talk to an expert →</button>
    </div>
  </section>
</main>

<footer>
  <div class="container footer-grid">
    <div class="footer-brand">
      <a class="logo logo-footer" href="#top">{{env('APP_NAME')}}</span></a>
      <p>Modern payment infrastructure for businesses that want to grow locally and globally.</p>
    </div>
    <div><h4>Solutions</h4><a href="#solutions">Payment Processing</a><a href="#payments">Payment Methods</a><a href="#solutions">Payouts</a><a href="#solutions">Risk & Fraud</a></div>
    <div><h4>Company</h4><a href="#about">About</a><a href="#about">Partners</a><a href="#about">Careers</a><a href="#about">Contact</a></div>
    <div><h4>Resources</h4><a href="#solutions">Documentation</a><a href="#solutions">API Reference</a><a href="#about">Help Center</a><a href="#about">Privacy</a></div>
  </div>
  <div class="container copyright">
    <span>© <span id="year"></span> {{env('APP_NAME')}} All rights reserved.</span>
    <span>Production-ready starter template.</span>
  </div>
</footer>

<div class="modal" id="leadModal" role="dialog" aria-modal="true" aria-labelledby="modalTitle" hidden>
  <div class="modal-backdrop" data-modal-close></div>
  <div class="modal-card">
    <button class="modal-close" data-modal-close aria-label="Close">×</button>
    <h3 id="modalTitle">Get started</h3>
    <p>Tell us about your business and our team will contact you.</p>
    <form id="leadForm">
      <label>Full name<input name="name" autocomplete="name" required></label>
      <label>Business email<input name="email" type="email" autocomplete="email" required></label>
      <label>Company name<input name="company" autocomplete="organization" required></label>
      <label>Monthly payment volume
        <select name="volume" required>
          <option value="">Select volume</option>
          <option>₹0 – ₹25 Lakhs</option>
          <option>₹25 Lakhs – ₹1 Crore</option>
          <option>₹1 – ₹10 Crores</option>
          <option>₹10 Crores+</option>
        </select>
      </label>
      <button class="btn btn-primary" type="submit">Submit enquiry</button>
      <p class="form-note" id="formMessage" aria-live="polite"></p>
    </form>
  </div>
</div>

<script src="{{asset('twaritpay/js/app.js')}}" defer></script>
</body>
</html>
