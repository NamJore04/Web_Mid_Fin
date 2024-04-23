<?php 
include 'sections/header.php';

?>


    <!-- payment  -->
    <section class="payment">
        <div class="container">
            <div class="payment-top-wrap">
                <div class="payment-top">
                    <div class="payment-top-payment payment-top-item">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                    <div class="payment-top-adress payment-top-item">
                        <i class="fa-solid fa-map-location-dot"></i>
                    </div>
                    <div class="payment-top-creddit payment-top-item active">
                        <i class="fa-regular fa-credit-card"></i>
                    </div>
                </div>
        </div>

        <div class="container">
            <div class="payment-content row">
                <div class="payment-content-left">
                    <div class="payment-content-left-method-delivery">
                        <p style="font-weight: bold;">Phương thức giao hàng</p>
                        <div class="ayment-content-left-method-delivery-item">
                            <input checked type="radio">
                            <label for="">Giao hàng chuyển phát nhanh</label>
                        </div>
                    </div>
                    <div class="payment-content-left-method-payment">
                        <p style="font-weight: bold;">Phương thức thanh toán</p>
                        <p>Mọi giao dịch đều được bảo mật và mã hóa. Thông tin thẻ tín dụng sẽ không bao giờ được lưu lại.</p>
                        <div class="payment-content-left-method-payment-item">
                            <input  name="method-payment" type="radio">
                            <label for="">Thanh toán bằng thể tín dụng(OnePay)</label>
                        </div>

                        <div class="payment-content-left-method-payment-img">
                            <img src="img/visa.png" alt="">
                        </div>
                        <div class="payment-content-left-method-payment-item">
                            <input name="method-payment" type="radio">
                            <label for="">Thanh toán bằng thể ATM(OnePay)</label>
                        </div>
                        <div class="payment-content-left-method-payment-img">
                            <img src="img/vcb.png" alt="">
                        </div>
                        <div class="payment-content-left-method-payment-item">
                            <input name="method-payment" type="radio">
                            <label for="">Thanh toán bằng ShopeePay</label>
                        </div>
                        <div class="payment-content-left-method-payment-img">
                            <img src="img/spay.png" alt="">
                        </div>
                        <div class="payment-content-left-method-payment-item">
                            <input checked name="method-payment" type="radio">
                            <label for="">Thanh toán khi nhận hàng.</label>
                        </div>
                    </div>
                </div>
                <div class="payment-content-right">
                    <div class="payment-content-right-button">
                        <input type="text" placeholder="Mã giảm giá/Quà tặng">
                        <button><i class="fa-solid fa-check"></i></button>
                    </div>
                    <div class="payment-content-right-button">
                        <input type="text" placeholder="Mã cộng tác viên">
                        <button><i class="fa-solid fa-check"></i></button>
                    </div>
                    <div class="payment-content-right-mnv">
                        <select name="" id="">
                            <option value="">Chọn mã nhân viên thân thiết</option>
                            <option value="">A124</option>
                            <option value="">E024</option>
                            <option value="">D015</option>
                            <option value="">Q212</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="payment-content-right-payment">
                <button>Tiếp tục thanh toán</button>
            </div>
        </div>
    </section>
    <?php 
include 'sections/footer.php';
?>