# Fibonacci Benchmark: Ruby, PHP, and Rust

This repository benchmarks the performance difference between **Ruby**, **PHP**, and **Rust** for calculating the Fibonacci sequence recursively. The goal is to demonstrate how a computationally expensive task can be significantly accelerated by leveraging Rust's performance, accessed via FFI (Foreign Function Interface).

## Directory Structure
```
.
├── fiber.rb        # Ruby benchmark script
├── fiber.php       # PHP benchmark script
├── rust_lib        # Rust library for Fibonacci
│   └── fib_lib
│       ├── Cargo.toml
│       ├── src
│       │   └── lib.rs
│       └── target
│           └── release
│               └── libfib_lib.so  # Compiled Rust library
```

## What This Does
1. **Ruby (fiber.rb)**
   - Implements a recursive Fibonacci sequence.
   - Benchmarks its execution time.
   - Calls the same Fibonacci function implemented in Rust using FFI.
   - Outputs execution times and performance comparison.

2. **PHP (fiber.php)**
   - Implements the same recursive Fibonacci sequence in PHP.
   - Benchmarks its execution time.
   - Calls the Rust Fibonacci function via FFI.
   - Outputs execution times and performance comparison.

3. **Rust (fib_lib)**
   - Contains the Rust implementation of the Fibonacci function.
   - Compiled as a shared library (`libfib_lib.so`) for use in both Ruby and PHP via FFI.

## Benchmarking Methodology
The scripts calculate the Fibonacci sequence for `n = 35` (or higher for heavier loads). Each script:

1. Measures the execution time of the Fibonacci function in the respective language.
2. Calls the Rust implementation of the same function via FFI and measures its execution time.
3. Outputs results, including execution times in milliseconds and a comparison showing how much faster Rust is.

## How to Use

### 1. Setup Rust Library
1. Navigate to the `rust_lib/fib_lib` directory:
   ```bash
   cd rust_lib/fib_lib
   ```
2. Build the Rust library:
   ```bash
   cargo build --release
   ```
3. Ensure the compiled library (`libfib_lib.so`) is located in `target/release/`.

### 2. Run the Ruby Benchmark
1. Go to the root of the project.
2. Run the Ruby script:
   ```bash
   ruby fiber.rb
   ```
3. Actual Ruby output:
   ```
Result: 1134903170
Result: 1134903170
                 user     system      total        real
Ruby:      164.275651   0.001685 164.277336 (164.310020)
Rust (FFI):  5.334036   0.000000   5.334036 (  5.337674)

Comparison Summary:
Ruby Execution Time: 85419.49 ms
Rust Execution Time: 2677.5 ms
Rust is 3190.28% faster than Ruby for n=45.
   ```

### 3. Run the PHP Benchmark
1. Go to the root of the project.
2. Run the PHP script:
   ```bash
   php fiber.php
   ```
3. Actual PHP output:
   ```
PHP Result: 1134903170
Rust Result: 1134903170

Comparison Summary:
PHP Execution Time: 34809.74 ms
Rust Execution Time: 2450.15 ms
Rust is 1420.72% faster than PHP for n=45.
   ```

## Key Takeaways
- The **Rust implementation** dramatically outperforms both Ruby and PHP for computationally heavy tasks.
- Using **FFI**, you can integrate high-performance Rust code into dynamic languages like Ruby and PHP with minimal overhead.

## Requirements
### Ruby
- Ruby 2.7+
- `ffi` gem (install with `gem install ffi`)

### PHP
- PHP 7.4+
- FFI extension (ensure it is enabled in your PHP installation)

### Rust
- Rust 1.65+ (install via [rustup](https://rustup.rs))

## Notes
- The Fibonacci sequence is computationally expensive with naive recursion and is used here purely as a benchmarking tool. For real-world applications, consider optimized algorithms.
- Adjust `n` in the scripts to control workload intensity.

