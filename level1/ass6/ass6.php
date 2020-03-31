<?php

function myCount() {
    $fileName = 'ass6_counter.txt';
    $counter = file_get_contents($fileName);
    echo $counter++;
    file_put_contents($fileName, $counter);
    
}

myCount();