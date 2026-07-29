import EventBus from "../core/EventBus.js";

EventBus.on("navbar:toggle", () => {

	console.log("toggle sidebar");

});