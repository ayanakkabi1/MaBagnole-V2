<?php 
session_start(); 
require_once 'classes/Database.php';
include_once 'classes/blog/Article.php';
include_once 'classes/blog/Commentaire.php';

use Blog\Article;
use Blog\Commentaire;

$db = new Database;
$pdo = $db->getPdo();
$id_article = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$commentaires = Commentaire::listerParArticle($pdo, $id_article);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CLIENT - MA BAGNOLE</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-black min-h-screen flex flex-col font-sans uppercase">
    <header class="border-b-4 border-black p-6 bg-white flex justify-between items-center sticky top-0 z-50">
        <h1 class="text-2xl font-black italic tracking-tighter">MB. CLIENT</h1>
        <nav class="space-x-4 font-black text-xs italic">
            <a href="blog.php" class="underline">BLOG</a>
            <a href="vehicules.php" class="underline">MES VÉHICULES</a>
            <a href="logout.php" class="text-red-600">SORTIE</a>
        </nav>
    </header>

    <main class="max-w-7xl mx-auto w-full p-8">
        <div class="mb-12">
            <form class="flex border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                <input type="text" placeholder="RECHERCHER UN ARTICLE..." class="flex-grow p-5 font-black outline-none italic">
                <button class="bg-black text-white px-10 font-black border-l-4 border-black hover:bg-white hover:text-black transition italic">CHERCHER</button>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="md:col-span-1 space-y-6">
                <a href="ajout_article.php" class="block bg-black text-white p-8 border-4 border-black text-center hover:bg-white hover:text-black transition">
                    <span class="text-3xl font-black italic underline decoration-4">+ AJOUTER ARTICLE</span>
                </a>
                
                <div class="border-4 border-black p-6">
                    <h3 class="text-xl font-black italic mb-4 border-b-2 border-black pb-2">EXPLORER THÈMES</h3>
                    <ul class="space-y-2 font-bold italic text-sm">
                        <li><a href="blog.php" class="hover:line-through"># MÉCANIQUE</a></li>
                        <li><a href="blog.php" class="hover:line-through"># ÉLECTRIQUE</a></li>
                        <li><a href="blog.php" class="hover:line-through"># GUIDES</a></li>
                    </ul>
                </div>
            </div>

            <div class="md:col-span-2 border-4 border-black p-8">
                <h3 class="text-3xl font-black italic mb-8 border-b-4 border-black inline-block">MES DERNIERS COMMENTAIRES</h3>
                <?php foreach($commentaires as $com):?>
                     <div class="space-y-6">
                    <div class="border-2 border-black p-4 bg-gray-50 group">
                        <div class="flex justify-between items-center mb-2 border-b-2 border-black pb-2">
                            <span class="text-[10px] font-black italic underline"><?php ?></span>
                            <div class="flex gap-4">
                                <button class="text-[10px] font-black italic underline">MODIFIER</button>
                                <button class="text-[10px] font-black italic underline text-red-600">SUPPRIMER</button>
                            </div>
                        </div>
                        <p class="font-bold italic"><?php ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
               
            </div>
        </div>
    </main>
</body>
</html>