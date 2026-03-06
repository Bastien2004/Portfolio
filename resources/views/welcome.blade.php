<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portfolio</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=Outfit:wght@300;400;500&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --bg: #050d1a;
            --surface: #0a1628;
            --surface2: #0f1f38;
            --blue: #2563eb;
            --blue-light: #3b82f6;
            --blue-glow: rgba(37, 99, 235, 0.35);
            --cyan: #06b6d4;
            --text: #e2e8f0;
            --muted: #64748b;
            --border: rgba(37, 99, 235, 0.2);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'Outfit', sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(rgba(37,99,235,0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(37,99,235,0.04) 1px, transparent 1px);
            background-size: 60px 60px;
            pointer-events: none;
            z-index: 0;
        }

        body::after {
            content: '';
            position: fixed;
            top: -200px;
            left: 50%;
            transform: translateX(-50%);
            width: 800px;
            height: 500px;
            background: radial-gradient(ellipse, rgba(37,99,235,0.15) 0%, transparent 70%);
            pointer-events: none;
            z-index: 0;
        }

        .wrapper { position: relative; z-index: 1; }

        nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 40px;
            border-bottom: 1px solid var(--border);
            backdrop-filter: blur(12px);
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(5, 13, 26, 0.8);
        }

        .nav-logo {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 20px;
            color: white;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-dot {
            display: inline-block;
            width: 8px;
            height: 8px;
            background: var(--blue-light);
            border-radius: 50%;
            box-shadow: 0 0 10px var(--blue-light);
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.6; transform: scale(0.8); }
        }

        .btn-add {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--blue);
            color: white;
            font-family: 'Outfit', sans-serif;
            font-weight: 500;
            font-size: 14px;
            padding: 9px 20px;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.2s;
            box-shadow: 0 0 20px var(--blue-glow);
        }
        .btn-add:hover {
            background: var(--blue-light);
            transform: translateY(-2px);
            box-shadow: 0 4px 30px var(--blue-glow);
        }

        .hero {
            padding: 70px 40px 50px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--cyan);
            font-weight: 500;
            margin-bottom: 20px;
        }
        .hero-eyebrow::before {
            content: '';
            display: block;
            width: 24px;
            height: 1px;
            background: var(--cyan);
        }

        h1 {
            font-family: 'Syne', sans-serif;
            font-size: clamp(48px, 6vw, 82px);
            font-weight: 800;
            line-height: 1.0;
            color: white;
        }
        h1 em {
            font-style: normal;
            background: linear-gradient(135deg, var(--blue-light), var(--cyan));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-sub {
            color: var(--muted);
            font-size: 16px;
            margin-top: 16px;
            font-weight: 300;
        }

        .hero-stats {
            display: flex;
            gap: 40px;
            margin-top: 40px;
        }

        .stat-val {
            font-family: 'Syne', sans-serif;
            font-size: 28px;
            font-weight: 700;
            color: white;
        }
        .stat-label {
            font-size: 12px;
            color: var(--muted);
            letter-spacing: 0.05em;
            text-transform: uppercase;
            margin-top: 2px;
        }

        .grid-section {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 40px 80px;
        }

        .projects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 20px;
        }

        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            cursor: pointer;
            transition: transform 0.3s ease, border-color 0.3s, box-shadow 0.3s;
            animation: fadeUp 0.5s ease both;
        }
        .card:hover {
            transform: translateY(-6px);
            border-color: rgba(37,99,235,0.5);
            box-shadow: 0 20px 60px rgba(0,0,0,0.4), 0 0 0 1px rgba(37,99,235,0.2);
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .card:nth-child(1) { animation-delay: 0.05s; }
        .card:nth-child(2) { animation-delay: 0.1s; }
        .card:nth-child(3) { animation-delay: 0.15s; }
        .card:nth-child(4) { animation-delay: 0.2s; }
        .card:nth-child(5) { animation-delay: 0.25s; }
        .card:nth-child(6) { animation-delay: 0.3s; }

        .card-media {
            height: 200px;
            background: var(--surface2);
            position: relative;
            overflow: hidden;
        }
        .card-media img, .card-media video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }
        .card:hover .card-media img,
        .card:hover .card-media video { transform: scale(1.04); }

        .card-media-icon {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            gap: 8px;
            color: var(--muted);
        }
        .card-media-icon span { font-size: 36px; }
        .card-media-icon p { font-size: 11px; letter-spacing: 0.1em; text-transform: uppercase; font-weight: 600; }

        .card-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(5,13,26,0.85) 0%, transparent 60%);
            opacity: 0;
            transition: opacity 0.3s;
            display: flex;
            align-items: flex-end;
            padding: 16px;
        }
        .card:hover .card-overlay { opacity: 1; }
        .card-overlay-text {
            font-size: 13px;
            color: white;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .file-count {
            position: absolute;
            top: 12px;
            right: 12px;
            background: rgba(5,13,26,0.7);
            backdrop-filter: blur(8px);
            color: var(--cyan);
            font-size: 11px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 20px;
            border: 1px solid rgba(6,182,212,0.3);
        }

        .featured-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            background: linear-gradient(135deg, var(--blue), var(--cyan));
            color: white;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 3px 10px;
            border-radius: 20px;
        }

        .card-body { padding: 20px; flex-grow: 1; display: flex; flex-direction: column; gap: 10px; }

        .card-title {
            font-family: 'Syne', sans-serif;
            font-size: 18px;
            font-weight: 700;
            color: white;
            line-height: 1.3;
        }

        .card-desc {
            font-size: 13px;
            color: var(--muted);
            line-height: 1.6;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .card-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-top: auto;
        }

        .tag {
            font-size: 11px;
            font-weight: 500;
            padding: 3px 10px;
            border-radius: 20px;
            background: rgba(37,99,235,0.12);
            color: var(--blue-light);
            border: 1px solid rgba(37,99,235,0.25);
        }

        .card-footer {
            padding: 12px 20px;
            border-top: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
        }

        .card-links { display: flex; gap: 8px; }

        .link-pill {
            font-size: 12px;
            color: var(--muted);
            text-decoration: none;
            padding: 4px 12px;
            border-radius: 6px;
            border: 1px solid var(--border);
            transition: all 0.2s;
        }
        .link-pill:hover {
            color: white;
            border-color: var(--blue-light);
            background: rgba(37,99,235,0.1);
        }

        .delete-btn {
            font-size: 11px;
            color: var(--muted);
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px 8px;
            border-radius: 6px;
            transition: all 0.2s;
            font-family: 'Outfit', sans-serif;
        }
        .delete-btn:hover { color: #f87171; background: rgba(248,113,113,0.08); }

        .empty {
            text-align: center;
            padding: 80px 20px;
            border: 1px dashed var(--border);
            border-radius: 20px;
        }
        .empty-icon { font-size: 48px; margin-bottom: 16px; }
        .empty h3 { font-family: 'Syne', sans-serif; font-size: 22px; color: white; margin-bottom: 8px; }
        .empty p { color: var(--muted); font-size: 14px; margin-bottom: 24px; }

        /* ── MODAL ── */
        .modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(5,13,26,0.85);
            backdrop-filter: blur(12px);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.25s ease;
        }
        .modal-backdrop.open {
            opacity: 1;
            pointer-events: all;
        }

        .modal {
            background: var(--surface);
            border: 1px solid rgba(37,99,235,0.3);
            border-radius: 20px;
            width: 100%;
            max-width: 680px;
            max-height: 90vh;
            overflow-y: auto;
            transform: translateY(20px) scale(0.97);
            transition: transform 0.3s ease;
            box-shadow: 0 40px 100px rgba(0,0,0,0.6), 0 0 0 1px rgba(37,99,235,0.1);
        }
        .modal-backdrop.open .modal {
            transform: translateY(0) scale(1);
        }
        .modal::-webkit-scrollbar { width: 5px; }
        .modal::-webkit-scrollbar-track { background: transparent; }
        .modal::-webkit-scrollbar-thumb { background: var(--border); border-radius: 3px; }

        .modal-header {
            position: relative;
            height: 260px;
            background: var(--surface2);
            border-radius: 20px 20px 0 0;
            overflow: hidden;
        }
        .modal-header img, .modal-header video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .modal-header-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, var(--surface) 0%, transparent 50%);
        }
        .modal-header-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            font-size: 64px;
        }

        .modal-close {
            position: absolute;
            top: 16px;
            right: 16px;
            width: 36px;
            height: 36px;
            background: rgba(5,13,26,0.7);
            backdrop-filter: blur(8px);
            border: 1px solid var(--border);
            border-radius: 10px;
            color: white;
            font-size: 18px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            z-index: 10;
            line-height: 1;
        }
        .modal-close:hover { background: rgba(248,113,113,0.2); border-color: rgba(248,113,113,0.4); color: #f87171; }

        .modal-body { padding: 28px; }

        .modal-title {
            font-family: 'Syne', sans-serif;
            font-size: 26px;
            font-weight: 800;
            color: white;
            margin-bottom: 12px;
        }

        .modal-desc {
            font-size: 15px;
            color: #94a3b8;
            line-height: 1.7;
            margin-bottom: 24px;
        }

        .modal-section-label {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--blue-light);
            margin-bottom: 10px;
        }

        .modal-tags { display: flex; flex-wrap: wrap; gap: 8px; }
        .modal-tag {
            font-size: 12px;
            font-weight: 500;
            padding: 5px 14px;
            border-radius: 20px;
            background: rgba(37,99,235,0.15);
            color: var(--blue-light);
            border: 1px solid rgba(37,99,235,0.3);
        }

        .modal-links { display: flex; gap: 12px; flex-wrap: wrap; }

        .modal-link-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s;
        }
        .modal-link-btn.primary {
            background: var(--blue);
            color: white;
            box-shadow: 0 0 20px var(--blue-glow);
        }
        .modal-link-btn.primary:hover { background: var(--blue-light); transform: translateY(-2px); }
        .modal-link-btn.secondary {
            background: var(--surface2);
            color: var(--text);
            border: 1px solid var(--border);
        }
        .modal-link-btn.secondary:hover { border-color: var(--blue-light); color: white; }

        .modal-files-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
            gap: 10px;
        }

        .modal-file-thumb {
            aspect-ratio: 1;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid var(--border);
            background: var(--surface2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            text-decoration: none;
            transition: border-color 0.2s;
        }
        .modal-file-thumb:hover { border-color: var(--blue-light); }
        .modal-file-thumb img { width: 100%; height: 100%; object-fit: cover; }

        .modal-divider {
            height: 1px;
            background: var(--border);
            margin: 20px 0;
        }

        .modal-meta { display: flex; gap: 24px; flex-wrap: wrap; }
        .meta-item { display: flex; flex-direction: column; gap: 3px; }
        .meta-key { font-size: 11px; text-transform: uppercase; letter-spacing: 0.08em; color: var(--muted); }
        .meta-val { font-size: 14px; color: white; font-weight: 500; }

        .modal-section { margin-bottom: 24px; }
    </style>
</head>
<body>
<div class="wrapper">

    <nav>
        <div class="nav-logo">
            <span class="nav-dot"></span>
            Portfolio
        </div>
        <a href="{{ route('projects.create') }}" class="btn-add">+ Nouveau projet</a>
    </nav>

    <div class="hero">
        <div class="hero-eyebrow">Mes travaux</div>
        <h1>Mes <em>Projets</em><br>& Réalisations</h1>
        <p class="hero-sub">Projets développés, designs conçus, problèmes résolus.</p>
        <div class="hero-stats">
            <div>
                <div class="stat-val">{{ $projects->count() }}</div>
                <div class="stat-label">Projets</div>
            </div>
            <div>
                <div class="stat-val">{{ $projects->where('is_featured', true)->count() }}</div>
                <div class="stat-label">En vedette</div>
            </div>
            <div>
                <div class="stat-val">{{ $projects->sum(fn($p) => $p->files->count()) }}</div>
                <div class="stat-label">Fichiers</div>
            </div>
        </div>
    </div>

    <div class="grid-section">
        @if($projects->isEmpty())
            <div class="empty">
                <div class="empty-icon">🚀</div>
                <h3>Aucun projet pour l'instant</h3>
                <p>Ajoutez votre premier projet pour commencer à construire votre portfolio.</p>
                <a href="{{ route('projects.create') }}" class="btn-add" style="display:inline-flex;margin-top:8px">+ Créer un projet</a>
            </div>
        @else
            <div class="projects-grid">
                @foreach($projects as $i => $project)
                    <div class="card" onclick="openModal({{ $project->id }})">
                        <div class="card-media">
                            @if($project->is_featured)
                                <div class="featured-badge">⭐ Featured</div>
                            @endif
                            @if($project->files->isNotEmpty())
                                @php $first = $project->files->first(); $ext = strtolower(pathinfo($first->file_path, PATHINFO_EXTENSION)); @endphp
                                @if(in_array($ext, ['jpg','jpeg','png','webp','gif']))
                                    <img src="{{ asset('storage/' . $first->file_path) }}" alt="{{ $project->title }}">
                                @elseif($ext === 'mp4')
                                    <video muted loop autoplay playsinline><source src="{{ asset('storage/' . $first->file_path) }}" type="video/mp4"></video>
                                @else
                                    <div class="card-media-icon"><span>{{ $ext === 'pdf' ? '📋' : '📄' }}</span><p>{{ $ext }}</p></div>
                                @endif
                                @if($project->files->count() > 1)
                                    <div class="file-count">{{ $project->files->count() }} fichiers</div>
                                @endif
                            @else
                                <div class="card-media-icon"><span>🗂️</span><p>Aucun média</p></div>
                            @endif
                            <div class="card-overlay">
                                <div class="card-overlay-text">→ Voir les détails</div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="card-title">{{ $project->title }}</div>
                            <div class="card-desc">{{ $project->description }}</div>
                            @if($project->tags)
                                <div class="card-tags">
                                    @foreach(array_slice(explode(',', $project->tags), 0, 3) as $tag)
                                        <span class="tag">{{ trim($tag) }}</span>
                                    @endforeach
                                    @if(count(explode(',', $project->tags)) > 3)
                                        <span class="tag">+{{ count(explode(',', $project->tags)) - 3 }}</span>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <div class="card-footer" onclick="event.stopPropagation()">
                            <div class="card-links">
                                @if($project->url)
                                    <a href="{{ $project->url }}" target="_blank" class="link-pill">🔗 Live</a>
                                @endif
                                @if($project->github)
                                    <a href="{{ $project->github }}" target="_blank" class="link-pill">⬡ GitHub</a>
                                @endif
                            </div>
                            <form action="{{ route('projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Supprimer ce projet ?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="delete-btn">Supprimer</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

{{-- MODAL --}}
<div class="modal-backdrop" id="modal-backdrop" onclick="closeModal(event)">
    <div class="modal" id="modal">
        <div class="modal-header" id="modal-header">
            <button class="modal-close" onclick="closeModalDirect()">✕</button>
        </div>
        <div class="modal-body">
            <div class="modal-title" id="modal-title"></div>
            <div class="modal-desc" id="modal-desc"></div>
            <div id="modal-tags-section" class="modal-section" style="display:none">
                <div class="modal-section-label">Technologies</div>
                <div class="modal-tags" id="modal-tags"></div>
            </div>
            <div id="modal-links-section" class="modal-section" style="display:none">
                <div class="modal-section-label">Liens</div>
                <div class="modal-links" id="modal-links"></div>
            </div>
            <div id="modal-files-section" class="modal-section" style="display:none">
                <div class="modal-section-label">Fichiers du projet</div>
                <div class="modal-files-grid" id="modal-files"></div>
            </div>
            <div class="modal-divider"></div>
            <div class="modal-meta" id="modal-meta"></div>
        </div>
    </div>
</div>

<script>
    const projects = {
        @foreach($projects as $project)
            {{ $project->id }}: {
            title: @json($project->title),
            description: @json($project->description),
            tags: @json($project->tags),
            url: @json($project->url),
            github: @json($project->github),
            is_featured: {{ $project->is_featured ? 'true' : 'false' }},
            created_at: @json($project->created_at->format('d/m/Y')),
            files_count: {{ $project->files->count() }},
            files: [
                    @foreach($project->files as $file)
                {
                    path: @json(asset('storage/' . $file->file_path)),
                    name: @json($file->file_name ?? basename($file->file_path)),
                    ext: @json(strtolower(pathinfo($file->file_path, PATHINFO_EXTENSION))),
                },
                @endforeach
            ]
        },
        @endforeach
    };

    const imageExts = ['jpg','jpeg','png','webp','gif'];

    function openModal(id) {
        const p = projects[id];
        if (!p) return;

        const header = document.getElementById('modal-header');
        const closeBtn = header.querySelector('.modal-close');
        header.innerHTML = '';
        header.appendChild(closeBtn);

        if (p.files.length > 0) {
            const f = p.files[0];
            if (imageExts.includes(f.ext)) {
                const img = document.createElement('img');
                img.src = f.path;
                header.appendChild(img);
            } else if (f.ext === 'mp4') {
                const vid = document.createElement('video');
                vid.autoplay = true; vid.muted = true; vid.loop = true; vid.playsInline = true;
                vid.innerHTML = `<source src="${f.path}" type="video/mp4">`;
                header.appendChild(vid);
            } else {
                const icon = document.createElement('div');
                icon.className = 'modal-header-icon';
                icon.textContent = f.ext === 'pdf' ? '📋' : '📄';
                header.appendChild(icon);
            }
            const overlay = document.createElement('div');
            overlay.className = 'modal-header-overlay';
            header.appendChild(overlay);
        } else {
            const icon = document.createElement('div');
            icon.className = 'modal-header-icon';
            icon.textContent = '🗂️';
            header.appendChild(icon);
        }

        document.getElementById('modal-title').textContent = p.title;
        document.getElementById('modal-desc').textContent = p.description;

        const tagsSection = document.getElementById('modal-tags-section');
        const tagsEl = document.getElementById('modal-tags');
        if (p.tags) {
            tagsEl.innerHTML = p.tags.split(',').map(t => `<span class="modal-tag">${t.trim()}</span>`).join('');
            tagsSection.style.display = 'block';
        } else { tagsSection.style.display = 'none'; }

        const linksSection = document.getElementById('modal-links-section');
        const linksEl = document.getElementById('modal-links');
        if (p.url || p.github) {
            let html = '';
            if (p.url) html += `<a href="${p.url}" target="_blank" class="modal-link-btn primary">🔗 Voir en ligne</a>`;
            if (p.github) html += `<a href="${p.github}" target="_blank" class="modal-link-btn secondary">⬡ GitHub</a>`;
            linksEl.innerHTML = html;
            linksSection.style.display = 'block';
        } else { linksSection.style.display = 'none'; }

        const filesSection = document.getElementById('modal-files-section');
        const filesEl = document.getElementById('modal-files');
        if (p.files.length > 0) {
            filesEl.innerHTML = p.files.map(f => {
                if (imageExts.includes(f.ext)) {
                    return `<a href="${f.path}" target="_blank" class="modal-file-thumb"><img src="${f.path}" alt="${f.name}"></a>`;
                }
                return `<a href="${f.path}" target="_blank" class="modal-file-thumb" title="${f.name}">${f.ext === 'pdf' ? '📋' : f.ext === 'mp4' ? '🎬' : '📄'}</a>`;
            }).join('');
            filesSection.style.display = 'block';
        } else { filesSection.style.display = 'none'; }

        document.getElementById('modal-meta').innerHTML = `
        <div class="meta-item"><span class="meta-key">Ajouté le</span><span class="meta-val">${p.created_at}</span></div>
        <div class="meta-item"><span class="meta-key">Fichiers</span><span class="meta-val">${p.files_count}</span></div>
        ${p.is_featured ? '<div class="meta-item"><span class="meta-key">Statut</span><span class="meta-val" style="color:#06b6d4">⭐ Featured</span></div>' : ''}
    `;

        document.getElementById('modal-backdrop').classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    function closeModal(e) {
        if (e.target === document.getElementById('modal-backdrop')) closeModalDirect();
    }
    function closeModalDirect() {
        document.getElementById('modal-backdrop').classList.remove('open');
        document.body.style.overflow = '';
    }
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModalDirect(); });
</script>
</body>
</html>
