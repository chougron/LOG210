LOG 210
=======

1) Installation et Configuration
--------------------------------

Pour installer le projet je pars du principe que vous avez tous un serveur WEB
fonctionnel sur votre machine. (LAMP, WAMP, ou MAMP)

Il faut également vérifier que le module mod_rewrite est activé. S'il ne l'est
pas, un truc de ce genre là pourra le faire :
http://stackoverflow.com/questions/869092/how-to-enable-mod-rewrite-for-apache-2-2

Puis, il faut créer un alias pour le site, afin de le rendre disponible sous une
certaine adresse locale.
Sous Windows le fichier en question a l'air de s'appeler httpd.conf, et il doit
se trouver quelque part dans le répertoire d'apache.
Sous Mac, le fichier semble se trouver ici : /etc/apache2/httpd.conf
Sous Linux, le fichier est là : /etc/apache2/sites-enabled/000-default.conf

Entre les balises <VirtualHost *:80> il faut rajouter un bloc de ce type :

    Alias /log210/ "/home/camille/ETS/LOG210/sources/web/"
    Alias /log210 "/home/camille/ETS/LOG210/sources/web/"
    <Directory "/home/camille/ETS/LOG210/sources/web/">
       Options Indexes FollowSymLinks MultiViews
       AllowOverride All
       Require local
       Order allow,deny
       Allow from all
    </Directory>

En remplaçant /home/camille/ETS/LOG210/sources/web/ par le chemin d'accès vers
les sources du projet. Rajoutez bien /web/ à la fin car on veut que l'adresse
pointe directement sur ce dossier en spécifique.

Normalement tout devrait marcher. Vous pouvez tester le site à l'adresse
http://localhost/log210/

Il y aura sûrement un fichier de configuration lorsque le module de
communication avec MongoDB sera réalisé. Ça sera expliqué en temps voulu.

2) Utilisation du modèle MVC
----------------------------

Pour commencer, il faut comprendre la notion de namespace. Un namespace est
juste fait pour donner une sorte de package à une classe. Comme en Java. Du coup
si vous voulez utiliser une classe en particulier, il faut spécifier de laquelle
il s'agit, avec l'instruction suivante :

    use Namespace\De\La\Classe\NomDeLaClasse;

Puis, dans tout le fichier PHP actuel, a chaque fois que NomDeLaClasse sera
utilisé, le système comprendra de quelle classe on veut parler.
Si vous créez un controller, ou autre, et qu'une erreur de type "class not
found" apparaît, vérifiez que vous avez bien spécifié le namespace.

Les classes de bases formant le coeur du modèle sont présentes dans le dossier
**app/component**. Certaines sont vides, mais des fonctionnalités seront
peut-être ajoutées dans un second temps.

Les classes Controller sont présentes dans le dossier **app/controller**. Chaque
classe hérite (extends) de la classe de base Controller. Un controlleur peut
posséder plusieurs actions, c'est à dire plusieurs méthodes que l'on peut
appeler depuis une adresse internet différente.
Lorsque l'on entre l'adresse http://localhost/log210/test/hello/camille le 
système comprend que l'on veut appeler le controlleur test (dont la classe
correspondante doit se trouver dans le dossier controller), avec l'action hello
(il faut donc une méthode appelée hello dans ce controlleur), et avec le
paramètre camille. Tout autre chaîne séparée par un **/** sera comptée comme un
autre paramètre pour l'action.

Les modèles sont à placer dans le dossier **app/model** et représentent nos
objets. Il peuvent contenir des attributs, des méthodes, statiques ou non,
privés, protégés, publiques... Ces modèles sont faits pour être appelés dans les
controlleurs.

Les vues sont à placer dans le dossier **app/view**. Les vues sont censées ne
faire qu'afficher des données, et ne faire aucun traitement (le traitement doit
être fait dans le controlleur). Pour appeler une vue depuis un controlleur, et
lui passer des données, la méthode statique suivante existe :

    View::render($file, $vars)

Où $file est le nom de la vue demandée (si la vue est dans le dossier index, et
s'appelle index.php, alors il faut mettre "index/index.php"), et où $vars est un
tableau associatif des variables que l'on veut transmettre à la vue. (ex:
array('test'=>'valeur') donnera une variable qui s'appelle test et dont la
valeur est 'valeur')

J'ai mis un exemple dans le controlleur index, faisant appel au model Test, et à
la vue index.php. Vous pouvez vous en inspirer pour faire vos pages.


Si vous avez des questions, ou si vous voyez que des choses ne marchent pas,
n'hésitez pas à me demander.