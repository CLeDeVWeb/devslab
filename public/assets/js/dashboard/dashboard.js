import Http from '../lib/Http';
import Modal from '../lib/Modal.js';


const oDashboard = {

	async load() {

		const oResult = await Http.get(...);

		this.render(oResult);

	},

	render(oData) {

	}

};

export default oDashboard;