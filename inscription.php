<?php 
require_once 'classes/Database.php';

session_start();

$erreur = null;
$succes = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $mdp = $_POST['password'];

    $db = new Database();
    $pdo = $db->getPdo();

    $check = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $check->execute([$email]);
    
    if ($check->fetch()) {
        $erreur = "Cet email est déjà utilisé.";
    } else {
        
        $mdpHash = password_hash($mdp, PASSWORD_BCRYPT);
        $dateCreation = date('Y-m-d');

        $insert = $pdo->prepare("INSERT INTO users (nom, email, mot_de_passe_hash, date_creation, role) VALUES (?, ?, ?, ?, 'user')");
        
        if ($insert->execute([$nom, $email, $mdpHash, $dateCreation])) {
            $succes = "Compte créé ! Vous pouvez vous connecter.";
            
        } else {
            $erreur = "Une erreur est survenue lors de l'inscription.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSCRIPTION - MA BAGNOLE</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-black min-h-screen flex flex-col font-sans">

    <header class="border-b-4 border-black p-6 flex justify-between items-center bg-black text-white">
        <a href="index.php" class="text-2xl font-black italic tracking-tighter">MA BAGNOLE.</a>
        <span class="text-[10px] font-bold uppercase tracking-tighter invisible md:visible italic">Rejoignez la communauté</span>
    </header>

    <main class="flex-grow flex items-center justify-center p-4 py-12">
        <div class="w-full max-w-lg border-4 border-black p-8 md:p-12 shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] bg-white">
            <h2 class="text-4xl font-black uppercase mb-2 italic text-center">REJOINDRE</h2>
            <div class="w-16 h-2 bg-black mx-auto mb-8"></div>
            
            <form action="" method="POST" class="space-y-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block uppercase font-black text-[10px] mb-1 italic underline">Nom Complet</label>
                        <input type="text" name="nom" placeholder="Jean Dupont" required 
                               class="w-full border-4 border-black p-3 font-bold focus:bg-black focus:text-white outline-none transition">
                    </div>
                    <div>
                        <label class="block uppercase font-black text-[10px] mb-1 italic underline">Email</label>
                        <input type="email" name="email" placeholder="votre@email.com" required 
                               class="w-full border-4 border-black p-3 font-bold focus:bg-black focus:text-white outline-none transition">
                    </div>
                </div>

                <div>
                    <label class="block uppercase font-black text-[10px] mb-1 italic underline">Mot de passe</label>
                    <input type="password" name="password" placeholder="Choisir un mot de passe" required 
                           class="w-full border-4 border-black p-3 font-bold focus:bg-black focus:text-white outline-none transition">
                </div>

                <div class="flex items-start gap-3 py-2">
                    <input type="checkbox" required class="mt-1 w-5 h-5 border-4 border-black accent-black cursor-pointer">
                    <label class="text-[10px] font-bold uppercase leading-tight">
                        J'accepte de confier les données de mes véhicules à <span class="underline italic font-black">MaBagnole</span> conformément aux règles du garage.
                    </label>
                </div>

                <button type="submit" class="w-full bg-black text-white font-black py-4 uppercase text-lg border-4 border-black hover:bg-white hover:text-black transition shadow-[6px_6px_0px_0px_rgba(0,0,0,0.3)]">
                    CRÉER MON COMPTE
                </button>
            </form>

            <div class="mt-8 text-center border-t-4 border-black pt-6">
                <p class="text-xs font-bold uppercase mb-2">Déjà membre ?</p>
                <a href="connexion.php" class="inline-block border-2 border-black px-4 py-2 font-black uppercase text-sm hover:bg-black hover:text-white transition">
                    Se connecter
                </a>
            </div>
        </div>
    </main>

    <footer class="p-8 bg-black text-white text-center">
        <p class="text-[10px] font-bold uppercase tracking-[0.3em]">Minimalist Car Management &copy; 2026</p>
    </footer>

</body>
</html>