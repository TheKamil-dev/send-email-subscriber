## Installation

git clone https://github.com/TheKamil-dev/send-email-subscriber.git

Update Environment variables  in .env file.

Create Databse in mysql and update DB_DATABASE 

Change your email setting.
`
MAIL_MAILER=smtp
MAIL_HOST=smtp.****.com
MAIL_PORT=587
mail_username=****@gmail.com
MAIL_PASSWORD=****
MAIL_ENCRYPTION=tls
mail_from_address=****@****.com
MAIL_FROM_NAME="${APP_NAME}"

Change QUEUE_CONNECTION to

QUEUE_CONNECTION=database
`

Run php artisan migrate

Run website seeder
php artisan db:seed

## Job Run 

Run following command to execute the queued jobs
php artisan queue:work or php artisan queue:listen

(Queue job use the Artisan command to send email.)

To send email using artisan command use below command.
php artisan subscriber:email {post_id}

## Send email with diffrent methods from PostController.php
(remove comments to send email using diffrent methods)

//Send Email using Event listner
//PostCreated::dispatch($post);

// Send Email using Job queue
dispatch(new SendEmailNotificationJob($post));

// Send Email using schedule Job queue.
//dispatch(new SendEmailNotificationJob($post))->delay(now()->addMinutes(10));


