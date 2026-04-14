<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portfolio | Mes Projets</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}?v=3">
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .modal-backdrop.show { opacity: .88 !important; background-color: #020610 !important; }
        .object-fit-cover    { object-fit: cover; }
        .modal-open          { overflow: hidden !important; padding-right: 0 !important; }
    </style>
</head>
<body>

{{-- Background orbs --}}
<div class="bg-orb bg-orb-1"></div>
<div class="bg-orb bg-orb-2"></div>

<div class="wrapper">

    {{-- ════════════════════════════════
         NAVIGATION
    ════════════════════════════════ --}}
    <nav id="main-nav">
        <a href="/" class="nav-logo">
            <span class="nav-dot"></span>
            Portfolio
        </a>
        <a href="{{ route('projects.create') }}" class="btn-new">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8 3v10M3 8h10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
            <span class="d-none d-sm-inline">Nouveau projet</span>
            <span class="d-sm-none">Créer</span>
        </a>
    </nav>

    {{-- ════════════════════════════════
         HERO
    ════════════════════════════════ --}}
    <header class="hero">
        <div class="hero-eyebrow">Mes travaux</div>

        <h1>
            Mes <em>Projets</em><br>
            &amp; Réalisations
        </h1>

        <p class="hero-sub">
            Projets développés, designs conçus, problèmes résolus.
        </p>

        <div class="hero-stats">
            <div class="stat-item">
                <div class="stat-val">{{ $projects->count() }}</div>
                <div class="stat-label">Projets</div>
            </div>
            <div class="stat-item">
                <div class="stat-val">{{ $projects->where('is_featured', true)->count() }}</div>
                <div class="stat-label">En vedette</div>
            </div>
            <div class="stat-item">
                <div class="stat-val">{{ $projects->sum(fn($p) => $p->files->count()) }}</div>
                <div class="stat-label">Fichiers</div>
            </div>
        </div>
    </header>

    {{-- ════════════════════════════════
         GRID
    ════════════════════════════════ --}}
    <main class="grid-section">

        @if($projects->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">🚀</div>
                <h3>Aucun projet pour l'instant</h3>
                <p>Ajoutez votre premier projet pour commencer.</p>
                <a href="{{ route('projects.create') }}" class="btn-new d-inline-flex">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                        <path d="M8 3v10M3 8h10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    Créer un projet
                </a>
            </div>

        @else
            <div class="section-divider">
                <span>Tous les projets</span>
            </div>

            <div class="projects-grid">
                @foreach($projects as $project)
                    <article class="card" onclick="openModal({{ $project->id }})">

                        {{-- Media --}}
                        <div class="card-media">

                            @if($project->is_featured)
                                <div class="featured-badge">★ Vedette</div>
                            @endif

                            @if($project->files->isNotEmpty())
                                @php
                                    $first = $project->files->first();
                                    $ext   = strtolower(pathinfo($first->file_path, PATHINFO_EXTENSION));
                                @endphp

                                @if(in_array($ext, ['jpg','jpeg','png','webp','gif']))
                                    <img src="{{ asset('storage/' . $first->file_path) }}"
                                         alt="{{ $project->title }}"
                                         loading="lazy">
                                @elseif($ext === 'mp4')
                                    <video muted loop autoplay playsinline>
                                        <source src="{{ asset('storage/' . $first->file_path) }}" type="video/mp4">
                                    </video>
                                @else
                                    <div class="d-flex align-items-center justify-content-center h-100" style="color: var(--muted);">
                                        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
                                            <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"/><polyline points="13 2 13 9 20 9"/>
                                        </svg>
                                    </div>
                                @endif

                                @if($project->files->count() > 1)
                                    <div class="file-count">{{ $project->files->count() }} fichiers</div>
                                @endif

                            @else
                                <div class="d-flex align-items-center justify-content-center h-100" style="color: var(--muted); opacity: .35;">
                                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round">
                                        <rect x="3" y="3" width="18" height="18" rx="3"/><path d="M9 9h6M9 12h6M9 15h4"/>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        {{-- Body --}}
                        <div class="card-body">
                            <h2 class="card-title">{{ $project->title }}</h2>
                            <p class="card-desc">{{ Str::limit($project->description, 110) }}</p>

                            @if($project->tags)
                                <div class="card-tags">
                                    @foreach(array_slice(explode(',', $project->tags), 0, 3) as $tag)
                                        <span class="tag">{{ trim($tag) }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        {{-- Footer --}}
                        <div class="card-footer" onclick="event.stopPropagation()">
                            <div>
                                @if($project->url)
                                    <a href="{{ $project->url }}"
                                       target="_blank"
                                       class="link-pill">
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/>
                                        </svg>
                                        Live
                                    </a>
                                @endif
                            </div>

                            <form action="{{ route('projects.destroy', $project) }}"
                                  method="POST"
                                  onsubmit="return confirm('Supprimer ce projet ?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="delete-btn">Supprimer</button>
                            </form>
                        </div>

                    </article>
                @endforeach
            </div>
        @endif

    </main>
</div>

{{-- ════════════════════════════════
     MODAL
════════════════════════════════ --}}
@include('modal')

{{-- ════════════════════════════════
     SCRIPTS
════════════════════════════════ --}}
<script>
    const projects = {
        @foreach($projects as $project)
            {{ $project->id }}: {
            title:      @json($project->title),
            description:@json($project->description),
            tags:       @json($project->tags),
            url:        @json($project->url),
            github:     @json($project->github),
            is_featured:{{ $project->is_featured ? 'true' : 'false' }},
            created_at: @json($project->created_at->format('d/m/Y')),
            files_count:{{ $project->files->count() }},
            files: [
                    @foreach($project->files as $file)
                {
                    path: @json(asset('storage/' . $file->file_path)),
                    ext:  @json(strtolower(pathinfo($file->file_path, PATHINFO_EXTENSION)))
                },
                @endforeach
            ]
        },
        @endforeach
    };

    const IMAGE_EXTS = ['jpg','jpeg','png','webp','gif'];
    let bsModal = null;

    document.addEventListener('DOMContentLoaded', () => {
        bsModal = new bootstrap.Modal(document.getElementById('projectModal'));

        // Nav scroll shadow
        const nav = document.getElementById('main-nav');
        window.addEventListener('scroll', () => {
            nav.classList.toggle('scrolled', window.scrollY > 20);
        }, { passive: true });
    });

    function openModal(id) {
        const p = projects[id];
        if (!p) return;

        /* ── Header media ── */
        const header = document.getElementById('bs-modal-header');
        header.innerHTML = '';

        if (p.files.length > 0) {
            const f = p.files[0];
            let media;
            if (IMAGE_EXTS.includes(f.ext)) {
                media = document.createElement('img');
                media.src = f.path;
                media.alt = p.title;
                media.style.cssText = 'width:100%;height:100%;object-fit:cover;';
            } else if (f.ext === 'mp4') {
                media = document.createElement('video');
                media.autoplay = media.muted = media.loop = media.playsInline = true;
                media.style.cssText = 'width:100%;height:100%;object-fit:cover;';
                const src = document.createElement('source');
                src.src = f.path; src.type = 'video/mp4';
                media.appendChild(src);
            } else {
                media = document.createElement('div');
                media.style.cssText = 'display:flex;align-items:center;justify-content:center;height:100%;color:var(--muted);font-size:2.5rem;';
                media.textContent = '📄';
            }
            header.appendChild(media);
        } else {
            header.innerHTML = `<div style="display:flex;align-items:center;justify-content:center;height:100%;color:var(--muted);opacity:.3;">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                <rect x="3" y="3" width="18" height="18" rx="3"/><path d="M9 9h6M9 12h6M9 15h4"/>
            </svg>
        </div>`;
        }

        /* ── Text ── */
        document.getElementById('bs-modal-title').textContent = p.title;
        document.getElementById('bs-modal-desc').textContent  = p.description || 'Aucune description.';

        /* ── Tags ── */
        const tagsEl = document.getElementById('bs-modal-tags');
        tagsEl.innerHTML = p.tags
            ? p.tags.split(',').map(t => `<span class="tag">${t.trim()}</span>`).join('')
            : '<span style="font-size:.8rem;color:var(--muted);">Aucun tag</span>';

        /* ── Links ── */
        const linksEl = document.getElementById('bs-modal-links');
        let html = '';
        if (p.url) {
            html += `<a href="${p.url}" target="_blank" class="modal-action-btn modal-action-primary">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
                <polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/>
            </svg>
            Aperçu live
        </a>`;
        }
        if (p.github) {
            html += `<a href="${p.github}" target="_blank" class="modal-action-btn modal-action-ghost">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0 0 24 12c0-6.63-5.37-12-12-12z"/>
            </svg>
            Code source
        </a>`;
        }
        linksEl.innerHTML = html || `<span class="modal-private-label">Projet privé</span>`;

        /* ── Meta ── */
        document.getElementById('bs-modal-meta').innerHTML = `
        <div class="meta-item">
            <span class="meta-label">Date</span>
            <span class="meta-val">${p.created_at}</span>
        </div>
        <div class="meta-item">
            <span class="meta-label">Fichiers</span>
            <span class="meta-val">${p.files_count}</span>
        </div>
        ${p.is_featured ? `
        <div class="meta-item">
            <span class="meta-label">Statut</span>
            <span class="meta-val" style="color:var(--cyan);">★ Vedette</span>
        </div>` : ''}
    `;

        bsModal.show();
    }
</script>
</body>
</html>
