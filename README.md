# DreamHome Property Management System
 
## Project Description
 
A comprehensive, web-based real estate and property management CRM based on the classic DreamHome case study. The system streamlines branch operations by managing property listings, client details, scheduled viewings, property inspections, and lease agreements. It features strict Role-Based Access Control (RBAC) to ensure secure operations across Super Admins, Managers, Supervisors, and Staff.
 
---
 
## Team Members
 
| Name | Module |
|---|---|
| Zyra Nadine Flores | Module 1 (Property & Owner Management), Properties, Owners |
| Archelle Aparici   | Module 2 (Client & Registration Module), Clients and Renters |
| Jonathan Justiniani| Module 3 (Staff & Branch Management), Manage Branches, Manage Managers ,Manage Staff |
| Bruce Bilar        | Module 4 (Rental & Viewing Management), Lease Agreements, Property Viewings, Inspections |
 
---
 
## Tech Stack
 
- Laravel (v11/12)
- PHP
- PostgreSQL
- Railway
- Tailwind CSS
 
---
 
## Repository Link
 
https://github.com/Jjustin91/DreamHome
 
---
 
## Setup Instructions
 
```bash
git clone [https://github.com/Jjustin91/DreamHome.git](https://github.com/Jjustin91/DreamHome.git)
 
composer install
npm install
 
cp .env.example .env
 
php artisan key:generate


## Environment Variables

Update `.env`

```env
DB_CONNECTION=pgsql
DB_HOST=
DB_PORT=5432
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

---

## Run Migration

```bash
php artisan migrate
php artisan db:seed

## Start Development Server

```bash
npm run dev
php artisan serve
```

## Default Login

Super Admin Account

```txt
staffID: ADMIN
password: password123
```

---

## Database Information

### Database Platform

Railway PostgreSQL

### Main Tables
        Tables          |                       Purpose                                 |
------------------------|---------------------------------------------------------------|
users	                |   System authentication and Spatie RBAC role management       |
branches	            |   Physical office locations for the agency                    |
staff	                |   Employee HR records, salaries, and branch assignments       |
owners	                |   Contact details for property owners and landlords           |
renter_details	        |   Client profiles and prospective property preferences        |
property_for_rents	    |   Inventory of managed, available, and rented properties      |
lease_agreements	    |   Active and historical financial rental contracts            |
property_viewings	    |   Appointment schedules and post-tour client feedback logs    |
property_inspections	|   Immutable condition and compliance audit reports            |
next_of_kins	        |   Emergency contact information for staff members             |
newspapers	            |   Registry of local publications used for marketing           |
property_adverts	    |   Tracking logs for property advertising campaigns            |

## Module Assignment

| Module | Assigned Developer   |
|   1    |  Zyra Nadine Flores  |
|   2    |   Archelle Aparici   |
|   3    | Jonathan Justiniani  |
|   4    |    Bruce Bilar       |


---

## Deployment Information

### Live URL

```txt
dreamhome-production-50b5.up.railway.app
```

### Hosting Platform

```txt
Railway
```

---

## Screenshots

Required screenshots:
- Login Page
- Dashboard
- CRUD Module
- PostgreSQL Database Tables