#B1 >>> Install
- get code : https://github.com/thanhbka89/laravel57.git
- Chuyen den thu muc get code ben tren, ex : cd D:\SourceCode\php\laravel\laravel57\blog
- Mo console, de cai cac package php : composer install
- Cai webserver (Ampps, Laragon, ...) : php > 7.1, start apache (hoac nginx), start mysql
- Tao domain tro den thu muc code, ex : 
    <VirtualHost *:80> 
        DocumentRoot "D:/SourceCode/php/laravel/laravel57/blog/public/"
        ServerName blog.local
        ServerAlias *.blog.local
        <Directory "D:/SourceCode/php/laravel/laravel57/blog/public/">
            AllowOverride All
            Require all granted
        </Directory>
    </VirtualHost>

- Mo notepad voi quyen admin, open file : C:\Windows\System32\drivers\etc\hosts roi them :
    127.0.0.1      blog.local

- Trong consle, chay lenh de tao bang va dump du lieu test : php artisan migrate --seed
  + Neu muon xoa het bang va chay lai migrate de tao lai bang (--seed de chay database seeder), go : php artisan migrate:fresh --seed

- Truy cap monior ung dung : http://blog.local/telescope/

- Login vao superadmin : thanhbka@yahoo.com/123456a@

#B2: >>> Programing

#Database

#Model
- Create Post model with migration and resource controller : php artisan make:model Post -m -c --resource

#Controller 
- Tao FormRequest de validate : php artisan make:request UserRequest

#Event 

#Queue
- Chay queue : php artisan queue:work

#Scheduler 

#Best practices : https://laravel-news.com/eloquent-tips-tricks
- cache config, limit IO request : php artisan config:cache
- cache route, ko su dung closure: php artisan route:cache

#Links
https://www.groloop.com/en/laravel-5-4-19-roles-and-permissions-part-1/
https://itsolutionstuff.com/post/laravel-56-user-roles-and-permissions-acl-using-spatie-tutorialexample.html
https://laravelcode.com/post/laravel-56-prevent-block-multiple-login-of-same-credentials
https://chungnguyen.xyz/posts/laravel-request-lifecycle-laravel-hoat-dong-nhu-the-nao-ban-biet-chua
https://github.com/alexeymezenin/laravel-best-practices


- chay Laravel Mix: quản lý tất cả tài nguyên (assets) như img, css, js trong dự án của bạn, đồng thời nó dự trên base là webpack build tất cả các file css, js pre-processors như SCSS, SASS thành css, chuyển ES6 thành ES5 (trình duyệt không hiểu cú pháp ES6).
// Chạy trên môi trường dev, local.
npm run dev
// Chạy khi đưa lên host, deploy app, 2 lệnh này giống nhau
npm run prod
npm run production
// Chạy khi vừa dev, vừa chỉnh các file assets
npm run watch

- tao model va migrations :
php artisan make:model Category -m

- tao migration file
php artisan make:migration create_category_product_table --create=category_product

- chay migrate de tao bang trong db:
php artisan migrate
php artisan migrate:refresh --> rollback toàn bộ CSDL đồng thời chạy lại luôn toàn bộ các file migrate của bạn

- seeder : tao du lieu (mau) dump vao csdl
tao file seeder : php artisan make:seeder <seeder-class-name>
them data vao csdl, chạy nội dung file DatabaseSeeder.php : php artisan db:seed
chay 1 file seeder cu the : php artisan db:seed --class=UserTableSeeder

- tao controller:
php artisan make:controller CategoryController

-xem danh sach routes:
php artisan route:list

- noted:
+ $category->posts sẽ query DB để lấy ra tất cả các posts thuộc về category hiện tại sau đó dựng các model Post, đưa vào Collection sau đó duyệt từng phần tử của Collection đó để lấy ra bản ghi đầu tiên từ điều kiện first() của ta.
+ $categoty->posts() thì như định nghĩa ở trên là return $this->hasMany(Post::class);, ta có thể thấy nó sẽ trả về instance của Category. Khi ta gọi $categoty->posts()->first() thì nó sẽ lấy 1 bản ghi duy nhất từ tầng database ra chứ không lấy tất cả bản ghi như $category->posts rồi mới lọc tiếp để lấy ra bản ghi đầu tiên nữa.

- eager load

- Event:
B1: Dinh nghia - php artisan make:event OrderPayment
B2: Tao event listener - php artisan make:listener SendEmailAfterOrderPayment --event="OrderPayment"
B3: Dang ky event trong app/Providers/EventServiceProvider.php
-->Sau do chay lenh : php artisan event:generate
