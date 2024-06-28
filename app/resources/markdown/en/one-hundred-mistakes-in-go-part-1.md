# One Hundred Mistakes in Go (1-10)

### 10 Common Mistakes in Go and How to Avoid Them

Go, often referred to as Golang, is a statically typed, compiled programming language designed for simplicity and efficiency. However, like any programming language, Go has its quirks and potential pitfalls. Here are ten common mistakes developers make when writing Go code and tips on how to avoid them.

#### 1. Ignoring Errors

In Go, error handling is explicit. Functions often return an error as their last return value. Ignoring these errors can lead to unexpected behavior and bugs.

**Example:**
```go
file, _ := os.Open("file.txt")
```
**Solution:**
Always check and handle errors appropriately.
```go
file, err := os.Open("file.txt")
if err != nil {
    log.Fatal(err)
}
```

#### 2. Misusing Goroutines

Goroutines are a powerful feature in Go, enabling concurrent execution. However, improper use can lead to race conditions or deadlocks.

**Example:**
```go
for _, item := range items {
    go process(item)
}
```
**Solution:**
Use synchronization mechanisms like `sync.WaitGroup` to ensure proper goroutine handling.
```go
var wg sync.WaitGroup
for _, item := range items {
    wg.Add(1)
    go func(it Item) {
        defer wg.Done()
        process(it)
    }(item)
}
wg.Wait()
```

#### 3. Incorrectly Using `defer`

The `defer` statement schedules a function call to be run after the function completes. Misusing it, especially in loops, can cause unexpected behavior.

**Example:**
```go
for _, f := range files {
    defer f.Close()
}
```
**Solution:**
Use `defer` correctly, typically at the beginning of a function or after opening a resource.
```go
for _, f := range files {
    f := f
    defer f.Close()
}
```

#### 4. Copying Slices Incorrectly

Slices in Go are references to an underlying array. Copying a slice does not create a deep copy, leading to potential modifications of the original data.

**Example:**
```go
newSlice := oldSlice
```
**Solution:**
Create a new slice and copy the elements.
```go
newSlice := make([]T, len(oldSlice))
copy(newSlice, oldSlice)
```

#### 5. Dereferencing Nil Pointers

Accessing a nil pointer will cause a runtime panic, which is often due to uninitialized or improperly assigned variables.

**Example:**
```go
var ptr *int
fmt.Println(*ptr)
```
**Solution:**
Always check if a pointer is nil before dereferencing.
```go
if ptr != nil {
    fmt.Println(*ptr)
}
```

#### 6. Improper Use of Channels

Channels are used for communication between goroutines. Misusing them can cause deadlocks or unintended blocking.

**Example:**
```go
ch := make(chan int)
ch <- 1
value := <-ch
```
**Solution:**
Understand and use channels correctly, possibly using buffered channels when appropriate.
```go
ch := make(chan int, 1)
ch <- 1
value := <-ch
```

#### 7. Incorrect Use of `time.After`

`time.After` returns a channel that receives the current time after a duration, but using it in select statements without proper handling can cause memory leaks.

**Example:**
```go
select {
case <-time.After(time.Second):
    fmt.Println("timeout")
}
```
**Solution:**
Use a single instance of `time.After` when the timeout duration is static.
```go
timeout := time.After(time.Second)
select {
case <-timeout:
    fmt.Println("timeout")
}
```

#### 8. Overusing Global Variables

Global variables can make the codebase difficult to maintain and introduce hidden dependencies, leading to hard-to-find bugs.

**Example:**
```go
var config Config
```
**Solution:**
Encapsulate variables within appropriate scopes, passing them as parameters when needed.
```go
func process(config Config) {
    // use config
}
```

#### 9. Not Using `context` Package Properly

The `context` package is essential for managing timeouts and cancellations in concurrent operations. Misusing it can lead to resource leaks and unresponsive programs.

**Example:**
```go
go doWork()
```
**Solution:**
Use `context` to control and manage the lifecycle of goroutines.
```go
ctx, cancel := context.WithTimeout(context.Background(), time.Second*10)
defer cancel()
go doWork(ctx)
```

#### 10. Ignoring Go Idioms

Writing Go code in the style of another programming language leads to non-idiomatic and often inefficient code. Embrace Go idioms to write clean, effective Go code.

**Example:**
```go
if is_valid {
    do_something()
}
```
**Solution:**
Follow Go idioms, such as using short variable declarations and idiomatic error handling.
```go
if isValid {
    doSomething()
}
```

By being aware of these common mistakes and following best practices, you can write more robust, efficient, and idiomatic Go code. Happy coding!