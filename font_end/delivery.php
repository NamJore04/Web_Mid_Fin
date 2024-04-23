<?php 
include 'sections/header.php';

?>


    <!-- delivery  -->
    <section class="delivery">
        <div class="container">
            <div class="delivery-top-wrap">
                <div class="delivery-top">
                    <div class="delivery-top-delivery delivery-top-item">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                    <div class="delivery-top-adress delivery-top-item active">
                        <i class="fa-solid fa-map-location-dot"></i>
                    </div>
                    <div class="delivery-top-creddit delivery-top-item">
                        <i class="fa-regular fa-credit-card"></i>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="delivery-content row">
                    <div class="delivery-content-left">
                        <p>Vui lòng chọn địa chỉ giao hàng</p>
                        <div class="delivery-content-left-dangnhap row">
                            <i class="fa-solid fa-right-to-bracket"></i>
                            <p>Đăng nhập (Nếu bạn đã có tài khoản của IVY)</p>
                        </div>
                        <div class="delivery-content-left-khachle row">
                            <input  checked name="loaikhach" type="radio" value="khachle">
                            <p> <span style="font-weight: bold; ">Khách lẻ</span> (Nếu bạn không muốn lưu lại thông tin)</p>
                        </div>
                        <div class="delivery-content-left-dangky row">
                            <input  checked name="loaikhach" type="radio" value="khachle">
                            <p> <span style="font-weight: bold; ">Đăng ký</span> (Nếu bạn chưa có tài khoản của IVY)</p>
                        </div>
                        <div class="delivery-content-left-input-top">
                            <div class="delivery-content-left-input-top-item">
                                <label for="">Họ tên <span style="color: red;">*</span></label>
                                <input type="text">
                            </div>
                            <div class="delivery-content-left-input-top-item">
                                <label for="">Điện thoại <span style="color: red;">*</span></label>
                                <input type="text">
                            </div>
                            <div class="delivery-content-left-input-top-item">
                                <label for="">Tỉnh/TP <span style="color: red;">*</span></label>
                                <input type="text">
                            </div>
                            <div class="delivery-content-left-input-top-item">
                                <label for="">Quận/Huyện <span style="color: red;">*</span></label>
                                <input type="text">
                            </div>
                        </div>
                        <div class="delivery-content-left-input-bottom">
                            <label for="">Địa chỉ chi tiết <span style="color: red;">*</span></label>
                            <input type="text">
                        </div>
                        <div class="delivery-content-left-button row">
                            <a href=""> <span><<</span> <p>Quay lại giỏ hàng</p></a>
                            <button><p style="font-weight: bold;">THANH TOÁN VÀ GIAO HÀNG</p></button>
                        </div>
                    </div>

                    <div class="delivery-content-right">
                        <table>
                            <tr>
                                <th>Tên sản phẩm</th>
                                <th>Giảm giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>
                            <tr>
                                <td>Áo thun nỉ</td>
                                <td>20%</td>
                                <td>1</td>
                                <td>790.000<sup>đ</sup></td>
                            </tr>
                            <tr>
                                <td>Áo thun nỉ nam</td>
                                <td>20%</td>
                                <td>2</td>
                                <td>800.000<sup>đ</sup></td>
                            </tr>
                            <tr>
                                <td colspan="3" style="font-weight: bold;">Tổng</td>
                                <td style="font-weight: bold;">1.590.000<sup>đ</sup></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Thuế VAT</td>
                                <td style="font-weight: bold;">90.000<sup>đ</sup></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Tổng tiền hàng</td>
                                <td style="font-weight: bold;">1.500.000<sup>đ</sup></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php 
include 'sections/footer.php';
?>