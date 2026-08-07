# Sumatra Career Centre

Official career website for Politeknik Caltex Riau — connecting students and alumni with job openings, internships, and career development information.

---

## 📖 About the Project

Sumatra Career Centre is a web-based platform built to support Politeknik Caltex Riau's career center in managing job postings, applications, and the recruitment process for students and alumni. The project was developed by a team following the Scrum methodology, from requirement analysis through deployment.

---

## 🛠️ Tech Stack

**Frontend**
- React
- Vite

**Backend**
- Laravel (PHP)

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
- Admin panel for managing job postings and applicants
- User authentication and account management

---

## 🚀 Installation & Setup

### Prerequisites
- PHP >= 8.1
- Composer
- Node.js & npm
- MySQL

### Backend (Laravel)

```bash
git clone https://github.com/username/sumatra-career-centre.git
cd sumatra-career-centre

composer install
cp .env.example .env
php artisan key:generate

# Configure your database settings in the .env file
php artisan migrate --seed

php artisan serve
```

### Frontend (React + Vite)

```bash
cd frontend
npm install
npm run dev
```

---

## 🧪 Testing

Functional and API testing was performed using **Postman** (endpoint collections available in `/tests/postman`), while performance/load testing was performed using **Apache JMeter**.

```bash
# Run backend test suite
php artisan test
```

---

## 👥 Development Team

Developed by a student team from Politeknik Caltex Riau using the Scrum methodology, covering both development and quality assurance roles.

---

## 📄 License

This project was developed for academic purposes at Politeknik Caltex Riau.
