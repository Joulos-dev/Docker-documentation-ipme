# Linux

## Racourcis claviers dans le terminal
Ctrl Alt T      Ouvrir un terminal
Ctrl A          Mettre le curseur au début de la ligne
Ctrl E          Mettre le curseur à la fin de la ligne
Fleche Haut/Bas     Retrouve la commande précédente/suivante
Ctrl L          "Clear" le terminal
Tab             Auto complétion si possible
Shift Ctrl V    Coller
Ctrl K          Coupe tout le texte après le curseur
Ctrl U          Coupe tout le texte avant le curseur
Ctrl Y          Colle le texte coupé

sudo !!         Lance la commande précédente en tant que root

## Les incontournables

### whoami
Donne le nom de l'utilisateur courant.

### man
"Manuel".
Affiche la documentation pour une commande donnée.

```sh
man ls      # Explique comment utiliser la commande "ls"
```

### whatis
Donne une explication courte sur une commande donnée.

### pwd
Pour "print working directory".
Affiche votre position actuelle sur la machine.

### cd
Pour "change directory".
Permet de se déplacer de dossier en dossier.

```sh
cd destination                  # On entre dans le dossier destination
cd /destination/absolue/ici

cd ~                            # Retour à la "home" de l utilisateur
cd                              # Idem
cd /                            # Retour à la racine
cd -                            # Retour au dossier précédent (PAS forcément parent)

```

### ls

Afficher les fichiers dans le repertoire courant

```sh
ls 
ls -l       # --long Liste verticale avec plus d'informations
ls -a       # --all Voir tous les fichiers et dossiers, même cachés
ls -al      # Combinaison des deux switchs ci-dessus
ls --color  # Ajoute des couleurs au résultat
```

### cat
Affiche le contenu d'un fichier.

### less
Affiche le contenu "page par page"

### head
Affiche le début d'un fichier.
On peut préciser le nombre de lignes.
```sh
head fichier
head -5 fichier     # Affiche seulement 5 lignes
```

### tail
Affiche la fin d'un fichier
On peut préciser le nombre de lignes.
```sh
tail fichier
tail -5 fichier     # Affiche seulement 5 lignes
```

### touch
Permet de créer un fichier ou plusieurs fichiers

```sh
touch nom-du-ficher
touch fichier1.txt fichier2.txt
touch fichier{1..10}.txt    # Créer fichier1.txt, fichier2.txt ... fichier10.txt
```

### echo
Affiche du texte dans le terminal (génère un output de texte).

### nano
Editeur de texte en terminal.

### vi
Editeur de texte en terminal très difficile à manipuler.

### mv
(Move) Déplace un fichier ou un dossier
Permet aussi de renommer un fichier si on spécifie un nouveau nom

```sh
mv fichier destination/
mv fichier meme_fichier_avec_un_nouveau_nom
mv fichier destination/meme_fichier_avec_un_nouveau_nom
```

On peut aussi déplacer plusieurs fichiers à la fois
```sh
mv fichier1 fichier2 fichier3 destination
mv *.txt destination
```
La dernière commande permet ici de déplacer tous les fichiers .txt vers le dossier de destination.

### cp
Pour "copy".
Fait une copie du ficher spécifié.

```sh
cp fichier1 fichier1copié
```

### cmp
Pour "compare".
Vérifie si deux fichiers sont identiques.

### diff
Pour "différence".
Voir les différences entre plusieurs fichiers.

### grep
Permet de trouver du texte dans des fichers via des expressions régulières.

-i : case incensitive
-r : recursive
-v : trouve toutes les lignes qui ne correspondent PAS à la recherche
-n : affiche le numéro de la ligne
-c : "count", compte le nombre d'occurence
-E : Expression régulière. Plus besoin d'échapper les caractères spéciaux comme |.

