<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>ADMIN - MA BAGNOLE</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-black min-h-screen flex flex-col font-sans uppercase">
    <header class="border-b-4 border-black p-6 bg-black text-white flex justify-between items-center">
        <h1 class="text-2xl font-black italic tracking-tighter">MB. ROOT_ACCESS</h1>
        <div class="flex items-center gap-6 text-[10px] font-black">
            <span>ADMIN : <?php echo $_SESSION['client_nom'] ?? 'ADMIN'; ?></span>
            <a href="logout.php" class="bg-red-600 px-3 py-1 border-2 border-red-600 hover:bg-white hover:text-red-600 transition">QUITTER</a>
        </div>
    </header>

    <div class="flex flex-col md:flex-row flex-grow">
        <aside class="w-full md:w-64 border-r-4 border-black p-6 space-y-2 bg-gray-50">
            <a href="#" class="block bg-black text-white p-3 font-black text-xs">VUE GLOBALE</a>
            <a href="#" class="block p-3 font-black text-xs border-2 border-black hover:bg-black hover:text-white transition italic">GÉRER ARTICLES</a>
            <a href="#" class="block p-3 font-black text-xs border-2 border-black hover:bg-black hover:text-white transition italic">UTILISATEURS</a>
        </aside>

        <main class="flex-grow p-8">
            <h2 class="text-5xl font-black mb-12 italic underline decoration-8">CONSOLE ADMIN</h2>

            <section class="border-4 border-black p-8 shadow-[10px_10px_0px_0px_rgba(0,0,0,1)]">
                <div class="flex justify-between items-center mb-8 border-b-4 border-black pb-4">
                    <h3 class="text-3xl font-black italic">GESTION DES THÈMES</h3>
                    <button class="bg-black text-white px-6 py-2 font-black text-sm border-4 border-black hover:bg-white hover:text-black transition uppercase italic">+ AJOUTER THÈME</button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php 
                    $themes = ['MÉCANIQUE', 'ÉLECTRIQUE', 'LÉGISLATION', 'OCCASION'];
                    foreach($themes as $t): ?>
                    <div class="border-4 border-black p-4 flex justify-between items-center hover:bg-black hover:text-white group transition">
                        <span class="font-black italic"><?php echo $t; ?></span>
                        <div class="flex gap-4">
                            <button class="text-[10px] font-black underline group-hover:text-white italic">MODIFIER</button>
                            <button class="text-[10px] font-black underline text-red-600 italic">SUPPRIMER</button>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </section>
        </main>
    </div>
</body>
</html>