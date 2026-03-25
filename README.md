# Campus Skill Exchange Platform

A full-stack web platform where college students can post projects, find collaborators, apply to teams, rate teammates, and build their skill portfolio — all within their campus community.

---

## Tech Stack

**Frontend**
- React.js (Create React App)
- Lucide React (icons)
- CSS Variables design system
- Fully responsive (mobile, tablet, desktop)

**Backend**
- PHP 8.2
- MySQL (via XAMPP)
- PHPMailer (email notifications)
- Google OAuth 2.0

**Environment**
- XAMPP (Apache + MySQL)
- Composer (PHP dependency manager)
- Node.js + npm

---

## Features

- **Authentication** — Register with email OTP verification, login, Google OAuth
- **Project Posting** — Post projects with domain, skill requirements, team size
- **Browse & Apply** — Search and filter projects, submit applications with cover messages
- **Application Management** — Accept or reject applicants, auto email notifications
- **Team Profiles** — View member profiles, skills, ratings, social links
- **Star Ratings** — Rate teammates after project completion
- **Notifications** — In-app bell + email notifications for all key events
- **Responsive UI** — Works on mobile, tablet, and desktop

---

## Project Structure

```
Campus-Skill-Exchange-Platform/
├── profile/
│   ├── backend/
│   │   ├── api/                  ← PHP API endpoints
│   │   │   ├── bootstrap.php
│   │   │   ├── config.php
│   │   │   ├── session.php
│   │   │   ├── dashboard.php
│   │   │   ├── profile.php
│   │   │   ├── edit_profile.php
│   │   │   ├── browse_projects.php
│   │   │   ├── post_project.php
│   │   │   ├── project_details.php
│   │   │   ├── apply.php
│   │   │   ├── applications.php
│   │   │   ├── manage_application.php
│   │   │   ├── my_projects.php
│   │   │   ├── update_project.php
│   │   │   ├── submit_rating.php
│   │   │   └── logout_api.php
│   │   ├── auth/                 ← Login, Register, OTP verification
│   │   │   ├── login_process.php
│   │   │   ├── register_process.php
│   │   │   ├── verify_otp.php
│   │   │   └── logout.php
│   │   ├── notifications/        ← Notification APIs + email helper
│   │   │   ├── get_notifications.php
│   │   │   ├── mark_read.php
│   │   │   └── send_email_notification.php
│   │   ├── oauth/                ← Google OAuth
│   │   │   ├── google_login.php
│   │   │   └── google_callback.php
│   │   ├── config/
│   │   │   └── db.php
│   │   ├── vendor/               ← PHPMailer (via Composer)
│   │   ├── .env                  ← Google OAuth credentials
│   │   └── composer.json
│   └── frontend/
│       ├── public/
│       │   └── index.html
│       ├── src/
│       │   ├── index.css         ← Global design system
│       │   ├── App.js            ← Routing + session
│       │   ├── index.js
│       │   ├── services/
│       │   │   └── api.js        ← All API calls (axios)
│       │   └── components/
│       │       ├── LoginPage.jsx
│       │       ├── RegisterPage.jsx
│       │       ├── DashboardPage.jsx
│       │       ├── ProfilePage.jsx
│       │       ├── EditProfilePage.jsx
│       │       ├── BrowseProjectsPage.jsx
│       │       ├── PostProjectPage.jsx
│       │       ├── ProjectDetailPage.jsx
│       │       ├── ApplicationsPage.jsx
│       │       ├── MyProjectsPage.jsx
│       │       ├── Sidebar.jsx
│       │       ├── Avatar.jsx
│       │       ├── StatusBadge.jsx
│       │       ├── SkillTag.jsx
│       │       ├── StarRating.jsx
│       │       ├── NotificationBell.jsx
│       │       ├── Toast.jsx
│       │       └── LoadingSkeleton.jsx
│       └── package.json
├── index.php                     ← Redirects to localhost:3000
└── .gitignore
```

---

## Database

**Database name:** `campus_skill_exchange`

**Tables:**
- `users` — id, name, email, password, bio, profile_image, experience_level, primary_domain_id, avg_rating, github_url, linkedin_url, portfolio_url, whatsapp_number, google_id
- `projects` — id, title, description, posted_by, domain_id, level, max_members, status
- `domains` — id, name
- `skills` — id, name
- `project_skills` — project_id, skill_id
- `project_applications` — id, project_id, applicant_id, status, message
- `project_members` — id, project_id, user_id, role
- `ratings` — id, project_id, giver_id, receiver_id, rating, feedback
- `notifications` — id, user_id, type, message, is_read, created_at
- `email_verifications` — id, email, otp, expires_at, verified
- `user_skills` — user_id, skill_id

