<?php
session_start(); 
require_once 'classes/Database.php';
include_once 'classes/blog/Article.php';
include_once 'classes/blog/Theme.php';

use Blog\Theme; 
use Blog\Article;

$id_article = isset($_GET['id']) ? (int)$_GET['id'] : null;
$article = null;

if ($id_article) {
    try {
        $db = new Database();
        $pdo = $db->getPdo();

        
        $sql = "SELECT a.*, t.titre_theme 
                FROM articles a 
                JOIN themes t ON a.id_theme = t.id_theme 
                WHERE a.id_article = :id AND a.status = 1";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id_article]);
        $article = $stmt->fetch(PDO::FETCH_ASSOC);

    } catch (Exception $e) {
        $erreur = "Erreur de base de données.";
    }
}

if (!$article) {
    header('Location: blog.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($article['titre_article']) ?> - MA BAGNOLE</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-black font-sans uppercase">

    <header class="border-b-8 border-black p-6 flex justify-between items-center sticky top-0 bg-white z-50">
        <a href="blog.php" class="text-xl font-black italic hover:underline decoration-4">← RETOUR_ARCHIVES</a>
        <div class="flex gap-4">
            <span class="text-[10px] font-black border-2 border-black px-2 py-1">LECTURE_DOSSIER_<?= $article['id_article'] ?></span>
        </div>
    </header>

    <main class="max-w-4xl mx-auto p-8 pt-16">
        
        <div class="mb-12">
            <div class="flex items-center gap-4 mb-6">
                <span class="bg-black text-white px-3 py-1 text-xs font-black italic">
                    #<?= htmlspecialchars($article['titre_theme']) ?>
                </span>
                <span class="text-xs font-bold opacity-40">
                    PUBLIÉ LE : <?= date('d/m/Y', strtotime($article['date_publication'])) ?>
                </span>
            </div>

            <h1 class="text-7xl font-black leading-none italic uppercase border-l-8 border-black pl-8 mb-8">
                <?= htmlspecialchars($article['titre_article']) ?>
            </h1>

            <?php if(!empty($article['tags'])): ?>
            <div class="flex flex-wrap gap-2">
                <?php foreach(explode(',', $article['tags']) as $tag): ?>
                    <span class="border-2 border-black px-2 py-1 text-[10px] font-black italic">
                        [ <?= trim($tag) ?> ]
                    </span>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>

        <article class="border-8 border-black p-10 bg-white shadow-[20px_20px_0px_0px_rgba(0,0,0,1)] mb-20">
            <div class="text-xl font-bold leading-relaxed italic opacity-80 normal-case">
                <?= nl2br(htmlspecialchars($article['contenu'])) ?>
            </div>
        </article>

        <section class="border-t-8 border-black pt-12 mb-32 flex flex-col md:flex-row justify-between items-center gap-8">
            <div class="max-w-xs">
                <p class="text-xs font-black opacity-40 italic uppercase">Fin du dossier technique. Les informations présentées ici sont archivées pour la communauté "MA BAGNOLE".</p>
            </div>
            <a href="blog.php?theme=<?= $article['id_theme'] ?>" 
               class="bg-black text-white border-4 border-black px-10 py-5 font-black text-xl hover:bg-white hover:text-black transition-all italic">
                VOIR PLUS DE #<?= htmlspecialchars($article['titre_theme']) ?>
            </a>
        </section>

    </main>

    <footer class="bg-black text-white p-12 text-center">
        <p class="text-[10px] font-black tracking-widest uppercase opacity-50">Gazette_Officielle_Ma_Bagnole_2026</p>
    </footer>

</body>
</html>