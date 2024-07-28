# DATN

ngrok config add-authtoken 2jo2c62D3OOGUswtoWIt0t1V9uk_MzkNikKmQmHJcBY2tQwk
ngrok http 8000

# lỗi cập nhật ảnh khi chuyển máy

cp -r public/storage backup_storage //sao lưu thư mục cũ
rm public/storage // Xóa symbolic link cũ
php artisan storage:link //Tạo lại symbolic link bằng lệnh Artisan
cp -r backup_storage/\* storage/app/public //Sao chép lại nội dung từ thư mục dự phòng backup_storage vào thư mục storage/app/public

# các câu lệnh cập nhật dữ liệu

composer update // cập nhật các thư viện
php artisan migrate // cập nhật dữ liệu
php artisan db:seed // làm mới dữ liệu
php artisan make:migration create_ten_table //Tạo migration

# các câu lệnh tạo file controlle

php artisan make:controller TenController
php artisan make:controller TenController --resource //Tạo một resource controller
php artisan make:controller TenController --model=TenModel //Tạo một controller với model

# các câu lệnh tạo file khác

php artisan make:model TenModel //Tạo model
php artisan make:model TenModel -m //Tạo model kèm migration
php artisan make:middleware TenMiddleware //Tạo migration
php artisan make:request TenRequest
php artisan make:mail TenMail

# các câu lệnh cấu hình

php artisan config:cache
php artisan view:cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# các câu lệnh liệt kê

php artisan route:list
php artisan list //Liệt kê các lệnh Artisan
php artisan view:cache //Liệt kê các views đã được cache
php artisan queue:work //các công việc (jobs) trong hàng đợi (queue)
