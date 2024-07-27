# NobodyCares Blog

The NobodyCares Blog is a minimalist blogging platform designed to prioritize content and accessibility. Built with Laravel, TailwindCSS, and Markdown, this blog ensures a robust, server-rendered experience that functions entirely without JavaScript.

## Features

- **Markdown for Content Management**: Utilize Markdown for creating and managing blog posts, making content creation straightforward and focused.
- **TailwindCSS for Styling**: Leverage TailwindCSS for a responsive, utility-first design that ensures the blog looks great on all devices without complex CSS.
- **Server-Side Rendering**: Built using Laravel to provide a fully functional website without the need for client-side JavaScript, enhancing accessibility and SEO.
- **Simple and Accessible Design**: Focus on usability and accessibility, ensuring that content is king.

## Upcoming Enhancements

- **Update Post Search on the Sidebar**: Improve the search functionality in the sidebar to make it more intuitive and efficient for users.
- **Update Logo**: Design and deploy a new logo to better reflect the brand and values of NobodyCares Blog.
- **Update Navigation for Mobile Support**: Enhance the navigation bar to be more responsive and mobile-friendly, ensuring a better user experience on all devices.
- **Add Pagination**: Implement pagination for blog posts to improve navigation and manage content visibility more effectively.
- **Add Markdown Support for Go Language**: Extend the Markdown parser to include syntax highlighting and support for the Go programming language, enhancing the writing and reading experience for technical content.


## Prerequisites

Before starting, ensure you have the following installed:

- PHP 7.4 or higher
- Composer: For managing PHP dependencies
- Node.js: For managing TailwindCSS and compiling CSS

## Getting Started

These instructions will get a copy of the project up and running on your local machine for development and testing purposes.

### Installation

Follow these steps to set up the project:

1. Clone the repository:
   ```bash
   git clone https://github.com/yourusername/nobodycares-blog.git
   ```
2. Navigate to the project directory:
   ```bash
   cd nobodycares-blog
   ```
3. Install PHP dependencies:
   ```bash
   composer install
   ```
4. Install and build TailwindCSS:
   ```bash
   npm install
   npm run production
   ```
5. Set up your environment file:
   ```bash
   cp .env.example .env
   ```
6. Generate an app key:
   ```bash
   php artisan key:generate
   ```
7. Run migrations (if applicable):
   ```bash
   php artisan migrate
   ```

### Running Locally

To run the project locally:

```bash
php artisan serve
```

## Deployment

Instructions on how to deploy this on a live system would depend on the server and infrastructure specifics. Ensure that PHP and appropriate server configurations are handled.

## Built With

- [Laravel](https://laravel.com/) - The backend framework used
- [TailwindCSS](https://tailwindcss.com/) - For utility-first styling
- Markdown - For content management


