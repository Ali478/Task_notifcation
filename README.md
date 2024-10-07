How to Run
1. link database
2. `composer update`
3. `php artisan key:generate`
4. Run migrations: `php artisan migrate`
5. Set up queues: `php artisan queue:work`
6. Build Docker containers: `docker-compose up`
7. Create pusher account or use existing account details in env
8. use stmp details in env for your account
9. A Form is available on root route just submit to send email and message
