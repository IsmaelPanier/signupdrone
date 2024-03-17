USE drone;

DROP TABLE IF EXISTS gestion_erreurs;
DROP TABLE IF EXISTS journal_activite;
DROP TABLE IF EXISTS historique_livraisons;
DROP TABLE IF EXISTS etat_drone;
DROP TABLE IF EXISTS utilisateurs;

CREATE TABLE utilisateurs (
  id INTEGER PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(255),
  prenom VARCHAR(255),
  mail VARCHAR(255),
  service VARCHAR(255),
  mot_de_passe VARCHAR(255),
  created_at DATETIME
);

CREATE TABLE etat_drone (
  id INTEGER PRIMARY KEY AUTO_INCREMENT,
  disponibilite VARCHAR(255) DEFAULT 'libre',
  batterie VARCHAR(255) DEFAULT 'suffisante',
  created_at DATETIME
);

CREATE TABLE historique_livraisons (
  id INTEGER PRIMARY KEY AUTO_INCREMENT,
  id_drone INTEGER,
  id_utilisateur INTEGER,
  heure_depart DATETIME,
  heure_arrivee DATETIME,
  statut_livraison VARCHAR(255),
  coordonnees_depart VARCHAR(255),
  coordonnees_arrivee VARCHAR(255),
  created_at DATETIME,
  FOREIGN KEY (id_drone) REFERENCES etat_drone(id),
  FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id)
);

CREATE TABLE journal_activite (
  id INTEGER PRIMARY KEY AUTO_INCREMENT,
  id_utilisateur INTEGER,
  action VARCHAR(255),
  heure_action DATETIME,
  created_at DATETIME,
  FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id)
);

CREATE TABLE gestion_erreurs (
  id INTEGER PRIMARY KEY AUTO_INCREMENT,
  id_drone INTEGER,
  description_erreur VARCHAR(255),
  heure_erreur DATETIME,
  created_at DATETIME,
  FOREIGN KEY (id_drone) REFERENCES etat_drone(id)
);