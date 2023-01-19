<?php

function get_algorithm($hash, $original) {
    // Get the length of the hash
    $hash_length = strlen($hash);
  
    // Iterate through all available algorithms
    foreach(hash_algos() as $algorithm) {
        if (strlen(hash($algorithm, $original)) == $hash_length) {
            return $algorithm;
        }
    }
  
    return null;
}

// Example usage
$original = 'password123';
$hash = '5f4dcc3b5aa765d61d8327deb882cf99'; // md5 hash of 'password123'

$algorithm = get_algorithm($hash, $original);

if ($algorithm) {
    echo "The algorithm used is: $algorithm";
} else {
    echo "The algorithm could not be determined.";
}

?>