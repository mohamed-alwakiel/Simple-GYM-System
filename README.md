
# Simply Gym System Using Laravel

The system consists of Roles (Admin, Gym Manager, City Manager, Trainee). Each one of them is granted to specific permissions. Trainee is handled to work via API.


## Installation
1- Download or Clone the project

2- Open the project in vs Code 

3- In a Terminal window run the following >>

```bash
composer update
```
```bash
cp .env.example .env
```
```bash
php artisan key:generate
```
4- Create new Schema in your DBMS, Assign it to "DB_DATABASE=" field in '.env' file, and set your DB Server information

5- Set These Values in ".env" file to test Verification using email
```bash
MAIL_MAILER=smtp
MAIL_HOST=smtp.googlemail.com
MAIL_PORT=465
MAIL_USERNAME=gymlaravel@gmail.com
MAIL_PASSWORD=gym123456789
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=gymlaravel@gmail.com
MAIL_FROM_NAME="GymSystem"
```

6- Run the following to load DB & Seed Data
```bash
php artisan migrate:fresh
```
```bash
php artisan db:seed
```
7- After All is Finished run
```bash
php artisan serve
```

## Notes
1- Admin is the 1st record with these login information
```bash
Email : admin@admin.com
Password : 123456789
```
2- All Seeded Managers/Trainees have a default Password

which is : 123456789

3- Use this email to verify your Registration
```bash
Email : gymlaravel@gmail.com
Password : gym123456789
```
4- Use the following Information in the Payment for a TrainingPackage

Email: anyemail@mail.com

Card Information:
```bash
4242 4242 4242 4242 -->> (Mandatory)
MM/YY -->> 01/25 (Or Any)
CVC -->> 123 (Or Any)
Name On Card -->> gym (Or Any)
```


## Authors

- [@Ahmed Mohamed Elsheikh](https://github.com/AhmedElsheikh680)
- [@Ahmed Reda Mohamed Bastwesy](https://github.com/Ahmed-bastwesy)
- [@Khalid Gamal Hamed](https://github.com/khalidghanamy)
- [@Mohamed Hossam ELdeen Alwakiel](https://github.com/Mo7ammed7ossam)
- [@Nermeen Ismail Shehab](https://github.com/NermeenShehab)
- [@Reem Adel Bedeer Mahmoud Samak](https://github.com/reemadelsamak)

