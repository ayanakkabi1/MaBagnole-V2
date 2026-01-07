<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MES VÉHICULES - MA BAGNOLE</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-black min-h-screen flex flex-col font-sans">

    <header class="border-b-4 border-black p-6 bg-white sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-3xl font-black italic tracking-tighter uppercase">MB. Garage</h1>
            <nav class="hidden md:flex space-x-6 font-black uppercase text-xs italic">
                <a href="index.php" class="hover:underline">Accueil</a>
                <a href="dashboard.php" class="hover:underline">Dashboard</a>
                <a href="blog.php" class="hover:underline">Blog</a>
                <a href="connexion.php" class="text-red-600">Quitter</a>
            </nav>
        </div>
    </header>

    <main class="flex-grow max-w-7xl mx-auto w-full px-6 py-12">
        
        <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
            <div>
                <h2 class="text-6xl font-black uppercase leading-none">VOTRE<br>FLOTTE.</h2>
                <p class="text-sm font-bold uppercase mt-2 italic">03 Véhicules enregistrés</p>
            </div>
            <button class="bg-black text-white px-8 py-4 font-black uppercase text-xl border-4 border-black hover:bg-white hover:text-black transition shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] hover:shadow-none">
                + AJOUTER UN VÉHICULE
            </button>
        </div>

        <div class="space-y-8">
            
            <div class="border-4 border-black p-0 flex flex-col md:flex-row group overflow-hidden">
                <div class="bg-black text-white p-8 flex flex-col justify-center items-center md:w-48 border-b-4 md:border-b-0 md:border-r-4 border-black">
                    <span class="text-4xl font-black italic">01</span>
                    <span class="text-[10px] font-bold uppercase tracking-widest">Actif</span>
                </div>
                <div class="flex-grow p-8 bg-white">
                    <div class="flex flex-col md:flex-row justify-between gap-4">
                        <div>
                            <h3 class="text-4xl font-black uppercase tracking-tighter">PORSCHE 911 GT3</h3>
                            <p class="font-mono text-lg uppercase font-bold italic opacity-60">Matricule : AA-888-XX</p>
                        </div>
                        <div class="grid grid-cols-2 gap-8 text-right">
                            <div>
                                <p class="text-[10px] font-black uppercase italic">Kilométrage</p>
                                <p class="text-2xl font-black">12,450 KM</p>
                            </div>
                            <div>
                                <p class="text-[10px] font-black uppercase italic">Année</p>
                                <p class="text-2xl font-black">2023</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8 flex gap-4">
                        <a href="#" class="border-2 border-black px-6 py-2 font-black uppercase text-xs hover:bg-black hover:text-white transition">Fiche Technique</a>
                        <a href="#" class="border-2 border-black px-6 py-2 font-black uppercase text-xs hover:bg-black hover:text-white transition text-white bg-black">Carnet d'entretien</a>
                        <button class="ml-auto text-xs font-black uppercase hover:underline text-red-600 italic">Supprimer</button>
                    </div>
                </div>
            </div>

            <div class="border-4 border-black p-0 flex flex-col md:flex-row group overflow-hidden opacity-60 hover:opacity-100 transition">
                <div class="bg-white text-black p-8 flex flex-col justify-center items-center md:w-48 border-b-4 md:border-b-0 md:border-r-4 border-black">
                    <span class="text-4xl font-black italic">02</span>
                    <span class="text-[10px] font-bold uppercase tracking-widest">Hiver</span>
                </div>
                <div class="flex-grow p-8 bg-white">
                    <div class="flex flex-col md:flex-row justify-between gap-4">
                        <div>
                            <h3 class="text-4xl font-black uppercase tracking-tighter text-gray-400">LAND ROVER DEFENDER</h3>
                            <p class="font-mono text-lg uppercase font-bold italic opacity-40">Matricule : BE-123-ZZ</p>
                        </div>
                        <div class="grid grid-cols-2 gap-8 text-right">
                            <div>
                                <p class="text-[10px] font-black uppercase italic">Kilométrage</p>
                                <p class="text-2xl font-black">45,000 KM</p>
                            </div>
                            <div>
                                <p class="text-[10px] font-black uppercase italic">Année</p>
                                <p class="text-2xl font-black">2021</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8 flex gap-4">
                        <a href="#" class="border-2 border-black px-6 py-2 font-black uppercase text-xs hover:bg-black hover:text-white transition">Fiche Technique</a>
                        <a href="#" class="border-2 border-black px-6 py-2 font-black uppercase text-xs hover:bg-black hover:text-white transition">Carnet d'entretien</a>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <footer class="border-t-4 border-black p-12 bg-black text-white">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-8">
            <div>
                <p class="text-3xl font-black italic uppercase italic leading-none">MA BAGNOLE.</p>
                <p class="text-[10px] font-bold uppercase tracking-widest mt-2">Gestion radicale de garage</p>
            </div>
            <div class="text-center md:text-right">
                <p class="text-xs font-black uppercase italic mb-2">Connecté en tant que : JEAN DUPONT</p>
                <p class="text-[10px] font-bold uppercase tracking-widest opacity-50">&copy; 2026 MB TERMINAL</p>
            </div>
        </div>
    </footer>

</body>
</html>