import Http from '../../../assets/js/lib/Http.js'
import Modal from '../../../assets/js/lib/Modal.js';


const oDashboard = {

	async init() {

		const oResult =  await Http.get('/request/initDashboard.php');

		console.log(oResult);

		// this.render(oResult);

	},

	render(oData) {

	}

};

export default oDashboard;