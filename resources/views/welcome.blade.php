<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mon Portfolio</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script> </head>
<body class="bg-gray-50 dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100 p-6 lg:p-12">

<div class="max-w-6xl mx-auto">
    <div class="flex justify-between items-center mb-10">
        <h1 class="text-4xl font-bold tracking-tight">Mon Portfolio</h1>
        <a href="{{ route('projects.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
            + Ajouter un projet
        </a>
    </div>

    <hr class="border-zinc-200 dark:border-zinc-800 mb-10">

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($projects as $project)
            <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm border border-zinc-200 dark:border-zinc-700 overflow-hidden flex flex-col">

                <div class="h-48 bg-zinc-100 dark:bg-zinc-900 flex items-center justify-center overflow-hidden">
                    @if($project->file_path)
                        @php $ext = pathinfo($project->file_path, PATHINFO_EXTENSION); @endphp

                        @if(in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif']))
                            <img src="{{ asset('storage/' . $project->file_path) }}" class="w-full h-full object-cover">
                        @elseif($ext === 'mp4')
                            <video controls class="w-full h-full object-cover">
                                <source src="{{ asset('storage/' . $project->file_path) }}" type="video/mp4">
                            </video>
                        @else
                            <div class="text-center p-4">
                                <span class="text-5xl">📄</span>
                                <p class="text-xs mt-2 uppercase font-bold text-zinc-500">{{ $ext }}</p>
                            </div>
                        @endif
                    @else
                        <span class="text-zinc-400 italic">Aucun média</span>
                    @endif
                </div>

                <div class="p-5 flex-grow">
                    <h3 class="text-xl font-bold mb-2">{{ $project->title }}</h3>
                    <p class="text-zinc-600 dark:text-zinc-400 text-sm line-clamp-3">
                        {{ $project->description }}
                    </p>
                </div>

                @if($project->file_path && !in_array(pathinfo($project->file_path, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'mp4']))
                    <div class="p-5 pt-0">
                        <a href="{{ asset('storage/' . $project->file_path) }}" target="_blank" class="text-blue-500 hover:underline text-sm font-medium">
                            Voir le document →
                        </a>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>

</body>
</html>
