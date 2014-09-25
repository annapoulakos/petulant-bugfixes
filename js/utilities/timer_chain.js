var Utilities = Utilities || {}
Utilities.TimerChain = Utilities.TimerChain || {}

/**
 * The TimerChain class allows a series of callbacks to be run at a specified set of intervals.
 * This is mostly beneficial for building animation chains, but can easily be used for other
 * items requiring a stepped set of function callbacks.
 */

Utilities.TimerChain = function () {
    this.timeoutHandler = null;
    this.chain = [];
    this.current = 0;
    this.running = false;
};


/**
 * Add a new element to the timing chain.
 * @param {Function} fn       The callback to run at the specified interval.
 * @param {int}      interval The interval to use with window.setTimeout
 * @param {[mixed]}  params   A list of params to send to the callback function.
 */
Utilities.TimerChain.prototype.add = function (fn, interval, params) {
    this.chain.push({
        fn: fn,
        interval: interval,
        params: params
    });
};

/**
 * Starts running the timeout chain
 */
Utilities.TimerChain.prototype.start = function () {
    if (this.running || this.chain.length == 0) {
        return;
    }

    this.running = true;
    this.current = 0;
    this.process();
};

/**
 * Stops the timeout chain
 */
Utilities.TimerChain.prototype.stop = function () {
    this.running = false;
    window.clearTimeout(this.timeoutHandler);
};

/**
 * Processes the current step of the timeout chain
 */
Utilities.TimerChain.prototype.process = function () {
    var the_ = this.chain[this.current];

    this.timeoutHandler = window.setTimeout(function () {
        the_.fn(the_.params);
        this.next();
    }.bind(this), the_.interval);
};

/**
 * Increments the current step; Either stops the timeout chain (if there are no more elements to chain) or processes the next chain.
 */
Utilities.TimerChain.prototype.next = function () {
    this.current = this.current + 1;

    this.current == this.chain.length? this.stop(): this.process();
};