#README

La participation au développement de ce présent application requiert une version 7.4^ de PHP avec une version 5.x^ de mySQL.

Pour se mettre à niveau, vous devez exécuter la dernière version du fichier se trouvant dans le repertoire ____/libraries/migrations/____ 

Et pour exécuter des jeux de fausses données dans la base de données afin de tester rapidement les différentes fonctionnalités, vous devez exécuter les contenu des différentes variables dans le fichier ___/libraries/fixtures/fixtures.php___ qui vous conviennent dans votre base de données. Il s'agit des requêtes SQL permettant la création de données dans les tables.

Le projet est décomposé en 3 grandes parties =>
###libraries - models - templates

##libraries
Ce repertoire contient essentiellement les différents fichiers qui pourraient être réutilisés dans d'autres applications différentes de celle là.

On y remarque 2 répertoires
1. ___/libraries/fixtures___: Il s'agit du dossier contenant l'application des jeux de fausses données dans la base de données
2. ___/libraries/migrations___: Il s'agit des différentes migration de la base de données suivant un étant évolutif.

    Pour les modifications des différentes informations de la base données, rendez-vous vers le fichier ___/libraries/Database.php___
    
    Le fichier __/libraries/Form.class.php__ est utilisé pour le formatage des formulaires utilisé dans l'application.

##models

Ce répertoire contient l'ensemble des class nécessaire à l'interraction avec la base de données.

##templates

Ce répertoire contient tous les fichiers nécessaire à la vue de l'application, regroupe également les différents feuilles de style **css, js, fontawesome**, et aussi les fichiers media **image...**. Certains de ces fichiers contiennent quelques lignes SQL, mais se verront d'être corriger plus tard.