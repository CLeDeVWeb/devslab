/**
 * Http.js
 *
 * Couche HTTP de DevLab.
 *
 * - Utilise fetch()
 * - Retourne une Promise
 * - Sérialise automatiquement les données en JSON
 * - Convertit automatiquement la réponse en JSON
 * - Gestion centralisée des erreurs
 */

export default class Http {

	static DEBUG_MODE = false;

	static async get(sUrl, oOptions = {}) {
		return this.request(sUrl, null, {
			...oOptions,
			method: 'GET'
		});
	}

	static async post(sUrl, oData = {}, oOptions = {}) {
		return this.request(sUrl, oData, {
			...oOptions,
			method: 'POST'
		});
	}

	static async put(sUrl, oData = {}, oOptions = {}) {
		return this.request(sUrl, oData, {
			...oOptions,
			method: 'PUT'
		});
	}

	static async delete(sUrl, oData = {}, oOptions = {}) {
		return this.request(sUrl, oData, {
			...oOptions,
			method: 'DELETE'
		});
	}

	static async request(sUrl, oData = {}, oOptions = {}) {

		const sMethod = (oOptions.method ?? 'POST').toUpperCase();

		const oFetchOptions = {
			method: sMethod,
			headers: {
				'Content-Type': 'application/json',
				...(oOptions.headers ?? {})
			}
		};

		if (sMethod !== 'GET') {
			oFetchOptions.body = JSON.stringify(oData);
		}

		try {

			const oResponse = await fetch(sUrl, oFetchOptions);

			let oJson = null;

			try {
				oJson = await oResponse.json();
			}
			catch {
				throw new Error('Réponse JSON invalide');
			}

			if (!oResponse.ok) {
				throw {
					status: oResponse.status,
					response: oJson
				};
			}

			return oJson;

		}
		catch (oError) {

			if (this.DEBUG_MODE) {
				console.group('Http');
				console.error(oError);
				console.groupEnd();
			}

			throw oError;
		}

	}

}