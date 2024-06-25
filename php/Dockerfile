# เลือก base image ของ PHP 5.6.26
FROM php:5.6.26-apache

# เพิ่ม extensions ต่าง ๆ ตามความต้องการ
RUN docker-php-ext-install mysqli pdo_mysql

# คัดลอกไฟล์การกำหนดค่า Apache ของเราไปยัง container
COPY . .

# เปิดการใช้งาน rewrite module ของ Apache
RUN a2enmod rewrite

EXPOSE 80

# รีโหลด Apache เพื่อให้เรียกใช้การเปลี่ยนแปลงที่เราทำ
RUN service apache2 restart
