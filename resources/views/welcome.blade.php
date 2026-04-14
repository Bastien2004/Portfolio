<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portfolio | Architecture & Digital</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</head>
<body>

<div class="bg-orbs">
    <div class="bg-orb-1"></div>
    <div class="bg-orb-2"></div>
</div>

<div class="wrapper">
    <nav id="main-nav" class="navbar sticky-top">
        <div class="container px-md-5">
            <a class="nav-logo" href="/">
                <span class="nav-dot"></span> PORTFOLIO
            </a>
            <a href="{{ route('projects.create') }}" class="btn-new">
                <i class="bi bi-plus-lg"></i> <span>Nouveau Projet</span>
            </a>
        </div>
    </nav>

    <header class="hero container">
        <div class="hero-content">
            <span class="hero-eyebrow">Portfolio Sélectionné</span>
            <h1 class="display-2 fw-bold">Design Pur & <em>Ingénierie</em></h1>
            <p class="hero-sub">Exploration visuelle et solutions techniques à travers une sélection de projets digitaux.</p>
        </div>
    </header>

    <main class="container pb-5">
        <div class="section-divider">
            <span>Projets Récents</span>
        </div>

        <div class="row g-4">
            @forelse($projects as $project)
                <div class="col-12 col-md-6 col-lg-4">
                    <article class="project-card" onclick="openModal({{ $project->id }})">
                        <div class="card-media">
                            @if($project->files->count() > 1)
                                <div class="file-badge">
                                    <i class="bi bi-stack"></i> {{ $project->files->count() }}
                                </div>
                            @endif

                            @php $firstFile = $project->files->first(); @endphp
                            @if($firstFile)
                                <img src="{{ asset('storage/' . $firstFile->file_path) }}" alt="{{ $project->title }}" loading="lazy">
                            @else
                                <div class="media-placeholder">
                                    <i class="bi bi-folder2-open"></i>
                                </div>
                            @endif
                        </div>

                        <div class="card-content">
                            <h2 class="project-title">{{ $project->title }}</h2>
                            <p class="project-excerpt">{{ Str::limit($project->description, 70) }}</p>

                            <div class="card-tags">
                                @foreach(explode(',', $project->tags) as $tag)
                                    @if(trim($tag))
                                        <span class="tag-pill">{{ trim($tag) }}</span>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <div class="card-footer" onclick="event.stopPropagation()">
                            @if($project->url)
                                <a href="{{ $project->url }}" target="_blank" class="link-external">
                                    Live Demo <i class="bi bi-arrow-up-right"></i>
                                </a>
                            @else
                                <span></span>
                            @endif
                            <form action="{{ route('projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Supprimer ce projet ?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-delete-icon"><i class="bi bi-trash3"></i></button>
                            </form>
                        </div>
                    </article>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted opacity-50">Aucun projet archivé pour le moment.</p>
                </div>
            @endforelse
        </div>
    </main>
</div>

<div class="modal fade" id="projectModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-body p-0">
                <button type="button" class="btn-close-custom" data-bs-dismiss="modal">
                    <i class="bi bi-x-lg"></i>
                </button>
                <div class="row g-0">
                    <div class="col-lg-7 bg-black-25">
                        <div id="modal-gallery" class="modal-gallery-container">
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="modal-info-panel">
                            <div class="modal-meta-top">
                                <span class="text-accent small fw-bold text-uppercase tracking-widest">Détails du projet</span>
                            </div>
                            <h2 id="modal-title" class="modal-project-title"></h2>
                            <div id="modal-desc" class="modal-project-desc"></div>

                            <div id="modal-links" class="mt-4 pt-4 border-top border-white-10">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Chargement des données avec les fichiers
    const projectsData = @json($projects->load('files')->keyBy('id'));

    function openModal(id) {
        const p = projectsData[id];
        if (!p) return;

        // Titre et Description
        document.getElementById('modal-title').textContent = p.title;
        document.getElementById('modal-desc').innerHTML = p.description.replace(/\n/g, '<br>');

        // Galerie d'images
        const gallery = document.getElementById('modal-gallery');
        gallery.innerHTML = '';

        if (p.files && p.files.length > 0) {
            p.files.forEach(file => {
                const img = document.createElement('img');
                img.src = `/storage/${file.file_path}`;
                img.className = 'modal-img-item';
                img.alt = p.title;
                gallery.appendChild(img);
            });
        }

        // Liens
        const linksContainer = document.getElementById('modal-links');
        linksContainer.innerHTML = '';
        if(p.url) {
            linksContainer.innerHTML += `<a href="${p.url}" target="_blank" class="btn-modal-action primary">Voir le site live</a>`;
        }
        if(p.github) {
            linksContainer.innerHTML += `<a href="${p.github}" target="_blank" class="btn-modal-action secondary mt-2">Code source GitHub</a>`;
        }

        const modal = new bootstrap.Modal(document.getElementById('projectModal'));
        modal.show();
    }
</script>
</body>
</html>
