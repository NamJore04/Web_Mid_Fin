<?php
include 'sections/header.php';

// Lấy dữ liệu slide từ cơ sở dữ liệu
$sql_slide = "SELECT * FROM tbl_slide";
$result_slide = $conn->query($sql_slide);
?>

<!-- Main -->
<section id="slider">
    <div class="aspect-ratio-169">
        <?php while ($slide = $result_slide->fetch_assoc()) : ?>
            <img src="<?php echo '/Web2/admin/' . $slide['slide_name']; ?>" alt="">

        <?php endwhile; ?>
    </div>
    <div class="dot-container">
        <!-- Dots for navigation -->
        <?php $index = 0; ?>
        <?php while ($index < mysqli_num_rows($result_slide)) : ?>
            <span class="dot <?php echo ($index === 0) ? 'active' : ''; ?>"></span>
            <?php $index++; ?>
        <?php endwhile; ?>
    </div>
</section>

<!-- App container -->
<section class="app-container">
    <p>Tải ứng dụng</p>
    <div class="app-google">
        <img src="img/googleplay.png" alt="">
        <img src="img/appstore.png" alt="">
    </div>
    <p>Nhận bản tin</p>
    <input type="text" placeholder="Nhập Email của bạn...">
</section>

<?php
include 'sections/footer.php';
?>
