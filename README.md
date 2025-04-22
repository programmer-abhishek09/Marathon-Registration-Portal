# 🏁 Marathon Registration Portal

A complete web-based application that allows users to register for a marathon, manage their account information, and receive a unique bib ID upon successful completion. Built using PHP and MySQL, this project ensures a secure and user-friendly experience for participants.

---

## 📌 Overview

This project is designed to streamline marathon registration and certificate validation. It features secure authentication, editable user profiles, and auto-generated unique bib IDs. Whether you're organizing a community run or a large-scale event, this project can be customized for your needs.

---

## ✨ Features

- 📝 **User Registration** with validations for name, email, phone number, and password  
- 🔐 **User Login** and session-based authentication  
- 🛠️ **Update Info**: Modify email, phone number, or password after login  
- 📄 **Certificate Upload**: Upload 5km completion certificate  
- 🎟️ **Bib ID Generation**: Receive a unique bib ID after successful registration  
- 🧼 Input validations for secure and clean data entry  
- 🚫 Access restrictions for non-logged-in users  

---

## ⚙️ Tech Stack

- **Frontend:** HTML, CSS, JavaScript  
- **Backend:** PHP  
- **Database:** MySQL  
- **Web Server:** Apache (XAMPP or LAMP)

---

## 🗃️ Database Schema

### 📍 Table: `users`

| Field         | Type           | Description                          |
|---------------|----------------|--------------------------------------|
| id            | INT (PK, AI)   | Unique user ID                       |
| name          | VARCHAR(100)   | Full name                            |
| email         | VARCHAR(100)   | Email (must be unique)               |
| phone         | VARCHAR(15)    | Phone number                         |
| password      | VARCHAR(255)   | Hashed password                      |
| created_at    | DATETIME       | Timestamp of registration            |

---

### 📍 Table: `bibs`

| Field            | Type           | Description                           |
|------------------|----------------|---------------------------------------|
| id               | INT (PK)       | Unique ID                             |
| email            | VARCHAR(255)   | Email associated with the bib         |
| certificate_path | VARCHAR(255)   | File path of uploaded certificate     |
| bib_code         | VARCHAR(50)    | Unique bib ID generated               |
| uploaded_at      | TIMESTAMP      | Timestamp of certificate upload       |

> SQL file included in `marathon.sql` for easy setup.

---
## 📂 Folder Structure
marathon/
├── index.html
├──index.php
├── validateRegisterForm.js
├── login.html
├── login.php
├── afterLoginStyle.css
├── update.html
├── update.php
├──validateRegisterForm.js
├──bibs.php
├── upload.php
├──exit.php
└── marathon.sql

## 🚀 How to Run This Project

1. **Clone the Repository**
   ```bash
   git clone https://github.com/yourusername/marathon-registration.git
   cd marathon-registratio
   Step 2: Setup the MySQL Database
2. Setup the Mysql Database
   - Create a new database (e.g., marathon)
   - import the marathon.sql file provided by the project to create the required tables
   
4. Start Apache and MySQL
   - Use XAMPP (on Windows) or LAMP (on Linux).
   - Place the project folder inside htdocs (XAMPP) or /var/www/html (LAMP).
   
4. Access the Project
 - Open your browser and go to:
  http://localhost/file_name/index.html

## 🤝 Contribution
- Contributions are welcome! If you find any bugs or have ideas for improvement, feel free to fork the repo and create a pull request.



📸 Screenshots
![registration](https://github.com/user-attachments/assets/70d35656-1b3f-4cb7-af23-9cf7a83576af)
![login](https://github.com/user-attachments/assets/493deee9-caf4-4f4a-9dc8-f5f9f8fc9de4)
![update](https://github.com/user-attachments/assets/c496239f-17e9-4638-92a1-fa4e67c57145)
![bibs](https://github.com/user-attachments/assets/57ebe0ee-ff78-4b09-b703-c8487285452e)
![logout](https://github.com/user-attachments/assets/690962c6-d4ec-45ff-80a9-8ad5fcca0cf9)




---

