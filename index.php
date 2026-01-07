<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MA BAGNOLE - Accueil</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-black min-h-screen flex flex-col">

    <header class="border-b-4 border-black p-6">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-3xl font-black italic tracking-tighter">MA BAGNOLE.</h1>
            <nav class="hidden md:flex space-x-8 font-bold uppercase text-sm">
                <a href="index.php" class="underline decoration-4">Accueil</a>
                <a href="vehicules.php" class="hover:underline">Mes Véhicules</a>
                <a href="connexion.php" class="hover:underline">Connexion</a>
            </nav>
            <a href="inscription.php" class="bg-black text-white px-6 py-2 font-black uppercase text-sm hover:bg-white hover:text-black border-2 border-black transition">S'inscrire</a>
        </div>
    </header>

    <main class="flex-grow">
        <section class="max-w-7xl mx-auto px-6 py-20">
            <div class="border-l-8 border-black pl-8">
                <h2 class="text-7xl md:text-9xl font-black uppercase leading-none mb-6">DOMINEZ VOTRE<br>GARAGE.</h2>
                <p class="text-xl max-w-lg font-medium mb-8">La gestion automobile sans compromis. Simple, brut, efficace.</p>
                <div class="flex flex-wrap gap-4">
                    <a href="inscription.php" class="bg-black text-white px-10 py-4 font-black uppercase text-xl border-4 border-black hover:bg-white hover:text-black transition">Démarrer maintenant</a>
                    <a href="blog.php" class="bg-white text-black px-10 py-4 font-black uppercase text-xl border-4 border-black hover:bg-black hover:text-white transition">Lire le blog</a>
                </div>
            </div>
        </section>
    </main>

    <footer class="border-t-4 border-black p-10 bg-black text-white">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-6">
            <p class="font-black italic text-xl">MA BAGNOLE.</p>
            <p class="text-sm uppercase font-bold tracking-widest">&copy; 2026 DESIGNED IN BLACK AND WHITE</p>
            <div class="flex space-x-6 text-xs font-bold uppercase">
                <a href="#" class="hover:underline">Mentions</a>
                <a href="#" class="hover:underline">Contact</a>
            </div>
        </div>
    </footer>

</body>
</html>