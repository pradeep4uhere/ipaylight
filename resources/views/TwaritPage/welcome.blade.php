<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>TwaritX — Payment Infrastructure for the Modern Economy</title>
<meta name="description" content="TwaritX is next-generation payment infrastructure for Indian and global businesses — UPI, cards, payouts, recurring billing and cross-border payments on one platform.">
<style>
  :root{
    --bg: #F6F8F7;
    --bg-panel: #FFFFFF;
    --ink: #0E1A22;
    --navy: #0F1E2E;
    --teal: #0B6E64;
    --teal-deep: #084F49;
    --teal-tint: #E4F0EE;
    --gold: #C79A3E;
    --gold-soft: #E9D19C;
    --line: #DDE5E2;
    --muted: #4E6560;
    --mono: 'IBM Plex Mono', ui-monospace, SFMono-Regular, Menlo, monospace;
    --sans: 'IBM Plex Sans', -apple-system, BlinkMacSystemFont, sans-serif;
    --disp: 'Space Grotesk', var(--sans);
  }
  *{box-sizing:border-box; margin:0; padding:0;}
  html{scroll-behavior:smooth;}
  body{
    background:var(--bg);
    color:var(--ink);
    font-family:var(--sans);
    font-size:16px;
    line-height:1.55;
    -webkit-font-smoothing:antialiased;
  }
  @media (prefers-reduced-motion: reduce){
    *{animation-duration:0.001ms !important; animation-iteration-count:1 !important; transition-duration:0.001ms !important;}
  }
  img,canvas{display:block; max-width:100%;}
  a{color:inherit; text-decoration:none;}
  ul{list-style:none;}
  :focus-visible{outline:2px solid var(--gold); outline-offset:2px;}

  .wrap{max-width:1180px; margin:0 auto; padding:0 28px;}
  section{padding:96px 0;}
  @media (max-width:720px){ section{padding:64px 0;} .wrap{padding:0 20px;} }

  h1,h2,h3,h4{font-family:var(--disp); font-weight:600; letter-spacing:-0.01em; color:var(--navy);}
  h2{font-size:clamp(28px,4vw,40px); line-height:1.15; max-width:640px;}
  h3{font-size:20px;}
  .lede{color:var(--muted); font-size:17px; max-width:520px; margin-top:14px;}
  .section-head{display:flex; justify-content:space-between; align-items:flex-end; gap:24px; margin-bottom:44px; border-bottom:1px solid var(--line); padding-bottom:28px;}
  .section-head .idx{font-family:var(--mono); font-size:13px; color:var(--gold); white-space:nowrap; padding-bottom:6px;}

  /* ---------- NAV ---------- */
  header{
    position:fixed; top:0; left:0; right:0; z-index:100;
    background:rgba(246,248,247,0.86); backdrop-filter:blur(10px);
    border-bottom:1px solid var(--line);
  }
  nav{display:flex; align-items:center; justify-content:space-between; padding:16px 28px; max-width:1180px; margin:0 auto;}
  .brand{display:flex; align-items:center; gap:10px; font-family:var(--disp); font-weight:700; font-size:19px; color:var(--navy);}
  .brand .mark{width:26px;height:26px; position:relative;}
  .brand .mark svg{width:100%;height:100%;}
  .navlinks{display:flex; gap:30px; font-size:14.5px; color:var(--navy);}
  .navlinks a{opacity:.78; transition:opacity .15s;}
  .navlinks a:hover{opacity:1;}
  .navcta{display:flex; align-items:center; gap:16px;}
  .navcta a.login{font-size:14.5px; color:var(--navy); opacity:.8;}
  @media (max-width:860px){ .navlinks{display:none;} }

  .btn{
    display:inline-flex; align-items:center; justify-content:center; gap:8px;
    padding:12px 22px; border-radius:3px; font-size:14.5px; font-weight:600;
    cursor:pointer; border:1px solid transparent; transition:transform .15s, background .15s, border-color .15s;
    font-family:var(--sans);
  }
  .btn:active{transform:translateY(1px);}
  .btn-primary{background:var(--teal); color:#fff;}
  .btn-primary:hover{background:var(--teal-deep);}
  .btn-outline{background:transparent; color:var(--navy); border-color:var(--line);}
  .btn-outline:hover{border-color:var(--navy);}
  .btn-gold{background:transparent; color:var(--gold); border-color:var(--gold-soft);}
  .btn-gold:hover{background:var(--gold); color:#fff;}

  /* ---------- HERO ---------- */
  #hero{
    padding:168px 0 96px;
    background:var(--navy);
    color:#fff;
    position:relative;
    overflow:hidden;
  }
  #hero .wrap{display:grid; grid-template-columns:1.05fr 0.95fr; gap:40px; align-items:center;}
  @media (max-width:900px){ #hero .wrap{grid-template-columns:1fr;} #hero{padding-top:140px;} }
  .eyebrow-line{font-family:var(--mono); font-size:12.5px; color:var(--gold); letter-spacing:.02em; margin-bottom:22px; display:flex; align-items:center; gap:10px;}
  .eyebrow-line::before{content:''; width:22px; height:1px; background:var(--gold);}
  #hero h1{
    font-family:var(--disp); color:#fff; font-weight:600;
    font-size:clamp(34px,5.2vw,58px); line-height:1.06; letter-spacing:-0.015em;
  }
  #hero .lede{color:#B9C7C4; font-size:17.5px; max-width:460px; margin-top:20px;}
  .hero-ctas{display:flex; gap:14px; margin-top:36px; flex-wrap:wrap;}
  .hero-sub-cta{margin-top:18px; font-size:14px;}
  .hero-sub-cta a{color:var(--gold-soft); border-bottom:1px solid rgba(233,209,156,.4);}

  .globe-panel{position:relative; height:460px;}
  #globeCanvas{width:100%; height:100%;}
  .globe-label{position:absolute; font-family:var(--mono); font-size:11px; color:var(--gold-soft); background:rgba(11,110,100,0.18); border:1px solid rgba(233,209,156,.3); padding:3px 8px; border-radius:2px; pointer-events:none; white-space:nowrap;}
  .globe-caption{position:absolute; bottom:0; left:0; font-family:var(--mono); font-size:11.5px; color:#8FA6A2; letter-spacing:.03em;}
  .ticker{position:absolute; top:0; right:0; text-align:right; font-family:var(--mono); font-size:13px; color:var(--gold-soft);}

  /* transaction micro animation */
  .tx-flow{margin-top:34px; display:flex; align-items:center; gap:0; font-family:var(--mono); font-size:12px; color:#8FA6A2; border-top:1px solid rgba(255,255,255,.12); padding-top:22px;}
  .tx-flow .tx-step{display:flex; align-items:center; gap:8px; opacity:.4; transition:opacity .4s;}
  .tx-flow .tx-step.on{opacity:1; color:#fff;}
  .tx-flow .dot{width:6px;height:6px;border-radius:50%; background:#8FA6A2;}
  .tx-flow .tx-step.on .dot{background:var(--gold);}
  .tx-flow .arrow{width:26px; height:1px; background:rgba(255,255,255,.18); margin:0 6px;}

  /* ---------- TRUST BAR ---------- */
  #trust{padding:38px 0; border-bottom:1px solid var(--line);}
  #trust .wrap{display:flex; align-items:center; gap:34px; flex-wrap:wrap; justify-content:space-between;}
  #trust p{font-family:var(--mono); font-size:12.5px; color:var(--muted); text-transform:uppercase; letter-spacing:.06em;}
  .chips{display:flex; flex-wrap:wrap; gap:10px;}
  .chip{font-size:13px; padding:7px 14px; border:1px solid var(--line); border-radius:20px; color:var(--navy); background:#fff;}

  /* ---------- SERVICES GRID ---------- */
  .grid-3{display:grid; grid-template-columns:repeat(3,1fr); gap:1px; background:var(--line); border:1px solid var(--line);}
  @media (max-width:900px){ .grid-3{grid-template-columns:repeat(2,1fr);} }
  @media (max-width:560px){ .grid-3{grid-template-columns:1fr;} }
  .svc-card{background:#fff; padding:28px 26px; min-height:168px; display:flex; flex-direction:column; justify-content:space-between; transition:background .15s;}
  .svc-card:hover{background:var(--teal-tint);}
  .svc-top{display:flex; justify-content:space-between; align-items:flex-start; gap:10px;}
  .svc-num{font-family:var(--mono); font-size:12px; color:var(--gold);}
  .status{font-family:var(--mono); font-size:10.5px; padding:3px 8px; border-radius:20px; letter-spacing:.03em;}
  .status.live{background:var(--teal-tint); color:var(--teal-deep); border:1px solid #BFDCD7;}
  .status.soon{background:#F4EEDD; color:#8A6A20; border:1px solid var(--gold-soft);}
  .svc-card h3{margin-top:14px; font-size:17px;}
  .svc-card p{color:var(--muted); font-size:14px; margin-top:8px;}

  /* ---------- EXPLORER ---------- */
  #explorer{background:var(--bg-panel); border-top:1px solid var(--line); border-bottom:1px solid var(--line);}
  .explorer-tabs{display:flex; gap:0; flex-wrap:wrap; border-bottom:1px solid var(--line); margin-bottom:0;}
  .etab{font-family:var(--mono); font-size:13px; padding:14px 20px; color:var(--muted); border-bottom:2px solid transparent; cursor:pointer; background:none; border-top:none; border-left:none; border-right:none;}
  .etab.active{color:var(--teal-deep); border-bottom-color:var(--teal);}
  .epanel{display:none; padding:32px 0 4px;}
  .epanel.active{display:block;}
  .emethods{display:grid; grid-template-columns:repeat(auto-fill,minmax(190px,1fr)); gap:14px;}
  .emethod{border:1px solid var(--line); background:var(--bg); padding:16px 18px; border-radius:3px; font-size:14px; display:flex; align-items:center; justify-content:space-between;}
  .emethod .tag{font-family:var(--mono); font-size:10px; color:var(--muted);}

  /* ---------- DASHBOARD PREVIEW ---------- */
  #dashboard{background:var(--navy); color:#fff;}
  #dashboard .section-head{border-bottom-color:rgba(255,255,255,.12);}
  #dashboard h2{color:#fff;}
  #dashboard .lede{color:#9FB3AF;}
  .demo-flag{font-family:var(--mono); font-size:10.5px; color:var(--gold-soft); border:1px solid rgba(233,209,156,.35); padding:3px 9px; border-radius:20px; align-self:flex-start;}
  .dash-grid{display:grid; grid-template-columns:repeat(4,1fr); gap:1px; background:rgba(255,255,255,.1); border:1px solid rgba(255,255,255,.1); margin-top:8px;}
  @media (max-width:820px){ .dash-grid{grid-template-columns:repeat(2,1fr);} }
  .dash-cell{background:#12222F; padding:24px; min-height:110px;}
  .dash-cell .label{font-family:var(--mono); font-size:11px; color:#8FA6A2; text-transform:uppercase; letter-spacing:.04em;}
  .dash-cell .value{font-family:var(--disp); font-size:26px; margin-top:10px; color:#fff;}
  .dash-cell .value.good{color:#7FD9C4;}
  .dash-bars{margin-top:1px; background:#12222F; border:1px solid rgba(255,255,255,.1); border-top:none; padding:26px 24px;}
  .bar-row{display:flex; align-items:center; gap:14px; margin-bottom:14px; font-family:var(--mono); font-size:12px; color:#8FA6A2;}
  .bar-row .barlabel{width:110px; flex-shrink:0;}
  .bar-track{flex:1; height:6px; background:rgba(255,255,255,.08); border-radius:3px; overflow:hidden;}
  .bar-fill{height:100%; background:linear-gradient(90deg,var(--teal),var(--gold)); border-radius:3px;}

  /* ---------- FLOW VISUALIZER ---------- */
  .flow-row{display:flex; align-items:center; justify-content:space-between; gap:8px; flex-wrap:wrap; margin-top:8px;}
  .flow-node{flex:1; min-width:120px; border:1px solid var(--line); background:#fff; text-align:center; padding:20px 10px; border-radius:3px; cursor:pointer; transition:border-color .15s, background .15s;}
  .flow-node:hover, .flow-node.active{border-color:var(--teal); background:var(--teal-tint);}
  .flow-node .fn-title{font-size:13.5px; font-weight:600; color:var(--navy);}
  .flow-arrow{font-family:var(--mono); color:var(--muted); font-size:14px; flex-shrink:0;}
  #flow-desc{margin-top:22px; font-size:14.5px; color:var(--muted); min-height:24px; border-top:1px solid var(--line); padding-top:18px;}

  /* ---------- DEVELOPER ---------- */
  #dev{background:var(--bg-panel); border-top:1px solid var(--line); border-bottom:1px solid var(--line);}
  .dev-grid{display:grid; grid-template-columns:1fr 1fr; gap:44px; align-items:start;}
  @media (max-width:860px){ .dev-grid{grid-template-columns:1fr;} }
  .code-tabs{display:flex; gap:2px; margin-bottom:0;}
  .ctab{font-family:var(--mono); font-size:12px; padding:9px 14px; background:#EEF3F2; color:var(--muted); cursor:pointer; border:1px solid var(--line); border-bottom:none;}
  .ctab.active{background:var(--navy); color:#fff; border-color:var(--navy);}
  .code-box{background:var(--navy); color:#D9E6E3; font-family:var(--mono); font-size:13px; padding:22px; border-radius:0 4px 4px 4px; overflow-x:auto; line-height:1.65; min-height:220px;}
  .code-box .k{color:var(--gold-soft);}
  .code-box .s{color:#8FE0C8;}
  .code-panel{display:none;}
  .code-panel.active{display:block;}
  .dev-links{display:flex; gap:12px; margin-top:24px; flex-wrap:wrap;}

  /* ---------- TERMINOLOGY WIDGET ---------- */
  #glossary-game{background:var(--teal-tint); border-top:1px solid var(--line); border-bottom:1px solid var(--line);}
  .quiz-card{background:#fff; border:1px solid var(--line); border-radius:4px; padding:30px; max-width:560px;}
  .quiz-term{font-family:var(--disp); font-size:22px; color:var(--navy); margin-bottom:4px;}
  .quiz-level{font-family:var(--mono); font-size:11px; color:var(--gold); text-transform:uppercase; letter-spacing:.05em; margin-bottom:18px;}
  .quiz-opts{display:grid; gap:10px;}
  .qopt{text-align:left; padding:13px 16px; border:1px solid var(--line); background:var(--bg); border-radius:3px; font-size:14px; cursor:pointer; color:var(--navy);}
  .qopt:hover{border-color:var(--teal);}
  .qopt.correct{border-color:var(--teal); background:var(--teal-tint); color:var(--teal-deep); font-weight:600;}
  .qopt.wrong{border-color:#C4534A; background:#FBEAE8; color:#A23B33;}
  .quiz-explain{margin-top:16px; font-size:13.5px; color:var(--muted); min-height:20px;}
  .quiz-foot{display:flex; justify-content:space-between; align-items:center; margin-top:20px; font-family:var(--mono); font-size:12px; color:var(--muted);}
  #xp{color:var(--gold); font-weight:600;}

  /* ---------- TWO COL FEATURE ---------- */
  .two-col{display:grid; grid-template-columns:1fr 1fr; gap:60px;}
  @media (max-width:820px){ .two-col{grid-template-columns:1fr; gap:44px;} }
  .feat-list li{display:flex; gap:12px; padding:13px 0; border-bottom:1px solid var(--line); font-size:14.5px; color:var(--navy);}
  .feat-list li .b{color:var(--gold); flex-shrink:0;}
  .flow-vert{border:1px solid var(--line); background:#fff; padding:26px;}
  .flow-vert .fv-step{padding:14px 0; border-bottom:1px dashed var(--line); font-family:var(--mono); font-size:13px; color:var(--navy); display:flex; align-items:center; gap:10px;}
  .flow-vert .fv-step:last-child{border-bottom:none;}
  .flow-vert .fv-arrow{text-align:center; color:var(--gold); font-size:12px; padding:2px 0;}

  /* ---------- GLOBAL PAYMENTS ---------- */
  .curr-grid{display:grid; grid-template-columns:repeat(auto-fill,minmax(140px,1fr)); gap:1px; background:var(--line); border:1px solid var(--line); margin-top:10px;}
  .curr-cell{background:#fff; padding:20px; text-align:left;}
  .curr-cell .sym{font-family:var(--disp); font-size:22px; color:var(--teal-deep);}
  .curr-cell .name{font-family:var(--mono); font-size:11px; color:var(--muted); margin-top:4px;}

  /* ---------- SOLUTIONS ---------- */
  .pill-grid{display:flex; flex-wrap:wrap; gap:12px; margin-top:10px;}
  .pill{border:1px solid var(--line); padding:11px 20px; border-radius:20px; font-size:14px; background:#fff; color:var(--navy);}

  /* ---------- SECURITY ---------- */
  #security{background:var(--navy); color:#fff;}
  #security .section-head{border-bottom-color:rgba(255,255,255,.12);}
  #security h2{color:#fff;}
  #security .lede{color:#9FB3AF;}
  .sec-grid{display:grid; grid-template-columns:repeat(4,1fr); gap:1px; background:rgba(255,255,255,.1); border:1px solid rgba(255,255,255,.1);}
  @media (max-width:820px){ .sec-grid{grid-template-columns:repeat(2,1fr);} }
  .sec-cell{background:#12222F; padding:22px; font-size:13.5px; color:#C7D6D2;}
  .disclaimer{margin-top:30px; font-size:13px; color:#8FA6A2; border-left:2px solid var(--gold); padding-left:16px; max-width:640px;}

  /* ---------- PRICING ---------- */
  .price-grid{display:grid; grid-template-columns:repeat(3,1fr); gap:1px; background:var(--line); border:1px solid var(--line); margin-top:10px;}
  @media (max-width:820px){ .price-grid{grid-template-columns:1fr;} }
  .price-cell{background:#fff; padding:34px 28px; display:flex; flex-direction:column;}
  .price-cell.mid{background:var(--navy); color:#fff;}
  .price-cell .ptier{font-family:var(--mono); font-size:12px; color:var(--gold); text-transform:uppercase; letter-spacing:.05em;}
  .price-cell h3{margin-top:10px; font-size:22px;}
  .price-cell.mid h3{color:#fff;}
  .price-cell p{color:var(--muted); font-size:14px; margin-top:10px; flex:1;}
  .price-cell.mid p{color:#9FB3AF;}
  .price-cell .btn{margin-top:22px;}

  /* ---------- FAQ ---------- */
  .faq-item{border-bottom:1px solid var(--line);}
  .faq-q{width:100%; text-align:left; background:none; border:none; padding:20px 0; font-size:15.5px; font-weight:600; color:var(--navy); display:flex; justify-content:space-between; align-items:center; cursor:pointer; font-family:var(--sans);}
  .faq-plus{font-family:var(--mono); color:var(--gold); font-size:18px; transition:transform .2s;}
  .faq-item.open .faq-plus{transform:rotate(45deg);}
  .faq-a{max-height:0; overflow:hidden; transition:max-height .25s ease; font-size:14.5px; color:var(--muted);}
  .faq-item.open .faq-a{max-height:200px; padding-bottom:20px;}

  /* ---------- ABOUT ---------- */
  #about{background:var(--teal-tint);}
  #about .wrap{max-width:760px; text-align:left;}
  #about h2{max-width:none;}
  #about p{margin-top:18px; font-size:16.5px; color:var(--muted); max-width:640px;}

  /* ---------- FINAL CTA ---------- */
  #final-cta{
    background:radial-gradient(ellipse at top right, #123B36 0%, var(--navy) 55%);
    color:#fff; text-align:center; padding:110px 0;
  }
  #final-cta h2{color:#fff; margin:0 auto; max-width:600px; font-size:clamp(28px,4.4vw,44px);}
  #final-cta .lede{color:#9FB3AF; margin:16px auto 0; max-width:480px;}
  #final-cta .hero-ctas{justify-content:center; margin-top:34px;}

  /* ---------- FOOTER ---------- */
  footer{background:var(--navy); color:#8FA6A2; padding:64px 0 30px; font-size:13.5px;}
  .foot-grid{display:grid; grid-template-columns:1.4fr repeat(4,1fr); gap:30px; padding-bottom:44px; border-bottom:1px solid rgba(255,255,255,.1);}
  @media (max-width:820px){ .foot-grid{grid-template-columns:repeat(2,1fr);} }
  .foot-brand{font-family:var(--disp); font-size:19px; color:#fff; font-weight:700;}
  .foot-tag{margin-top:10px; color:#8FA6A2; max-width:220px;}
  .foot-col h4{font-family:var(--mono); font-size:11px; color:var(--gold-soft); text-transform:uppercase; letter-spacing:.05em; margin-bottom:14px;}
  .foot-col a{display:block; padding:5px 0; color:#B3C4C0;}
  .foot-bottom{display:flex; justify-content:space-between; align-items:center; padding-top:26px; flex-wrap:wrap; gap:12px; color:#6D857F;}

  .rev{color:var(--gold);}
</style>
</head>
<body>

<header>
  <nav>
   
      <a class="class" href="#top" aria-label="{{env('APP_NAME')}} home"><img src="{{asset('twaritpay/images/logo.png')}}" width="200px" height="80px"></a>
    <div class="navlinks">
      <a href="#services">Products</a>
      <a href="#solutions">Solutions</a>
      <a href="#global">Global</a>
      <a href="#dev">Developers</a>
      <a href="#pricing">Pricing</a>
    </div>
    <div class="navcta">
      <a href="#" class="login">Log in</a>
      <a href="#" class="btn btn-primary">Get started</a>
    </div>
  </nav>
</header>

<!-- ============ HERO ============ -->
<section id="hero">
  <div class="wrap">
    <div>
      <div class="eyebrow-line">PAYMENT INFRASTRUCTURE</div>
      <h1>Move money.<br>Move business forward.</h1>
      <p class="lede">Accept payments, automate collections, send payouts and run your entire payment stack from one platform built for India and the world.</p>
      <div class="hero-ctas">
        <a href="#" class="btn btn-primary">Get started</a>
        <a href="#" class="btn btn-outline" style="color:#fff; border-color:rgba(255,255,255,.25);">Talk to sales</a>
      </div>
      <div class="hero-sub-cta"><a href="#services">Explore payment solutions →</a></div>

      <div class="tx-flow" id="txflow">
        <div class="tx-step" data-i="0"><span class="dot"></span>Payment initiated</div>
        <div class="arrow"></div>
        <div class="tx-step" data-i="1"><span class="dot"></span>Secured</div>
        <div class="arrow"></div>
        <div class="tx-step" data-i="2"><span class="dot"></span>Processed</div>
        <div class="arrow"></div>
        <div class="tx-step" data-i="3"><span class="dot"></span>₹25,000 successful</div>
      </div>
    </div>

    <div class="globe-panel">
      <div class="ticker" id="ticker">₹ 2,45,820</div>
      <canvas id="globeCanvas"></canvas>
      <div class="globe-caption">GLOBAL PAYMENT NETWORK — illustrative, not live transaction data</div>
    </div>
  </div>
</section>

<!-- ============ TRUST BAR ============ -->
<section id="trust">
  <div class="wrap">
    <p>Built for the modern digital economy</p>
    <div class="chips">
      <span class="chip">UPI</span><span class="chip">RuPay</span><span class="chip">Visa</span>
      <span class="chip">Mastercard</span><span class="chip">Net Banking</span><span class="chip">Wallets</span>
      <span class="chip">EMI</span><span class="chip">BNPL</span><span class="chip">QR</span>
    </div>
  </div>
</section>

<!-- ============ CORE SERVICES ============ -->
<section id="services">
  <div class="wrap">
    <div class="section-head">
      <div>
        <h2>Everything you need to move money</h2>
        <p class="lede">One platform. Every payment journey — from a single checkout to global payouts.</p>
      </div>
      <div class="idx">01 / PRODUCTS</div>
    </div>
  </div>
  <div class="wrap" style="padding:0 28px;">
    <div class="grid-3" id="svc-grid"></div>
  </div>
</section>

<!-- ============ PAYMENT METHODS EXPLORER ============ -->
<section id="explorer">
  <div class="wrap">
    <div class="section-head">
      <div>
        <h2>Explore every way your customers can pay</h2>
        <p class="lede">Select a category to see the methods available under it.</p>
      </div>
      <div class="idx">02 / METHODS</div>
    </div>
    <div class="explorer-tabs" id="etabs"></div>
    <div id="epanels"></div>
  </div>
</section>

<!-- ============ DASHBOARD PREVIEW ============ -->
<section id="dashboard">
  <div class="wrap">
    <div class="section-head">
      <div>
        <h2>Your payments. One intelligent dashboard.</h2>
        <p class="lede">A live operating view of collections, settlements and payouts.</p>
      </div>
      <div class="demo-flag">DEMO DATA</div>
    </div>
    <div class="dash-grid">
      <div class="dash-cell"><div class="label">Total transactions</div><div class="value">₹4,82,50,000</div></div>
      <div class="dash-cell"><div class="label">Success rate</div><div class="value good">98.7%</div></div>
      <div class="dash-cell"><div class="label">Pending settlements</div><div class="value">₹12,40,000</div></div>
      <div class="dash-cell"><div class="label">International volume</div><div class="value">$2.4M</div></div>
    </div>
    <div class="dash-bars">
      <div class="bar-row"><span class="barlabel">UPI</span><div class="bar-track"><div class="bar-fill" style="width:64%"></div></div><span>64%</span></div>
      <div class="bar-row"><span class="barlabel">Cards</span><div class="bar-track"><div class="bar-fill" style="width:21%"></div></div><span>21%</span></div>
      <div class="bar-row"><span class="barlabel">Net banking</span><div class="bar-track"><div class="bar-fill" style="width:9%"></div></div><span>9%</span></div>
      <div class="bar-row"><span class="barlabel">Wallets + EMI</span><div class="bar-track"><div class="bar-fill" style="width:6%"></div></div><span>6%</span></div>
    </div>
  </div>
</section>

<!-- ============ FLOW VISUALIZER ============ -->
<section id="flow">
  <div class="wrap">
    <div class="section-head">
      <div>
        <h2>How a payment actually moves</h2>
        <p class="lede">Click a stage to see what happens there.</p>
      </div>
      <div class="idx">03 / HOW IT WORKS</div>
    </div>
    <div class="flow-row" id="flow-row"></div>
    <div id="flow-desc">Select a stage above to see what happens at that step.</div>
  </div>
</section>

<!-- ============ DEVELOPER ============ -->
<section id="dev">
  <div class="wrap">
    <div class="section-head">
      <div>
        <h2>Integrate payments in hours, not weeks</h2>
        <p class="lede">A single, consistent API across every payment method.</p>
      </div>
      <div class="idx">04 / DEVELOPERS</div>
    </div>
    <div class="dev-grid">
      <div>
        <div class="code-tabs" id="ctabs"></div>
        <div id="cpanels"></div>
      </div>
      <div>
        <h3>Built for developers</h3>
        <p class="lede" style="margin-top:12px;">REST APIs, SDKs and webhooks that plug into your existing stack — with a sandbox for testing before you go live.</p>
        <ul class="feat-list" style="margin-top:20px;">
          <li><span class="b">—</span>Webhooks for every payment event</li>
          <li><span class="b">—</span>SDKs for JS, Python, PHP, Node, Android, iOS</li>
          <li><span class="b">—</span>Sandbox environment — no real money moved</li>
          <li><span class="b">—</span>Idempotent, versioned REST API</li>
        </ul>
        <div class="dev-links">
          <a href="#" class="btn btn-outline">View API docs</a>
          <a href="#" class="btn btn-outline">Explore SDKs</a>
          <a href="#" class="btn btn-gold">Open sandbox</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ TERMINOLOGY GAME ============ -->
<section id="glossary-game">
  <div class="wrap">
    <div class="section-head">
      <div>
        <h2>Master the language of payments</h2>
        <p class="lede">A quick way for your team to learn payment terminology.</p>
      </div>
      <div class="idx">05 / LEARN</div>
    </div>
    <div class="quiz-card" id="quiz-card"></div>
  </div>
</section>

<!-- ============ PAYOUTS + RECURRING ============ -->
<section id="payouts">
  <div class="wrap two-col">
    <div>
      <div class="idx" style="margin-bottom:14px;">06 / PAYOUTS</div>
      <h2>Move money at scale</h2>
      <p class="lede">Send vendor, employee, refund and marketplace payouts through one API — tracked from initiation to settlement.</p>
      <ul class="feat-list" style="margin-top:22px;">
        <li><span class="b">—</span>Bulk and scheduled payouts</li>
        <li><span class="b">—</span>UPI and bank transfer payouts</li>
        <li><span class="b">—</span>Beneficiary management</li>
        <li><span class="b">—</span>Real-time payout status tracking</li>
      </ul>
    </div>
    <div class="flow-vert">
      <div class="fv-step">TwaritX</div>
      <div class="fv-arrow">↓</div>
      <div class="fv-step">Bank / UPI network</div>
      <div class="fv-arrow">↓</div>
      <div class="fv-step">Recipient account</div>
    </div>
  </div>
</section>

<section id="recurring" style="background:var(--teal-tint); border-top:1px solid var(--line); border-bottom:1px solid var(--line);">
  <div class="wrap two-col">
    <div class="flow-vert" style="order:2;">
      <div class="fv-step">Subscription created</div>
      <div class="fv-arrow">↓</div>
      <div class="fv-step">Mandate authorised</div>
      <div class="fv-arrow">↓</div>
      <div class="fv-step">Payment due</div>
      <div class="fv-arrow">↓</div>
      <div class="fv-step">Auto-debit</div>
      <div class="fv-arrow">↓</div>
      <div class="fv-step">Renewal successful</div>
    </div>
    <div style="order:1;">
      <div class="idx" style="margin-bottom:14px;">07 / RECURRING</div>
      <h2>Turn transactions into recurring revenue</h2>
      <p class="lede">UPI AutoPay, card mandates, eNACH and subscription billing — built for predictable revenue.</p>
      <p class="disclaimer" style="border-left-color:var(--teal); margin-top:20px;">Availability depends on applicable rules, banking-partner capability and merchant eligibility.</p>
    </div>
  </div>
</section>

<!-- ============ GLOBAL PAYMENTS ============ -->
<section id="global">
  <div class="wrap">
    <div class="section-head">
      <div>
        <h2>Go global without rebuilding your stack</h2>
        <p class="lede">Accept and pay out in the currencies your business operates in.</p>
      </div>
      <div class="idx">08 / GLOBAL</div>
    </div>
    <div class="curr-grid" id="curr-grid"></div>
    <p class="disclaimer" style="border-left-color:var(--teal);">Country and currency coverage depends on licensing, banking partners and applicable regulation in each market.</p>
  </div>
</section>

<!-- ============ SOLUTIONS ============ -->
<section id="solutions">
  <div class="wrap">
    <div class="section-head">
      <div>
        <h2>Payment stacks built by industry</h2>
        <p class="lede">The right mix of methods, automation and analytics for how you sell.</p>
      </div>
      <div class="idx">09 / SOLUTIONS</div>
    </div>
    <div class="pill-grid">
      <span class="pill">E-commerce</span><span class="pill">D2C</span><span class="pill">SaaS</span>
      <span class="pill">Marketplaces</span><span class="pill">EdTech</span><span class="pill">Healthcare</span>
      <span class="pill">Travel</span><span class="pill">Real estate</span><span class="pill">Subscription businesses</span>
      <span class="pill">Professional services</span>
    </div>
  </div>
</section>

<!-- ============ SECURITY ============ -->
<section id="security">
  <div class="wrap">
    <div class="section-head">
      <div>
        <h2>Security is built into every transaction</h2>
        <p class="lede">Encryption, tokenisation and risk monitoring at every stage of the payment.</p>
      </div>
      <div class="idx">10 / SECURITY</div>
    </div>
    <div class="sec-grid">
      <div class="sec-cell">Encryption in transit and at rest</div>
      <div class="sec-cell">Tokenisation of stored payment methods</div>
      <div class="sec-cell">Fraud detection and risk monitoring</div>
      <div class="sec-cell">Audit logs across the payment lifecycle</div>
    </div>
    <p class="disclaimer">Compliance and certification claims are made only where TwaritX holds the corresponding authorisation. Product availability depends on the specific banking partner, licensing status and applicable law. See our Regulatory &amp; Compliance page for details.</p>
  </div>
</section>

<!-- ============ PRICING ============ -->
<section id="pricing">
  <div class="wrap">
    <div class="section-head">
      <div>
        <h2>Simple, transparent pricing</h2>
        <p class="lede">Pick a plan to start. Enterprise pricing is custom.</p>
      </div>
      <div class="idx">11 / PRICING</div>
    </div>
    <div class="price-grid">
      <div class="price-cell">
        <div class="ptier">Starter</div>
        <h3>For small businesses</h3>
        <p>Core payment acceptance to get your first transactions live quickly.</p>
        <a href="#" class="btn btn-outline">Get custom pricing</a>
      </div>
      <div class="price-cell mid">
        <div class="ptier">Growth</div>
        <h3>For growing businesses</h3>
        <p>Recurring billing, payouts and analytics as your volume scales.</p>
        <a href="#" class="btn btn-gold">Talk to sales</a>
      </div>
      <div class="price-cell">
        <div class="ptier">Enterprise</div>
        <h3>For high-volume businesses</h3>
        <p>Custom infrastructure, dedicated support and negotiated commercial terms.</p>
        <a href="#" class="btn btn-outline">Talk to sales</a>
      </div>
    </div>
  </div>
</section>

<!-- ============ FAQ ============ -->
<section id="faq">
  <div class="wrap" style="max-width:760px;">
    <div class="section-head">
      <div><h2>Frequently asked</h2></div>
      <div class="idx">12 / FAQ</div>
    </div>
    <div id="faq-list"></div>
  </div>
</section>

<!-- ============ ABOUT ============ -->
<section id="about">
  <div class="wrap">
    <div class="idx" style="margin-bottom:14px;">13 / ABOUT</div>
    <h2>Building the infrastructure behind modern commerce</h2>
    <p>TwaritX is being built to simplify the complex world of digital payments through intelligent technology, seamless integrations and a merchant-first experience. Our aim is to make moving money as simple as sending a message — fast, secure, transparent and globally connected.</p>
  </div>
</section>

<!-- ============ FINAL CTA ============ -->
<section id="final-cta">
  <div class="wrap">
    <h2>Ready to move money smarter?</h2>
    <p class="lede">Build better payment experiences with TwaritX.</p>
    <div class="hero-ctas">
      <a href="#" class="btn btn-primary">Get started</a>
      <a href="#" class="btn btn-outline" style="color:#fff; border-color:rgba(255,255,255,.25);">Talk to sales</a>
      <a href="#" class="btn btn-gold">Explore APIs</a>
    </div>
  </div>
</section>

<footer>
  <div class="wrap">
    <div class="foot-grid">
      <div>
        <div class="foot-brand">TwaritX</div>
        <div class="foot-tag">Fast · Secure · Seamless Payments</div>
      </div>
      <div class="foot-col"><h4>Products</h4><a href="#services">Payment gateway</a><a href="#payouts">Payouts</a><a href="#recurring">Recurring</a></div>
      <div class="foot-col"><h4>Developers</h4><a href="#dev">API docs</a><a href="#dev">SDKs</a><a href="#dev">Sandbox</a></div>
      <div class="foot-col"><h4>Company</h4><a href="#about">About</a><a href="#pricing">Pricing</a><a href="#">Contact</a></div>
      <div class="foot-col"><h4>Legal</h4><a href="#">Privacy policy</a><a href="#">Terms</a><a href="#">Regulatory &amp; compliance</a></div>
    </div>
    <div class="foot-bottom">
      <span>© 2026 TwaritX. All rights reserved.</span>
      <span>Payment products are offered subject to applicable regulatory approval and banking-partner availability.</span>
    </div>
  </div>
</footer>

<script>
/* ============ DATA ============ */
const services = [
  {t:"Payment gateway", d:"Accept UPI, cards, net banking and wallets in one integration.", status:"live"},
  {t:"UPI payments", d:"Intent, collect and QR flows with UPI AutoPay for recurring debits.", status:"live"},
  {t:"Payment links & pages", d:"Get paid without a checkout — share a link or hosted page.", status:"live"},
  {t:"Recurring payments", d:"UPI AutoPay, card mandates and eNACH for subscriptions.", status:"live"},
  {t:"Payouts", d:"Send vendor, employee and marketplace payouts in bulk or by API.", status:"live"},
  {t:"International payments", d:"Accept and settle cross-border payments in multiple currencies.", status:"soon"},
  {t:"Split settlements", d:"Automatically route marketplace payments to multiple parties.", status:"soon"},
  {t:"Payment analytics", d:"Success rate, failure and settlement reporting in one view.", status:"live"},
  {t:"Fraud & risk management", d:"Real-time risk scoring on every transaction.", status:"live"},
  {t:"Developer APIs & SDKs", d:"REST APIs, webhooks and SDKs across major languages.", status:"live"},
  {t:"Reconciliation", d:"Automated matching of payments, settlements and bank records.", status:"soon"},
  {t:"WhatsApp collections", d:"Send and collect payments over WhatsApp.", status:"soon"},
];

const methodGroups = {
  "UPI": ["UPI Intent","UPI Collect","UPI QR","UPI AutoPay","UPI apps"],
  "Cards": ["Visa","Mastercard","RuPay","American Express","Domestic cards","International cards"],
  "Banking": ["Net banking","Bank transfer","Virtual accounts"],
  "Wallets & EMI": ["Wallets","EMI","BNPL","QR"],
  "International": ["International cards","Bank transfers","Multi-currency acceptance","Cross-border payments"],
  "Recurring": ["UPI AutoPay","Card mandates","eNACH","Subscription billing"],
};

const flowStages = [
  {t:"Customer", d:"The customer chooses a payment method at checkout — UPI, card, net banking or wallet."},
  {t:"Payment method", d:"The selected method captures payment details and hands them to TwaritX securely."},
  {t:"TwaritX", d:"TwaritX authenticates, tokenises and routes the transaction to the right network."},
  {t:"Payment network", d:"The card network, UPI switch or bank rail processes the transaction request."},
  {t:"Bank / issuer / acquirer", d:"The issuing and acquiring banks authorise and confirm the transfer of funds."},
  {t:"Merchant", d:"The merchant receives a real-time payment confirmation and can fulfil the order."},
  {t:"Settlement", d:"Funds are settled to the merchant's account on the agreed settlement cycle."},
];

const codeSamples = {
  "cURL": `curl https://api.twaritx.com/v1/payments \\
  -H <span class="k">"Authorization: Bearer sk_live_..."</span> \\
  -H <span class="k">"Content-Type: application/json"</span> \\
  -d <span class="s">'{"amount": 250000, "currency": "INR"}'</span>`,
  "JavaScript": `<span class="k">const</span> payment = <span class="k">await</span> twaritx.payments.create({
  amount: 250000,
  currency: <span class="s">"INR"</span>,
  customer: <span class="s">"demo@customer.com"</span>
});
<span class="k">console</span>.log(payment.status); <span style="color:#7A9490">// "created"</span>`,
  "Python": `payment = twaritx.Payment.create(
    amount=250000,
    currency=<span class="s">"INR"</span>,
    customer=<span class="s">"demo@customer.com"</span>
)
print(payment.status)  <span style="color:#7A9490"># "created"</span>`,
  "Node.js": `<span class="k">const</span> Twaritx = require(<span class="s">'twaritx-node'</span>);
<span class="k">const</span> client = <span class="k">new</span> Twaritx(process.env.TWARITX_KEY);

<span class="k">const</span> payment = <span class="k">await</span> client.payments.create({
  amount: 250000, currency: <span class="s">"INR"</span>
});`
};

const quizTerms = [
  {term:"Acquirer", level:"Payment beginner", opts:["The bank that holds the merchant's account and receives funds","The customer's bank that issues the card","A regulator that licenses payment companies","A currency conversion service"], correct:0, explain:"The acquirer is the merchant's bank — it receives the funds on the merchant's behalf and settles them to the merchant's account."},
  {term:"Chargeback", level:"Payment explorer", opts:["A discount offered to loyal customers","A forced reversal of a payment, initiated by the cardholder's bank", "A recurring subscription fee","A fee charged for using a wallet"], correct:1, explain:"A chargeback happens when a cardholder disputes a transaction and their bank forcibly reverses it."},
  {term:"Settlement", level:"Payment explorer", opts:["The moment a customer enters their PIN","The transfer of authorised funds from acquirer to merchant account","The process of refunding a customer","A type of fraud check"], correct:1, explain:"Settlement is when authorised, captured funds actually move into the merchant's bank account."},
  {term:"Tokenisation", level:"Fintech pro", opts:["Deleting a customer's card details after one use","Replacing sensitive card data with a non-sensitive substitute value","Converting INR to USD","Sending an OTP to the customer"], correct:1, explain:"Tokenisation swaps real card details for a token, so the actual card number is never stored by the merchant."},
];

/* ============ RENDER SERVICES ============ */
const svcGrid = document.getElementById('svc-grid');
services.forEach((s,i)=>{
  const el = document.createElement('div');
  el.className = 'svc-card';
  el.innerHTML = `<div class="svc-top"><span class="svc-num">${String(i+1).padStart(2,'0')}</span><span class="status ${s.status}">${s.status==='live'?'Available':'Coming soon'}</span></div><div><h3>${s.t}</h3><p>${s.d}</p></div>`;
  svcGrid.appendChild(el);
});

/* ============ RENDER EXPLORER ============ */
const etabs = document.getElementById('etabs');
const epanels = document.getElementById('epanels');
Object.keys(methodGroups).forEach((cat,i)=>{
  const tab = document.createElement('button');
  tab.className = 'etab' + (i===0?' active':'');
  tab.textContent = cat;
  tab.onclick = ()=>{
    document.querySelectorAll('.etab').forEach(t=>t.classList.remove('active'));
    document.querySelectorAll('.epanel').forEach(p=>p.classList.remove('active'));
    tab.classList.add('active');
    document.getElementById('epanel-'+i).classList.add('active');
  };
  etabs.appendChild(tab);

  const panel = document.createElement('div');
  panel.className = 'epanel' + (i===0?' active':'');
  panel.id = 'epanel-'+i;
  panel.innerHTML = `<div class="emethods">${methodGroups[cat].map(m=>`<div class="emethod">${m}<span class="tag">→</span></div>`).join('')}</div>`;
  epanels.appendChild(panel);
});

/* ============ RENDER FLOW ============ */
const flowRow = document.getElementById('flow-row');
const flowDesc = document.getElementById('flow-desc');
flowStages.forEach((s,i)=>{
  if(i>0){
    const arrow = document.createElement('div');
    arrow.className = 'flow-arrow';
    arrow.textContent = '→';
    flowRow.appendChild(arrow);
  }
  const node = document.createElement('div');
  node.className = 'flow-node';
  node.innerHTML = `<div class="fn-title">${s.t}</div>`;
  node.onclick = ()=>{
    document.querySelectorAll('.flow-node').forEach(n=>n.classList.remove('active'));
    node.classList.add('active');
    flowDesc.textContent = s.d;
  };
  flowRow.appendChild(node);
});

/* ============ RENDER DEV CODE TABS ============ */
const ctabs = document.getElementById('ctabs');
const cpanels = document.getElementById('cpanels');
Object.keys(codeSamples).forEach((lang,i)=>{
  const tab = document.createElement('div');
  tab.className = 'ctab' + (i===0?' active':'');
  tab.textContent = lang;
  tab.onclick = ()=>{
    document.querySelectorAll('.ctab').forEach(t=>t.classList.remove('active'));
    document.querySelectorAll('.code-panel').forEach(p=>p.classList.remove('active'));
    tab.classList.add('active');
    document.getElementById('cpanel-'+i).classList.add('active');
  };
  ctabs.appendChild(tab);

  const panel = document.createElement('div');
  panel.className = 'code-panel' + (i===0?' active':'');
  panel.id = 'cpanel-'+i;
  panel.innerHTML = `<div class="code-box"><pre style="white-space:pre-wrap;">${codeSamples[lang]}</pre></div>`;
  cpanels.appendChild(panel);
});

/* ============ TERMINOLOGY QUIZ ============ */
let quizIdx = 0, xp = 0;
const quizCard = document.getElementById('quiz-card');
function renderQuiz(){
  const q = quizTerms[quizIdx % quizTerms.length];
  quizCard.innerHTML = `
    <div class="quiz-level">${q.level}</div>
    <div class="quiz-term">${q.term}</div>
    <div style="font-size:14px;color:var(--muted);margin-bottom:18px;">What does it mean?</div>
    <div class="quiz-opts">${q.opts.map((o,i)=>`<button class="qopt" data-i="${i}">${o}</button>`).join('')}</div>
    <div class="quiz-explain"></div>
    <div class="quiz-foot"><span id="xp">${xp} XP</span><button class="btn btn-outline" id="nextq" style="padding:8px 16px;font-size:13px;">Next term →</button></div>
  `;
  quizCard.querySelectorAll('.qopt').forEach(btn=>{
    btn.onclick = ()=>{
      if(quizCard.dataset.answered) return;
      quizCard.dataset.answered = "1";
      const i = parseInt(btn.dataset.i);
      if(i===q.correct){ btn.classList.add('correct'); xp+=50; }
      else { btn.classList.add('wrong'); quizCard.querySelectorAll('.qopt')[q.correct].classList.add('correct'); }
      quizCard.querySelector('.quiz-explain').textContent = q.explain;
      quizCard.querySelector('#xp').textContent = xp + " XP";
    };
  });
  quizCard.querySelector('#nextq').onclick = ()=>{
    quizIdx++;
    delete quizCard.dataset.answered;
    renderQuiz();
  };
}
renderQuiz();

/* ============ CURRENCY GRID ============ */
const currencies = [
  {sym:"₹", name:"INR — India"}, {sym:"$", name:"USD — United States"},
  {sym:"€", name:"EUR — Europe"}, {sym:"£", name:"GBP — United Kingdom"},
  {sym:"AED", name:"UAE"}, {sym:"S$", name:"SGD — Singapore"},
  {sym:"A$", name:"AUD — Australia"}, {sym:"¥", name:"JPY — Japan"},
];
document.getElementById('curr-grid').innerHTML = currencies.map(c=>`<div class="curr-cell"><div class="sym">${c.sym}</div><div class="name">${c.name}</div></div>`).join('');

/* ============ FAQ ============ */
const faqs = [
  {q:"What is TwaritX?", a:"TwaritX is a payment technology platform that helps businesses accept, automate and move money across India and internationally."},
  {q:"What payment methods are supported?", a:"UPI, cards, net banking, wallets, EMI, BNPL and QR are supported today; recurring and cross-border methods are being rolled out — see each product's status above."},
  {q:"Can I automate recurring payments?", a:"Yes — UPI AutoPay, card mandates and eNACH support subscription billing, subject to banking-partner and regulatory eligibility."},
  {q:"How does settlement work?", a:"Authorised transactions are settled to your bank account on your agreed settlement cycle; you can track settlement status from your dashboard."},
  {q:"Does TwaritX provide APIs?", a:"Yes — a REST API with SDKs for major languages, webhooks for payment events, and a sandbox for testing before going live."},
  {q:"How is fraud handled?", a:"Every transaction is screened by a real-time risk engine; additional checks apply for higher-risk transactions."},
];
const faqList = document.getElementById('faq-list');
faqs.forEach(f=>{
  const item = document.createElement('div');
  item.className = 'faq-item';
  item.innerHTML = `<button class="faq-q"><span>${f.q}</span><span class="faq-plus">+</span></button><div class="faq-a">${f.a}</div>`;
  item.querySelector('.faq-q').onclick = ()=> item.classList.toggle('open');
  faqList.appendChild(item);
});

/* ============ HERO TX FLOW ANIMATION ============ */
const txSteps = document.querySelectorAll('#txflow .tx-step');
let txI = 0;
setInterval(()=>{
  txSteps.forEach(s=>s.classList.remove('on'));
  for(let k=0;k<=txI;k++) txSteps[k].classList.add('on');
  txI = (txI+1) % txSteps.length;
}, 1100);

/* ============ TICKER ============ */
const tickerVals = ["₹ 2,45,820","$ 8,450","€ 4,820","AED 17,500","£ 2,340","S$ 6,120"];
let tI = 0;
setInterval(()=>{ document.getElementById('ticker').textContent = tickerVals[tI = (tI+1)%tickerVals.length]; }, 1800);

/* ============ GLOBE CANVAS ============ */
(function(){
  const canvas = document.getElementById('globeCanvas');
  const ctx = canvas.getContext('2d');
  let W,H,R;
  function resize(){
    const panel = canvas.parentElement.getBoundingClientRect();
    W = canvas.width = panel.width;
    H = canvas.height = panel.height;
    R = Math.min(W,H) * 0.34;
  }
  resize();
  window.addEventListener('resize', resize);

  // lat/long grid points
  const pts = [];
  for(let lat=-80; lat<=80; lat+=20){
    for(let lon=0; lon<360; lon+=20){
      pts.push({lat:lat*Math.PI/180, lon:lon*Math.PI/180});
    }
  }
  // cities (lat, lon in degrees)
  const cities = {
    India:[21,78], USA:[39,-98], UK:[54,-2], UAE:[24,54], Singapore:[1.3,103.8], Europe:[50,10], Australia:[-25,134]
  };
  const routes = [["India","USA"],["India","UK"],["India","UAE"],["India","Singapore"],["India","Europe"],["USA","UK"],["UAE","Europe"]];

  let rot = 0;
  function project(lat, lon, rotation){
    const clat = Math.cos(lat), slat = Math.sin(lat);
    const clon = Math.cos(lon+rotation), slon = Math.sin(lon+rotation);
    const x = clat*slon;
    const y = slat;
    const z = clat*clon;
    return {x: W/2 + x*R, y: H/2 - y*R, z};
  }
  function toRad(deg){return deg*Math.PI/180;}

  function drawArc(p1, p2, rotation, t){
    // simple great-circle-ish interpolation via slerp on unit vectors
    function vec(lat,lon){ const la=toRad(lat), lo=toRad(lon); return [Math.cos(la)*Math.sin(lo), Math.sin(la), Math.cos(la)*Math.cos(lo)]; }
    const v1 = vec(p1[0],p1[1]), v2 = vec(p2[0],p2[1]);
    const dot = v1[0]*v2[0]+v1[1]*v2[1]+v1[2]*v2[2];
    const omega = Math.acos(Math.max(-1,Math.min(1,dot)));
    if(omega < 0.001) return null;
    const steps = 40;
    let prev = null;
    const lineStops = [];
    for(let i=0;i<=steps;i++){
      const f = i/steps;
      const a = Math.sin((1-f)*omega)/Math.sin(omega);
      const b = Math.sin(f*omega)/Math.sin(omega);
      const vx = a*v1[0]+b*v2[0], vy=a*v1[1]+b*v2[1], vz=a*v1[2]+b*v2[2];
      // lift arc slightly outward
      const lift = 1 + 0.15*Math.sin(f*Math.PI);
      const lon = Math.atan2(vx,vz);
      const lat = Math.asin(vy);
      const proj = project(lat, lon, rotation);
      lineStops.push(proj);
    }
    return lineStops;
  }

  function draw(){
    ctx.clearRect(0,0,W,H);
    rot += 0.0022;

    // sphere outline
    ctx.beginPath();
    ctx.arc(W/2,H/2,R,0,Math.PI*2);
    ctx.strokeStyle = 'rgba(233,209,156,0.18)';
    ctx.lineWidth = 1;
    ctx.stroke();

    // dot grid
    pts.forEach(p=>{
      const proj = project(p.lat, p.lon, rot);
      if(proj.z > -0.15){
        const alpha = Math.max(0.08, proj.z*0.5+0.35);
        ctx.beginPath();
        ctx.arc(proj.x, proj.y, 1.1, 0, Math.PI*2);
        ctx.fillStyle = `rgba(143,224,200,${alpha*0.6})`;
        ctx.fill();
      }
    });

    // routes
    routes.forEach((r,ri)=>{
      const stops = drawArc(cities[r[0]], cities[r[1]], rot);
      if(!stops) return;
      ctx.beginPath();
      let started=false;
      stops.forEach(s=>{
        if(s.z > -0.1){
          if(!started){ ctx.moveTo(s.x,s.y); started=true; }
          else ctx.lineTo(s.x,s.y);
        } else { started=false; }
      });
      ctx.strokeStyle = 'rgba(11,110,100,0.55)';
      ctx.lineWidth = 1;
      ctx.stroke();

      // moving particle
      const t = (Date.now()/1800 + ri*0.35) % 1;
      const idx = Math.floor(t*stops.length);
      const pt = stops[Math.min(idx, stops.length-1)];
      if(pt && pt.z > -0.1){
        ctx.beginPath();
        ctx.arc(pt.x, pt.y, 2.2, 0, Math.PI*2);
        ctx.fillStyle = '#C79A3E';
        ctx.shadowColor = '#C79A3E';
        ctx.shadowBlur = 6;
        ctx.fill();
        ctx.shadowBlur = 0;
      }
    });

    // city nodes
    Object.entries(cities).forEach(([name,[lat,lon]])=>{
      const proj = project(toRad(lat), toRad(lon), rot);
      if(proj.z > -0.1){
        ctx.beginPath();
        ctx.arc(proj.x, proj.y, 2.4, 0, Math.PI*2);
        ctx.fillStyle = '#E9D19C';
        ctx.fill();
      }
    });

    requestAnimationFrame(draw);
  }
  draw();
})();
</script>
</body>
</html>
