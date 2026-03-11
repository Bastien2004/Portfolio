<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portfolio | Mes Projets</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=Outfit:wght@300;400;500&display=swap" rel="stylesheet">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}?v=2">
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Ajustements de secours pour la cohérence avec bootstrap */
        .modal-backdrop.show { opacity: 0.85 !important; background-color: #050d1a !important; }
        .object-fit-cover { object-fit: cover; }
        .modal-open { overflow: hidden !important; padding-right: 0 !important; }
    </style>
</head>
<body>

<div class="wrapper">
    <nav>
        <div class="nav-logo">
            <span class="nav-dot"></span>
            Portfolio
        </div>
        <a href="{{ route('projects.create') }}" class="btn-add">
            <span class="fs-5">+</span>
            <span class="hidden sm:inline">Nouveau projet</span>
            <span class="sm:hidden">Projet</span>
        </a>
    </nav>

    <header class="hero">
        <div class="hero-eyebrow">Mes travaux</div>
        <h1>Mes <em>Projets</em><br>& Réalisations</h1>
        <p class="hero-sub">Projets développés, designs conçus, problèmes résolus.</p>

        <div class="hero-stats">
            <div class="stat-card">
                <div class="stat-val">{{ $projects->count() }}</div>
                <div class="stat-label">Projets</div>
            </div>
            <div class="stat-card">
                <div class="stat-val">{{ $projects->where('is_featured', true)->count() }}</div>
                <div class="stat-label">En vedette</div>
            </div>
            <div class="stat-card">
                <div class="stat-val">{{ $projects->sum(fn($p) => $p->files->count()) }}</div>
                <div class="stat-label">Fichiers</div>
            </div>
        </div>
    </header>

    <main class="grid-section">
        @if($projects->isEmpty())
            <div class="empty text-center py-5">
                <div class="empty-icon fs-1 mb-3">🚀</div>
                <h3 class="fw-bold">Aucun projet pour l'instant</h3>
                <p class="text-muted">Ajoutez votre premier projet pour commencer.</p>
                <a href="{{ route('projects.create') }}" class="btn-add d-inline-flex mt-3">+ Créer</a>
            </div>
        @else
            <div class="projects-grid">
                @foreach($projects as $project)
                    <article class="card" onclick="openModal({{ $project->id }})">
                        <div class="card-media">
                            @if($project->is_featured)
                                <div class="featured-badge">⭐ Vedette</div>
                            @endif

                            @if($project->files->isNotEmpty())
                                @php
                                    $first = $project->files->first();
                                    $ext = strtolower(pathinfo($first->file_path, PATHINFO_EXTENSION));
                                @endphp
                                @if(in_array($ext, ['jpg','jpeg','png','webp','gif']))
                                    <img src="{{ asset('storage/' . $first->file_path) }}" alt="{{ $project->title }}" loading="lazy">
                                @elseif($ext === 'mp4')
                                    <video muted loop autoplay playsinline><source src="{{ asset('storage/' . $first->file_path) }}" type="video/mp4"></video>
                                @else
                                    <div class="d-flex align-items-center justify-content-center h-100 bg-dark text-white opacity-50">
                                        <span class="fs-1">📄</span>
                                    </div>
                                @endif

                                @if($project->files->count() > 1)
                                    <div class="file-count">{{ $project->files->count() }} fichiers</div>
                                @endif
                            @else
                                <div class="d-flex align-items-center justify-content-center h-100 bg-dark text-white opacity-25">
                                    <span class="fs-1">🗂️</span>
                                </div>
                            @endif
                        </div>

                        <div class="card-body">
                            <h2 class="card-title">{{ $project->title }}</h2>
                            <p class="card-desc">{{ Str::limit($project->description, 100) }}</p>

                            @if($project->tags)
                                <div class="card-tags">
                                    @foreach(array_slice(explode(',', $project->tags), 0, 3) as $tag)
                                        <span class="tag">{{ trim($tag) }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <div class="card-footer" onclick="event.stopPropagation()">
                            <div class="card-links">
                                @if($project->url)
                                    <a href="{{ $project->url }}" target="_blank" class="link-pill labelColor">Aperçu Live</a>
                                @endif
                            </div>
                            <form action="{{ route('projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Supprimer ce projet ?')">
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

@include('modal')

<script>
    // Data Injection
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
                    ext: @json(strtolower(pathinfo($file->file_path, PATHINFO_EXTENSION)))
                },
                @endforeach
            ]
        },
        @endforeach
    };

    const imageExts = ['jpg','jpeg','png','webp','gif'];
    let bsModal = null;

    document.addEventListener('DOMContentLoaded', () => {
        // Initialisation de la modal Bootstrap 5
        bsModal = new bootstrap.Modal(document.getElementById('projectModal'));
    });

    function openModal(id) {
        const p = projects[id];
        if (!p) return;

        // 1. Header Media Logic
        const header = document.getElementById('bs-modal-header');
        header.innerHTML = '';
        if (p.files.length > 0) {
            const f = p.files[0];
            if (imageExts.includes(f.ext)) {
                header.innerHTML = `<img src="${f.path}" class="w-100 h-100 object-fit-cover animate__animated animate__fadeIn">`;
            } else if (f.ext === 'mp4') {
                header.innerHTML = `<video autoplay muted loop playsinline class="w-100 h-100 object-fit-cover"><source src="${f.path}" type="video/mp4"></video>`;
            } else {
                header.innerHTML = `<div class="d-flex align-items-center justify-content-center h-100 fs-1 text-white opacity-50">📄 ${f.ext.toUpperCase()}</div>`;
            }
            // Gradient Overlay for readability
            const overlay = document.createElement('div');
            overlay.className = 'position-absolute bottom-0 start-0 w-100';
            overlay.style.height = '120px';
            overlay.style.background = 'linear-gradient(transparent, var(--surface))';
            header.appendChild(overlay);
        } else {
            header.innerHTML = `<div class="d-flex align-items-center justify-content-center h-100 fs-1 text-white opacity-25">🗂️</div>`;
        }

        // 2. Text Content
        document.getElementById('bs-modal-title').textContent = p.title;
        document.getElementById('bs-modal-desc').textContent = p.description;

        // 3. Tags Logic
        const tagsEl = document.getElementById('bs-modal-tags');
        tagsEl.innerHTML = p.tags ? p.tags.split(',').map(t =>
            `<span class="tag">${t.trim()}</span>`
        ).join('') : '<span class="text-muted small">Aucun tag</span>';

        // 4. Links Logic
        const linksEl = document.getElementById('bs-modal-links');
        let linksHtml = '';
        if (p.url) {
            linksHtml += `<a href="${p.url}" target="_blank" class="btn-add py-2 px-3 text-sm" style="box-shadow:none">🔗 Live Demo</a>`;
        }
        if (p.github) {
            linksHtml += `<a href="${p.github}" target="_blank" class="btn btn-outline-primary py-2 px-3 text-sm rounded-pill border-0" style="background: rgba(255,255,255,0.05); color: white;">⬡ Code source</a>`;
        }
        linksEl.innerHTML = linksHtml || '<span class="small labelColor">Privé</span>';

        // 5. Metadata
        document.getElementById('bs-modal-meta').innerHTML = `
            <div><span class="labelColor">Date:</span> <span class="text-white">${p.created_at}</span></div>
            <div><span class="labelColor">Éléments:</span> <span class="text-white">${p.files_count}</span></div>
            ${p.is_featured ? '<div class="text-cyan fw-bold">⭐ VEDETTE</div>' : ''}
        `;

        bsModal.show();
    }
</script>
</body>
</html>
