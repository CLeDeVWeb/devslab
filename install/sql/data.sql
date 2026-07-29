use DEVLAB
INSERT INTO CLIENT
(nom, prenom, email, telephone)
VALUES
('Dupont','Jean','jean.dupont@devlab.fr','0610101010'),
('Martin','Marie','marie.martin@devlab.fr','0620202020'),
('Bernard','Paul','paul.bernard@devlab.fr','0630303030');

INSERT INTO SITE
(client_id, nom, adresse, cp, ville)
VALUES
(1,'Siège Montpellier','1 avenue de France','34000','Montpellier'),
(1,'Agence Sète','5 rue du Port','34200','Sète'),
(2,'Entrepôt Béziers','12 avenue de Béziers','34500','Béziers'),
(3,'Agence Nîmes','18 rue Victor Hugo','30000','Nîmes');

INSERT INTO TICKET (site_id,titre,description,statut,priorite)
VALUES
(1,'Caméra hors service','La caméra principale ne répond plus.','En cours','Haute'),

(1,'Accès impossible',
'Le badge principal ne fonctionne plus.',
'Nouveau',
'Normale'),

(2,'Maintenance annuelle',
'Contrôle des équipements.',
'Résolu',
'Basse'),

(3,'Serveur arrêté',
'Le serveur ne démarre plus.',
'Fermé',
'Critique'),

(4,'Mise à jour logiciel',
'Prévoir une mise à jour.',
'En cours',
'Normale');

INSERT INTO DOCUMENT
(site_id,nom,fichier,type)
VALUES
(1,'Contrat','contrat_montpellier.pdf','pdf'),
(1,'Plan du site','plan_site.pdf','pdf'),
(2,'Notice centrale','notice.pdf','pdf'),
(3,'Rapport maintenance','rapport.docx','docx'),
(4,'Photos installation','photos.zip','zip');