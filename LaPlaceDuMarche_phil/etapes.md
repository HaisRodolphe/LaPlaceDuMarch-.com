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

- tables : `Products` / `Fruits` / `Vegetables` / `Juices` / `Dry_products`
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
  - **`Fruits`** :
    >
    | Nom               | Type         | Interclassement    | Descriptions                             | Commentaires |
    | ----------------- | ------------ | ------------------ | -----------------------------------------| -------------|
    | ID                | INT(11)      |                    | Non NULL - AUTO_INCREMENT - PRIMARY_KEY  |              |
    | name              | VARCHAR(50)  | utf8mb4_general_ci | Non NULL                                 |              |
    | description       | VARCHAR(255) | utf8mb4_general_ci | NULL                                     |              |
    | price             | INT(11)      | utf8mb4_general_ci | Non NULL                                 |              |
    | producer          | VARCHAR(50)  | utf8mb4_general_ci | Non NULL                                 |              |
    | cityOrigin_ID     | VARCHAR(50)  | utf8mb4_general_ci | Non NULL                                 |              |
    | countryProduct_ID | VARCHAR(50)  | utf8mb4_general_ci | Non NULL                                 |              |

  >
  - **`countryProduct`** :
    >

  >
  - **`cityOrigin`** :
    >

  >
  - **`producer`** :
    >

  >
  - **`customer`** :
    >

