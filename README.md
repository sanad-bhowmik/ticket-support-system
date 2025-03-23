# Customer Support Ticketing System

## Project Overview
This is a Customer Support Ticketing System built with Laravel for the backend and Vue.js for the frontend. It allows customers to submit support tickets and communicate with admin users via real-time chat.

## Admin Credentials
- **Username:** admin
- **Password:** 12345678

## Features

### User Authentication
- Laravel Sanctum for API token-based authentication.
- Role-based authentication (Admin & Customer).
- Secure login and registration.

### Ticket Management
- Customers can create tickets with:
  - Subject
  - Description
  - Category (Technical, Billing, General)
  - Priority (Low, Medium, High)
  - Attachments (optional)
- CRUD operations for tickets.
- Customers can view only their tickets.
- Admins can manage all tickets.

### Ticket Status Management
- Ticket statuses: Open, In Progress, Resolved, Closed.
- Admins can update ticket statuses.
- API endpoint to update ticket status.

### Commenting System
- Customers and Admins can comment on tickets.

### Customer-Admin Chat
- Real-time chat feature for ticket discussions.
- Implemented using Laravel WebSockets / Pusher.

### Frontend
- Built using Vue.js (or an alternative framework).
- Responsive UI with form validation.

### Security Measures
- CSRF protection enabled.
- SQL injection prevention mechanisms.
- Secure file uploads and data validation.

### Database
- MySQL database with migrations and seeders.

### Version Control
- Git repository with meaningful commit history.

## Installation
1. Clone the repository:
   ```sh
   git clone https://github.com/your-repo/ticket-support-system.git
   ```
2. Navigate to the project directory:
   ```sh
   cd ticket-support-system
   ```
3. Install dependencies:
   ```sh
   composer install
   ```
4. Set up environment variables:
   ```sh
   cp .env.example .env
   ```
5. Generate application key:
   ```sh
   php artisan key:generate
   ```
6. Run database migrations:
   ```sh
   php artisan migrate --seed
   ```
7. Start the Laravel server:
   ```sh
   php artisan serve
   ```

## API Documentation
- API endpoints are documented in `README.md`.
- Postman collection available for API testing.

## Contributing
Pull requests are welcome. Please follow coding standards and best practices.

## License
This project is open-source under the MIT license.
