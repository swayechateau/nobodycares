---
title: "Go Packages: Fcrypt"
featured: false
excerpt: "Fcrypt is a flexible and secure encryption package for Go, designed for easy data encryption and decryption using AES-GCM. It supports stream encryption, chunk-based encryption for large files, key rotation, re-encryption, and SHA3-256 hashing. Ideal for applications requiring robust data protection."
hero_image: "https://file.swayechateau.com/view/global43rC3eryP33PPwISjsXn37"
category: "Go Packages"
author: "NobodyCares"
---

## Go Package: Fcrypt

Fcrypt was built to be a lightweight yet powerful encryption library for Go, built to simplify secure data handling in any Go application. By leveraging AES-GCM for encryption and advanced hashing algorithms like SHA3-256, Fcrypt ensures data integrity and confidentiality without sacrificing ease of use.

#### Why Use Fcrypt?

For any project that demands data protection, Fcrypt is designed with scalability in mind. With features like stream and chunk-based encryption, it handles everything from small secrets to large files with ease. Key rotation and re-encryption support make it particularly valuable in environments where security policies require frequent key updates.

---

### Key Features

1. **AES-GCM Encryption and Decryption**  
   AES-GCM (Galois/Counter Mode) provides both encryption and integrity protection, making it highly secure. Fcrypt wraps this algorithm with an intuitive API for quick implementation in Go applications.

2. **Stream and Chunk-Based Encryption**  
   Encryption operations on large files or data streams are handled efficiently by Fcrypt's chunk-based encryption. This reduces memory load and speeds up the processing of extensive data, making it ideal for applications working with large datasets.

3. **Key Management**  
   Key rotation is a crucial security practice in data management, and Fcrypt simplifies it. By supporting re-encryption with a new key, Fcrypt ensures your data remains secure even as security keys evolve.

4. **Hashing Functions**  
   With SHA3-256 and BLAKE2b support, Fcrypt offers hashing for verifying data integrity or securely storing passwords.

---

### Installation

```bash
go get github.com/swayedev/fcrypt
```

---

### Quick Start Example

```go
package main

import (
    "fmt"
    "log"

    "github.com/swayedev/fcrypt"
)

func main() {
    passphrase := "your-secure-passphrase"
    data := []byte("Sensitive data here")

    salt, err := fcrypt.GenerateSalt(16)
    if err != nil {
        log.Fatalf("Failed to generate salt: %v", err)
    }

    key, err := fcrypt.GenerateKey(passphrase, salt, fcrypt.DefaultKeyLength)
    if err != nil {
        log.Fatalf("Failed to generate key: %v", err)
    }

    encryptedData, err := fcrypt.Encrypt(data, key)
    if err != nil {
        log.Fatalf("Failed to encrypt data: %v", err)
    }

    decryptedData, err := fcrypt.Decrypt(encryptedData, key)
    if err != nil {
        log.Fatalf("Failed to decrypt data: %v", err)
    }

    fmt.Printf("Original data: %s\n", data)
    fmt.Printf("Decrypted data: %s\n", decryptedData)
}
```

---

#### Resources

- **GitHub Repository**: [github.com/swayedev/fcrypt](https://github.com/swayedev/fcrypt)
- **Project Roadmap**: [Roadmap](https://github.com/swayedev/fcrypt/blob/main/ROADMAP.md)
- **Go Package Documentation**: [pkg.go.dev/github.com/swayedev/fcrypt](https://pkg.go.dev/github.com/swayedev/fcrypt)
- **Open Source Insights**: [deps.dev for Fcrypt](https://deps.dev/go/github.com%2Fswayedev%2Ffcrypt/v0.2.2)
