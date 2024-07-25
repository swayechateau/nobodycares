---
title: "The Solemnity Suite"
featured: true
excerpt: "Solemnity is a collection of microservices to streamline common app functionalities. Services include Single Sign-On, Website Meta Data Grabber, File Storage, and Scripts. Built with Go and Docker, except for Scripts, which uses various languages, more services are planned, and some are still in development."
hero_image: "https://images.unsplash.com/photo-1640175951336-41d45843b3db?q=80&w=3870&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
category: "Microservices"
author: "NobodyCares"
---

## Solemnity Services Documentation

Solemnity is a suite of microservices designed to streamline common functionalities in my applications. After identifying a recurring need for certain components, I created dedicated microservices for each key element.

These services aim to enhance efficiency and maintainability across my applications by modularizing common functionalities. The goal is to create a robust ecosystem of microservices that can be easily integrated and reused in different projects.

### Single Sign-On (SSO)

Simplify authentication with a centralized SSO service.

- **Service URL:** [sso.solemnity.icu](https://sso.solemnity.icu)
- **GitHub Repository:** [solemnity-sso](https://github.com/swayechateau/solemnity-sso)

### Website Meta Data Grabber
Extract and utilize metadata from web links.

- **Service URL:** [meta.solemnity.icu](https://meta.solemnity.icu)
- **GitHub Repository:** [solemnity-meta](https://github.com/swayechateau/solemnity-meta)

### File Storage

Store files locally or on cloud providers like G Cloud, AWS S3, or Azure Blob Storage.

- **Service URL:** [file.solemnity.icu](https://file.solemnity.icu)
- **GitHub Repository:** [solemnity-fileserver](https://github.com/swayechateau/solemnity-fileserver)

### Scripts

Access various scripts needed by multiple projects and servers.

- **Service URL:** [scripts.solemnity.icu](https://scripts.solemnity.icu)
- **GitHub Repository:** [solemnity-scripts](https://github.com/swayechateau/solemnity-scripts)

### Future Services

More services will be added in the future to expand Solemnity’s capabilities. Currently, some services like File Storage and SSO are still in development. All these applications are built with Go and Docker, except for Scripts, which is a mix of various languages and Bash files.
