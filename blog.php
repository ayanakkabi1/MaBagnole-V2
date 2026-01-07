<?php 
session_start(); 
require_once 'classes/Database.php';
include_once 'classes/blog/Article.php';
include_once 'classes/blog/Theme.php';

use Blog\Theme;

$id_theme_selectionne = isset($_GET['theme']) ? (int)$_GET['theme'] : null;
$articles = [];
$list_theme = [];
$erreur = null;

try {
    $db = new Database();
    $pdo = $db->getPdo();

    
    $list_theme = Theme::listerTousActifs($pdo);

    
    if ($id_theme_selectionne) {
        $sql = "SELECT a.*, t.titre_theme 
                FROM articles a 
                JOIN themes t ON a.id_theme = t.id_theme 
                WHERE a.id_theme = :id 
                AND a.status = 1 
                ORDER BY a.date_publication DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id_theme_selectionne]);
        $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} catch (Exception $e) {
    $erreur = "Système hors ligne : " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MA BAGNOLE - BLOG</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        
        .scrollbar-custom::-webkit-scrollbar { height: 12px; }
        .scrollbar-custom::-webkit-scrollbar-track { background: #fff; border: 4px solid #000; }
        .scrollbar-custom::-webkit-scrollbar-thumb { background: #000; border: 2px solid #fff; }
        
        .brutalist-card:hover { 
            transform: translate(-4px, -4px); 
            box-shadow: 12px 12px 0px 0px rgba(0,0,0,1); 
        }
        
        .flex-nowrap { white-space: nowrap; }
    </style>
</head>
<body class="bg-white text-black font-sans uppercase">

    <header class="border-b-8 border-black p-8 flex justify-between items-center sticky top-0 bg-white z-50">
        <a href="index.php" class="text-4xl font-black italic tracking-tighter hover:skew-x-12 transition">MA BAGNOLE.</a>
        <nav class="flex gap-6 font-black text-xs italic">
            <a href="dashboard_client.php" class="border-2 border-black px-4 py-2 hover:bg-black hover:text-white transition">DASHBOARD</a>
            <a href="logout.php" class="bg-red-600 text-white px-4 py-2 border-2 border-black">SORTIE</a>
        </nav>
    </header>

    <main class="max-w-7xl mx-auto p-8">
        
        <div class="mb-16">
            <h1 class="text-8xl font-black leading-none italic underline decoration-8">L'ARCHIVE.</h1>
            <p class="text-xl font-bold mt-4 opacity-60">Sélectionnez une catégorie pour extraire les données.</p>
        </div>

        <section class="mb-16">
            <div class="flex items-start gap-6 overflow-x-auto pb-8 scrollbar-custom">
                
                <div class="bg-black text-white p-4 shrink-0 border-4 border-black sticky left-0 z-20">
                    <span class="font-black text-xs italic uppercase">Catégories :</span>
                </div>

                <div class="flex flex-nowrap gap-6">
                    <?php if (!empty($list_theme)): ?>
                        <?php foreach ($list_theme as $theme): ?>
                            <div class="group relative shrink-0">
                                <a href="?theme=<?= $theme['id_theme'] ?>" 
                                   class="<?= ($id_theme_selectionne == $theme['id_theme']) ? 'bg-black text-white' : 'bg-white text-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]' ?> border-4 border-black px-8 py-4 font-black text-sm italic hover:bg-black hover:text-white transition-all block">
                                    #<?= htmlspecialchars($theme['titre_theme']) ?>
                                </a>
                                
                                <?php if(!empty($theme['description_theme'])): ?>
                                <div class="hidden group-hover:block absolute z-30 top-full left-0 mt-2 w-64 bg-white border-4 border-black p-3 text-[10px] font-bold lowercase shadow-[10px_10px_0px_0px_rgba(0,0,0,1)]">
                                    <?= htmlspecialchars($theme['description_theme']) ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <section class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <?php if ($erreur): ?>
                <div class="col-span-full border-4 border-red-600 p-6 text-red-600 font-black">
                    <?= $erreur ?>
                </div>
            <?php endif; ?>

            <?php if ($id_theme_selectionne): ?>
                
                <?php if (!empty($articles)): ?>
                    <?php foreach ($articles as $art): ?>
                        <article class="brutalist-card border-8 border-black p-8 bg-white transition-all flex flex-col group">
                            <div class="flex justify-between items-start mb-6">
                                <span class="bg-black text-white px-3 py-1 text-xs font-black italic uppercase">
                                    <?= htmlspecialchars($art['titre_theme']) ?>
                                </span>
                                <span class="text-xs font-black opacity-30 italic">
                                    <?= date('d.m.Y', strtotime($art['date_publication'])) ?>
                                </span>
                            </div>

                            <h2 class="text-4xl font-black mb-6 leading-tight italic uppercase">
                                <?= htmlspecialchars($art['titre_article']) ?>
                            </h2>
                            
                            <p class="text-md font-bold mb-10 opacity-70 flex-grow italic">
                                <?= mb_strimwidth(htmlspecialchars($art['contenu']), 0, 180, "...") ?>
                            </p>

                            <a href="article_detail.php?id=<?= $art['id_article'] ?>" 
                               class="border-4 border-black py-4 text-center font-black text-lg hover:bg-black hover:text-white transition italic uppercase">
                                Ouvrir le dossier →
                            </a>
                        </article>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-span-full border-8 border-black border-dashed p-32 text-center">
                        <p class="text-4xl font-black italic opacity-20 uppercase tracking-widest">Aucune donnée trouvée.</p>
                    </div>
                <?php endif; ?>

            <?php else: ?>
                <div class="col-span-full border-8 border-black p-20 text-center bg-gray-50 shadow-[20px_20px_0px_0px_rgba(0,0,0,0.05)]">
                    <p class="text-4xl font-black italic uppercase animate-pulse leading-none">Accès restreint.<br>Sélectionnez une archive.</p>
                    <p class="mt-4 font-bold opacity-50 italic">Utilisez la navigation horizontale ci-dessus.</p>
                </div>
            <?php endif; ?>
        </section>

    </main>

    <footer class="mt-32 border-t-8 border-black p-20 bg-black text-white flex flex-col md:flex-row justify-between items-center">
        <span class="text-3xl font-black italic">MA BAGNOLE.</span>
        <div class="text-right">
            <p class="text-xs font-black opacity-50 tracking-[1em] uppercase">Data_Recovery_System</p>
            <p class="text-[10px] mt-2 font-bold opacity-30 italic">Propulsé par le bitume et le PHP.</p>
        </div>
    </footer>

</body>
</html>
