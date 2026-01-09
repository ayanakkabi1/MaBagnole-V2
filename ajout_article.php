<?php
session_start();
require_once 'classes/Database.php';
require_once 'classes/blog/Article.php';
require_once 'classes/blog/Theme.php';

use Blog\Article;
use Blog\Theme;

if (!isset($_SESSION['client_id'])) {
    header('Location: login.php');
    exit;
}

$db = new Database();
$pdo = $db->getPdo();

$list_theme = Theme::listerTousActifs($pdo);
$erreurs = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $titre   = trim($_POST['titre_article'] ?? '');
    $contenu = trim($_POST['contenu'] ?? '');
    $idTheme = $_POST['id_theme'] ?? '';
    $tags    = trim($_POST['tags'] ?? '');

    if ($titre === '') {
        $erreurs[] = "Le titre est obligatoire.";
    }

    if ($idTheme === '') {
        $erreurs[] = "Le thème est obligatoire.";
    }

    if ($contenu === '') {
        $erreurs[] = "Le contenu est obligatoire.";
    }

    if (empty($erreurs)) {
        $article = new Article(
            (int)$idTheme,
            (int)$_SESSION['client_id'],
            $titre,
            $contenu,
            $tags
        );

        if ($article->insert($pdo)) {
            $success = true;
        } else {
            $erreurs[] = "Erreur lors de l'ajout de l'article.";
        }
    }
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
        .scrollbar-custom::-webkit-scrollbar {
            height: 12px;
        }

        .scrollbar-custom::-webkit-scrollbar-track {
            background: #fff;
            border: 4px solid #000;
        }

        .scrollbar-custom::-webkit-scrollbar-thumb {
            background: #000;
            border: 2px solid #fff;
        }

        .brutalist-card:hover {
            transform: translate(-4px, -4px);
            box-shadow: 12px 12px 0px 0px rgba(0, 0, 0, 1);
        }

        .flex-nowrap {
            white-space: nowrap;
        }
    </style>
</head>

<body class="bg-white text-black font-sans uppercase">

    <header class="border-b-8 border-black p-8 flex justify-between items-center sticky top-0 bg-white z-50">
        <a href="blog.php" class="text-4xl font-black italic tracking-tighter hover:skew-x-12 transition">MA BAGNOLE.</a>
        <nav class="flex gap-6 font-black text-xs italic">
            <a href="dashboard_client.php" class="border-2 border-black px-4 py-2 hover:bg-black hover:text-white transition">DASHBOARD</a>
            <a href="logout.php" class="bg-red-600 text-white px-4 py-2 border-2 border-black">SORTIE</a>
        </nav>
    </header>
    <main class="max-w-4xl mx-auto p-8">
        <div class="mb-12 border-l-8 border-black pl-6">
            <h1 class="text-6xl font-black italic uppercase leading-none">Nouveau_article.</h1>
            <p class="font-bold opacity-50 italic mt-2">Ajouter votre propre article.</p>
        </div>
         <?php if (!empty($erreurs)): ?>
    <div class="border-4 border-red-600 bg-red-100 p-4 mb-6">
        <ul class="text-red-700 font-bold text-sm">
            <?php foreach ($erreurs as $erreur): ?>
                <li>• <?= htmlspecialchars($erreur) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<?php if ($success): ?>
    <div class="border-4 border-green-600 bg-green-100 p-4 mb-6">
        Article ajouté avec succès 
    </div>
<?php endif; ?>

        <form method="POST" class="space-y-10">

            <div class="bg-white border-8 border-black p-8 shadow-[15px_15px_0px_0px_rgba(0,0,0,1)]">

                <div class="grid grid-cols-1 gap-8">
                    <div class="flex flex-col">
                        <label for="titre_article" class="text-xs font-black italic mb-2">Titre_article :</label>
                        <input type="text"
                            id="titre_article"
                            name="titre_article"
                            required
                            placeholder="EX: RÉGLAGE CARBURATEUR DOUBLE CORPS"
                            class="border-4 border-black p-4 text-xl font-black placeholder:opacity-20 focus:bg-yellow-300 outline-none transition-colors">
                    </div>

                    <div class="flex flex-col">
                        <label for="id_theme" class="text-xs font-black italic mb-2">CATÉGORIE_THÉMATIQUE :</label>
                        <select id="id_theme"
                            name="id_theme"
                            required
                            class="border-4 border-black p-4 font-black italic bg-white focus:bg-black focus:text-white outline-none cursor-pointer transition-all">
                            <option value="">-- SÉLECTIONNER UN THÈME --</option>
                            <?php foreach ($list_theme as $theme): ?>
                                <option value="<?= $theme['id_theme'] ?>">
                                    #<?= strtoupper(htmlspecialchars($theme['titre_theme'])) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="bg-white border-8 border-black p-8 shadow-[15px_15px_0px_0px_rgba(0,0,0,1)]">
                <div class="flex flex-col">
                    <label for="contenu" class="text-xs font-black italic mb-2">CORPS_DU_TEXTE (MAX 5000 CARACTÈRES) :</label>
                    <textarea id="contenu"
                        name="contenu"
                        rows="12"
                        required
                        placeholder="DÉTAILLEZ VOTRE ANALYSE TECHNIQUE ICI..."
                        class="border-4 border-black p-6 font-bold italic leading-relaxed focus:bg-gray-50 outline-none resize-none"></textarea>
                    <div class="mt-2 text-[10px] font-black opacity-30 text-right uppercase">Encodage_UTF-8_Requis</div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white border-8 border-black p-6 shadow-[10px_10px_0px_0px_rgba(0,0,0,1)]">
                    <label for="tags" class="text-xs font-black !italic mb-2 block">TAGS (SÉPARÉS PAR DES VIRGULES) :</label>
                    <input type="text"
                        id="tags"
                        name="tags"
                        placeholder="MOTEUR, V8, TUTO, RUST"
                        class="w-full border-4 border-black p-3 font-black text-sm outline-none focus:border-blue-600">
                </div>


            </div>
      
            <div class="pt-10">
                <button type="submit"
                    class="w-full bg-black text-white border-8 border-black p-6 text-3xl font-black italic uppercase hover:bg-white hover:text-black transition-all shadow-[20px_20px_0px_0px_rgba(0,0,0,0.2)] active:shadow-none active:translate-x-2 active:translate-y-2">
                    Submit→
                </button>
            </div>
        </form>
        

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