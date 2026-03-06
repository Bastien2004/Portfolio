<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nouveau Projet</title>
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
            background: radial-gradient(ellipse, rgba(37,99,235,0.12) 0%, transparent 70%);
            pointer-events: none;
            z-index: 0;
        }

        .wrapper {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .container { width: 100%; max-width: 580px; }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--muted);
            text-decoration: none;
            font-size: 13px;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            margin-bottom: 32px;
            transition: color 0.2s;
        }
        .back-link:hover { color: var(--blue-light); }

        .page-title {
            font-family: 'Syne', sans-serif;
            font-size: 40px;
            font-weight: 800;
            color: white;
            line-height: 1.1;
            margin-bottom: 32px;
        }
        .page-title em {
            font-style: normal;
            background: linear-gradient(135deg, var(--blue-light), var(--cyan));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .form-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 36px;
        }

        .form-group { margin-bottom: 22px; }

        .form-label {
            display: block;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--blue-light);
            margin-bottom: 8px;
        }

        .form-input {
            width: 100%;
            padding: 11px 16px;
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 10px;
            color: var(--text);
            font-family: 'Outfit', sans-serif;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-input::placeholder { color: var(--muted); }
        .form-input:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 3px rgba(37,99,235,0.15);
        }
        textarea.form-input { resize: none; }

        .form-hint {
            font-size: 12px;
            color: var(--muted);
            margin-top: 5px;
        }

        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }

        /* Drop zone */
        .drop-zone {
            border: 2px dashed rgba(37,99,235,0.3);
            border-radius: 12px;
            background: var(--surface2);
            padding: 32px 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
        }
        .drop-zone:hover, .drop-zone.dragover {
            border-color: var(--blue-light);
            background: rgba(37,99,235,0.06);
        }
        .drop-icon { font-size: 28px; margin-bottom: 10px; }
        .drop-title { font-size: 14px; font-weight: 500; color: var(--text); margin-bottom: 4px; }
        .drop-sub { font-size: 12px; color: var(--muted); }

        /* File previews */
        .file-list { margin-top: 12px; display: flex; flex-direction: column; gap: 8px; }

        .file-preview {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 10px;
            font-size: 13px;
            animation: slideIn 0.2s ease;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateX(-8px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .file-thumb {
            width: 42px;
            height: 42px;
            border-radius: 8px;
            object-fit: cover;
            border: 1px solid var(--border);
            flex-shrink: 0;
        }
        .file-thumb-icon {
            width: 42px;
            height: 42px;
            border-radius: 8px;
            background: rgba(37,99,235,0.1);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .file-info { flex-grow: 1; min-width: 0; }
        .file-name { font-weight: 500; color: var(--text); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .file-size { font-size: 11px; color: var(--muted); margin-top: 2px; }

        .remove-file {
            background: none;
            border: none;
            color: var(--muted);
            cursor: pointer;
            font-size: 18px;
            line-height: 1;
            padding: 4px;
            border-radius: 6px;
            transition: all 0.15s;
            flex-shrink: 0;
        }
        .remove-file:hover { color: #f87171; background: rgba(248,113,113,0.1); }

        /* Checkbox */
        .checkbox-row {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 16px;
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 10px;
            cursor: pointer;
        }
        .checkbox-row input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: var(--blue-light);
            cursor: pointer;
        }
        .checkbox-label {
            font-size: 14px;
            color: var(--text);
            cursor: pointer;
            user-select: none;
        }
        .checkbox-label span { font-size: 12px; color: var(--muted); }

        /* Error */
        .error-box {
            background: rgba(248,113,113,0.08);
            border: 1px solid rgba(248,113,113,0.3);
            border-radius: 10px;
            padding: 14px 16px;
            margin-bottom: 22px;
            font-size: 13px;
            color: #fca5a5;
        }
        .error-box div { margin-bottom: 3px; }

        /* Divider */
        .form-divider { height: 1px; background: var(--border); margin: 24px 0; }

        /* Actions */
        .form-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 28px;
        }

        .btn-cancel {
            color: var(--muted);
            text-decoration: none;
            font-size: 14px;
            transition: color 0.2s;
        }
        .btn-cancel:hover { color: var(--text); }

        .btn-submit {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--blue);
            color: white;
            font-family: 'Outfit', sans-serif;
            font-weight: 500;
            font-size: 15px;
            padding: 12px 28px;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 0 24px var(--blue-glow);
        }
        .btn-submit:hover {
            background: var(--blue-light);
            transform: translateY(-2px);
            box-shadow: 0 6px 30px var(--blue-glow);
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="container">

        <a href="{{ route('projects.index') }}" class="back-link">← Retour au portfolio</a>

        <h1 class="page-title">Nouveau<br><em>Projet</em></h1>

        <div class="form-card">
            <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @if($errors->any())
                    <div class="error-box">
                        @foreach($errors->all() as $error)
                            <div>· {{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <div class="form-group">
                    <label class="form-label">Titre du projet *</label>
                    <input type="text" name="title" value="{{ old('title') }}"
                           placeholder="Ex : Application de gestion de tâches"
                           class="form-input" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Description *</label>
                    <textarea name="description" rows="4"
                              placeholder="Décrivez les objectifs, technologies utilisées, et challenges relevés..."
                              class="form-input" required>{{ old('description') }}</textarea>
                </div>

                <div class="form-row form-group">
                    <div>
                        <label class="form-label">URL du projet</label>
                        <input type="url" name="url" value="{{ old('url') }}"
                               placeholder="https://mon-projet.com" class="form-input">
                    </div>
                    <div>
                        <label class="form-label">GitHub</label>
                        <input type="url" name="github" value="{{ old('github') }}"
                               placeholder="https://github.com/..." class="form-input">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Technologies / Tags</label>
                    <input type="text" name="tags" value="{{ old('tags') }}"
                           placeholder="Laravel, Vue.js, MySQL, TailwindCSS..." class="form-input">
                    <p class="form-hint">Séparez les tags par des virgules.</p>
                </div>

                <div class="form-divider"></div>

                <div class="form-group">
                    <label class="form-label">Fichiers du projet</label>
                    <div class="drop-zone" id="drop-zone" onclick="document.getElementById('file-input').click()">
                        <div class="drop-icon">📎</div>
                        <div class="drop-title">Déposez vos fichiers ici</div>
                        <div class="drop-sub">ou cliquez pour sélectionner · Images, MP4, PDF, DOCX — max 20 Mo</div>
                    </div>
                    <input type="file" name="files[]" id="file-input" multiple
                           accept="image/*,video/mp4,.pdf,.docx" class="hidden">
                    <div class="file-list" id="file-list"></div>
                </div>

                <div class="form-group">
                    <label class="checkbox-row" for="is_featured">
                        <input type="checkbox" name="is_featured" id="is_featured" value="1">
                        <span class="checkbox-label">
                            Mettre en avant ce projet
                            <span>(badge "Featured" sur la carte)</span>
                        </span>
                    </label>
                </div>

                <div class="form-actions">
                    <a href="{{ route('projects.index') }}" class="btn-cancel">Annuler</a>
                    <button type="submit" class="btn-submit">Enregistrer le projet →</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const input = document.getElementById('file-input');
    const dropZone = document.getElementById('drop-zone');
    const fileListEl = document.getElementById('file-list');
    let dataTransfer = new DataTransfer();

    dropZone.addEventListener('dragover', e => { e.preventDefault(); dropZone.classList.add('dragover'); });
    dropZone.addEventListener('dragleave', () => dropZone.classList.remove('dragover'));
    dropZone.addEventListener('drop', e => {
        e.preventDefault();
        dropZone.classList.remove('dragover');
        addFiles(e.dataTransfer.files);
    });

    input.addEventListener('change', () => {
        addFiles(input.files);
        input.value = '';
    });

    function addFiles(files) {
        Array.from(files).forEach(file => {
            dataTransfer.items.add(file);
            renderPreview(file, dataTransfer.files.length - 1);
        });
        input.files = dataTransfer.files;
    }

    function renderPreview(file, index) {
        const ext = file.name.split('.').pop().toLowerCase();
        const isImage = ['jpg','jpeg','png','webp','gif'].includes(ext);
        const item = document.createElement('div');
        item.className = 'file-preview';
        item.dataset.index = index;

        if (isImage) {
            const img = document.createElement('img');
            img.className = 'file-thumb';
            img.src = URL.createObjectURL(file);
            item.appendChild(img);
        } else {
            const icon = document.createElement('div');
            icon.className = 'file-thumb-icon';
            icon.textContent = ext === 'pdf' ? '📋' : ext === 'mp4' ? '🎬' : '📄';
            item.appendChild(icon);
        }

        const info = document.createElement('div');
        info.className = 'file-info';
        info.innerHTML = `<div class="file-name">${file.name}</div>
                          <div class="file-size">${(file.size / 1024 / 1024).toFixed(2)} Mo</div>`;
        item.appendChild(info);

        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'remove-file';
        btn.textContent = '×';
        btn.onclick = () => removeFile(index, item);
        item.appendChild(btn);

        fileListEl.appendChild(item);
    }

    function removeFile(index, el) {
        const newDT = new DataTransfer();
        Array.from(dataTransfer.files)
            .filter((_, i) => i !== index)
            .forEach(f => newDT.items.add(f));
        dataTransfer = newDT;
        input.files = dataTransfer.files;
        el.remove();
        document.querySelectorAll('#file-list .file-preview').forEach((el, i) => {
            el.dataset.index = i;
            el.querySelector('.remove-file').onclick = () => removeFile(i, el);
        });
    }
</script>
</body>
</html>
