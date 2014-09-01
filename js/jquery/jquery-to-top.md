# jQuery To Top Scroll plugin

## Introduction

I needed a quick and easy scroll utility that I could put on any page without having issues. I built this to be super simple, effective, and configurable with minimum fuss.

## Instructions

Include [this file](./jquery-to-top.js) in your project after you have loaded jQuery.
Add this code at some point in the <body> tag, preferably near the end.
    
    $('#toTopLink').toTopScroll();
    
You will additionally need to add a link or button with an id of toTopLink in order to call it this way.

## Options

You can include three options for this plugin as an object passed to the toTopScroll() method.

* _min_height_: This is the minimum height before the link appears to scroll to the top. The default value is 120.
* _scroll_speed_: This option affects the speed at which the page scrolls. Larger numbers increase speed, while lower numbers slow the animation down. The default value is 3. Setting this value to 0 breaks the plugin. Just an FYI.
* _fade_time_: This option determines the time, in milliseconds, the to top link takes to fade in or out. The default is 1000.

    var options = { min_height: 300, scroll_speed: 2, fade_time: 500 };
    $('#toTopLink').toTopScroll(options);
    
    
