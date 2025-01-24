<?php

// Load the Rust library
$ffi = FFI::cdef(
    "unsigned int fib_rust(unsigned int n);",
    "./rust_lib/fib_lib/target/release/libfib_lib.so" // Path to the Rust library
);

// PHP Fibonacci function
function fib_php($n) {
    if ($n <= 1) {
        return $n;
    }
    return fib_php($n - 1) + fib_php($n - 2);
}

$n = 45;

// Benchmark PHP implementation
$start_php = microtime(true);
$result_php = fib_php($n);
$time_php = (microtime(true) - $start_php) * 1000; // Convert to milliseconds

// Benchmark Rust implementation via FFI
$start_rust = microtime(true);
$result_rust = $ffi->fib_rust($n);
$time_rust = (microtime(true) - $start_rust) * 1000; // Convert to milliseconds

// Displaying measurable data
echo "PHP Result: $result_php\n";
echo "Rust Result: $result_rust\n";

$time_php_rounded = round($time_php, 2);
$time_rust_rounded = round($time_rust, 2);
$speedup = round(($time_php / $time_rust) * 100, 2);

echo "\nComparison Summary:\n";
echo "PHP Execution Time: {$time_php_rounded} ms\n";
echo "Rust Execution Time: {$time_rust_rounded} ms\n";
echo "Rust is {$speedup}% faster than PHP for n={$n}.\n";
