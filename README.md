# EduPlayAI

AI-powered educational YouTube playlist discovery platform built with Laravel.

## Requirements
- PHP 8.2+
- MySQL
- Composer
- OpenAI API key
- YouTube Data API v3 key

## Setup

\`\`\`bash
git clone https://github.com/YOUR_USERNAME/eduplay-ai.git
cd eduplay-ai
composer install
cp .env.example .env
\`\`\`

Edit `.env` and set:
\`\`\`
OPENAI_API_KEY=your_key_here
YOUTUBE_API_KEY=your_key_here
DB_DATABASE=eduplay_ai
DB_USERNAME=root
DB_PASSWORD=
DB_PORT=3307
\`\`\`

\`\`\`bash
php artisan key:generate
php artisan migrate
php artisan serve
\`\`\`

In a separate terminal:
\`\`\`bash
php artisan queue:work 
\`\`\`

## Usage
1. Open http://localhost:8000
2. Enter categories (one per line)
3. Click "Start Fetching"
4. Watch real-time progress
5. Browse courses at /courses
