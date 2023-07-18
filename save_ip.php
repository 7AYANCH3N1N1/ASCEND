<?php
function getIp(){
  if(!empty($_SERVER['HTTP_CLIENT_IP'])){
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }else{
    $ip = $_SERVER['REMOTE_ADDR'];
  }

  // Le cas où plusieurs adresses IP sont renvoyées par HTTP_X_FORWARDED_FOR
  if (strpos($ip, ',') !== false) {
    $ip_array = explode(',', $ip);
    $ip = trim($ip_array[0]);
  }

  return $ip;
}

// Récupérer l'adresse IP de l'utilisateur
$ip = getIp();

// Enregistrement de l'adresse IP dans un fichier texte (vous pouvez utiliser une base de données si vous préférez)
$file = 'ips.txt';

// Ouvrir le fichier en mode écriture (si le fichier n'existe pas, il sera créé)
$handle = fopen($file, 'a');

// Écrire l'adresse IP dans le fichier suivi d'un saut de ligne
fwrite($handle, $ip . "\n");

// Fermer le fichier
fclose($handle);

echo 'L adresse IP de l utilisateur a été enregistrée : '.$ip;

header("Location: index.html");
exit;
?>
