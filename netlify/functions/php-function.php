<?php

// A basic function that returns a response
function handler($event) {
    return [
        'statusCode' => 200,
        'body' => 'Hello from the PHP serverless function!'
    ];
}

echo handler($event);
