(function($) {
	$.extend( {
		async : function() {
			var callbackQueue = [];
			this.result = undefined;
			this.state = "running";
			this.completed = false;
			this.yield = function(result, delayMillSeconds) {
				var self = this;
				setTimeout(function() {
					self.result = result;
					self.state = "completed";
					self.completed = true;
					while (callbackQueue.length > 0) {
						var callback = callbackQueue.shift();
						callback(self.result)
					}
				}, delayMillSeconds || 1);
				return this
			};
			this.addCallback = function(callback) {
				callbackQueue.push(callback);
				if (this.completed) {
					this.yield(this.result)
				}
				return this
			}
		},
		asyncInvoke : function(callback, result, delayMillSeconds) {
			var $async = new $.async();
			$async.addCallback(callback);
			$async.yield(result, delayMillSeconds);
			return $async
		}
	})
})(jQuery);
var ajaxSync = {
	async : function() {
		var callbackQueue = [];
		this.result = undefined;
		this.state = "running";
		this.completed = false;
		this.yield = function(result, delayMillSeconds) {
			var self = this;
			setTimeout(function() {
				self.result = result;
				self.state = "completed";
				self.completed = true;
				while (callbackQueue.length > 0) {
					var callback = callbackQueue.shift();
					callback(self.result)
				}
			}, delayMillSeconds || 1);
			return this
		};
		this.addCallback = function(callback) {
			callbackQueue.push(callback);
			if (this.completed) {
				this.yield(this.result)
			}
			return this
		}
	},
	asyncInvoke : function(callback, result, delayMillSeconds) {
		var $async = new ajaxSync.async();
		$async.addCallback(callback);
		$async.yield(result, delayMillSeconds);
		return $async
	}
};