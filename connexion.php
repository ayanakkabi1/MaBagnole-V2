<?php 
session_start();
require_once 'classes/Database.php';
require_once 'classes/Client.php';

$erreur = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $mdpSaisi = $_POST['password'];

    
    $db = new Database();
    $pdo = $db->getPdo();

    $query = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $query->execute([$email]);
    $data = $query->fetch();

    if ($data) {
       
        if (password_verify($mdpSaisi, $data['mot_de_passe_hash'])) {
            
            $clientConnecte = new Client(
                $data['id'], 
                $data['nom'], 
                $data['email'], 
                $data['mot_de_passe_hash'],
                $data['role']
            );
         
            $_SESSION['client_id'] = $clientConnecte->getId();
            $_SESSION['client_nom'] = $clientConnecte->getNom();
            $_SESSION['client_role'] = $clientConnecte->getRole();
            if($role ==='admin')
            header('Location: dashboard_admin.php');
        
            else
            header('Location: dashboard_client.php');
            exit;

        } else {
            $erreur = "Mot de passe incorrect.";
        }
    } else {
        $erreur = "Cet email n'existe pas dans notre base.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONNEXION - MA BAGNOLE</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-black min-h-screen flex flex-col font-sans">

    <header class="border-b-4 border-black p-6 flex justify-between items-center">
        <a href="index.php" class="text-2xl font-black italic tracking-tighter">MA BAGNOLE.</a>
        <a href="index.php" class="text-xs font-bold uppercase hover:underline">← Retour</a>
    </header>

    <main class="flex-grow flex items-center justify-center p-4">
        <div class="w-full max-w-md border-4 border-black p-8 md:p-12 shadow-[12px_12px_0px_0px_rgba(0,0,0,1)]">
            <h2 class="text-4xl font-black uppercase mb-2 italic">ACCÈS</h2>
            <p class="text-sm font-bold uppercase mb-8 border-b-2 border-black pb-2">Connectez-vous à votre garage</p>
            
            <form action="" method="POST" class="space-y-6">
                <div>
                    <label class="block uppercase font-black text-[10px] mb-1">Email</label>
                    <input type="email" name="email" placeholder="conducteur@email.com" required 
                           class="w-full border-4 border-black p-3 font-bold placeholder:text-gray-300 focus:bg-black focus:text-white outline-none transition">
                </div>
                <div>
                    <label class="block uppercase font-black text-[10px] mb-1">Mot de passe</label>
                    <input type="password" name="password" placeholder="********" required 
                           class="w-full border-4 border-black p-3 font-bold placeholder:text-gray-300 focus:bg-black focus:text-white outline-none transition">
                </div>
                 <a href="index.php?id=<?= (int)$Client_id ?>" >
                <button type="submit" class="w-full bg-black text-white font-black py-4 uppercase text-lg border-4 border-black hover:bg-white hover:text-black transition active:translate-y-1">
                    SE CONNECTER
                </button>
                </a>
            </form>

            <div class="mt-10 flex flex-col gap-2 text-center">
                <p class="text-xs font-bold uppercase">Nouveau ici ?</p>
                <a href="inscription.php" class="text-sm font-black uppercase underline decoration-2 hover:bg-black hover:text-white p-2 transition">
                    Créer mon compte gratuitement
                </a>
            </div>
        </div>
    </main>

    <footer class="p-6 border-t-2 border-black text-center text-[10px] font-black uppercase tracking-widest">
        MA BAGNOLE &copy; 2026 - TOUS DROITS RÉSERVÉS
    </footer>

</body>
</html>