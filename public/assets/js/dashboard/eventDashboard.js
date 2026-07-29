import oDashboard from './dashboard.js';
import Modal from '../lib/Modal.js';

const oEvent = {

	init() {

		document .getElementById('btnLoad') ?.addEventListener('click', () => Dashboard.load());

		document .getElementById('btnModal') ?.addEventListener('click', () => Modal.open('modalTest'));

	}

};

export default oEvent;