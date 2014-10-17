# Timer Chain Object

This object is used to chain function callbacks in a simple queue. I use this mainly for generating custom VelocityJS animations with multiple steps that can't generally be accomplished easily in VelocityJS directly. Other uses could be for building walk-through systems or managing animation chains in custom applications.

## Internal Variables

```javascript
timeoutHandler: Holds the timeout instance in case we need to stop the chain unexpectedly.
chain: An array of chained callbacks and parameters.
current: Current index in the chain.
running: Boolean to determine if the system is already in progress.
```

## Functions

```javascript
TimerChain.add(fn, interval, params)
```

> This function allows you to add a function, interval and callback parameters to the chain.

```javascript
TimerChain.start()
```

> This function starts the chain. If the chain is already running, or is zero-length, this function
> simply exits.

```javascript
TimerChain.stop()
```

> This function stops the chain at its current iteration. It does not perform transaction rollback.

```javascript
TimerChain.process()
```

> This function processes the current step of the timer chain. It also sets the timeout handler
> so that the next item in the chain can be run subsequently.

```javascript
TimerChain.next()
```

> This function moves the pointer to the next item, if any, and either processes the callback
> or exits the chain.

## Usage

The following is a basic usage example.

```javascript
function test (params) {
    console.table(params);
}

myChain = new TimerChain();
myChain.add(test, 1000, [1,2,3,4,5]);
myChain.add(test, 1000, {key: '1', value: 'This is a test.'});
myChain.add(test, 500, [1,2,3,4,5]);
myChain.add(test, 500, {key: '1', value: 'This is a test.'});
myChain.add(test, 2000, [1,2,3,4,5]);
myChain.add(test, 2000, {key: '1', value: 'This is a test.'});

myChain.start();
```

> This example will run the test function 6 times over the course of seven seconds.

For a better example, visit the demo here: [http://jimpoulakos.com/test/game.html](http://jimpoulakos.com/test/game.html)
