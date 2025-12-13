<?php
    include "../header.php";
    include "slider.php";
    include "class/cartegory_class.php"

?>

<?php 
    $cartegory = new cartegory;
    // if($_SERVER["REQUEST_METHOD"] === 'POST') {
    //     $cartegory_name = $_POST['cartegory_name'];
    //     $insert_cartegory = $cartegory -> insert_cartegory($cartegory_name);
    // }

    $show_cartegory = $cartegory ->show_cartegory();



?>

        <div class="admin-content-right">
            <div class="admin-content-right-cartegory-list">
                <h1>Danh sách danh mục</h1>
                <table style="width:100%; text-align: center;">
                    <tr>
                        <th>STT</th>
                        <th>ID</th>
                        <th>Danh mục</th>
                        <th>Tùy biến</th>
                    </tr>

                    <?php
                    if($show_cartegory) {
                        $i = 0;
                        while($result = $show_cartegory->fetch_assoc()) { 
                            $i++;
            
                    ?>

                    <tr>
                        <td><?php echo $i?></td>
                        <td><?php echo $result['cartegory_id']?></td>
                        <td><?php echo $result['cartegory_name']?></td>
                        <td><a href="cartegoryedit.php?cartegory_id=<?php echo $result['cartegory_id']?>">Sửa</a>
                        |<a href="cartegorydelete.php?cartegory_id=<?php echo $result['cartegory_id']?>">Xóa</a></td>
                    </tr>

                    <?php 
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </section>
</body>
</html>