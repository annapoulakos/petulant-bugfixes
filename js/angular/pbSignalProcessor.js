;angular.module('pbUtilities', [])
.factory('SignalProcessor', ['$rootScope', function($rootScope){
    var SignalProcessorService = {
        register: function(signal_name, signal_callback){
            $rootScope.$on(signal_name, function(event, params){
                signal_callback(params);
            });
        }
    };

    return SignalProcessorService;
}])