# Dự án cuối kỳ của nhóm 21 và nhóm 32

Dự án này cung cấp một hệ thống quản lý cửa hàng bao gồm các chức năng quản lý nhân viên, quản lý sản phẩm, quản lý khách hàng, quản lý đơn hàng và báo cáo thống kê. link GitHub: https://github.com/NamJore04/Pos_Computer_Web_Using_PHP.git (branch: main).


## Cấu trúc thư mục

- `admin/`: Chứa các file và thư mục liên quan đến quản lý cửa hàng.
  - `Account_Management/`: Chứa các file liên quan đến quản lý nhân viên và tài khoản nhân viên.
  - `Customer_Management_Transaction_Processing/`: Chứa các file liên quan đến quản lý khách hàng, đơn hàng và thanh toán.
  - `Product_Catalog_Management/`: Chứa các file liên quan đến quản lý danh mục sản phẩm.
  - `Reporting_and_Analytics/`: Chứa các file liên quan đến báo cáo và thống kê.
  - `css/`: Chứa các file CSS cho giao diện của trang web.
- `.vscode/`: Chứa các cài đặt cho Visual Studio Code.

## Tài khoản hệ thống

1. Admin
  Tài khoản: admin
  Mật khẩu:  123456
2. Nhân viên
  Tài khoản: triminhan471999
  Mật khẩu:  123456

## Cách sử dụng

1. Clone dự án về máy.
2. Chạy `composer install` trong thư mục `admin/Account_Management/` và `admin/Customer_Management_Transaction_Processing/` để cài đặt các thư viện cần thiết. (PHPMailer và FPDF)
3. Import file `n21_web.sql` vào cơ sở dữ liệu MySQL.
4. Truy cập `http://localhost/Web_Mid_Fin/admin/index.php` để bắt đầu sử dụng hệ thống.


## Thư viện được sử dụng

- PHPMailer: Được sử dụng để gửi email từ PHP. Xem thêm tại [đây](https://github.com/PHPMailer/PHPMailer).
- FPDF: Được sử dụng để tạo file PDF từ PHP. Xem thêm tại [đây](https://github.com/Setasign/FPDF).

## Tác giả

- Các thành viên nhóm 21 và nhóm 32
- Liên hệ: 	52200151@student.tdtu.edu.vn
		52200168@student.tdtu.edu.vn
		52200156@student.tdtu.edu.vn
		52200021@student.tdtu.edu.vn
