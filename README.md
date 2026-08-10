# Sumatra Career Centre

Official career website for Politeknik Caltex Riau — connecting students and alumni with job openings, internships, and career development information.

---

## 📖 About the Project

Sumatra Career Centre is a web-based platform built to support Politeknik Caltex Riau's career center in managing job postings, applications, career development classes, and the recruitment process for students and alumni. The project was developed by a team following the Scrum methodology, from requirement analysis through deployment.

---

## 🛠️ Tech Stack

**Application**
- Laravel (PHP) — backend & server-rendered views (Blade)
- Vite — asset bundling (CSS & JS)

**Database**
- MySQL

**Testing & QA**
- Postman — functional & API testing
- Apache JMeter — performance/load testing

**Tools**
- Git
- Jira / Trello — project management

---

## ✨ Key Features

- Job and internship listing management
- Application submission and status tracking
- Career Development module (classes, lessons, video content, enrollment & progress tracking)
- Article/blog management
- Admin panel for managing job postings, applicants, and career development content
- User authentication and account management

---

## 🚀 Installation & Setup

### Prerequisites
- PHP >= 8.1
- Composer
- Node.js & npm
- MySQL

### Setup

```bash
git clone https://github.com/username/sumatra-career-centre.git
cd sumatra-career-centre

# Install PHP dependencies
composer install

# Install frontend dependencies (CSS/JS assets, compiled via Vite)
npm install

# Environment setup
cp .env.example .env
php artisan key:generate

# Configure your database settings in the .env file
php artisan migrate --seed
```

### Running the App

This project needs **two processes running at the same time**, each in its own terminal:

```bash
# Terminal 1 — compile & watch frontend assets (CSS/JS) via Vite
npm run dev
```

```bash
# Terminal 2 — run the Laravel app
php artisan serve
```

Once both are running, open the app at `http://localhost:8000`.

---

## 📄 License

This project was developed for academic purposes at Politeknik Caltex Riau.
