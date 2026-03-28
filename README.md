# 🎓 EduPlayAI  
**AI-Powered Educational YouTube Playlist Discovery**

[![PHP Version](https://img.shields.io/badge/PHP-8.2%2B-blue.svg)](https://php.net)
[![Laravel Version](https://img.shields.io/badge/Laravel-11.x-red.svg)](https://laravel.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

EduPlayAI is a Laravel-based platform that leverages **Gemini** and **YouTube Data API v3** to generate curated educational playlists from simple text prompts. Users can input topics (e.g., "linear algebra", "machine learning") and get a list of high-quality YouTube playlists instantly. The application features real‑time progress tracking, a modern dark/light theme, and a responsive mobile sidebar.

---

## ✨ Features

- **AI‑Powered Playlist Generation** – Uses Gemini to parse user input and fetch relevant YouTube playlists.
- **Real‑Time Progress** – Live progress bar and status updates during playlist generation.
- **Dark / Light Mode** – Persistent theme toggle with smooth transitions.
- **Mobile‑Friendly Sidebar** – Slide‑out navigation with animated arrows and footer.
- **Custom Cursor** – Interactive animated cursor for desktop users.
- **Pagination & Filters** – Browse courses with category filters and paginated results.
- **Background Jobs** – Queue system for long‑running playlist fetching tasks.
- **Responsive Design** – Fully adapted to all screen sizes.

---

## 🛠️ Technologies

| Tech                | Purpose                                         |
|---------------------|-------------------------------------------------|
| Laravel 11          | Backend framework                               |
| PHP 8.2+            | Server-side language                            |
| MySQL               | Database                                        |
| Gemini API          | Natural language processing for topics          |
| YouTube Data API v3 | Fetch playlists and video metadata              |
| Bootstrap 5         | Frontend layout & components                    |
| Font Awesome 6      | Icons                                           |
| Custom CSS          | Unique design (cursor, sidebar, scroll progress)|

---

## 📋 Prerequisites

Before you begin, ensure you have the following installed:

- **PHP** 8.2 or higher (with extensions: `curl`, `mbstring`, `zip`, `pdo_mysql`, `fileinfo`)
- **Composer** – PHP dependency manager
- **MySQL** – Database server (or MariaDB)
- **Node.js & NPM** (optional, if you use frontend assets)
- **Gemini API Key** – [Get it here](https://aistudio.google.com/app/api-keys)
- **YouTube Data API v3 Key** – [Get it here](https://console.cloud.google.com/apis/library/youtube.googleapis.com)

---

## 🚀 Installation

Follow these steps to get EduPlayAI running on your local machine.

### 1. Clone the Repository
```bash
git clone https://github.com/nancy-abduallh/eduplay-ai.git
cd eduplay-ai
