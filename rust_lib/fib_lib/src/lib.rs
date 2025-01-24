#[macro_use]
mod macros;


ffi!(fib_rust(n: u32) -> u32 {
    if n <= 1 {
        n
    } else {
        fib_rust(n - 1) + fib_rust(n - 2)
    }
}
);