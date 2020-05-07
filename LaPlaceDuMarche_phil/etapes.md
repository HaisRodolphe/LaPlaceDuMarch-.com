# Projet : La place du marché
---
>
### Création de la Bdd
>
- nom de la Base de données : **`laplacedumarche`**
  >
  - Nom d'utilisateur .. : _laplacedumarche_ ou RodolpheH
  - Mot de passe ....... : _rodo#phil28_     ou 1234
  >

- tables : 
  >
  - **`products`** :
    >
    | Nom         | Type         | Interclassement    | Descriptions                             | Commentaires |
    | ----------- | ------------ | ------------------ | -----------------------------------------| -------------|
    | ID          | INT(11)      |                    | Non NULL - AUTO_INCREMENT - PRIMARY_KEY  |              |
    | title       | VARCHAR(50)  | utf8mb4_general_ci | Non NULL                                 |              |
    | description | VARCHAR(255) | utf8mb4_general_ci | Non NULL                                 |              |
    | price       | INT(11)      |                    |                                          |              |

  >
  - **`fruits`** & **`vegetables`** & **`juices`** & **`dry_products`**:
    >
    | Nom               | Type         | Interclassement    | Descriptions                             | Commentaires |
    | ----------------- | ------------ | ------------------ | -----------------------------------------| -------------|
    | ID                | INT(11)      |                    | Non NULL - AUTO_INCREMENT - PRIMARY_KEY  |              |
    | name              | VARCHAR(50)  | utf8mb4_general_ci | Non NULL                                 |              |
    | description       | VARCHAR(255) | utf8mb4_general_ci | NULL                                     |              |
    | price             | INT(11)      | utf8mb4_general_ci | Non NULL                                 |              |
    | producer_ID       | VARCHAR(50)  | utf8mb4_general_ci | Non NULL                                 |              |
    | cityOrigin_ID     | VARCHAR(50)  | utf8mb4_general_ci | Non NULL                                 |              |
    | countryProduct_ID | VARCHAR(50)  | utf8mb4_general_ci | Non NULL                                 |              |

  >
  - **`countryProduct`** :
    >

  >
  - **`cityOrigin`** :
    >

  >
  - **`producers`** :
    >
    | Nom                       | Type              | Interclassement     | Description                             | Commentaires           |
    | ------------------------- | ----------------- | ------------------- | --------------------------------------- | ---------------------- |
    | ID                        | INT(11)           |                     | Non NULL - AUTO_INCREMENT - PRIMARY KEY |                        |
    | familyName                | VARCHAR(50)       | utf8mb4_general_ci  | Non NULL                                |                        |
    | firstName                 | VARCHAR(50)       | utf8mb4_general_ci  | Non NULL                                |                        |
    | societyName               | VARCHAR(100)      | utf8mb4_general_ci  | Non NULL                                |                        |
    | siret_nbr                 | INT(80)           |                     | Non NULL                                |                        |
    | building_nbr              | INT(11)           |                     | Non NULL                                |                        |
    | wayName                   | VARCHAR(100)      | utf8mb4_general_ci  | Non NULL                                |                        |
    | address                   | VARCHAR(255)      | utf8mb4_general_ci  | Non NULL                                |                        |
    | ZIP code                  | INT(11)           |                     | Non NULL                                |                        |
    | city                      | VARCHAR(80)       | utf8mb4_general_ci  | Non NULL                                |                        |
    | country                   | VARCHAR(50)       | utf8mb4_general_ci  | Non NULL                                |                        |
    | producer_communication_ID | INT(11)           |                     | Non NULL                                |                        |

  >
  - **`producers_communication`** :
    >
    | Nom             | Type              | Interclassement     | Description                             | Commentaires           |
    | --------------- | ----------------- | ------------------- | --------------------------------------- | ---------------------- |
    | ID              | INT(11)           |                     | Non NULL - AUTO_INCREMENT - PRIMARY KEY |                        |
    | phone_office    |
    | portable_office |
    | email_office    |

  >
  - **`customers`** :
    >

---

  >
  - **`Blog`** :
    >
    - table : **blog_post**
      >
      _Ne pas oublier de gérer le compteur de message dans le poste._
      >
      | Nom             | Type              | Interclassement     | Description                             | Commentaires                                                   |
      | --------------- | ----------------- | ------------------- | --------------------------------------- | -------------------------------------------------------------- |
      | ID              | INT(11)           |                     | Non NULL - AUTO_INCREMENT - PRIMARY KEY |                                                                |
      | title           | VARCHAR(100)      | utf8mb4_general_ci  | Non NULL                                | Titre du post                                                  |
      | blog_author_id  | INT(11)           |                     | Non NULL                                | Auteur du post en lien avec le champ ID dans la table 'author' |
      | content         | TEXT              | utf8mb4_general_ci  | Non NULL                                | Contenu du post                                                |
      | created_at      | DATETIME          |                     | Non NULL                                | Date du post                                                   |
      | image           | VARCHAR(255)      | utf8mb4_general_ci  | NULL                                    | URL de l'image                                                 |
      >
      >
    - table : **blog_author**
      >
      | Nom             | Type              | Interclassement     | Description                             | Commentaires                          |
      | --------------- | ----------------- | ------------------- | --------------------------------------- | ------------------------------------- |
      | ID              | INT(11)           |                     | Non NULL - AUTO_INCREMENT - PRIMARY KEY |                                       |
      | familyname      | VARCHAR(50)       | utf8mb4_general_ci  | Non NULL                                | Nom de famille                        |
      | firstname       | VARCHAR(50)       | utf8mb4_general_ci  | Non NULL                                | Prénom                                |
      >
      >
    - table : **blog_comment**
      >
       | Nom                   | Type              | Interclassement     | Description                             | Commentaires                                     |
       | --------------------- | ----------------- | ------------------- | --------------------------------------- | ------------------------------------------------ |
       | ID                    | INT(11)           |                     | Non NULL - AUTO_INCREMENT - PRIMARY KEY |                                                  |
       | blog_commentauthor_id | INT(11))          |                     | Non NULL                                | Lien avec le champ ID de la table 'commentauthor |
       | comment               | TEXT              | utf8mb4_general_ci  | Non NULL                                | Commentaire d'un post                            |
       | blog_post_Id          | INT(10)           |                     | Non NULL - INDEX                        | Lien avec la champ ID dans la table 'post'       |
       | created_at            | DATETIME          |                     | Non Null                                | Date du commentaire                              |
       >
       >
    - table : **blog_commentauthor**
      >
       | Nom             | Type              | Interclassement     | Description                             | Commentaires                                   |
       | --------------- | ----------------- | ------------------- | --------------------------------------- | ---------------------------------------------- |
       | ID              | INT(11)           |                     | Non NULL - AUTO_INCREMENT - PRIMARY KEY |                                                |
       | nickname        | VARCHAR(20)       | utf8mb4_general_ci  | Non NULL                                | Pseudo de celui qui laisse un commenatire      |
       | email           | VARCHAR(32)       | utf8mb4_general_ci  | Non Null - UNIQUE                       | Email de la personne qui laisse le commentaire |
       | website         | VARCHAR(255)      | utf8mb4_general_ci  | NULL                                    | URL de site eventuel                           |