```sh
grep plop fichier            # Regarde si "fichier" contient "plop"
grep plop ./dossier/*       # Regarde si un des fichiers de "dossier" contient plop
grep -E "ou$|plop$" fichier        # Trouve les lignes se terminant par "ou" ou "plop"

# Avec le pipe
cat fichier | grep coucou       # Recherche coucou dans l'output de cat
ls -al | grep coucou       # Recherche coucou dans l'output de ls
```

### sed
[Tuto de DistroTube](https://www.youtube.com/watch?v=EACe7aiGczw)
Permet de remplacer des chaines de caractères.
-i case incensitive
-e expression régulière

```sh
sed -e "s/coucou/PLOP/g" fichier    # Remplace les "coucou" par des "PLOP" dans fichier
cat fichier | sed -e "s/ou/PLOP/g" # Remplace les "ou" par des "PLOP" dans l'output de cat (mais le fichier est intact).
```

### awk
[Tuto de DistroTube](https://www.youtube.com/watch?v=9YOZmI-zWok)
Outil surpuissant de traitement de texte avancé. Permet une grande précision, des déclarations de variables et executions de commandes.

```sh
awk pattern { action }
awk '{print $3}' monfichier.txt     # On peut lui passer un fichier
cat monfichier | awk '{print $1}'   # On peut aussi lui passer un flux

awk '{print $0}' fichier            # Affiche tout le contenu de fichier
awk '{print $1}' fichier            # Affiche la première "colonne" de fichier (premier mot de chaque ligne)

awk 'FS=";" {print $2} fichier'      # Défini ";" comme séparateur de champs au lieu de espace.

awk '$3 ~ /pattern/ {print $1 " " $2 }' fichier # Recherche de pattern
awk '$3 !~ /pattern/ {print $1 " " $2 }' fichier # Exclusion de pattern
```

### tr
Transformation de caractères

```sh
tr pattern remplacement
echo abcd | tr bd 24            # Retourne a2c4
```

### df
Voir l'espace utilisé sur le disque.
Le switch -h ('human') permet d'avoir un retour plus lisible.

### free
Comme df, mais affiche l'espace libre.

### shred
S'assure qu'un fichier soit "déchiquetté" et rendu parfaitement illisible, même après suppression.

### find
Permet de trouver un fichier ou dossier dans un repertoire donné.

```sh
find . -type f -name "*.mp3"      # Trouve tous les fichiers .mp3 se trouvant dans le dossier courant

find / -type d -name "important*" #Trouve tous les dossiers commençant par "important" sur toute la machine
```

### ps
"Processes"
Affiche les processus en cours d'execution.

### kill
Permet de "tuer" un processus en renseignant sont Pid (process id).


## Gestion des permissions et utilisateurs

### adduser
Ajoute un nouvel utilisateur sur la machine.

```sh
sudo adduser charlotte  # Créer l'utilisatrice "charlotte" et le groupe "Charlotte"
# On sera invité à lui choisir un mdp et d'autres informations
# Le repertoire /home/charlotte sera créé automatiquement avec les bonnes permissions
# Une Shell lui sera attribué par default
```

### useradd
Ajoute un utilisateur mais ne donne pas la possibilité de changer ses données et mdp.
Ne génère pas non plus de "home" pour ce user par défault !

```sh
sudo useradd sylvain        # Créé juste le user
sudo useradd sylvain -m     # Génère aussi le dossier "/home/sylvain"
```

### passwd
Change le mot de passe d'un utilisateur.

```sh
sudo passwd françois    # Change le mdp de l'utilisateur "françois"
sudo passwd root         # Change le mdp de root (qui n'a pas de mdp par défault)
```

### userdel
Supprime un utilisateur (mais pas son dossier home).

```sh
sudo userdel françois   # François n'existe plus, mais ses fichiers existent toujours
```

### visudo
Permet d'éditer le fichiers des "sudoers" : les utilisateurs ayant le droit d'utiliser
"sudo" (les administrateurs donc).
```sh
sudo visudo
```
On peut alors ajouter des users et groupes et leur donner les droits sudoers.

```sh
françois ALL = /sbin/useradd       # Autorise françois à utiliser l'executable useradd
charlotte ALL = ALL                 # Donne tous les droits à charlottes
```
### usermod
"User modification" permet de changer les informations d'un utilisateur.
Consultez "man usermod" pour voir toutes les options possibles.

```sh
sudo usermod charlotte --shell /usr/bin/zsh     # Change la shell de Charlotte à ZSH.
sudo usermod -l michel françois                 # Renomme "françois" en "michel"
```

### su
"Switch user"
Permet de se logger en tant qu'un autre utilisateur
```sh
su charlotte            # Se log en tant que charlotte
su                      # Se log en tant que root
su - charlotte          # Se log en tant que charlotte et charge son environnement (MIEUX)
su -                    # Se log en tant que root et charge son environnement (MIEUX)
```

On peut simplement faire "exit" pour revenir à son profil de base.

### finger
Doit être installé.
Permet d'avoir des informations concernant un utilisateur.

### Voir tous les users
```sh
cat /etc/passwd
```
Pour chaque user, nous obtenons une ligne suivant ce model
username:password:uid:gid:personaldata:homeDIR:shell
uid = user id
gid = group id

Exemple:
charlotte:x:1000:1000:,,,:/home/charlotte:/bin/bash
Le "x" pour password indique que celui ci est rangé dans un autre fichier (/etc/shadow).
Bien sûr ce dernier est hashé.


### groups
Voir les groupes auquels appartient le user.

### groupadd
Ajoute un nouveau groupe.

```sh
sudo groupadd powerrangers
```
### Voir tous les groupes sur la machine
```sh
cat /etc/group
```

### Ajouter un user à un groupe
Il faut passer par la commande usermod.

```sh
sudo usermod -G powerangers françois     # DANGER !! François ne fera plus parti QUE du groupe powerangers
sudo usermod -aG powerangers françois     # On AJOUTE le groupe poweranger à François
```

### chmod
Change les droits d'accès à un fichier/dossier.
read = r = 4
write = w = 2
execute = x = 1

user = u
group = g
others = o

```sh
chmod 744 fichier           # Donne toutes les permission au possesseur, mais les autres ne peuvent que lire
chmod 777 fichier           # Donne toutes les permissions à tout le monde sur ce fichier
chmod +x fichier            # Ajoute à tout le monde la permission d'execution sur ce fichier
chmod u+x go-rw fichier     # Ajoute "execute" au user, retire read/write au groupe et aux autres
```

### chown
Change le propriétaire du fichier/dossier.
```sh
chown françois fichier   # Maintenant le fichier appartient à françois
chown -R françois dossier   # Maintenant le dossier et son contenu appartiennent à françois
```

### chgrp
Change le groupe d'un fichier
```sh
chgrp powerrangers fichier   # Maintenant le fichier appartient au groupe powerrangers
chgrp -R powerrangers dossier   # Maintenant le fichier appartient au groupe powerrangers
```

### chsh
"Change shell" permet de changer la shell de l'utilisateur.
Par défault il s'agit de /bin/bash, mais il existe d'autres shells tels que zsh et fish,
plus modernes, mais qui ne sont pas forcément installées sur la machine.
```sh
sudo chsh       # On sera alors invité à renseigner la nouvelle shell
```
Le changement de shell ne prendra effet qu'en relançant la machine.

## Reseau
Ressources
[Tuto SSH par DistroTube](https://www.youtube.com/watch?v=2QXkrLVsRmk)
[Tuto SSH par TraversyMedia](https://www.youtube.com/watch?v=hQWRp-FdTpc)

### openssh-client / openssh-server et setup
Le client et le serveur permettant de réaliser des connections SSH.
La machine qui essaye de se connecter en remote est le "client" et doit donc avoir openssh-client installé.
La machine a laquelle on veut se connecter doit avoir openssh-server installé ET doit exposer
un port.

```sh
sudo apt install openssh-server    # Debian
sudo pacman install openssh         # Arch (openssh contient le client et le serveur)

sudo systemctl status ssh           # Check le status du serveur SSH
# sshd (pour ssh daemon) fonctionne également

# S'il n'est pas actif, faire les commandes suivantes
sudo systemctl enable ssh
sudo systemctl restart ssh
# ou
sudo systemctl enable --now ssh     # Cumule des deux commandes ci-dessus.

# Ensuite il faut ouvrir le Port auquel on souhaite se connecter.
sudo systemctl status ufw       # Vérifie si notre firewall est actif
sudo ufw allow ssh              # Autorise les connections SSH sur le port par defaut (22)

# On peut à présent se connecter à la machine hôte en SSH via le port 22
ssh username@ip
```

### ssh
Permet de se connecter à une machine distante via le protocole ssh
"host" peut être un domaine (localhost, google.com) ou une adresse IP.
Le port par défaut est 22, mais celui ci n'est pas forcément celui attendu par l'hôte pour
des raisons de sécurité !

```sh
ssh user@host       # Se connecte en tant que "user" sur la machine host via le port 22
ssh root@129.138.23.42 -p 12345 # Se connecte en tant que "root" sur le port 12345

# Pour se connecter sur une Virtual Machine
ssh user@localhost -p 2222      # Le port doit être défini dans la configuration réseau de votre VM (Configuration/Réseau)
# Mode d'accès NAT
# Redirection réseaux : créer une rêgle pour bind le port 22 à 2222 par exemple
```

### ssh-keygen
Permet de générer des paires de clés publique/privée.
Elles seront enregistrées dans ~/.ssh sous linux ou "Utilisateur/.ssh" sous windows.

```sh
ssh-keygen -t keyname
```

Ne dévoilez JAMAIS votre clé privée (.pk). N'exposez que la clé publique ".pub".

Afin de vous connecter à une machine distante sans avoir besoin de mot de passe, vous pouvez enregistrer votre clé publique (client) dans ~/.ssh/authorized_keys de la machine hôte (serveur).

Pour plus de sécurité, vous pouvez désactiver les connections par mot de passe sur le serveur afin de n'autoriser que les connections par clé.

```sh
sudo nano /etc/ssh/sshd_config
# Editez la ligne concernant "PasswordAuthentication" et passez là en "no"
# Dé-commentez là ci besoin (retirez le #)
```

### scp
Permet d'échanger des fichiers (cp/copy) mais via ssh.

```sh
scp [...<fichier(s)_à_copier>] <destination>
scp fichier.txt user@host:/chemin/vers/repertoire       # Copie "fichier.txt" dans /chemin/vers/repertoire de l'hôte.
scp fichier1.txt fichier2.txt fichier3.txt user@host:/chemin/vers/repertoire

scp user@host:/chemin/vers/fichier.txt .      # Copie fichier.txt vers le système local.
scp -P 2222 user@host:/chemin/vers/fichier.txt .      # Pour préciser le port, -P MAJUSCULE !! (me semble t'il)
```

### ifconfig
Doit être installé avec "net-tools". 
Sert à configurer une interface réseau.

```sh
sudo apt install net-tools      # Installation
```

### ip address
Affiche l'addresse IP de la machine.

```sh
ip a        # Raccourci
```

### ping
Permet de tester la connection à un hote.

```sh
ping google.com             # Ping en continue google.com
ping google.com -c 3        # Réalise 3 Pings
```

### netstat
Retourne les infos réseaux.
-tulpn pour filtrer

### ss
Comme netstat, plus moderne.

### iptables
Permet de controler les ports de la machine. Complexe à utiliser.

### ufw
Pour "uncomplicated firewall".
Permet de contrôler le pare-feu et les ports de la machine plus simplement.

```sh
sudo ufw enable     # Active le pare-feux
sudo ufw status     # Voir les ports ouverts
sudo ufw allow 80    # Ouvre le port 80 (HTTP)
sudo ufw allow 22    # Ouvre le port 22 (SSH)
```

### ssh-copy-id
Commande à lancer depuis la machine client (si vous êtes sous linux).
Enregistre la clé ssh du client dans les "authorized keys" du serveur.

```sh
ssh-copy-id user@host
```

## Les outils modernes
Ces outils ne sont généralement PAS installés par défaut sur une machine Linux mais sont
facile à trouver.

### zsh
Une shell un peu plus puissante (meilleur auto complétion) et customisable que bash avec un fonctionnement identique.
Depuis 2023, zsh est la shell par défaut sous Mac.

```sh
sudo apt install zsh
zsh             # Pour essayer zsh, mais n'en fait pas la shell par défaut
chsh            # changer sa shell à "/usr/bin/zsh" puis redémarer la machine

# Pour customiser votre zsh, éditez le fichier ~/.zshrc
```

### fish
Une shell moderne plus puissante que bash et zsh mais au fonctionnement distinct.
[Site officiel](https://fishshell.com/)

```sh
sudo apt install fish
fish             # Pour essayer fish, mais n'en fait pas la shell par défaut
chsh            # changer sa shell à "/usr/bin/fish" puis redémarer la machine

# Pour customiser votre fish, éditez le fichier ~/.config/fish/fish.config
```

### nerd fonts
[NerdFonts](https://www.nerdfonts.com/)
Les nerds fonts sont des polices avec icones. Vous devez paramétrer votre terminal pour qu'il utilise une NerdFont (de votre choix) si vous voulez bénéficier d'icones avec des outils comme exa ou oh-my-posh.

### exa
exa est une version plus moderne et puissante de "ls".

```sh
sudo apt install exa
exa
exa -al
exa --icons     # Affiche des icones à côté du nom des fichiers dossiers
# Pour cela, vous devez installer une police NerdFont
```

### bat (batcat)
batcat est une version plus moderne et puissante de "cat".
L'output est plus propre (couleurs pour le code, numéro des lignes...).

```sh
sudo apt install batcat     # Installation
bat fichier.txt             # Utilisation
```

### rg (ripgrep)
Variation plus puissante et moderne de grep codé en Rust.

```sh
sudo apt install ripgrep        # Installation
rg "pattern" fichier.txt        # Utilisation
```

### nvim (neovim)
Version plus moderne et customisable de Vi.
Toujours aussi délicat à manipuler, mais hautement configurable si on y passe le temps nécessaire... (diagnostics (détection d'erreurs dans le code), LSP (Language Server Protocol), auto-completion, syntax highlightning ). 

```sh
sudo apt install neovim         # Installation
nvim fichier.txt                # Utilisation
```


### htop
Comme "top" mais en plus joli et intéractif.

```sh
sudo apt install htop         # Installation
htop                          # Utilisation
```

### ranger
Explorateur de fichiers dans un terminal.

```sh
sudo apt install ranger
ranger
```

### tree
Affiche dans le terminal l'arborescence des fichiers/dossiers à partir du dossier courant.

```sh
sudo apt install tree
tree
```

### neofetch
Affiche le logo de votre distribution Linux, des informations sur votre machine et la palette de couleurs utilisée par votre terminal.

```sh
sudo apt install neofetch
neofetch
```

## Customisation des "Prompts" de son terminal
Ces deux programmes vous permettent de customiser votre terminal.
Plus qu'un aspect esthétique, ils permettent aussi d'afficher des informations complémentaires (versions installées des langages de programmation, branche git courante etc).
[NerdFonts nécessaires !](https://www.nerdfonts.com/)

### oh-my-posh
[Site officiel](https://ohmyposh.dev/)
Codé en Go. Configuration en .json.

### starship
[Site officiel](https://starship.rs/)
Codé en Rust. Configuration en .toml.