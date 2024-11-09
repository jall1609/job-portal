# Job Portal
## Step Install : 
- Clone Repo
```
git clone https://github.com/jall1609/job-portal
```
- Update Composer
```
composer update
```
- Rename .env.example to .env
- Migrade n Seed
```
php artisan migrate:fresh
```
```
php artisan db:seed
```
- Run Testing
```
php artisan test
```
- Run Laravel
```
php artisan serve
```
## EndPoint
#### Auth
- POST | api/auth/login
- POST | api/auth/register-candidat
- POST | api/auth/register-company
#### Candidat
- GET | api/candidat/my-application
####  Company Job Vacancy
- GET | api/company/job-vacancy
- POST | api/company/job-vacancy
- GET | api/company/job-vacancy/{job_vacancy_slug}/applicant
- POST | api/company/job-vacancy/{job_vacancy_slug}/applicant/{candidat}/change-status
- GET | api/company/job-vacancy/{job_vacancy}
- PUT | api/company/job-vacancy/{job_vacancy}
- DELETE | api/company/job-vacancy/{job_vacancy}
#### Job List
- GET | api/job-list
- GET | api/job-list/{job_vacancy_slug}
- POST | api/job-list/{job_vacancy_slug}/apply
#### User
- POST | api/me

## Postman Collection
File : https://github.com/jall1609/job-portal/blob/master/job-portal.postman_collection.json

## Deploy
Deploy EndPoint : http://job-portal.rijalf1609.my.id/ |
e.g. https://job-portal.rijalf1609.my.id/api/job-list/