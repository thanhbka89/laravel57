#B1 >>> Install
- Get code : https://github.com/thanhbka89/laravel57.git
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

- Mo notepad voi quyen admin, open file C:\Windows\System32\drivers\etc\hosts roi them :
    127.0.0.1      blog.local

- Trong consle, chay lenh de tao bang va dump du lieu test : php artisan migrate --seed
  + Neu muon xoa het bang va chay lai migrate de tao lai bang (--seed de chay database seeder), go : php artisan migrate:fresh --seed

- Truy cap monior ung dung : http://blog.local/telescope/

- Login vao superadmin : thanhbka@yahoo.com/123456a@

#B2: >>> Programing

#Database
https://allaravel.com/laravel-tutorials/lam-viec-voi-co-so-du-lieu-trong-laravel/
https://allaravel.com/laravel-tutorials/laravel-eloquent-orm-phan-2-xu-ly-database-relationship/
https://allaravel.com/laravel-tutorials/laravel-eloquent-orm-phan-3-xu-ly-du-lieu-dau-ra/
https://allaravel.com/laravel-tutorials/xay-dung-truy-van-bang-laravel-query-builder/

#Transaction
Giao dịch (transaction) là một nhóm các hành động có thứ tự trên CSDL nhưng lại được người dùng xem như là một đơn vị thao tác duy nhất. Ví dụ: một giao dịch thanh toán trực tuyến cho một món hàng trên mạng sẽ bao gồm nhiều hành động trên CSDL:

Trừ tiền từ tài khoản người dùng.
Cộng tiền vào tài khoản nhà cung cấp.
Giảm số lượng hàng trong kho.

Khi đó, bất kỳ một hành động nào bị lỗi sẽ dẫn đến giao dịch lỗi. Trong thực tế khi lập trình, người ta thường nhóm các nhiều các hành động trên CSDL vào thành một nhóm và thực hiện chúng như một giao dịch, nếu một hành động lỗi, hệ thống sẽ thực hiện các lệnh sao cho quay về trạng thái ban đầu (rollback). Laravel cũng hỗ trợ quản lý transaction, thực hiện chúng khá đơn giản với cú pháp:

DB::transaction(function () {
    DB::table('users')->update(['votes' => 1]);

    DB::table('posts')->delete();
}, 5);
Chú ý tham số thứ 2 của phương thức transaction() là số lần thử thực hiện lại khi gặp tình trạng deadlock.

#Migration
- Tao migration file :
    php artisan make:migration create_category_product_table --create=category_product

- Chay migrate de tao bang trong db:
    php artisan migrate
    php artisan migrate:refresh --> rollback toàn bộ CSDL đồng thời chạy lại luôn toàn bộ các file migrate của bạn

- Seeder : tao du lieu (mau) dump vao csdl
Tao file seeder : php artisan make:seeder <seeder-class-name>
Them data vao csdl, chạy nội dung file DatabaseSeeder.php : php artisan db:seed
Chay 1 file seeder cu the : php artisan db:seed --class=UserTableSeeder

#Model
- Create Post model with migration and resource controller : 
php artisan make:model Post -m -c --resource

- Tao model va file migrations :
php artisan make:model Category -m

- Mutator và Accessor : tự động định dạng các giá trị khi lấy lên hoặc trước khi lưu vào cơ sở dữ liệu, ví dụ: bạn muốn một trường nào đó trước khi lưu xuống cơ sở dữ liệu sẽ được mã hóa lại và khi lấy từ cơ sở dữ liệu lên sẽ tự động thực hiện giải mã.
    + Accessor : là phương thức sẽ được gọi đến khi truy xuất một thuộc tính của đối tượng, để định nghĩa Accessor, sử dụng phương thức có tên với quy tắc sau [get][Tên thuộc tính][Attribute]
    + Mutator : thay đổi dữ liệu trước khi lưu xuống database
