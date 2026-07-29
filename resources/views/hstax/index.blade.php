<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $company['name'] }} — {{ $company['description'] }}</title>
<meta name="description" content="{{ $company['hero_badge'] }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap" rel="stylesheet">
<style>
  :root {
    --maroon:       #8B1A1A;
    --maroon-dk:    #5A0D0D;
    --maroon-lt:    #A82828;
    --accent-gold:  #D4AF37;
    --cream:        #FAF7F2;
    --cream-card:   #F4EFEA;
    --charcoal:     #1E1E24;
    --mid:          #55555E;
    --border:       #E5DFD9;
    --white:        #FFFFFF;
    --green-wa:     #25D366;
    --green-wa-dk:  #1DA851;
    --shadow-sm:    0 4px 12px rgba(0, 0, 0, 0.03);
    --shadow-md:    0 8px 28px rgba(139, 26, 26, 0.08);
    --shadow-hover: 0 16px 36px rgba(139, 26, 26, 0.15);
    --radius-sm:    8px;
    --radius-md:    16px;
    --radius-lg:    24px;
    --transition:   all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
  }
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
  html { scroll-behavior: smooth; }
  body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    color: var(--charcoal);
    background: var(--white);
    line-height: 1.6;
    overflow-x: hidden;
  }
  a { text-decoration: none; }
  img { max-width: 100%; height: auto; }

  .reveal { opacity: 0; transform: translateY(24px); transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), transform 0.8s cubic-bezier(0.16, 1, 0.3, 1); }
  .reveal.active { opacity: 1; transform: translateY(0); }

  nav {
    position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
    padding: 0 6%; display: flex; align-items: center; justify-content: space-between;
    height: 76px; background: rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(16px); border-bottom: 1px solid rgba(226, 221, 216, 0.5);
    transition: var(--transition);
  }
  nav.scrolled { height: 68px; background: rgba(255, 255, 255, 0.95); box-shadow: var(--shadow-md); }
  .nav-logo { display: flex; align-items: center; gap: 12px; text-decoration: none; }
  .nav-logo-icon { width: 100px; height: 42px; border-radius: 12px; display: flex; align-items: center; justify-content: center; overflow: hidden; box-shadow: 0 4px 12px rgba(139, 26, 26, 0.25); }
  .nav-logo-icon img { width: 100%; height: 100%; object-fit: cover; }
  .nav-logo-text { font-family: 'Playfair Display', serif; font-size: 20px; font-weight: 700; color: var(--maroon); line-height: 1.1; }
  .nav-logo-text span { color: var(--mid); font-size: 10px; font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 600; display: block; letter-spacing: 1.5px; text-transform: uppercase; margin-top: 2px; }
  .nav-links { display: flex; gap: 28px; list-style: none; align-items: center; }
  .nav-links a { text-decoration: none; color: var(--charcoal); font-size: 14px; font-weight: 500; transition: var(--transition); position: relative; }
  .nav-links a:not(.nav-cta)::after { content: ''; position: absolute; bottom: -4px; left: 0; width: 0; height: 2px; background: var(--maroon); transition: var(--transition); border-radius: 2px; }
  .nav-links a:not(.nav-cta):hover::after { width: 100%; }
  .nav-links a:hover { color: var(--maroon); }
  .nav-cta { background: var(--maroon); color: #fff !important; padding: 10px 22px; border-radius: 50px; font-size: 13.5px !important; font-weight: 600 !important; box-shadow: 0 4px 14px rgba(139, 26, 26, 0.2); transition: var(--transition) !important; }
  .nav-cta:hover { background: var(--maroon-dk) !important; transform: translateY(-2px); box-shadow: 0 6px 20px rgba(139, 26, 26, 0.3); }
  .hamburger { display: none; flex-direction: column; gap: 6px; cursor: pointer; padding: 4px; }
  .hamburger span { width: 24px; height: 2.5px; background: var(--charcoal); border-radius: 2px; transition: var(--transition); }
  .mobile-nav { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(255,255,255,0.98); backdrop-filter: blur(20px); z-index: 999; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 24px; opacity: 0; pointer-events: none; transition: var(--transition); transform: translateY(-10px); }
  .mobile-nav.active { opacity: 1; pointer-events: auto; transform: translateY(0); }
  .mobile-nav a { font-size: 18px; font-weight: 600; color: var(--charcoal); text-decoration: none; }
  .mobile-nav .nav-cta { font-size: 16px !important; padding: 14px 32px; }

  #hero { min-height: 100vh; background: radial-gradient(circle at 80% 20%, #A82828 0%, #8B1A1A 40%, #4A0808 100%); display: flex; align-items: center; justify-content: center; text-align: center; padding: 140px 6% 80px; position: relative; overflow: hidden; }
  #hero::before { content: ''; position: absolute; width: 600px; height: 600px; background: rgba(255, 255, 255, 0.03); border-radius: 50%; top: -100px; right: -100px; pointer-events: none; }
  .hero-inner { position: relative; max-width: 840px; z-index: 2; }
  .hero-badge { display: inline-flex; align-items: center; gap: 8px; border: 1px solid rgba(255,255,255,0.25); background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border-radius: 50px; padding: 8px 20px; font-size: 13px; font-weight: 600; letter-spacing: 0.5px; color: #fff; margin-bottom: 28px; box-shadow: 0 4px 20px rgba(0,0,0,0.1); }
  .hero-h1 { font-family: 'Playfair Display', serif; font-size: clamp(36px, 5.5vw, 64px); font-weight: 700; color: #fff; line-height: 1.15; margin-bottom: 24px; letter-spacing: -0.5px; }
  .hero-h1 em { font-style: italic; color: var(--accent-gold); font-weight: 600; }
  .hero-sub { font-size: clamp(16px, 2vw, 19px); color: rgba(255, 255, 255, 0.88); max-width: 640px; margin: 0 auto 44px; font-weight: 300; line-height: 1.7; }
  .hero-btns { display: flex; gap: 16px; justify-content: center; flex-wrap: wrap; }
  .btn-wa { display: inline-flex; align-items: center; gap: 10px; background: var(--green-wa); color: #fff; padding: 16px 32px; border-radius: 50px; font-weight: 700; font-size: 15px; text-decoration: none; transition: var(--transition); box-shadow: 0 8px 24px rgba(37, 211, 102, 0.35); }
  .btn-wa:hover { background: var(--green-wa-dk); transform: translateY(-3px) scale(1.02); box-shadow: 0 12px 32px rgba(37, 211, 102, 0.45); }
  .btn-outline-white { display: inline-flex; align-items: center; gap: 8px; border: 1.5px solid rgba(255,255,255,0.4); color: #fff; padding: 16px 30px; border-radius: 50px; font-weight: 600; font-size: 15px; text-decoration: none; backdrop-filter: blur(4px); transition: var(--transition); }
  .btn-outline-white:hover { border-color: #fff; background: rgba(255,255,255,0.15); transform: translateY(-2px); }

  .hero-stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; max-width: 700px; margin: 64px auto 0; border-top: 1px solid rgba(255,255,255,0.15); padding-top: 36px; }
  .stat-item { text-align: center; }
  .stat-num { font-family: 'Playfair Display', serif; font-size: clamp(32px, 4vw, 44px); font-weight: 700; color: #fff; line-height: 1; }
  .stat-label { font-size: 13px; color: rgba(255,255,255,0.75); margin-top: 6px; font-weight: 500; }

  section { padding: 100px 6%; }
  .section-label { display: inline-block; font-size: 12px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: var(--maroon); background: rgba(139, 26, 26, 0.06); padding: 6px 16px; border-radius: 50px; margin-bottom: 14px; }
  .section-title { font-family: 'Playfair Display', serif; font-size: clamp(28px, 4vw, 42px); font-weight: 700; color: var(--charcoal); line-height: 1.2; margin-bottom: 16px; letter-spacing: -0.5px; }
  .section-sub { font-size: 16px; color: var(--mid); max-width: 600px; font-weight: 400; line-height: 1.6; }
  .section-head { margin-bottom: 56px; }
  .section-head.center { text-align: center; }
  .section-head.center .section-sub { margin-left: auto; margin-right: auto; }

  #alur { background: var(--white); }
  .steps-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 28px; }
  .step-card { background: var(--cream); padding: 36px 28px; border-radius: var(--radius-md); border: 1px solid var(--border); transition: var(--transition); position: relative; }
  .step-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-hover); border-color: var(--maroon-lt); }
  .step-num { width: 44px; height: 44px; background: var(--maroon); color: #fff; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 16px; margin-bottom: 22px; box-shadow: 0 6px 16px rgba(139, 26, 26, 0.2); }
  .step-title { font-family: 'Playfair Display', serif; font-size: 20px; font-weight: 700; margin-bottom: 10px; color: var(--charcoal); }
  .step-desc { font-size: 14px; color: var(--mid); line-height: 1.65; }

  #layanan { background: var(--cream); }
  .paket-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 28px; }
  .paket-card { background: #fff; border: 1.5px solid var(--border); border-radius: var(--radius-md); padding: 36px 30px; position: relative; transition: var(--transition); display: flex; flex-direction: column; justify-content: space-between; }
  .paket-card:hover { box-shadow: var(--shadow-hover); transform: translateY(-6px); border-color: var(--maroon); }
  .paket-card.popular { border-color: var(--maroon); box-shadow: var(--shadow-md); background: linear-gradient(180deg, #FFFFFF 0%, #FFFBFB 100%); }
  .popular-badge { position: absolute; top: -14px; left: 50%; transform: translateX(-50%); background: var(--maroon); color: #fff; font-size: 11px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; padding: 6px 18px; border-radius: 50px; white-space: nowrap; box-shadow: 0 4px 12px rgba(139, 26, 26, 0.3); }
  .paket-icon { width: 48px; height: 48px; border-radius: 12px; background: #F8EAEA; display: flex; align-items: center; justify-content: center; margin-bottom: 20px; font-size: 22px; }
  .paket-name { font-family: 'Playfair Display', serif; font-size: 22px; font-weight: 700; margin-bottom: 8px; }
  .paket-desc { font-size: 13.5px; color: var(--mid); margin-bottom: 24px; line-height: 1.5; min-height: 40px; }
  .paket-price { font-size: 32px; font-weight: 700; color: var(--maroon); font-family: 'Playfair Display', serif; margin-bottom: 2px; }
  .paket-period { font-size: 12.5px; color: var(--mid); margin-bottom: 28px; font-weight: 500; }
  .paket-features { list-style: none; margin-bottom: 32px; border-top: 1px solid var(--border); padding-top: 20px; }
  .paket-features li { font-size: 13.5px; color: var(--charcoal); padding: 8px 0; display: flex; align-items: center; gap: 10px; }
  .paket-features li::before { content: '✓'; color: var(--maroon); font-weight: 800; font-size: 15px; flex-shrink: 0; }
  .btn-paket { display: block; text-align: center; background: var(--maroon); color: #fff; padding: 14px; border-radius: 50px; text-decoration: none; font-weight: 700; font-size: 14px; transition: var(--transition); box-shadow: 0 4px 14px rgba(139, 26, 26, 0.2); }
  .btn-paket:hover { background: var(--maroon-dk); transform: translateY(-2px); box-shadow: 0 6px 20px rgba(139, 26, 26, 0.3); }
  .btn-paket-outline { background: transparent; color: var(--maroon); border: 1.5px solid var(--maroon); box-shadow: none; }
  .btn-paket-outline:hover { background: var(--maroon); color: #fff; }

  #kenapa { background: var(--white); }
  .why-grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; margin-top: 20px; }
  .why-card-3 { padding: 44px 36px; border-radius: var(--radius-md); background: var(--cream); border: 1px solid var(--border); transition: var(--transition); }
  .why-card-3:hover { transform: translateY(-4px); box-shadow: var(--shadow-md); }
  .why-card-3.featured { background: linear-gradient(145deg, var(--maroon) 0%, var(--maroon-dk) 100%); color: #fff; }
  .why-num { font-family: 'Playfair Display', serif; font-size: 14px; font-weight: 700; color: var(--maroon); letter-spacing: 1px; margin-bottom: 20px; }
  .why-card-3.featured .why-num { color: rgba(255,255,255,0.6); }
  .why-icon-3 { font-size: 36px; margin-bottom: 18px; }
  .why-title-3 { font-family: 'Playfair Display', serif; font-size: 26px; font-weight: 700; color: var(--charcoal); margin-bottom: 14px; }
  .why-card-3.featured .why-title-3 { color: #fff; }
  .why-text-3 { font-size: 14.5px; color: var(--mid); line-height: 1.7; }
  .why-card-3.featured .why-text-3 { color: rgba(255,255,255,0.85); }

  #dokumen { background: var(--cream); }
  .doc-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 32px; }
  .doc-card { background: #fff; border-radius: var(--radius-md); padding: 40px; border: 1px solid var(--border); }
  .doc-title { font-family: 'Playfair Display', serif; font-size: 22px; font-weight: 700; margin-bottom: 20px; color: var(--maroon); }
  .doc-list { list-style: none; }
  .doc-list li { font-size: 14.5px; color: var(--charcoal); padding: 10px 0; border-bottom: 1px solid var(--border); display: flex; align-items: center; gap: 12px; }
  .doc-list li:last-child { border-bottom: none; }
  .doc-list li::before { content: '📁'; font-size: 16px; }

  #siapa { background: var(--white); }
  .siapa-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 32px; }
  .siapa-card { background: var(--cream); border-radius: var(--radius-md); padding: 40px; border: 1px solid var(--border); transition: var(--transition); }
  .siapa-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-md); }
  .siapa-emoji { font-size: 40px; margin-bottom: 18px; }
  .siapa-title { font-family: 'Playfair Display', serif; font-size: 24px; font-weight: 700; margin-bottom: 12px; }
  .siapa-desc { font-size: 14.5px; color: var(--mid); margin-bottom: 24px; line-height: 1.7; }
  .siapa-tags { display: flex; flex-wrap: wrap; gap: 10px; }
  .tag { font-size: 12.5px; font-weight: 600; background: #F8EAEA; color: var(--maroon); padding: 6px 14px; border-radius: 50px; }

  #berita { background: var(--cream); }
  .berita-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 28px; }
  .berita-card { background: #fff; border: 1px solid var(--border); border-radius: var(--radius-md); overflow: hidden; transition: var(--transition); }
  .berita-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-hover); border-color: var(--maroon-lt); }
  .berita-img { width: 100%; height: 200px; object-fit: cover; background: #f0ece6; display: flex; align-items: center; justify-content: center; color: var(--mid); font-size: 2rem; }
  .berita-body { padding: 24px; }
  .berita-date { font-size: 12px; color: var(--mid); font-weight: 500; }
  .berita-title { font-family: 'Playfair Display', serif; font-size: 18px; font-weight: 700; margin: 8px 0; color: var(--charcoal); }
  .berita-title a { color: inherit; text-decoration: none; }
  .berita-title a:hover { color: var(--maroon); }
  .berita-excerpt { font-size: 13.5px; color: var(--mid); line-height: 1.6; }
  .berita-link { display: inline-flex; align-items: center; gap: 6px; color: var(--maroon); font-weight: 600; font-size: 13px; margin-top: 12px; transition: var(--transition); }
  .berita-link:hover { gap: 10px; }

  #sosmed { background: var(--cream); }
  .sosmed-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; }
  .sosmed-card { background: #fff; padding: 28px 24px; border-radius: var(--radius-md); border: 1px solid var(--border); text-align: center; text-decoration: none; color: var(--charcoal); transition: var(--transition); display: flex; flex-direction: column; align-items: center; gap: 12px; }
  .sosmed-card:hover { transform: translateY(-5px); border-color: var(--maroon); box-shadow: var(--shadow-md); }
  .sosmed-icon { width: 52px; height: 52px; border-radius: 50%; background: #F8EAEA; color: var(--maroon); display: flex; align-items: center; justify-content: center; font-size: 22px; transition: var(--transition); }
  .sosmed-card:hover .sosmed-icon { background: var(--maroon); color: #fff; }
  .sosmed-name { font-weight: 700; font-size: 16px; }
  .sosmed-handle { font-size: 13px; color: var(--mid); }

  #perbandingan { background: var(--charcoal); color: #fff; }
  #perbandingan .section-label { background: rgba(255,255,255,0.1); color: var(--accent-gold); }
  #perbandingan .section-title { color: #fff; }
  .compare-table { width: 100%; border-collapse: collapse; margin-top: 36px; }
  .compare-table th, .compare-table td { padding: 18px 20px; text-align: center; font-size: 14px; border-bottom: 1px solid rgba(255,255,255,0.08); }
  .compare-table th { font-family: 'Playfair Display', serif; font-size: 17px; font-weight: 700; color: #fff; padding-bottom: 24px; border-bottom: 2px solid rgba(255,255,255,0.15); }
  .compare-table th.hs { color: var(--accent-gold); font-size: 19px; }
  .compare-table td { color: rgba(255,255,255,0.7); }
  .compare-table td.hs { color: #fff; font-weight: 700; background: rgba(255,255,255,0.03); }
  .compare-table td:first-child { text-align: left; color: rgba(255,255,255,0.8); font-size: 14px; font-weight: 500; }
  .chk { color: #4CAF50; font-weight: 800; font-size: 16px; }
  .x { color: #EF5350; font-weight: 800; font-size: 16px; }
  .partial { color: #FFC107; font-weight: 800; font-size: 16px; }

  #garansi { background: var(--white); text-align: center; }
  .trust-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 28px; margin-top: 40px; }
  .trust-card { padding: 32px 24px; border: 1px solid var(--border); border-radius: var(--radius-md); background: var(--cream); transition: var(--transition); }
  .trust-card:hover { transform: translateY(-4px); border-color: var(--maroon-lt); }
  .trust-icon { font-size: 36px; margin-bottom: 16px; }
  .trust-title { font-weight: 700; font-size: 17px; margin-bottom: 10px; color: var(--charcoal); }
  .trust-text { font-size: 13.5px; color: var(--mid); line-height: 1.6; }

  #testimoni { background: var(--cream); }
  .testi-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 28px; }
  .testi-card { background: #fff; border: 1px solid var(--border); border-radius: var(--radius-md); padding: 32px 28px; display: flex; flex-direction: column; justify-content: space-between; }
  .testi-stars { color: #F59E0B; font-size: 15px; margin-bottom: 16px; letter-spacing: 2px; }
  .testi-text { font-size: 14.5px; color: var(--charcoal); line-height: 1.7; font-style: italic; margin-bottom: 24px; }
  .testi-author { display: flex; align-items: center; gap: 14px; }
  .testi-avatar { width: 44px; height: 44px; border-radius: 50%; background: linear-gradient(135deg, var(--maroon) 0%, var(--maroon-lt) 100%); display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 16px; font-family: 'Playfair Display', serif; }
  .testi-name { font-weight: 700; font-size: 15px; }
  .testi-role { font-size: 12.5px; color: var(--mid); }

  #faq { background: var(--white); }
  .faq-wrap { max-width: 800px; margin: 0 auto; }
  .faq-search-box { margin-bottom: 32px; position: relative; }
  .faq-search-input { width: 100%; padding: 16px 20px 16px 50px; border: 1.5px solid var(--border); border-radius: 50px; font-size: 15px; font-family: inherit; outline: none; transition: var(--transition); background: #FAFAFA; }
  .faq-search-input:focus { border-color: var(--maroon); background: #fff; box-shadow: 0 0 0 4px rgba(139, 26, 26, 0.1); }
  .faq-search-icon { position: absolute; left: 20px; top: 50%; transform: translateY(-50%); color: var(--mid); font-size: 16px; }
  .faq-item { border-bottom: 1px solid var(--border); transition: var(--transition); }
  .faq-q { width: 100%; text-align: left; background: none; border: none; cursor: pointer; padding: 22px 0; display: flex; justify-content: space-between; align-items: center; gap: 16px; font-family: inherit; font-size: 16px; font-weight: 700; color: var(--charcoal); transition: var(--transition); }
  .faq-q:hover { color: var(--maroon); }
  .faq-icon { font-size: 20px; color: var(--maroon); transition: var(--transition); font-weight: 400; }
  .faq-a { max-height: 0; overflow: hidden; opacity: 0; transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1); font-size: 14.5px; color: var(--mid); line-height: 1.75; }
  .faq-item.open .faq-a { max-height: 300px; opacity: 1; padding-bottom: 24px; }
  .faq-item.open .faq-icon { transform: rotate(45deg); }

  #lokasi { background: var(--cream); }
  .lokasi-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: center; }
  .lokasi-title { font-family: 'Playfair Display', serif; font-size: 28px; font-weight: 700; color: var(--charcoal); margin-bottom: 16px; }
  .map-box { width: 100%; height: 360px; border-radius: var(--radius-md); overflow: hidden; border: 1px solid var(--border); box-shadow: var(--shadow-md); }
  .map-box iframe { width: 100%; height: 100%; border: 0; }
  .payment-methods { margin-top: 56px; text-align: center; border-top: 1px solid var(--border); padding-top: 36px; }
  .payment-title { font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: var(--mid); margin-bottom: 20px; }
  .payment-badges { display: flex; gap: 16px; justify-content: center; flex-wrap: wrap; }
  .pay-badge { background: #fff; padding: 10px 20px; border-radius: 50px; border: 1px solid var(--border); font-size: 13.5px; font-weight: 700; color: var(--charcoal); box-shadow: var(--shadow-sm); }

  #kontak { background: radial-gradient(circle at 50% 50%, #8B1A1A 0%, #4A0808 100%); text-align: center; padding: 100px 6%; color: #fff; }
  #kontak .section-title { color: #fff; }
  #kontak .section-sub { color: rgba(255,255,255,0.85); margin: 0 auto 44px; }
  .kontak-btns { display: flex; gap: 16px; justify-content: center; flex-wrap: wrap; margin-bottom: 48px; }
  .kontak-info { display: flex; gap: 36px; justify-content: center; flex-wrap: wrap; }
  .kontak-info-item a { color: #fff; text-decoration: none; font-size: 14px; font-weight: 500; transition: var(--transition); }
  .kontak-info-item a:hover { color: var(--accent-gold); }

  footer { background: var(--charcoal); color: rgba(255,255,255,0.5); text-align: center; padding: 32px 6%; font-size: 13px; border-top: 1px solid rgba(255,255,255,0.05); }

  @keyframes waPulse { 0% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.6); } 70% { box-shadow: 0 0 0 18px rgba(37, 211, 102, 0); } 100% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0); } }
  .wa-float { position: fixed; bottom: 32px; right: 32px; z-index: 998; width: 60px; height: 60px; border-radius: 50%; background: var(--green-wa); display: flex; align-items: center; justify-content: center; animation: waPulse 2s infinite; text-decoration: none; transition: var(--transition); }
  .wa-float:hover { transform: scale(1.1); background: var(--green-wa-dk); }
  .wa-float svg { width: 32px; height: 32px; fill: #fff; }

  .mobile-cta-bar { display: none; position: fixed; bottom: 0; left: 0; right: 0; background: #fff; padding: 12px 20px; border-top: 1px solid var(--border); z-index: 997; box-shadow: 0 -4px 16px rgba(0,0,0,0.08); }
  .mobile-cta-bar .btn-wa { width: 100%; justify-content: center; padding: 12px 20px; font-size: 14px; border-radius: 50px; }

  @media (max-width: 768px) {
    .why-grid-3 { grid-template-columns: 1fr; }
    .hero-stats { grid-template-columns: 1fr; gap: 20px; }
    .siapa-grid, .doc-grid, .lokasi-grid { grid-template-columns: 1fr; }
    .compare-table { font-size: 12px; }
    .compare-table th, .compare-table td { padding: 12px 10px; font-size: 12px; }
    .compare-table th { font-size: 14px; }
    .compare-table th.hs { font-size: 15px; }
    section { padding: 72px 5%; }
    .berita-grid { grid-template-columns: 1fr; }
    .paket-grid { grid-template-columns: 1fr; }
    .cb-box, .siapa-card, .doc-card { padding: 28px 20px; }
    .mobile-cta-bar { display: block; }
    .wa-float { bottom: 80px; right: 20px; width: 50px; height: 50px; }
    .wa-float svg { width: 26px; height: 26px; }
    .nav-links { display: none; }
    .hamburger { display: flex; }
  }
</style>
</head>
<body>

@php $waUrl = "https://wa.me/{$whatsapp['number']}?text={$whatsapp['text']}"; @endphp

<nav id="navbar">
  <a class="nav-logo" href="#">
    <div class="nav-logo-icon"><img src="{{ asset($logo) }}" alt="{{ $company['name'] }}"></div>
  </a>
  <ul class="nav-links">
    <li><a href="#alur">Alur</a></li>
    <li><a href="#layanan">Layanan</a></li>
    <li><a href="#kenapa">Kenapa Kami</a></li>
    <li><a href="#dokumen">Dokumen</a></li>
    <li><a href="#berita">Berita</a></li>
    <li><a href="#testimoni">Ulasan</a></li>
    <li><a href="#faq">FAQ</a></li>
    <li><a href="#lokasi">Lokasi</a></li>
    <li><a href="{{ $waUrl }}" class="nav-cta" target="_blank">Konsultasi Gratis</a></li>
  </ul>
  <div class="hamburger" onclick="toggleMobileNav()">
    <span></span><span></span><span></span>
  </div>
</nav>

<div class="mobile-nav" id="mobileNav">
  <a href="#alur" onclick="toggleMobileNav()">Alur</a>
  <a href="#layanan" onclick="toggleMobileNav()">Layanan</a>
  <a href="#kenapa" onclick="toggleMobileNav()">Kenapa Kami</a>
  <a href="#dokumen" onclick="toggleMobileNav()">Dokumen</a>
  <a href="#berita" onclick="toggleMobileNav()">Berita</a>
  <a href="#testimoni" onclick="toggleMobileNav()">Ulasan</a>
  <a href="#faq" onclick="toggleMobileNav()">FAQ</a>
  <a href="#lokasi" onclick="toggleMobileNav()">Lokasi</a>
  <a href="{{ $waUrl }}" class="nav-cta" target="_blank">Konsultasi Gratis</a>
</div>

{{-- HERO --}}
<section id="hero">
  <div class="hero-inner">
    <div class="hero-badge"><span>★</span> {{ $company['hero_badge'] }}</div>
    <h1 class="hero-h1">{!! $company['hero_title'] !!}</h1>
    <p class="hero-sub">{{ $company['hero_sub'] }}</p>
    <div class="hero-btns">
      <a href="{{ $waUrl }}" class="btn-wa" target="_blank">
        <svg width="20" height="20" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
        Konsultasi Gratis Via WhatsApp
      </a>
      <a href="#layanan" class="btn-outline-white">Lihat Paket Layanan →</a>
    </div>
    <div class="hero-stats">
      @foreach ($stats as $s)
      <div class="stat-item">
        <div class="stat-num">{{ $s['value'] }}{{ $s['suffix'] ?? '' }}</div>
        <div class="stat-label">{{ $s['label'] }}</div>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- ALUR --}}
<section id="alur">
  <div class="section-head center reveal">
    <div class="section-label">Cara Kerja</div>
    <h2 class="section-title">Konsultasi Mudah, 4 Langkah</h2>
  </div>
  <div class="steps-grid">
    @foreach ($steps as $s)
    <div class="step-card reveal">
      <div class="step-num">{{ $s['num'] }}</div>
      <div class="step-title">{{ $s['title'] }}</div>
      <div class="step-desc">{{ $s['desc'] }}</div>
    </div>
    @endforeach
  </div>
</section>

{{-- LAYANAN (PAKET) --}}
<section id="layanan">
  <div class="section-head center reveal">
    <div class="section-label">Paket Layanan</div>
    <h2 class="section-title">Pilih Sesuai Kebutuhan</h2>
    <p class="section-sub">Tarif flat, transparan, tanpa biaya tersembunyi. Semua paket sudah termasuk konsultasi via WhatsApp.</p>
  </div>
  <div class="paket-grid">
    @foreach ($packages as $pkg)
    <div class="paket-card reveal {{ $pkg->is_popular ? 'popular' : '' }}">
      @if ($pkg->is_popular)<div class="popular-badge">⭐ Paling Populer</div>@endif
      <div>
        <div class="paket-icon">{{ $pkg->icon }}</div>
        <div class="paket-name">{{ $pkg->name }}</div>
        <div class="paket-desc">{{ $pkg->desc }}</div>
        <div class="paket-price">{{ $pkg->price }}</div>
        <div class="paket-period">{{ $pkg->period }}</div>
        @if ($pkg->features)
        <ul class="paket-features">
          @foreach ($pkg->features as $f) <li>{{ $f }}</li> @endforeach
        </ul>
        @endif
      </div>
      <a href="{{ $waUrl }}" class="btn-paket {{ $pkg->is_popular ? '' : 'btn-paket-outline' }}" target="_blank">Pilih Paket →</a>
    </div>
    @endforeach
  </div>
</section>

{{-- KENAPA --}}
<section id="kenapa">
  <div class="section-head center reveal">
    <div class="section-label">Keunggulan</div>
    <h2 class="section-title">Kenapa HS Tax?</h2>
  </div>
  <div class="why-grid-3">
    @foreach ($why as $w)
    <div class="why-card-3 reveal {{ !empty($w['featured']) ? 'featured' : '' }}">
      <div class="why-num">{{ $w['num'] }}</div>
      <div class="why-icon-3">{{ $w['icon'] }}</div>
      <div class="why-title-3">{{ $w['title'] }}</div>
      <div class="why-text-3">{{ $w['text'] }}</div>
    </div>
    @endforeach
  </div>
</section>

{{-- DOKUMEN --}}
<section id="dokumen">
  <div class="section-head center reveal">
    <div class="section-label">Persiapan</div>
    <h2 class="section-title">Siapkan Dokumen Berikut</h2>
  </div>
  <div class="doc-grid">
    @foreach ($documents as $key => $doc)
    <div class="doc-card reveal">
      <div class="doc-title">{{ $doc['title'] }}</div>
      <ul class="doc-list">
        @foreach ($doc['items'] as $item) <li>{{ $item }}</li> @endforeach
      </ul>
    </div>
    @endforeach
  </div>
</section>

{{-- SIAPA --}}
<section id="siapa">
  <div class="section-head center reveal">
    <div class="section-label">Target</div>
    <h2 class="section-title">Untuk Siapa HS Tax?</h2>
  </div>
  <div class="siapa-grid">
    @foreach ($audience as $a)
    <div class="siapa-card reveal">
      <div class="siapa-emoji">{{ $a['emoji'] }}</div>
      <div class="siapa-title">{{ $a['title'] }}</div>
      <div class="siapa-desc">{{ $a['desc'] }}</div>
      <div class="siapa-tags">@foreach ($a['tags'] as $t) <span class="tag">{{ $t }}</span> @endforeach</div>
    </div>
    @endforeach
  </div>
</section>

{{-- BERITA --}}
@if ($news->count())
<section id="berita">
  <div class="section-head center reveal">
    <div class="section-label">Artikel</div>
    <h2 class="section-title">Berita & Artikel Terbaru</h2>
    <p class="section-sub">Info seputar perpajakan, UMKM, dan tips keuangan dari HS Tax.</p>
  </div>
  <div class="berita-grid">
    @foreach ($news as $item)
    <div class="berita-card reveal">
      @if ($item->image)
        <img class="berita-img" src="{{ $item->image }}" alt="{{ $item->title }}" loading="lazy">
      @else
        <div class="berita-img"><i class="berita-img-icon">📰</i></div>
      @endif
      <div class="berita-body">
        <div class="berita-date">{{ $item->created_at->format('d F Y') }}</div>
        <h3 class="berita-title"><a href="{{ route('news.detail', $item->slug) }}">{{ $item->title }}</a></h3>
        @if ($item->excerpt)<p class="berita-excerpt">{{ $item->excerpt }}</p>@endif
        <a href="{{ route('news.detail', $item->slug) }}" class="berita-link">Baca Selengkapnya →</a>
      </div>
    </div>
    @endforeach
  </div>
</section>
@endif

{{-- PERBANDINGAN --}}
<section id="perbandingan">
  <div class="section-head center reveal">
    <div class="section-label">Perbandingan</div>
    <h2 class="section-title">Kenapa HS Tax Lebih Praktis?</h2>
  </div>
  <div style="overflow-x:auto;" class="reveal">
    <table class="compare-table">
      <thead>
        <tr>
          <th style="text-align:left;">Layanan</th>
          <th class="hs">HS Tax</th>
          <th>Konsultasi Konvensional</th>
          <th>Aplikasi Software Self-service</th>
        </tr>
      </thead>
      <tbody>
        <tr><td>Spesialis UMKM & Freelancer</td><td class="hs chk">✓ Spesialis</td><td class="x">✗ Jarang</td><td class="partial">~ Umum</td></tr>
        <tr><td>Harga Transparan di Awal</td><td class="hs chk">✓ Flat Rate</td><td class="x">✗ Berubah-ubah</td><td class="chk">✓ Biaya Langganan</td></tr>
        <tr><td>Pendampingan Personal WhatsApp</td><td class="hs chk">✓ Langsung Konsultan</td><td class="partial">~ Lambat</td><td class="x">✗ Chatbot Bot/Tiket</td></tr>
        <tr><td>Konsultasi Tanpa Jargon</td><td class="hs chk">✓ Mudah Dipahami</td><td class="x">✗ Bahasa Formal Teknis</td><td class="partial">~ Mandiri Pelajari Manual</td></tr>
      </tbody>
    </table>
  </div>
</section>

{{-- GARANSI --}}
<section id="garansi">
  <div class="section-head center reveal">
    <div class="section-label">Jaminan</div>
    <h2 class="section-title">Aman, Rahasia, & Tepat Waktu</h2>
  </div>
  <div class="trust-grid">
    @foreach ($trust as $item)
    <div class="trust-card reveal">
      <div class="trust-icon">{{ $item['icon'] }}</div>
      <div class="trust-title">{{ $item['title'] }}</div>
      <div class="trust-text">{{ $item['text'] }}</div>
    </div>
    @endforeach
  </div>
</section>

{{-- TESTIMONI --}}
<section id="testimoni">
  <div class="section-head center reveal">
    <div class="section-label">Ulasan Klien</div>
    <h2 class="section-title">Apa Kata Mereka?</h2>
  </div>
  <div class="testi-grid">
    @forelse ($testimonials as $item)
    <div class="testi-card reveal">
      <div>
        <div class="testi-stars">{{ str_repeat('★', $item->stars) }}</div>
        <p class="testi-text">"{{ $item->text }}"</p>
      </div>
      <div class="testi-author">
        <div class="testi-avatar">{{ $item->initial ?: substr($item->name, 0, 1) }}</div>
        <div>
          <div class="testi-name">{{ $item->name }}</div>
          <div class="testi-role">{{ $item->role }}</div>
        </div>
      </div>
    </div>
    @empty
    <div class="text-center" style="grid-column:1/-1;">Belum ada testimoni.</div>
    @endforelse
  </div>
</section>

{{-- FAQ --}}
<section id="faq">
  <div class="section-head center reveal">
    <div class="section-label">Tanya Jawab</div>
    <h2 class="section-title">Pertanyaan Umum</h2>
  </div>
  <div class="faq-wrap">
    <div class="faq-search-box reveal">
      <span class="faq-search-icon">🔍</span>
      <input class="faq-search-input" type="text" id="faqSearch" placeholder="Cari pertanyaan..." oninput="filterFaq()">
    </div>
    @foreach ($faqs as $faq)
    <div class="faq-item reveal" data-q="{{ strtolower($faq->question) }}">
      <button class="faq-q" onclick="toggleFaq(this)">
        {{ $faq->question }}
        <span class="faq-icon">+</span>
      </button>
      <div class="faq-a">{{ $faq->answer }}</div>
    </div>
    @endforeach
  </div>
</section>

{{-- LOKASI --}}
<section id="lokasi">
  <div class="lokasi-grid">
    <div class="reveal">
      <div class="section-label">Kantor</div>
      <div class="lokasi-title">Temukan Kami</div>
      <p style="color:var(--mid);line-height:1.7;margin-bottom:20px;">{{ $contact['address'] }}</p>
      <div style="display:flex;flex-direction:column;gap:12px;">
        <span><strong>📞</strong> {{ $contact['phone'] }}</span>
        <span><strong>✉️</strong> {{ $contact['email'] }}</span>
        <span><strong>🕐</strong> {{ $contact['working_hours'] }}</span>
      </div>
      <div class="payment-methods" style="margin-top:40px;text-align:left;border-top:none;padding-top:0;">
        <div class="payment-title">Metode Pembayaran</div>
        <div class="payment-badges" style="justify-content:flex-start;">
          @foreach ($payments as $pay) <span class="pay-badge">{{ $pay }}</span> @endforeach
        </div>
      </div>
    </div>
    <div class="reveal">
      <div class="map-box">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.1234!2d104.0!3d1.0!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMcKwMDAnMDAuMCJOIDEwNMKwMDAnMDAuMCJF!5e0!3m2!1sid!2sid!4v1" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>
  </div>
</section>

{{-- SOSMED --}}
<section id="sosmed">
  <div class="section-head center reveal">
    <div class="section-label">Ikuti Kami</div>
    <h2 class="section-title">Terhubung di Media Sosial</h2>
  </div>
  <div class="sosmed-grid">
    <a href="{{ $social['instagram']['url'] ?? '#' }}" class="sosmed-card reveal" target="_blank" rel="noopener">
      <div class="sosmed-icon">📸</div>
      <div class="sosmed-name">Instagram</div>
      <div class="sosmed-handle">{{ $social['instagram']['handle'] ?? '' }}</div>
    </a>
    <a href="{{ $social['tiktok']['url'] ?? '#' }}" class="sosmed-card reveal" target="_blank" rel="noopener">
      <div class="sosmed-icon">🎵</div>
      <div class="sosmed-name">TikTok</div>
      <div class="sosmed-handle">{{ $social['tiktok']['handle'] ?? '' }}</div>
    </a>
  </div>
</section>

{{-- KONTAK --}}
<section id="kontak">
  <div class="section-head center reveal">
    <div class="section-label" style="background:rgba(255,255,255,0.1);color:var(--accent-gold);">Konsultasi</div>
    <h2 class="section-title">Siap Bantu Urusan Pajak Anda</h2>
    <p class="section-sub">Tim HS Tax siap merespon pertanyaan Anda via WhatsApp. Konsultasi awal gratis tanpa komitmen.</p>
  </div>
  <div class="kontak-btns reveal">
    <a href="{{ $waUrl }}" class="btn-wa" target="_blank">
      <svg width="20" height="20" viewBox="0 0 24 24" style="fill:#fff;"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
      Konsultasi Gratis Via WhatsApp
    </a>
  </div>
  <div class="kontak-info reveal">
    <div class="kontak-info-item"><a href="tel:{{ $contact['phone'] }}">📞 {{ $contact['phone_formatted'] }}</a></div>
    <div class="kontak-info-item"><a href="mailto:{{ $contact['email'] }}">✉️ {{ $contact['email'] }}</a></div>
    <div class="kontak-info-item"><span>🕐 {{ $contact['working_hours'] }}</span></div>
  </div>
</section>

<footer>
  &copy; {{ date('Y') }} {{ $company['name'] }}. {{ $company['copyright'] }}
</footer>

<a href="{{ $waUrl }}" class="wa-float" target="_blank" aria-label="WhatsApp">
  <svg viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
</a>

<div class="mobile-cta-bar">
  <a href="{{ $waUrl }}" class="btn-wa" target="_blank">
    <svg width="18" height="18" viewBox="0 0 24 24" style="fill:#fff;"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
    Konsultasi Gratis
  </a>
</div>

<script>
function toggleMobileNav() { document.getElementById('mobileNav').classList.toggle('active'); }

// Scroll-based nav changes
window.addEventListener('scroll', function() {
  const nav = document.getElementById('navbar');
  if (window.scrollY > 60) { nav.classList.add('scrolled'); } else { nav.classList.remove('scrolled'); }
});

// Reveal on scroll
const observer = new IntersectionObserver((entries) => {
  entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('active'); } });
}, { threshold: 0.1 });
document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

// FAQ toggle
function toggleFaq(btn) {
  const item = btn.closest('.faq-item');
  const isOpen = item.classList.contains('open');
  document.querySelectorAll('.faq-item.open').forEach(el => el.classList.remove('open'));
  if (!isOpen) item.classList.add('open');
}

// FAQ search
function filterFaq() {
  const q = document.getElementById('faqSearch').value.toLowerCase();
  document.querySelectorAll('.faq-item').forEach(item => {
    item.style.display = item.dataset.q.includes(q) ? '' : 'none';
  });
}
</script>
</body>
</html>
