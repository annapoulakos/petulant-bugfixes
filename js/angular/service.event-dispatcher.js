angular.module('application')
.service('EventDispatcher', ['$rootScope', function($rootScope){
	this.events = [
		{receive: 'child.broadcast.event', broadcast: 'core.broadcast.event'}
	];
	this.registered = false;

	/**
	 * fetch_event
	 * This function fetches the event from the master events list.
	 * @param <string> receiver This is the event name received via $broadcast in a child element.
	 * @return <object> Returns the specified receiver object.
	 */
	this.fetch_event = function(receiver){
		var len = this.events.length;
		while(len--){
			if(receiver == this.events[len].receive){
				return this.events[len];
			}
		}
	};

	/**
	 * broadcast
	 * This function broadcasts a dispatch message to child controllers
	 */
	this.broadcast = function(event, params){
		$rootScope.$broadcast(event, params);
	};

	/**
	 * receive
	 * This function receives broadcast from child controllers.
	 */
	this.receive = function(event, params){
		var e = this.fetch_event(event.name);
		this.broadcast(e.broadcast, params);
	};

	/**
	 * __init
	 * This is the initialization function. Should be called only once upon initialization
	 */
	this.__init = function(){
		if(this.registered) return;

		var len = this.events.length;
		while(len--){
			$rootScope.$on(this.events[len].receive, this.receive);
		}
		this.registered = true;
	};

}]);
