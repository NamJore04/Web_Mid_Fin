<?php 
include 'sections/header.php';

?>


    <!-- cart  -->
    <section class="cart">
        <div class="container">
            <div class="cart-top-wrap">
                <div class="cart-top">
                    <div class="cart-top-cart cart-top-item active">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                    <div class="cart-top-adress cart-top-item">
                        <i class="fa-solid fa-map-location-dot"></i>
                    </div>
                    <div class="cart-top-creddit cart-top-item">
                        <i class="fa-regular fa-credit-card"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="container ">
            <div class="cart-content row">
                <div class="cart-content-lelf">
                <table>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Màu</th>
                        <th>Size</th>
                        <th>SL</th>
                        <th>Thành tiền</th>
                        <th>Xóa</th>
                    </tr>
                    <tr>
                        <td><img src="img/nu8.2.jpg" alt=""></td>
                        <td><p>Áo sơ mi in hình</p></td>
                        <td><img src="img/mau8.png" alt=""></td>
                        <td><p>L</p></td>
                        <td><input type="number" value="1" min="1"></td>
                        <td><p>790.000 <sup>đ</sup></p></td>
                        <td><span>X</span></td>

                    </tr>

                    <tr>
                        <td><img src="img/nu8.2.jpg" alt=""></td>
                        <td><p>Áo sơ mi in hình</p></td>
                        <td><img src="img/mau8.png" alt=""></td>
                        <td><p>L</p></td>
                        <td><input type="number" value="1" min="1"></td>
                        <td><p>790.000 <sup>đ</sup></p></td>
                        <td><span>X</span></td>

                    </tr>
                </table>
                </div>

                <div class="cart-content-right">
                    <table>
                        <tr>
                            <th colspan="2">TỔNG TIỀN GIỎ HÀNG</th>
                        </tr>
                        <tr>
                            <td>TỔNG SẢN PHẨM</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>TỔNG TIỀN HÀNG</td>
                            <td><p>790.000 <sup>đ</sup></p></td>
                        </tr>
                        <tr>
                            <td>TẠM TÍNH</td>
                            <td><p style="color: black; font-weight: bold;">790.000 <sup>đ</sup></p></td>
                        </tr>
                    </table>

                    <div class="cart-content-right-text">
                        <p style="color: red; font-weight: bold;">Miễn đổi trả đối với sản phẩm đồng giá / sale trên 50%</p>
                    </div>
                    <div class="cart-content-right-button">
                        <button>Tiếp tục mua sắm</button>
                        <button>Thanh toán</button>
                    </div>

                    <div class="cart-content-right-dangnhap">
                        <p>Tài khoản IVY</p> <br>
                        <p>Hãy <a href="" style="color: orange;">đăng nhập</a> tài khoản để tích lũy điểm thưởng.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php 
include 'sections/footer.php';
?>