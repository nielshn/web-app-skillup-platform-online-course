# SkillUp Web App Development

Welcome to the SkillUp Web App Development repository! This project represents the development of an online tutoring platform designed to enhance the learning experience for students through a variety of interactive and administrative features. Built with Laravel 11, this web application focuses on providing a comprehensive and user-friendly interface for students, teachers, and administrators.

## Project Overview

The SkillUp Web App is a robust online tutoring platform that enables students to register, enroll in courses, interact with teachers, and manage their learning journey. Administrators have the capability to manage courses, teachers, reviews, and other critical elements of the platform, ensuring a seamless and up-to-date learning environment.

## Key Features

1. **Registration Functionality**
   - Students can register for an account using their email and log into the application.

2. **Login and Logout Functionality**
   - Admins and students can log into and out of the application securely.

3. **Teacher Management**
   - Admins can add, edit, and remove teachers who will provide guidance to students, enhancing their learning experience.

4. **Course Management**
   - Admins can add, edit, and delete courses on the platform, ensuring relevant and updated content for users.

5. **Review Management**
   - Admins can manage user reviews of courses, including viewing, adding, editing, and deleting reviews as per platform policies.

6. **Course Image Management**
   - Teachers can add, edit, view, and delete images associated with courses.

7. **Course Purchase**
   - Students can purchase desired courses by selecting their preferred payment methods.

8. **Video Management**
   - Teachers can add, edit, and delete instructional videos to support the learning process.

9. **Notification Viewing**
   - Students can view notifications to ensure their subscriptions and other activities are updated.

10. **Profile Management**
    - Users can manage their accounts, including personal information and settings.

11. **Payment Status Viewing**
    - Students can check whether their accounts are active based on their payment status.

12. **Payment Approval**
    - Admins can approve course purchases made by students.

13. **FAQ Management**
    - Admins can manage frequently asked questions and answers relevant to students' needs.

14. **Category Management**
    - Admins can create and manage categories for the courses offered on the platform.

## Implementation Details

### Framework
- **Laravel 11**: The entire application is built using Laravel 11, a robust PHP framework known for its elegant syntax and comprehensive feature set.

### Storage Link
- **Activating Storage Link**: Ensure the storage link is activated to manage file uploads and storage efficiently.

### Performance Optimization
- **Caching**: Implemented caching strategies to enhance the performance of the application.
- **Database Optimization**: Utilized efficient database queries to improve data retrieval and management.

## Getting Started

### Prerequisites
- Ensure you have PHP 8.1 or higher installed.
- Install Composer for dependency management.

### Installation Steps

1. **Clone the repository**:
   ```sh
   git clone https://github.com/nielshn/web-app-skillup-platform-online-course.git
   ```
2. **Navigate to the project directory**:
   ```sh
   cd web-app-skillup-platform-online-course
   ```
3. **Install Depedencies**:
   ```sh
   composer install
   ```
4. **Copy the .env file**:
   ```sh
   cp .env.example .env
   ```
5. **Generate the application key**:
   ```sh
   php artisan key:generate
   ```
6. **Set up the database**:
   - Update the .env file with your database credentials.
   - Run the migrations and seed database:
     ```sh
     php artisan migrate --seed
     ```
7. **Activate the storage link**:
   ```sh
   php artisan storage:link
   ```

### Running the Application
- Start the development server:
  ```sh
  php artisan serve
  ```
- Visit http://localhost:8000 in your web browser to access the application.
---

## Conclusion
The SkillUp Web App is a comprehensive platform designed to enhance the online learning experience for students, teachers, and administrators. 
By focusing on robust functionality and user experience, this project demonstrates the effective use of Laravel 11 for developing modern web applications.

----
Feel free to explore the repository and provide any feedback or suggestions. Thank you for your interest in the SkillUp Web App!

Happy coding!
