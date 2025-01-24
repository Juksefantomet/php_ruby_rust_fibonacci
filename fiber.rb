require 'ffi'
require 'benchmark'

# Ruby Fibonacci
def fib_ruby(n)
  return n if n <= 1
  fib_ruby(n - 1) + fib_ruby(n - 2)
end

# Rust Fibonacci via FFI
module FibRust
  extend FFI::Library
  ffi_lib './rust_lib/fib_lib/target/release/libfib_lib.so' # Adjust path for your system
  attach_function :fib_rust, [:uint], :uint
end

n = 45
ruby_time = nil
rust_time = nil

Benchmark.bm(10) do |x|
  x.report("Ruby:") do
    ruby_time = Benchmark.realtime { fib_ruby(n) }
    puts "Result: #{fib_ruby(n)}"
  end

  x.report("Rust (FFI):") do
    rust_time = Benchmark.realtime { FibRust.fib_rust(n) }
    puts "Result: #{FibRust.fib_rust(n)}"
  end
end

# Displaying measurable data
ruby_ms = (ruby_time * 1000).round(2)
rust_ms = (rust_time * 1000).round(2)
speedup = ((ruby_time / rust_time) * 100).round(2)

puts "\nComparison Summary:"
puts "Ruby Execution Time: #{ruby_ms} ms"
puts "Rust Execution Time: #{rust_ms} ms"
puts "Rust is #{speedup}% faster than Ruby for n=#{n}."