- $casts (sử dụng trong model) : Chuyển đổi dạng dữ liệu của thuộc tính
    + Chuyển đổi dạng Array là rất hữu ích khi chúng ta làm việc với cột được lưu trữ ở dạng chuỗi JSON, khi thêm chuyển đổi dạng này vào $casts, nó sẽ tự động chuyển từ dữ liệu JSON sang thành mảng khi chúng ta truy cập vào thuộc tính của Model

#Eloquent ORM và Query Builder : thao tác với CSDL
- Query Builder
    + Query Builder sử dụng PDO nhằm bảo vệ ưng dụng và tránh các lỗi về SQL injection.Query Builder xây dựng lớp Illuminate\Support\Facades\DBđể thực hiện các câu truy vấn.
    + Sử dụng thao tác trực tiếp với bảng
    + Có câu lệnh viết phức tạp hơn nhưng cũng có thể thể thực hiện các truy vấn phức tạp
    + Tốc độ thực hiện truy vấn nhanh hơn
- ORM(Object Relational Mapping) là một kỹ thuật lập trình dùng để chuyển đổi dữ liệu giữa một hệ thống không hướng đối tượng như cơ sở dữ liệu sang hệ thống hướng đối tượng như lập trình hướng đôi tượng trong PHP.
    + Mỗi bảng của database sẽ được ánh xạ qua ‘Model’, mỗi Model sẽ được kế thừa từ Illuminate\Database\Eloquent\Model;
    + Cung cấp ActiveRecord đầy đủ.
    + Các câu lệnh của Eloquent ORM là ngắn gọn, dễ hiểu và dễ sử dụng hơn.
    + Các câu hàm trong Query Builder có thể sử dụng được trong Eloquent bằng cách call Static, nhưng ngược lại Query Builder thì không sử dụng được các hàm trong Eloquent
    + Tốc độ xử lý chậm hơn so với Query Builder
    + Nói cách khác thì Eloquent ORM nó như là 1 bản nâng cấp từ Query Builder giúp cho các viết ngắn gọi dễ hiểu,cung cấp các phương thức tĩnh và các phương thức thêm mà Query Builder không có như softDelele, các scope, và các event boot
--> Phần quan trọng nhất là nếu chúng ta muốn thay đổi cơ sở dữ liệu khác , thì DB::raw sẽ gây đau đầu cho chúng ta và trong trường hợp đó Laravel Eloquent sẽ giải quyết tất cả các vấn đề một cách đơn giản. Nó có thể xử lý các loại Database khác nhau.
https://hocphp.info/laravel-framework-eloquent-orm-va-query-builder-co-ban-chua-biet/


https://allaravel.com/laravel-tutorials/laravel-eloquent-orm-phan-1-thao-tac-voi-database-qua-eloquent-model/

#Authen
https://allaravel.com/laravel-tutorials/phan-quyen-nguoi-dung-voi-laravel-authorization/
https://allaravel.com/laravel-tutorials/laravel-authentication-xac-thuc-nguoi-dung-that-don-gian/

#Controller 
- Tao FormRequest de validate : php artisan make:request UserRequest
- Tao controller:
    php artisan make:controller CategoryController

#Event 
- Event:
    B1: Dinh nghia --> php artisan make:event OrderPayment
    B2: Tao event listener --> php artisan make:listener SendEmailAfterOrderPayment --event="OrderPayment"
    B3: Dang ky event trong app/Providers/EventServiceProvider.php
    -->Sau do chay lenh : php artisan event:generate

- Links :
    https://allaravel.com/laravel-tutorials/quan-ly-su-kien-trong-ung-dung-voi-laravel-event/

#Queue
- Chay queue (thuc thi job trong Queue) : php artisan queue:work
- Mặc định job sẽ được thực hiện 1 lần, nếu lỗi sẽ được bỏ qua, để thiết lập số lần thử thực hiện lại một job chúng ta có hai cách: hoặc sử dụng câu lệnh artisan cho tất cả các job
    php artisan queue:work --tries=3
