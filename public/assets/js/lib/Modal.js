/**
 * Modal.js
 *
 * Couche d'abstraction des modales Bootstrap.
 *
 * - Ouverture/Fermeture simplifiées
 * - Vérification des paramètres
 * - Gestion centralisée des erreurs
 * - Focus automatique sur le premier champ
 */

export default class Modal {

	static DEBUG_MODE = false;

	/**
	 * Ouvre une modale Bootstrap.
	 *
	 * @param {string} sIdModal
	 * @param {boolean} bFocus
	 */
	static open(sIdModal, bFocus = true) {

		const oElement = this.#getModalElement(sIdModal);

		if (!oElement) {
			return false;
		}

		try {

			const oModal = bootstrap.Modal.getOrCreateInstance(oElement);

			oModal.show();

			if (bFocus) {

				oElement.addEventListener(
					'shown.bs.modal',
					function onShown() {

						const oInput = oElement.querySelector(
							'input, textarea, select, button'
						);

						oInput?.focus();

						oElement.removeEventListener(
							'shown.bs.modal',
							onShown
						);

					}
				);

			}

			return true;

		}
		catch (oError) {

			this.#logError(
				`Impossible d'ouvrir la modale "${sIdModal}"`,
				oError
			);

			return false;

		}

	}

	/**
	 * Ferme une modale Bootstrap.
	 *
	 * @param {string} sIdModal
	 */
	static close(sIdModal) {

		const oElement = this.#getModalElement(sIdModal);

		if (!oElement) {
			return false;
		}

		try {

			bootstrap.Modal
				.getOrCreateInstance(oElement)
				.hide();

			return true;

		}
		catch (oError) {

			this.#logError(
				`Impossible de fermer la modale "${sIdModal}"`,
				oError
			);

			return false;

		}

	}

	/**
	 * Bascule l'état de la modale.
	 *
	 * @param {string} sIdModal
	 */
	static toggle(sIdModal) {

		const oElement = this.#getModalElement(sIdModal);

		if (!oElement) {
			return false;
		}

		try {

			bootstrap.Modal
				.getOrCreateInstance(oElement)
				.toggle();

			return true;

		}
		catch (oError) {

			this.#logError(
				`Impossible de basculer la modale "${sIdModal}"`,
				oError
			);

			return false;

		}

	}

	/**
	 * Retourne l'instance Bootstrap.
	 *
	 * @param {string} sIdModal
	 * @returns {bootstrap.Modal|null}
	 */
	static getInstance(sIdModal) {

		const oElement = this.#getModalElement(sIdModal);

		if (!oElement) {
			return null;
		}

		return bootstrap.Modal.getOrCreateInstance(oElement);

	}

	/**
	 * Vérifie et retourne l'élément DOM.
	 *
	 * @param {string} sIdModal
	 * @returns {HTMLElement|null}
	 */
	static #getModalElement(sIdModal) {

		if (typeof sIdModal !== 'string' || sIdModal.trim() === '') {

			this.#logError('ID de modale invalide.', sIdModal);

			return null;

		}

		const oElement = document.getElementById(sIdModal);

		if (!oElement) {

			this.#logError(
				`Aucune modale trouvée avec l'ID "${sIdModal}".`
			);

			return null;

		}

		if (!oElement.classList.contains('modal')) {

			this.#logError(
				`"${sIdModal}" n'est pas une modale Bootstrap.`
			);

			return null;

		}

		return oElement;

	}

	/**
	 * Journalisation centralisée.
	 *
	 * @param {string} sMessage
	 * @param {*} oData
	 */
	static #logError(sMessage, oData = null) {

		if (!this.DEBUG_MODE) {
			return;
		}

		console.group('[Modal]');
		console.warn(sMessage);

		if (oData !== null) {
			console.info(oData);
		}

		console.groupEnd();

	}

}