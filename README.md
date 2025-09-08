# Office Management System

A simple **Office Management System** built with **Laravel**, **MySQL**, and **jQuery DataTables**.  
This system allows management of **Companies** and **Employees**, with CRUD operations and filters for better organization.

---

## Live Server   https://office-management-n7jbg.sevalla.app/employees

## 🚀 Features

- **Company Management**
  - Add, edit, delete companies
- **Employee Management**
  - Add, edit, delete employees
  - Assign employees to companies
  - Assign managers (employee → employee relationship)
  - Store location (Country, State, City)
- **Dynamic Filters**
  - Filter employees by company and position
- **DataTables Integration**
  - AJAX-powered employee listing
  - Search, filter, pagination
- **Responsive UI**
  - TailwindCSS-based design
- **Deployment Ready**
  - Tested on [Sevalla](https://sevalla.com/) hosting

---

## 🛠️ Tech Stack

- **Backend**: Laravel 10
- **Database**: MySQL
- **Frontend**: Blade, TailwindCSS, jQuery, DataTables
- **API**: [CountriesNow API](https://countriesnow.space/) for Country/State/City dropdowns

---

## 📦 Installation

Clone the repository:

```bash
git clone https://github.com/your-username/office-management.git
cd office-management
composer install
npm install && npm run dev