---

## Local Setup

### Prerequisites
- XAMPP (Apache + MySQL)
- Node.js 18+
- Composer
- Git

### Step 1 — Download the project
Download or clone this repository and place the folder inside:
```
C:\xampp\htdocs\Campus-Skill-Exchange-Platform
```

### Step 2 — Database setup
1. Start XAMPP → Apache + MySQL
2. Open `http://localhost/phpmyadmin`
3. Create database: `campus_skill_exchange`
4. Import `profile/backend/sample_data.sql`

### Step 3 — Backend dependencies
```powershell
cd profile/backend
composer install
```

### Step 4 — Environment variables
Create `profile/backend/.env`:
```
CLIENT_ID=your_google_client_id
CLIENT_SECRET=your_google_client_secret
```

### Step 5 — Frontend dependencies
```powershell
cd profile/frontend
npm install
npm start
```

### Step 6 — Open the app
```
http://localhost:3000
```

---

## Environment Variables

Create `profile/backend/.env` with:

| Variable | Description |
|---|---|
| `CLIENT_ID` | Google OAuth Client ID |
| `CLIENT_SECRET` | Google OAuth Client Secret |

---

## Google OAuth Setup

1. Go to [console.cloud.google.com](https://console.cloud.google.com)
2. Create a project → Enable Google+ API
3. Create OAuth 2.0 credentials (Web application)
4. Add authorized redirect URI:
```
http://localhost/Campus-Skill-Exchange-Platform/profile/backend/oauth/google_callback.php
```
5. Copy Client ID and Secret into `.env`

---

## Email Notifications

Uses PHPMailer with Gmail SMTP. To configure, open `profile/backend/notifications/send_email_notification.php` and update:

```php
$mail->Username = 'your_gmail@gmail.com';
$mail->Password = 'your_app_password';
```

To generate a Gmail App Password:
1. Go to myaccount.google.com → Security
2. Enable 2-Step Verification
3. Search "App Passwords" → Generate one for "Mail"

---

## API Endpoints

All endpoints are at `http://localhost/Campus-Skill-Exchange-Platform/profile/backend/api/`

| Method | Endpoint | Description |
|---|---|---|
| GET | `session.php` | Check login status |
| GET | `dashboard.php` | Dashboard data |
| GET | `profile.php` | User profile |
| POST | `edit_profile.php` | Update profile |
| GET | `browse_projects.php` | List projects |
| POST | `post_project.php` | Create project |
| GET | `project_details.php` | Project detail |
| POST | `apply.php` | Apply to project |
| GET | `applications.php` | List applications |
| POST | `manage_application.php` | Accept/reject application |
| GET | `my_projects.php` | User's projects |
| POST | `update_project.php` | Update project status |
| POST | `submit_rating.php` | Rate a teammate |
| POST | `logout_api.php` | Logout |

---

## Deployment

For production deployment, update these values:

1. `profile/frontend/src/services/api.js` — change base URL to your domain
2. `profile/backend/notifications/send_email_notification.php` — update the link
3. `profile/backend/oauth/google_login.php` + `google_callback.php` — update redirect URI
4. Google Console — add your production redirect URI

---

## My Contribution

This was a group project. My individual contributions were:

### Google OAuth 2.0

- Implemented the complete Google login flow from scratch using raw **cURL** — no external OAuth library
- Built `google_login.php` to construct the Google authorization URL and redirect the user
- Built `google_callback.php` to handle the OAuth callback: exchange the authorization code for an access token, fetch the user's Google profile, and create or resume their session
- Registered the app in Google Cloud Console and configured the redirect URI

### Login System

- Built `login_process.php` — handles credential validation, password verification, and PHP session initialization on successful login

### Email OTP Registration

- Built the two-step registration flow using **PHPMailer + Gmail SMTP**
- `register_process.php` — collects user data, generates a time-limited OTP, and dispatches the verification email
- `verify_otp.php` — validates the submitted OTP against the `email_verifications` table and activates the account on success

### Notifications API

- Built `get_notifications.php` — the backend endpoint that fetches a user's in-app notifications from the `notifications` table, used by the frontend `NotificationBell` component to display unread and historical alerts

---

*Campus Skill Exchange — Where Campus Skills Meet Opportunity*  
*Built as a college project at KIIT University*
