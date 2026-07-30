<?php
declare(strict_types=1);
class TicketModel extends Model {
	
	const DEFAULT_DATABASE = 'DEVLAB';
	const TABLE_NAME = 'TICKET';
	const DEFAULT_NUM_RESULT_BY_PAGE = 20;
	const CLASS_CONTROLLER = 'TicketController';
	
	/**
	 * Génère la requête SQL pour faire la recherche
	 * @param  mixed[] $pamSearchFields  Tableau de recherche, voir \CT::search
	 * @param  mixed[] $pamSearchOptions Tableau d'options à appliquer, voir \CT::search
	 * @return string
	 */
	private static function generateSearchSQL($pamSearchFields = array(), $pamSearchOptions = array()) {
		$asWhere = array();
		$asJoin = array();
		$oConn = self::getConnexion(self::DEFAULT_DATABASE);
		$bOnlyCount = isset($pamSearchOptions['bOnlyCount']) && ($pamSearchOptions['bOnlyCount'] === true);
		$sSQL = "SELECT ".($bOnlyCount ? 'count(*)' : 'main.*')." FROM ".self::TABLE_NAME." main ";
		
		if (isset($pamSearchFields['nInteger']) && ((int) $pamSearchFields['nInteger']) > 0) {
			$nInteger = (int) $pamSearchFields['nInteger'];
			$asJoin['TABLE1'] = " TABLE1 t1 ON (main.fk1 = t1.pk) ";
			$asWhere[] = " t1.integer = {$nInteger} ";
		}
		
		if (isset($pamSearchFields['sChaine']) && $pamSearchFields['sChaine'] !== '') {
			$asJoin['TABLE2'] = " TABLE2 t2 ON (main.fk2 = t2.pk) ";
			$asWhere[] = " t2.chaine like '{$oConn->real_escape_string($pamSearchFields['sChaine'])}' ";
		}
		
		if (!empty($asJoin)) {
			$sSQL .= " INNER JOIN ".implode(' INNER JOIN ', $asJoin);
		}
		
		if (!empty($asWhere)) {
			$sSQL.= " WHERE ".implode(' AND ', $asWhere);
		}
		
		if (!$bOnlyCount) {
			$nNombreResultats = (int) (isset($pamSearchOptions['nNombreResultats']) ? $pamSearchOptions['nNombreResultats'] : self::DEFAULT_NUM_RESULT_BY_PAGE);
			$nFirstResult = (int) (isset($pamSearchOptions['nPage']) ? ($pamSearchOptions['nPage'] * $nNombreResultats) : 0);
			$sSQL.= " ORDER BY main.order ".($nNombreResultats !== 0 ? " LIMIT {$nFirstResult}, {$nNombreResultats} " : '');
		}
		// error_log($sSQL);
		return $sSQL;
	}
	
	/**
	 * Charge toutes les données depuis la BDD
	 * @return \CT[]
	 */
	public static function load() {
		$aoReturn = array();
		$sSQL = "SELECT * FROM ".self::TABLE_NAME;
		
		if (($rez = self::query($sSQL, self::DEFAULT_DATABASE)) !== false) {
			while ($obj = $rez->fetch_object(self::CLASS_CONTROLLER)) {
				$aoReturn[] = $obj;
			}
			$rez->free();
		}
		
		return $aoReturn;
	}
	
	/**
	 * Charge un élément depuis la BDD
	 * @param  integer $pnId Identifiant de l'élément
	 * @return \CT
	 */
	public static function loadById($pnId) {
		$nId = (int) $pnId;
		$obj = null;
		$sSQL = "SELECT * FROM ".self::TABLE_NAME." WHERE id = {$nId}";
		
		if (($rez = self::query($sSQL, self::DEFAULT_DATABASE)) !== false) {
			$obj = $rez->fetch_object(self::CLASS_CONTROLLER);
			$rez->free();
		}
		
		return $obj;
	}
	
	/**
	 * Enregistre un élément en BDD
	 * @param  \CT $poElement Element à enregistrer
	 */
	public static function save(CT $poElement) {
		$oConn = self::getConnexion(self::DEFAULT_DATABASE);
		
		if ($poElement->getId() === 0) {
			$poElement->setId(self::_getIdMax(self::TABLE_NAME, 'id', self::DEFAULT_DATABASE));
		}
		
		$sSQL = "INSERT INTO ".self::TABLE_NAME." () VALUES () ON DUPLICATE KEY UPDATE [...] ";
		
		if (!self::query($sSQL, self::DEFAULT_DATABASE)) {
			throw new WBB_DB_Exception(CTranslator::getValue('classe', 'common', 'exception.bdd.fail_save'));
		}
	}
	
	/**
	 * Cherche des éléments en BDD
	 * @param  mixed[] $pamSearchFields  Tableau de recherche, voir \CT::search
	 * @param  mixed[] $pamSearchOptions Tableau d'options à appliquer, voir \CT::search
	 * @return \CT[]
	 */
	public static function search($pamSearchFields = array(), $pamSearchOptions = array()) {
		$aoReturn = array();
		$sSQL = self::generateSearchSQL($pamSearchFields, $pamSearchOptions);
		
		if (($rez = self::query($sSQL, self::DEFAULT_DATABASE)) !== false) {
			while ($obj = $rez->fetch_object(self::CLASS_CONTROLLER)) {
				$obj->applyOptions($pamSearchOptions);
				$aoReturn[] = $obj;
			}
			$rez->free();
		}
		
		return $aoReturn;
	}
	
	/**
	 * Compte le nombre d'éléments correspondants à une recherche en BDD
	 * @param  mixed[] $pamSearchFields  Tableau de recherche, voir \CT::search
	 * @return integer
	 */
	public static function searchCount($pamSearchFields = array()) {
		$nReturn = 0;
		$sSQL = self::generateSearchSQL($pamSearchFields, array('bOnlyCount' => true));
		
		if (($rez = self::query($sSQL, self::DEFAULT_DATABASE)) !== false) {
			$arr = $rez->fetch_array(MYSQLI_NUM);
			$nReturn = (int) $arr[0];
			$rez->free();
		}
		
		return $nReturn;
	}
}