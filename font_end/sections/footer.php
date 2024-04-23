    <!-- <link rel="stylesheet" href="style.css"> -->

    <style>
        .grid {
            width: 100%;
            display: block;
            padding: 0;
        }

        .grid.wide {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* .row {
    display: flex;
    flex-wrap: wrap;
    margin-left: -4px;
    margin-right: -4px;
} */

        .row.no-gutters {
            margin-left: 0;
            margin-right: 0;
        }

        .col {
            padding-left: 4px;
            padding-right: 4px;
        }

        .row.no-gutters .col {
            padding-left: 0;
            padding-right: 0;
        }

        .c-0 {
            display: none;
        }

        .c-1 {
            flex: 0 0 8.33333%;
            max-width: 8.33333%;
        }

        .c-2 {
            flex: 0 0 16.66667%;
            max-width: 16.66667%;
        }

        .c-3 {
            flex: 0 0 25%;
            max-width: 25%;
        }

        .c-4 {
            flex: 0 0 33.33333%;
            max-width: 33.33333%;
        }

        .c-5 {
            flex: 0 0 41.66667%;
            max-width: 41.66667%;
        }

        .c-6 {
            flex: 0 0 50%;
            max-width: 50%;
        }

        .c-7 {
            flex: 0 0 58.33333%;
            max-width: 58.33333%;
        }

        .c-8 {
            flex: 0 0 66.66667%;
            max-width: 66.66667%;
        }

        .c-9 {
            flex: 0 0 75%;
            max-width: 75%;
        }

        .c-10 {
            flex: 0 0 83.33333%;
            max-width: 83.33333%;
        }

        .c-11 {
            flex: 0 0 91.66667%;
            max-width: 91.66667%;
        }

        .c-12 {
            flex: 0 0 100%;
            max-width: 100%;
        }

        .c-o-1 {
            margin-left: 8.33333%;
        }

        .c-o-2 {
            margin-left: 16.66667%;
        }

        .c-o-3 {
            margin-left: 25%;
        }

        .c-o-4 {
            margin-left: 33.33333%;
        }

        .c-o-5 {
            margin-left: 41.66667%;
        }

        .c-o-6 {
            margin-left: 50%;
        }

        .c-o-7 {
            margin-left: 58.33333%;
        }

        .c-o-8 {
            margin-left: 66.66667%;
        }

        .c-o-9 {
            margin-left: 75%;
        }

        .c-o-10 {
            margin-left: 83.33333%;
        }

        .c-o-11 {
            margin-left: 91.66667%;
        }

        /* >= Tablet */
        @media (min-width: 740px) {
            .row {
                margin-left: -8px;
                margin-right: -8px;
            }

            .col {
                padding-left: 8px;
                padding-right: 8px;
            }

            .m-0 {
                display: none;
            }

            .m-1,
            .m-2,
            .m-3,
            .m-4,
            .m-5,
            .m-6,
            .m-7,
            .m-8,
            .m-9,
            .m-10,
            .m-11,
            .m-12 {
                display: block;
            }

            .m-1 {
                flex: 0 0 8.33333%;
                max-width: 8.33333%;
            }

            .m-2 {
                flex: 0 0 16.66667%;
                max-width: 16.66667%;
            }

            .m-3 {
                flex: 0 0 25%;
                max-width: 25%;
            }

            .m-4 {
                flex: 0 0 33.33333%;
                max-width: 33.33333%;
            }

            .m-5 {
                flex: 0 0 41.66667%;
                max-width: 41.66667%;
            }

            .m-6 {
                flex: 0 0 50%;
                max-width: 50%;
            }

            .m-7 {
                flex: 0 0 58.33333%;
                max-width: 58.33333%;
            }

            .m-8 {
                flex: 0 0 66.66667%;
                max-width: 66.66667%;
            }

            .m-9 {
                flex: 0 0 75%;
                max-width: 75%;
            }

            .m-10 {
                flex: 0 0 83.33333%;
                max-width: 83.33333%;
            }

            .m-11 {
                flex: 0 0 91.66667%;
                max-width: 91.66667%;
            }

            .m-12 {
                flex: 0 0 100%;
                max-width: 100%;
            }

            .m-o-1 {
                margin-left: 8.33333%;
            }

            .m-o-2 {
                margin-left: 16.66667%;
            }

            .m-o-3 {
                margin-left: 25%;
            }

            .m-o-4 {
                margin-left: 33.33333%;
            }

            .m-o-5 {
                margin-left: 41.66667%;
            }

            .m-o-6 {
                margin-left: 50%;
            }

            .m-o-7 {
                margin-left: 58.33333%;
            }

            .m-o-8 {
                margin-left: 66.66667%;
            }

            .m-o-9 {
                margin-left: 75%;
            }

            .m-o-10 {
                margin-left: 83.33333%;
            }

            .m-o-11 {
                margin-left: 91.66667%;
            }
        }

        /* PC medium resolution > */
        @media (min-width: 1113px) {
            .row {
                margin-left: -12px;
                margin-right: -12px;
            }

            .row.sm-gutter {
                margin-left: -5px;
                margin-right: -5px;
            }

            .col {
                padding-left: 12px;
                padding-right: 12px;
            }

            .row.sm-gutter .col {
                padding-left: 5px;
                padding-right: 5px;
            }

            .l-0 {
                display: none;
            }

            .l-1,
            .l-2,
            .l-2-4,
            .l-3,
            .l-4,
            .l-5,
            .l-6,
            .l-7,
            .l-8,
            .l-9,
            .l-10,
            .l-11,
            .l-12 {
                display: block;
            }

            .l-1 {
                flex: 0 0 8.33333%;
                max-width: 8.33333%;
            }

            .l-2 {
                flex: 0 0 16.66667%;
                max-width: 16.66667%;
            }

            .l-2-4 {
                flex: 0 0 20%;
                max-width: 20%;
            }

            .l-3 {
                flex: 0 0 25%;
                max-width: 25%;
            }

            .l-4 {
                flex: 0 0 33.33333%;
                max-width: 33.33333%;
            }

            .l-5 {
                flex: 0 0 41.66667%;
                max-width: 41.66667%;
            }

            .l-6 {
                flex: 0 0 50%;
                max-width: 50%;
            }

            .l-7 {
                flex: 0 0 58.33333%;
                max-width: 58.33333%;
            }

            .l-8 {
                flex: 0 0 66.66667%;
                max-width: 66.66667%;
            }

            .l-9 {
                flex: 0 0 75%;
                max-width: 75%;
            }

            .l-10 {
                flex: 0 0 83.33333%;
                max-width: 83.33333%;
            }

            .l-11 {
                flex: 0 0 91.66667%;
                max-width: 91.66667%;
            }

            .l-12 {
                flex: 0 0 100%;
                max-width: 100%;
            }

            .l-o-1 {
                margin-left: 8.33333%;
            }

            .l-o-2 {
                margin-left: 16.66667%;
            }

            .l-o-3 {
                margin-left: 25%;
            }

            .l-o-4 {
                margin-left: 33.33333%;
            }

            .l-o-5 {
                margin-left: 41.66667%;
            }

            .l-o-6 {
                margin-left: 50%;
            }

            .l-o-7 {
                margin-left: 58.33333%;
            }

            .l-o-8 {
                margin-left: 66.66667%;
            }

            .l-o-9 {
                margin-left: 75%;
            }

            .l-o-10 {
                margin-left: 83.33333%;
            }

            .l-o-11 {
                margin-left: 91.66667%;
            }
        }

        /* Tablet - PC low resolution */
        @media (min-width: 740px) and (max-width: 1023px) {
            .wide {
                width: 644px;
            }
        }

        /* > PC low resolution */
        @media (min-width: 1024px) and (max-width: 1239px) {
            .wide {
                width: 984px;
            }

            .wide .row {
                margin-left: -12px;
                margin-right: -12px;
            }

            .wide .row.sm-gutter {
                margin-left: -5px;
                margin-right: -5px;
            }

            .wide .col {
                padding-left: 12px;
                padding-right: 12px;
            }

            .wide .row.sm-gutter .col {
                padding-left: 5px;
                padding-right: 5px;
            }

            .wide .l-0 {
                display: none;
            }

            .wide .l-1,
            .wide .l-2,
            .wide .l-2-4,
            .wide .l-3,
            .wide .l-4,
            .wide .l-5,
            .wide .l-6,
            .wide .l-7,
            .wide .l-8,
            .wide .l-9,
            .wide .l-10,
            .wide .l-11,
            .wide .l-12 {
                display: block;
            }

            .wide .l-1 {
                flex: 0 0 8.33333%;
                max-width: 8.33333%;
            }

            .wide .l-2 {
                flex: 0 0 16.66667%;
                max-width: 16.66667%;
            }

            .wide .l-2-4 {
                flex: 0 0 20%;
                max-width: 20%;
            }

            .wide .l-3 {
                flex: 0 0 25%;
                max-width: 25%;
            }

            .wide .l-4 {
                flex: 0 0 33.33333%;
                max-width: 33.33333%;
            }

            .wide .l-5 {
                flex: 0 0 41.66667%;
                max-width: 41.66667%;
            }

            .wide .l-6 {
                flex: 0 0 50%;
                max-width: 50%;
            }

            .wide .l-7 {
                flex: 0 0 58.33333%;
                max-width: 58.33333%;
            }

            .wide .l-8 {
                flex: 0 0 66.66667%;
                max-width: 66.66667%;
            }

            .wide .l-9 {
                flex: 0 0 75%;
                max-width: 75%;
            }

            .wide .l-10 {
                flex: 0 0 83.33333%;
                max-width: 83.33333%;
            }

            .wide .l-11 {
                flex: 0 0 91.66667%;
                max-width: 91.66667%;
            }

            .wide .l-12 {
                flex: 0 0 100%;
                max-width: 100%;
            }

            .wide .l-o-1 {
                margin-left: 8.33333%;
            }

            .wide .l-o-2 {
                margin-left: 16.66667%;
            }

            .wide .l-o-3 {
                margin-left: 25%;
            }

            .wide .l-o-4 {
                margin-left: 33.33333%;
            }

            .wide .l-o-5 {
                margin-left: 41.66667%;
            }

            .wide .l-o-6 {
                margin-left: 50%;
            }

            .wide .l-o-7 {
                margin-left: 58.33333%;
            }

            .wide .l-o-8 {
                margin-left: 66.66667%;
            }

            .wide .l-o-9 {
                margin-left: 75%;
            }

            .wide .l-o-10 {
                margin-left: 83.33333%;
            }

            .wide .l-o-11 {
                margin-left: 91.66667%;
            }
        }

        /* orgation */
        :root {
            --primary-color: #e74026;
            --primary-color-rgba: rgba(232, 64, 38, 0.15);
            --primary-color-hover: #e65d5d;
            --white-color: #fff;
            --black-color: #000;
            --text-color: #333;
            --border-color: #bdbdbd;

            --header-height: 160px;
            --header__navbar-height: 55px;
            --header-with-search: calc(var(--header-height) - var(--header__navbar-height));
            --header-sort-bar-height: 36px;
            --z-index-first: 1;
            --z-index-second: 2;
            --z-index-third: 3;

            --star-gold-color: #FFCE3E;
        }

        .footer {
            border-top: 3px solid var(--primary-color);
            padding-top: 16px;
        }

        .footer__heading {
            font-size: 12px;
            text-transform: uppercase;
            color: var(--text-color);
            padding-bottom: 20px;
        }

        .footer-list {
            padding-left: 0;
            list-style: none;

        }

        .footer-item-link {
            font-size: 12px;
            text-decoration: none;
            color: #737373;
            padding: 4px 0;
            align-items: center;
            text-align: center;
        }

        .footer-item-link:hover {
            color: var(--primary-color);

        }

        .footer-item i {
            font-size: 16px;
            margin: -1px 8px 0 0;
        }

        .footer__download {
            display: flex;
        }

        .footer__download-qr {
            width: 80px;
            border: 1px solid var(--border-color);
        }

        .footer__download-apps {
            flex: 1;
            margin-left: 16px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .footer__download-apps-link {
            color: transparent;
            text-decoration: none;
        }

        .footer__download-apps-chplay {
            height: 24px;
        }

        .footer__download-apps-appstore {
            height: 24px;
        }

        .footer__bottom {
            background-color: #f5f5f5;
            padding: 8px 0;
            margin-top: 24px;
        }

        .footer__text {
            margin: 0;
            font-size: 12px;
            text-align: center;
            color: #737373;
        }
    </style>
    <!-- footer  -->
    <footer class="footer">
        <div class="grid wide footer__content">
            <div class="row">
                <div class="col l-2-4 m-4 c-6">
                    <h3 class="footer__heading">Chăm sóc khách hàng</h3>
                    <ul class="footer-list">
                        <li class="footer-item">
                            <a href="" class="footer-item-link">Trung tâm trợ giúp</a>
                        </li>
                        <li class="footer-item">
                            <a href="" class="footer-item-link">Hoài Nam Mail</a>
                        </li>
                        <li class="footer-item">
                            <a href="" class="footer-item-link">Hướng dẫn mua hàng</a>
                        </li>
                    </ul>
                </div>
                <div class="col l-2-4 m-4 c-6">
                    <h3 class="footer__heading">Giới thiệu</h3>
                    <ul class="footer-list">
                        <li class="footer-item">
                            <a href="" class="footer-item-link">Giới thiệu</a>
                        </li>
                        <li class="footer-item">
                            <a href="" class="footer-item-link">Tuyển dụng</a>
                        </li>
                        <li class="footer-item">
                            <a href="" class="footer-item-link">Điều khoản</a>
                        </li>
                    </ul>
                </div>
                <div class="col l-2-4 m-4 c-6">
                    <h3 class="footer__heading">Theo dõi</h3>
                    <ul class="footer-list">
                        <li class="footer-item">
                            <a href="https://www.facebook.com/profile.php?id=100038246903604" class="footer-item-link">
                                <i class="fa-brands fa-facebook"></i>
                                Facebook</a>
                        </li>
                        <li class="footer-item">
                            <a href="https://www.instagram.com/namhuynhzz/" class="footer-item-link">
                                <i class="fa-brands fa-instagram"></i>
                                Instagram</a>
                        </li>
                        <li class="footer-item">
                            <a href="https://www.linkedin.com/in/john-nam-943a02236/" class="footer-item-link">
                                <i class="fa-brands fa-linkedin"></i>
                                Linked-in</a>
                        </li>
                    </ul>
                </div>
                <div class="col l-2-4 m-4 c-6">
                    <h3 class="footer__heading">Danh mục</h3>
                    <ul class="footer-list">
                        <li class="footer-item">
                            <a href="" class="footer-item-link">ASUS</a>
                        </li>
                        <li class="footer-item">
                            <a href="" class="footer-item-link">DELL</a>
                        </li>
                        <li class="footer-item">
                            <a href="" class="footer-item-link">LENOVO</a>
                        </li>
                    </ul>
                </div>
                <div class="col l-2-4 m-8 c-12">
                    <h3 class="footer__heading">Vào cửa hàng trên ứng dụng</h3>
                    <div class="footer__download">
                        <img src="img/qr.png" alt="" class="footer__download-qr">
                        <div class="footer__download-apps">
                            <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" class="footer__download-apps-link">
                                <img src="img\googleplay.png" alt="Google Play" class="footer__download-apps-chplay">
                            </a>
                            <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" class="footer__download-apps-link">
                                <img src="img\appstore.png" alt="App Store" class="footer__download-apps-appstore">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer__bottom">
            <div class="grid wide">
                <p class="footer__text">© 2023 - Bản quyên thuộc về Hoài Nam</p>
            </div>
        </div>
    </footer>
    </body>

    <!-- Javescript -->

    <script>
        const header = document.querySelector("header")
        window.addEventListener("scroll", function() {
            x = window.pageYOffset
            console.log(x)
            if (x > 0) {
                header.classList.add("sticky")
            } else {
                header.classList.remove("sticky")
            }
        })





        const imgPosition = document.querySelectorAll(".aspect-ratio-169 img")
        const imgContainer = document.querySelector(".aspect-ratio-169")
        const dotItem = document.querySelectorAll(".dot")
        let imgNumber = imgPosition.length
        let index = 0


        imgPosition.forEach(function(image, index) {
            image.style.left = index * 100 + "%"
            dotItem[index].addEventListener("click", function() {
                slider(index)
            })
        })



        function imgSlide() {
            index++;
            if (index >= imgNumber) {
                index = 0;
            }
            slider(index)
        }

        function slider(index) {
            imgContainer.style.left = "-" + index * 100 + "%"
            const dotActive = document.querySelector(".active")
            dotActive.classList.remove("active")
            dotItem[index].classList.add("active")
        }
        setInterval(imgSlide, 3000)
    </script>

    </html>