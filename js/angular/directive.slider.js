angular.module('application')
.directive('jpSlider', [function(){
	var jpSliderDefinition = {
		 replace: false
		,restrict: 'A'
		,scope: false
		,link: function(scope, element, attributes){
			var expression = attributes.jpSlider;
			var duration = (attributes.jpSliderDuration || 'fast');

			if(!scope.$eval(expression)){
				element.hide();
			}

			scope.$watch(expression, function(new_value, old_value){
				if(new_value === old_value) return;

				if(new_value){
					element.stop(true,true).slideDown(duration);
				} else {
					element.stop(true,true).slideUp(duration);
				}
			});
		}
	};

	return jpSliderDefinition;
}]);
