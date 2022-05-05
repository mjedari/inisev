## Install
migration
```
php artisan migrate
```
you can generate 10 users with websites and post

```
php artisan db:seed
```

make run queue command to work:
```
php artisan queue:work
```



## Usage

### api
to subscribe use this url:

```
// POST method
/api/websites/{website_id}/subscribe
```


to publish a post that is existed with `DRAFT` status: 
```
// PUT method
api/posts/{post_id}/publish
```

to create a post :

```
// POST method
api/websites/{website_id}/posts
```
### command 
To run command witch send email to all subscribers for a specific post:
```
php artisan subscribers:send {post_id}
```

They are also other API's that are accessible in `api.php` file.

