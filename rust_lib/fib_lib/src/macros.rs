// src/macros.rs
#[macro_export]
macro_rules! ffi {
    ($name:ident($($arg:ident : $type:ty),*) -> $ret:ty $body:block) => {
        #[no_mangle]
        pub extern "C" fn $name($($arg: $type),*) -> $ret $body
    };
}
