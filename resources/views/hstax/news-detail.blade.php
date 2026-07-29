<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $news->title }} — {{ config('app.name', 'HS Tax') }}</title>
<meta name="description" content="{{ $news->excerpt ?? Str::limit($news->content, 160) }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap" rel="stylesheet">
<style>
  :root {
    --maroon: #8B1A1A; --maroon-dk: #5A0D0D; --maroon-lt: #A82828;
    --accent-gold: #D4AF37; --cream: #FAF7F2; --cream-card: #F4EFEA;
    --charcoal: #1E1E24; --mid: #55555E; --border: #E5DFD9; --white: #FFFFFF;
    --green-wa: #25D366; --green-wa-dk: #1DA851;
    --shadow-sm: 0 4px 12px rgba(0,0,0,0.03);
    --shadow-md: 0 8px 28px rgba(139,26,26,0.08);
    --radius-md: 16px;
    --transition: all 0.3s cubic-bezier(0.16,1,0.3,1);
  }
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    color: var(--charcoal); background: var(--cream);
    line-height: 1.7;
  }
  a { text-decoration: none; color: var(--maroon); }
  a:hover { color: var(--maroon-dk); }
  img { max-width: 100%; height: auto; border-radius: var(--radius-md); }
  .container { max-width: 1000px; margin: 0 auto; padding: 0 24px; }
  nav {
    background: var(--white); border-bottom: 1px solid var(--border);
    padding: 16px 24px; display: flex; align-items: center;
    justify-content: space-between; position: sticky; top: 0; z-index: 100;
  }
  .nav-logo { font-family: 'Playfair Display', serif; font-size: 20px; font-weight: 700; color: var(--maroon); }
  .nav-back { font-size: 14px; font-weight: 600; color: var(--charcoal); display: flex; align-items: center; gap: 6px; }
  .nav-back:hover { color: var(--maroon); }
  main { padding: 48px 0 80px; }
  .article-header { margin-bottom: 36px; }
  .article-category { display: inline-block; font-size: 12px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: var(--maroon); background: rgba(139,26,26,0.08); padding: 6px 14px; border-radius: 50px; margin-bottom: 14px; }
  .article-title { font-family: 'Playfair Display', serif; font-size: clamp(28px,4vw,40px); font-weight: 700; line-height: 1.2; color: var(--charcoal); margin-bottom: 16px; }
  .article-meta { display: flex; gap: 20px; font-size: 14px; color: var(--mid); flex-wrap: wrap; }
  .article-image { margin: 32px 0; }
  .article-content { font-size: 16px; color: var(--charcoal); line-height: 1.85; }
  .article-content p { margin-bottom: 20px; }
  .article-content h2, .article-content h3 { font-family: 'Playfair Display', serif; margin: 32px 0 16px; color: var(--charcoal); }
  .article-content h2 { font-size: 26px; }
  .article-content h3 { font-size: 22px; }
  .article-content ul, .article-content ol { margin-bottom: 20px; padding-left: 24px; }
  .article-content li { margin-bottom: 8px; }
  .article-content blockquote { border-left: 4px solid var(--maroon); padding: 16px 20px; margin: 24px 0; background: var(--cream-card); border-radius: 0 var(--radius-md) var(--radius-md) 0; font-style: italic; color: var(--mid); }
  .share-section { display: flex; gap: 12px; align-items: center; padding: 28px 0; border-top: 1px solid var(--border); margin-top: 40px; flex-wrap: wrap; }
  .share-label { font-size: 14px; font-weight: 600; color: var(--mid); }
  .share-btn { display: inline-flex; align-items: center; gap: 6px; padding: 8px 18px; border-radius: 50px; font-size: 13px; font-weight: 600; border: 1px solid var(--border); transition: var(--transition); color: var(--charcoal); }
  .share-btn:hover { border-color: var(--maroon); color: var(--maroon); }
  .comments-section { background: var(--white); border-radius: var(--radius-md); padding: 36px; margin-top: 48px; border: 1px solid var(--border); }
  .comments-title { font-family: 'Playfair Display', serif; font-size: 24px; font-weight: 700; margin-bottom: 24px; }
  .comment-item { border-bottom: 1px solid var(--border); padding: 20px 0; }
  .comment-item:last-child { border-bottom: none; }
  .comment-author { font-weight: 700; font-size: 15px; color: var(--charcoal); }
  .comment-date { font-size: 12px; color: var(--mid); margin-left: 12px; }
  .comment-body { margin-top: 8px; font-size: 14.5px; color: var(--mid); line-height: 1.7; }
  .comment-form { margin-top: 32px; }
  .comment-form h5 { font-family: 'Playfair Display', serif; font-size: 20px; font-weight: 700; margin-bottom: 20px; }
  .form-group { margin-bottom: 16px; }
  .form-group label { display: block; font-size: 14px; font-weight: 600; margin-bottom: 6px; color: var(--charcoal); }
  .form-control { width: 100%; padding: 12px 16px; border: 1.5px solid var(--border); border-radius: 12px; font-family: inherit; font-size: 14px; transition: var(--transition); outline: none; background: var(--white); }
  .form-control:focus { border-color: var(--maroon); box-shadow: 0 0 0 3px rgba(139,26,26,0.1); }
  textarea.form-control { min-height: 120px; resize: vertical; }
  .btn-submit { background: var(--maroon); color: #fff; border: none; padding: 12px 28px; border-radius: 50px; font-weight: 700; font-size: 14px; cursor: pointer; transition: var(--transition); }
  .btn-submit:hover { background: var(--maroon-dk); transform: translateY(-2px); }
  .alert-success { background: #d4edda; color: #155724; padding: 14px 20px; border-radius: 12px; margin-bottom: 24px; font-size: 14px; font-weight: 500; }
  .sidebar-section { margin-top: 48px; }
  .sidebar-section h4 { font-family: 'Playfair Display', serif; font-size: 20px; font-weight: 700; margin-bottom: 20px; }
  .recent-item { display: block; padding: 16px 0; border-bottom: 1px solid var(--border); }
  .recent-item:last-child { border-bottom: none; }
  .recent-title { font-weight: 600; font-size: 15px; color: var(--charcoal); transition: var(--transition); }
  .recent-item:hover .recent-title { color: var(--maroon); }
  .recent-date { font-size: 12px; color: var(--mid); margin-top: 4px; }
  .back-home { display: inline-flex; align-items: center; gap: 6px; color: var(--maroon); font-weight: 600; font-size: 14px; margin-bottom: 32px; }
  .back-home:hover { gap: 10px; }
  footer { background: var(--charcoal); color: rgba(255,255,255,0.5); text-align: center; padding: 24px; font-size: 13px; }
  @media (max-width: 768px) {
    .comments-section { padding: 24px 20px; }
    .container { padding: 0 16px; }
  }
</style>
</head>
<body>

<nav>
  <a href="/" class="nav-logo">{{ config('app.name', 'HS Tax') }}</a>
  <a href="/" class="nav-back">&larr; Kembali</a>
</nav>

<main>
  <div class="container">
    <a href="/#berita" class="back-home">&larr; Semua Berita</a>

    <article>
      <div class="article-header">
        @if ($news->category)
          <div class="article-category">{{ $news->category }}</div>
        @endif
        <h1 class="article-title">{{ $news->title }}</h1>
        <div class="article-meta">
          <span>{{ $news->created_at->format('d F Y') }}</span>
          @if ($news->author)
            <span>Oleh {{ $news->author }}</span>
          @endif
        </div>
      </div>

      @if ($news->image)
        <div class="article-image">
          <img src="{{ $news->image }}" alt="{{ $news->title }}" loading="lazy">
        </div>
      @endif

      <div class="article-content">
        {!! $news->content !!}
      </div>

      <div class="share-section">
        <span class="share-label">Bagikan:</span>
        <a class="share-btn" href="https://wa.me/?text={{ urlencode($news->title . ' - ' . request()->url()) }}" target="_blank" rel="noopener">WhatsApp</a>
        <a class="share-btn" href="https://www.facebook.com/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" rel="noopener">Facebook</a>
        <a class="share-btn" href="https://twitter.com/intent/tweet?text={{ urlencode($news->title) }}&url={{ urlencode(request()->url()) }}" target="_blank" rel="noopener">X (Twitter)</a>
      </div>
    </article>

    {{-- Comments Section --}}
    <div class="comments-section" id="komentar">
      <h4 class="comments-title">Komentar ({{ $comments->count() }})</h4>

      @if (session('comment_success'))
        <div class="alert-success">{{ session('comment_success') }}</div>
      @endif

      @if ($comments->count())
        @foreach ($comments as $comment)
          <div class="comment-item">
            <div>
              <span class="comment-author">{{ $comment->name }}</span>
              <span class="comment-date">{{ $comment->created_at->diffForHumans() }}</span>
            </div>
            <div class="comment-body">{{ $comment->content }}</div>
          </div>
        @endforeach
      @else
        <p style="color:var(--mid);font-size:14px;">Belum ada komentar. Jadilah yang pertama!</p>
      @endif

      {{-- Comment Form --}}
      <div class="comment-form">
        <h5>Tinggalkan Komentar</h5>
        <form method="POST" action="{{ route('news.comment', $news->id) }}">
          @csrf
          <div class="form-group">
            <label for="name">Nama <span style="color:var(--maroon);">*</span></label>
            <input type="text" name="name" id="name" class="form-control" required maxlength="100" placeholder="Nama Anda">
            @error('name') <small style="color:var(--maroon);">{{ $message }}</small> @enderror
          </div>
          <div class="form-group">
            <label for="email">Email <small style="color:var(--mid);font-weight:400;">(opsional)</small></label>
            <input type="email" name="email" id="email" class="form-control" maxlength="100" placeholder="email@anda.com">
            @error('email') <small style="color:var(--maroon);">{{ $message }}</small> @enderror
          </div>
          <div class="form-group">
            <label for="content">Komentar <span style="color:var(--maroon);">*</span></label>
            <textarea name="content" id="content" class="form-control" required maxlength="2000" placeholder="Tulis komentar Anda..."></textarea>
            @error('content') <small style="color:var(--maroon);">{{ $message }}</small> @enderror
          </div>
          <button type="submit" class="btn-submit">Kirim Komentar</button>
        </form>
      </div>
    </div>

    {{-- Recent News Sidebar --}}
    @if ($recentNews->count())
      <div class="sidebar-section">
        <h4>Berita Terbaru</h4>
        @foreach ($recentNews as $item)
          <a href="{{ route('news.detail', $item->slug) }}" class="recent-item">
            <div class="recent-title">{{ Str::limit($item->title, 70) }}</div>
            <div class="recent-date">{{ $item->created_at->format('d F Y') }}</div>
          </a>
        @endforeach
      </div>
    @endif
  </div>
</main>

<footer>
  &copy; {{ date('Y') }} {{ config('app.name', 'HS Tax') }}. All rights reserved.
</footer>

</body>
</html>
