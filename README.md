# Proactive Dropout Mitigation for School Student Success

> A full-stack **Student Management System** that enables efficient student record handling and proactive dropout identification with high accuracy.

## 📌 Overview

This project implements a **Student Management System** designed to help schools track student data and identify students at risk of dropping out. By integrating data capture, analytics, and predictive logic, the system enables early intervention and supports student success efforts.

Key features include:

* Structured student records (100+ entries)
* Dropout risk identification with **94% accuracy**
* Web-based full-stack application
* Intuitive UI for administrators and teachers

Published research details and evaluation metrics are available in *IEEE Xplore*. ([ResearchGate][2])

---

## 🧠 Motivation

Student dropout is a critical issue worldwide — negatively impacting students, families, and communities. Early identification of at-risk students helps educators provide timely support and reduces dropout rates. This system:

✔ Centralizes student data
✔ Applies predictive methods to signal risk
✔ Encourages proactive academic interventions

---

## 🚀 Features

The system includes the following modules:

### ✅ Student Management

* Add, update, delete student records
* Upload student profile photos
* Attendance recording

### 🚸 Dropout Risk Evaluation

* Predictive model evaluates risk
* Highlights high-risk students
* Dashboards for headmasters and teachers

### 🔐 User Roles

* **Principal**
* **Teachers**
* **Admin**
* **School staff**

---

## 🛠️ Technologies Used

| Layer            | Technology                             |
| ---------------- | -------------------------------------- |
| Backend          | PHP                                    |
| Frontend         | HTML, CSS, JavaScript                  |
| Database         | MySQL                                  |
| Authentication   | Role-based login system                |
| Predictive Logic | Integrated model for dropout detection |

---

## 📊 Dropout Identification

This system integrates an analytics component that processes student data (e.g., attendance, academic performance) to calculate a **dropout risk score**.

✨ **Model performance:**
✔ Accuracy: **94%**
✔ Validated using real student records and evaluation sets

These results are part of our research publication in *IEEE Explorer*. (https://ieeexplore.ieee.org/document/10915221)

---

## 📄 Research Publication

📘 **Soft Alert Generation for Student Dropout Mitigation and Proactive Management by Machine Learning Algorithms**
Authors: S. Geetha, Spandana A. P., Vijay D., Vishruth M. V.
Conference: *2025 International Conference on Intelligent and Innovative Technologies in Computing, Electrical and Electronics (IITCEE)*
Indexed on IEEE Xplore.

You can access the full paper on **IEEE Explorer** for details on model design and evaluation.

---

## 🧪 Demo & Screenshots

*(Place sample screenshots here)*

---

## 📥 Setup

1. **Clone this repository**

   ```bash
   git clone https://github.com/spandana2004/Proactive-Dropout-Mitigation-of-School-Students.git
   ```

2. **Setup Database**

   * Create a MySQL database (e.g., `school_db`)
   * Import provided SQL dumps

3. **Configure Connection**

   * Update database credentials in `connection.php`

4. **Run the App**

   * Deploy on a local server (e.g., XAMPP, WAMP)
   * Open browser → `http://localhost/<repo>`

---

## 👥 Roles & Access

| Role      | Access                    |
| --------- | ------------------------- |
| Admin     | Full                      |
| Principal | View / Manage             |
| Teacher   | View student reports      |
| Staff     | Attendance & record edits |

--
