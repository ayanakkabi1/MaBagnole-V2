<?php
require_once 'classes/Database.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: vehicules.php');
    exit;
}

$db = new Database();
$pdo = $db->getPdo();

// Requête pour un seul véhicule avec sa catégorie
$stmt = $pdo->prepare("SELECT v.*, c.nom AS categorie_nom, c.description AS cat_desc 
                       FROM vehicules v 
                       JOIN categories c ON v.id_categorie = c.id 
                       WHERE v.id = ?");
$stmt->execute([$id]);
$v = $stmt->fetch();

if (!$v) {
    die("Véhicule introuvable.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DÉTAILS - PORSCHE 911 GT3</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-black min-h-screen flex flex-col font-sans uppercase">

    <header class="border-b-4 border-black p-6 bg-white sticky top-0 z-50 flex justify-between items-center">
        <a href="vehicules.php" class="text-xl font-black italic hover:line-through decoration-4">← RETOUR GARAGE</a>
        <h1 class="text-2xl font-black italic tracking-tighter invisible md:visible">PORSCHE 911 GT3</h1>
        <div class="flex gap-4">
            <button class="border-2 border-black px-4 py-1 font-black text-xs hover:bg-black hover:text-white transition italic">ÉDITER</button>
        </div>
    </header>

    <main class="flex-grow max-w-7xl mx-auto w-full px-6 py-12">
        
        <div class="mb-12 border-l-8 border-black pl-6">
            <span class="text-xs font-black bg-black text-white px-2 py-1 italic">VÉHICULE EN RÈGLE</span>
            <h2 class="text-6xl md:text-8xl font-black leading-none mt-2">PORSCHE 911<br>(992) GT3</h2>
            <p class="text-2xl font-mono mt-4 italic opacity-70">MATRICULE : AA-888-XX</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
            <div class="border-4 border-black p-6 bg-black text-white">
                <p class="text-[10px] font-black italic mb-2">Kilométrage Actuel</p>
                <p class="text-4xl font-black">12,450</p>
                <p class="text-xs font-bold">KM</p>
            </div>
            <div class="border-4 border-black p-6">
                <p class="text-[10px] font-black italic mb-2">Carburant</p>
                <p class="text-4xl font-black italic underline decoration-4">SP98</p>
                <p class="text-xs font-bold">ESSENCE</p>
            </div>
            <div class="border-4 border-black p-6">
                <p class="text-[10px] font-black italic mb-2">Puissance</p>
                <p class="text-4xl font-black italic">510</p>
                <p class="text-xs font-bold">CH DIN</p>
            </div>
            <div class="border-4 border-black p-6">
                <p class="text-[10px] font-black italic mb-2">Date Achat</p>
                <p class="text-4xl font-black italic">03.23</p>
                <p class="text-xs font-bold">NEUF</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            
            <section>
                <h3 class="text-2xl font-black mb-6 border-b-4 border-black inline-block italic">LOG DE MAINTENANCE</h3>
                <div class="space-y-4">
                    <div class="border-2 border-black p-4 flex justify-between items-center bg-gray-50">
                        <div>
                            <p class="font-black text-sm">VIDANGE + FILTRES</p>
                            <p class="text-[10px] font-bold italic opacity-60">PORSCHE SERVICE - 10,200 KM</p>
                        </div>
                        <span class="font-black italic">12.11.25</span>
                    </div>
                    <div class="border-2 border-black p-4 flex justify-between items-center opacity-40">
                        <div>
                            <p class="font-black text-sm">RODAGE TERMINÉ</p>
                            <p class="text-[10px] font-bold italic">2,500 KM</p>
                        </div>
                        <span class="font-black italic">05.04.23</span>
                    </div>
                    <button class="w-full border-2 border-black border-dashed py-4 font-black hover:bg-black hover:text-white transition">
                        + AJOUTER UNE INTERVENTION
                    </button>
                </div>
            </section>

            <section>
                <h3 class="text-2xl font-black mb-6 border-b-4 border-black inline-block italic">ADMINISTRATIF</h3>
                <div class="border-4 border-black p-8 space-y-8 shadow-[10px_10px_0px_0px_rgba(0,0,0,1)]">
                    <div class="flex justify-between items-end border-b-2 border-black pb-4">
                        <div>
                            <p class="text-[10px] font-black italic">Prochain CT</p>
                            <p class="text-2xl font-black">MARS 2027</p>
                        </div>
                        <span class="text-[10px] font-black bg-black text-white px-2 py-1">OK</span>
                    </div>
                    <div class="flex justify-between items-end border-b-2 border-black pb-4">
                        <div>
                            <p class="text-[10px] font-black italic">Assurance</p>
                            <p class="text-2xl font-black italic underline decoration-2">AXA PREMIUM</p>
                        </div>
                        <span class="text-[10px] font-black border-2 border-black px-2 py-1 italic">CONTRAT ACTIF</span>
                    </div>
                    <div class="pt-4 text-center">
                        <button class="bg-black text-white w-full py-4 font-black text-sm tracking-widest hover:bg-white hover:text-black border-4 border-black transition">
                            TÉLÉCHARGER LE CARNET COMPLET (PDF)
                        </button>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <footer class="mt-20 border-t-4 border-black p-10 bg-black text-white flex justify-between items-center">
        <p class="font-black italic text-xl italic tracking-tighter">MB. DETAILED VIEW</p>
        <p class="text-[10px] font-black opacity-50 tracking-[0.5em]">SYSTEM-AUTO-SCAN-2026</p>
    </footer>

</body>
</html>