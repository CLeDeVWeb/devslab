import EventBus from "../core/EventBus.js";

EventBus.emit("navbar:toggle");

const Navbar = {

	init() {
		this.bindEvents();
	},

	bindEvents() {

	}

};

export default Navbar;