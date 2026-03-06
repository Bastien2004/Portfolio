<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#050d1a] min-h-screen flex items-center justify-center">
<div class="bg-[#0a1628] border border-blue-900/30 rounded-2xl p-10 w-full max-w-sm">
    <h1 class="text-white text-2xl font-bold mb-8 text-center">Accès Admin</h1>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        @error('password')
        <p class="text-red-400 text-sm mb-4">{{ $message }}</p>
        @enderror
        <input type="password" name="password" placeholder="Mot de passe"
               class="w-full bg-[#0f1f38] text-white border border-blue-900/30 rounded-xl px-4 py-3 mb-4 outline-none focus:border-blue-500">
        <button type="submit"
                class="w-full bg-blue-600 text-white font-bold py-3 rounded-xl hover:bg-blue-500 transition">
            Entrer
        </button>
    </form>
</div>
</body>
</html>
