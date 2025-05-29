## OA Test

This is a very simple Laravel CODING ASSESSMENT. It has features such as:

-   Authentication and Authorization
-   User Management CRUD
-   Project Management CRUD
-   Simple RBAC (Role Based Access Control)

Data are saved to a mysql table. The application is built on Laravel 12.

## Prerequisites

Before you start, ensure you have the following installed:

-   Docker
-   PHP version 8.2 or later
-   Web browser
-   Shell or terminal environment

## Setting up the project locally

1. **Clone the repository:**

    ```bash
    git clone git@github.com:degod/oa-test.git
    ```

2. **Navigate to the project directory:**

    ```bash
    cd oa-test/
    ```

3. **Build and start app in Docker (make sure you already started your docker locally before running below):**

    ```bash
    docker-compose up --build -d
    ```

4. **Getting your env sorted:**

    ```bash
    docker exec -it oa-test-app cp .env.example .env
    ```

5. **Installing composer:**

    ```bash
    docker exec -it oa-test-app composer install
    ```

6. **Sorting your application key:**

    ```bash
    docker exec -it oa-test-app  php artisan key:generate
    ```

7. **Logging in to container shell:**

    ```bash
    docker exec -it oa-test-app bash
    ```

8. **Completing the setup:**

    ```bash
    php artisan migrate:fresh --seed && php artisan test
    ```

9. **Exiting container shell:**

    ```bash
    exit
    ```

10. **Accessing the application:**

-   The application should now be running on your local environment.
-   Navigate to `http://localhost:8484` in your browser to access the application.
-   To access the database, go to `http://localhost:8485/`.
    -   USER: `laravel`
    -   PASS: `laravelpassword`
-   To login to the app:
    -   With the "Admin" privilege:
        -   USER: `superadmin@mail.com`
        -   PASS: `superadmin`
            This should work as long as you ran the above migration code
    -   With a regular "User" privilege:
        -   USER: _[Pick a User Email from the users table in the DB]_
        -   PASS: `password`

## Local Setup (From a ZIPPED project bundle)

Make sure you have the necessary prerequisites before proceeding with this.

1. **Unzip to your htdocs (or www as the case may be) and make sure to start up your local server**

2. **Navigate to the project directory in your terminal (assuming you unzipped into "oa-test" folder):**

    ```bash
    cd oa-test/
    ```

3. **Install composer:**

    ```bash
    composer install
    ```

4. **Serve Project:**

    ```bash
    php artisan serve
    ```

5. **Run migration, seeders and test (first create database "oa_test_db" within your phpmyadmin):**

    ```bash
    php artisan migrate:fresh --seed && php artisan test
    ```

6. **Accessing the application:**

-   The application should now be running on your local environment.
-   Navigate to `http://localhost:8000` in your browser to access the application.
-   To access the database, go to your phpmyadmin and locate `oa_test_db`.
-   To login to the app:
    -   With the "Admin" privilege:
        -   USER: `superadmin@mail.com`
        -   PASS: `superadmin`
            This should work as long as you ran the above migration code
    -   With a regular "User" privilege:
        -   USER: _[Pick a User Email from the users table in the DB]_
        -   PASS: `password`

## PART 2 - DATABASE ASSESSMENT – Advanced SQL and Modelling (Task)

For the Part 2 task, the SQL to given below are coined from the schema given in the assessment:

-   Retrieve a list of employees with their department names

```bash
    SELECT
        e.name AS employee_name,
        d.name AS department_name
    FROM
        Employees e
    JOIN
        Departments d ON e.department_id = d.id;
```

-   Find total salary expenditure per department

```bash
    SELECT
        d.name AS department_name,
        SUM(e.salary) AS total_salary
    FROM
        Employees e
    JOIN
        Departments d ON e.department_id = d.id
    GROUP BY
        d.name;
```

-   List employees working on more than one project

```bash
    SELECT
        e.name AS employee_name,
        COUNT(p.id) AS project_count
    FROM
        Employees e
    JOIN
        Projects p ON e.id = p.Employee_id
    GROUP BY
        e.name
    HAVING
        COUNT(p.id) > 1;
```

## Contributing

If you encounter bugs or wish to contribute, please follow these steps:

-   Fork the repository and clone it locally.
-   Create a new branch (`git checkout -b feature/fix-issue`).
-   Make your changes and commit them (`git commit -am 'Fix issue'`).
-   Push to the branch (`git push origin feature/fix-issue`).
-   Create a new Pull Request against the `main` branch, tagging `@degod`.

## Contact

For inquiries or assistance, you can reach out to Godwin Uche:

-   `Email:` godwinseeyou@gmail.com
-   `Phone:` +2348024245093
