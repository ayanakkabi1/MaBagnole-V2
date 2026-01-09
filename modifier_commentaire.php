<?php
session_start();
require_once 'classes/Database.php';
require_once 'classes/blog/Article.php';
require_once 'classes/blog/Theme.php';
include_once 'classes/blog/Commentaire.php';

use Blog\Article;
use Blog\Theme;
use Blog\Commentaire;

if (!isset($_SESSION['client_id'])) {
    header('Location: login.php');
    exit;
}
$success=null;
$db = new Database();
$pdo = $db->getPdo();
$client_id = (int) $_SESSION['client_id'];
$id_com = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$titre_com=$contenu_com='';
$commentaires = Commentaire::modifierCommentaire( $pdo,$id_com,$titre_com,$contenu_com);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MA BAGNOLE - BLOG</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($article['titre_article']) ?> - MA BAGNOLE</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white text-black font-sans uppercase">

    <header class="border-b-8 border-black p-6 flex justify-between items-center sticky top-0 bg-white z-50">
        <a href="blog.php" class="text-xl font-black italic hover:underline decoration-4">← RETOUR_ARCHIVES</a>
        <div class="flex gap-4">
            <span class="text-[10px] font-black border-2 border-black px-2 py-1"></span>
        </div>
    </header>
    <section class="max-w-4xl mx-auto p-8 mb-20">
        <div class="mb-12 border-l-8 border-black pl-6">
            <h2 class="text-5xl font-black italic uppercase leading-none">Feedback.</h2>
            <p class="font-bold opacity-50 italic mt-2">Partagez votre expertise technique.</p>
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
                Commentaire modifier avec succès Merci pour votre Feedback
            </div>
        <?php endif; ?>

        <form method="POST" class="space-y-10">
            <input type="hidden" name="id_article" value="<?= ' id_article' ?>">

            <div class="bg-white border-8 border-black p-8 shadow-[15px_15px_0px_0px_rgba(0,0,0,1)]">
                <div class="grid grid-cols-1 gap-8">

                    <div class="flex flex-col">
                        <label for="titre_com" class="text-xs font-black italic mb-2">Sujet_du_message :</label>
                        <input type="text"
                            name="titre_com"
                            id="titre_com"
                            value="<?= $com->title_com ?>"
                            required
                            placeholder="EX: RÉPONSE SUR L'ALLUMAGE"
                            class="border-4 border-black p-4 text-xl font-black placeholder:opacity-20 focus:bg-yellow-300 outline-none transition-colors">
                    </div>

                    <div class="flex flex-col">
                        <label for="contenu_com" class="text-xs font-black italic mb-2">Commentaire (Brut) :</label>
                        <textarea name="contenu_com"
                            id="contenu_com"
                            rows="6"
                            required
                            placeholder="VOTRE ANALYSE..."
                            class="border-4 border-black p-6 font-bold italic leading-relaxed focus:bg-gray-50 outline-none resize-none"></textarea>
                    </div>

                </div>
            </div>

            <div class="pt-4">
                <button type="submit" name="submit_comment"
                    class="w-full md:w-auto bg-black text-white border-8 border-black px-12 py-5 text-2xl font-black italic uppercase hover:bg-white hover:text-black transition-all shadow-[10px_10px_0px_0px_rgba(0,0,0,0.2)] active:shadow-none active:translate-x-1 active:translate-y-1">
                    Poster_Commentaire→
                </button>
            </div>
        </form>


    </section>
    <footer class="bg-black text-white p-12 text-center">
        <p class="text-[10px] font-black tracking-widest uppercase opacity-50">Gazette_Officielle_Ma_Bagnole_2026</p>
    </footer>

</body>

</html>