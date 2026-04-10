<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Event</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 p-10">
    <div class="max-w-4xl mx-auto text-center">
        <h1 class="text-3xl font-bold text-slate-800 mb-8">Amikom Event Hub</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10 text-left">
            <div class="bg-white p-6 rounded-xl shadow-md hover:scale-105 transition transform border border-slate-200">
                <span class="bg-purple-100 text-purple-700 px-2 py-1 rounded text-xs font-bold">Tech</span>
                <h3 class="font-bold text-xl mt-2 text-slate-800">Seminar Laravel 11</h3>
                <p class="text-slate-500 mt-2 italic text-sm text-justify">Belajar fundamental Laravel untuk pemula di Amikom.</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md hover:scale-105 transition transform border border-slate-200">
                <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-bold">Design</span>
                <h3 class="font-bold text-xl mt-2 text-slate-800">Workshop UI/UX</h3>
                <p class="text-slate-500 mt-2 italic text-sm text-justify">Mendesain interface aplikasi modern dengan Figma.</p>
            </div>
        </div>

        <div class="flex gap-4 justify-center">
            <a href="/profil" class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-4 py-2 rounded-lg transition">Profil</a>
            <a href="/katalog" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition shadow-md">Katalog</a>
            <a href="/bantuan" class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-4 py-2 rounded-lg transition">Bantuan</a>
        </div>
    </div>
</body>
</html>