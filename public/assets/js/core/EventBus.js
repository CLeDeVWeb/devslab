/**
 * DevLab EventBus
 */

class EventBus {

	constructor() {
		this.events = new Map();
	}

	on(event, callback) {

		if (!this.events.has(event)) {
			this.events.set(event, []);
		}

		this.events.get(event).push(callback);
	}

	off(event, callback) {

		if (!this.events.has(event)) {
			return;
		}

		const listeners = this.events.get(event);

		this.events.set(
			event,
			listeners.filter(fn => fn !== callback)
		);
	}

	emit(event, data = null) {

		if (!this.events.has(event)) {
			return;
		}

		this.events.get(event).forEach(callback => callback(data));
	}

	once(event, callback) {

		const wrapper = (data) => {
			callback(data);
			this.off(event, wrapper);
		};

		this.on(event, wrapper);
	}

	clear() {
		this.events.clear();
	}

}

export default new EventBus();