- Chú ý, câu lệnh này khi đã thực hiện sẽ chạy cho đến khi đóng cửa sổ dòng lệnh hoặc dừng nó bằng một câu lệnh. Queue worker là các tiến trình có thời gian sống dài do đó nó sẽ không cập nhật code khi có thay đổi, khi bạn thay đổi code chương trình, bạn cần khởi động lại queue worker bằng câu lệnh : php artisan queue:restart
- Số giây job có thể chạy trước khi timeout : php artisan queue:work --timeout=60

php artisan queue:restart

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
https://blog.eduonix.com/web-programming-tutorials/learn-using-repositories-services-laravel-5/
https://storyofsu.com/ac-mong-mang-ten-coding-conventions/

#Laravel Mix
- chay Laravel Mix: quản lý tất cả tài nguyên (assets) như img, css, js trong dự án của bạn, đồng thời nó dự trên base là webpack build tất cả các file css, js pre-processors như SCSS, SASS thành css, chuyển ES6 thành ES5 (trình duyệt không hiểu cú pháp ES6).
// Chạy trên môi trường dev, local.
npm run dev
// Chạy khi đưa lên host, deploy app, 2 lệnh này giống nhau
npm run prod
npm run production
// Chạy khi vừa dev, vừa chỉnh các file assets
npm run watch

-xem danh sach routes:
php artisan route:list

- noted:
+ $category->posts sẽ query DB để lấy ra tất cả các posts thuộc về category hiện tại sau đó dựng các model Post, đưa vào Collection sau đó duyệt từng phần tử của Collection đó để lấy ra bản ghi đầu tiên từ điều kiện first() của ta.
+ $categoty->posts() thì như định nghĩa ở trên là return $this->hasMany(Post::class);, ta có thể thấy nó sẽ trả về instance của Category. Khi ta gọi $categoty->posts()->first() thì nó sẽ lấy 1 bản ghi duy nhất từ tầng database ra chứ không lấy tất cả bản ghi như $category->posts rồi mới lọc tiếp để lấy ra bản ghi đầu tiên nữa.

- Eager load :


#B3 >>> Others

#PHP Trait : PHP chỉ cho phép mỗi class thừa kế từ tối đa là 1 class khác.trong khi trait có thể hỗ trợ đa kế thừa.

#PHP Generator : thuật ngữ được PHP hỗ trợ từ phiên bản 5.5 trở lên, nó hỗ trợ chúng ta có thể truy xuất dến dữ liệu trong mảng mà không cần lưu trữ mảng trên bộ nhớ.
https://viblo.asia/p/traits-va-generator-trong-php-djeZ1DbmKWz

#Git
- Git cung cấp file .gitignore để bỏ qua những file không quan trọng mà dev không muốn tracking, ví dụ như khi code android bằng android studio thì hàng loạt file build hoặc gradle được tạo ra, trong trường hợp đó sử dụng gitignore rất hữu ích để bảo git không tracking những file không cần thiết.
Tuy nhiên giả sử trường hợp cập nhật file .gitignore để untrack 1 file đã cập nhật trước đó thì lại xảy ra trường hợp git vẫn tracking file mà mình vừa cập nhật trong .gitignore.
Nếu gặp trường hợp này cần xoá cached của git , và commit lại . Thực hiện theo các câu lệnh dưới đây, truy cập thư mục code, mở console gõ :
    git rm -r --cached .  #remove các files có trong git cache rồi cập nhật gitignore
    git add .             #add tất cả những file được cho phép
    git commit -m "fixed untracked files"

#XDebug
- Tai extension xdebug ung voi phien ban php dang su dung : https://xdebug.org/download.php 
- Copy file php_xdebug.dll vao thu muc ext trong php 
- Edit file php.ini , them vao dong :
    extesion=xdebug 
    xdebug.remote_enable=1
    xdebug.remote_handler=dbgp
    xdebug.remote_host=127.0.0.1
    xdebug.remote_port=9000
    xdebug.remote_log="/var/log/xdebug/xdebug.log"

