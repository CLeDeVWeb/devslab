<?php
class TicketController {
	
	// Constantes
	
	// Attributs

	private int $id; 
  	private int $site_id; 
	private string $titre; 
  	private string $description; 
  	private string $statut; 
  	private string $priorite; 
  	private string $created_at; 

	
	/**
	 * Constructeur de la classe
	 */
	public function __construct(){}
	
	/**
	 * Applique des options sur l'objet (chargement de données annexes, formatage, etc)
	 * @param  mixed[] $pamOptions Tableau contenant les options à appliquer
	 *                               - bOption -> L'option doit être chargée ?
	 * @return self
	 */
	public function applyOptions($pamOptions) {
		if (isset($pamOptions['bOption']) && $pamOptions['bOption']) {
			// $this->loadOption();
		}
		
		return $this;
	}
	
	// Accesseurs
	public function getId() : int { return  $this->id; }
	public function getSiteId() : int{ return  $this->site_id; }
	public function getTitre() : string { return $this->titre; }
	public function getDescription() : string { return $this->description; }
	public function getStatut() : string { return $this->statut; }
	public function getPiorite() : string { return $this->priorite; }
	public function getCreatedAt() : string { return $this->created_at; }
	
	/**
	 * Charge toutes les données depuis la BDD
	 * @return \TicketController[]
	 */
	public static function load() {
		return TicketModel::load();
	}
	
	/**
	 * Charge un élément depuis la BDD
	 * @param  integer $Id Identifiant de l'élément
	 * @return \TicketController
	 */
	public static function loadById($Id) {
		return TicketModel::loadById($Id);
	}
	
	/**
	 * Sauvegarde l'élément en BDD
	 */
	public function save() {
		return TicketModel::save($this);
	}
	
	/**
	 * Cherche des éléments selon les cham passés dans le premier tableau
	 * @param  mixed[] $pamSearchFields   Cham (en clé) à mettre en recherche avec les valeurs qu'ils doivent avoir. Clés supportées :
	 *                                      - nInteger -> integer (0 = non filtré)
	 *                                      - sChaine -> string ('' = non filtré)
	 * @param  mixed[] $pamSearchOptions  Tableau d'options pour la recherche, au format clé (option) => valeur
	 *                                      - bOnlyCount -> Doit-on seulement compter le nombre de résultats ? Si à true, toutes les autres options sont ignorées (optionnel, default false)
	 *                                      - nNombreResultats -> Nombre de résultats par page (optionnel, default 20)
	 *                                      - nPage -> Page à partir de laquelle récupérer les résultats (optionnel, default 0)
	 *                                      - Toutes les clés de applyOptions
	 * @return \TicketController[]
	 */
	public static function search($pamSearchFields = array(), $pamSearchOptions = array()) {
		return TicketModel::search($pamSearchFields, $pamSearchOptions);
	}
	
	/**
	 * Décompte les résultats d'une recherche d'éléments selon les cham passés dans le tableau
	 * @param  mixed[] $pamSearchFields   voir self::search
	 * @return integer
	 */
	public static function searchCount($pamSearchFields) {
		return TicketModel::searchCount($pamSearchFields);
	}
	
	// Mutateurs
	
	public function setId(int $id): self { $this->id =  $id; return $this; }
	public function setSiteId(int $siteId): self { $this->site_id =  $siteId; return $this; }
	public function setTitre(string $titre): self { $this->titre = $titre; return $this; }
	public function setDescription(string $description): self { $this->description = $description; return $this; }
	public function setStatut(string $statut): self { $this->statut = $statut; return $this; }
	public function setPriorite(string $priorite): self { $this->priorite = $priorite; return $this; }
	public function setCreatedAt(string $createdAt): self { $this->created_at = $createdAt; return $this; }
}