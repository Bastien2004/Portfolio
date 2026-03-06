<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ajouter un projet</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100 min-h-screen flex items-center justify-center p-6">

<div class="max-w-md w-full bg-white dark:bg-zinc-800 p-8 rounded-2xl shadow-xl border border-zinc-200 dark:border-zinc-700">
    <h1 class="text-2xl font-bold mb-6">Nouveau Projet</h1>

    <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium mb-1">Titre du projet</label>
            <input type="text" name="title" placeholder="Ex: Mon superbe site Laravel" required
                   class="w-full px-4 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-transparent focus:ring-2 focus:ring-blue-500 outline-none">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Description</label>
            <textarea name="description" rows="4" placeholder="Décrivez votre travail..." required
                      class="w-full px-4 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-transparent focus:ring-2 focus:ring-blue-500 outline-none"></textarea>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Fichier (Image, Vidéo, PDF...)</label>
            <input type="file" name="file"
                   class="w-full text-sm text-zinc-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            <p class="text-xs text-zinc-500 mt-1">Images, MP4, PDF ou DOCX acceptés.</p>
        </div>

        <div class="pt-4 flex items-center justify-between">
            <a href="/" class="text-sm text-zinc-500 hover:underline">Annuler</a>
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition duration-200">
                Enregistrer
            </button>
        </div>
    </form>
</div>

</body>
</html>
