<script>
    $('.widget-pg-product-carousel-slick').slick({
        dots: true,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });
</script>
<style>
.slick-slide-img-wrapper img{
  object-fit : cover;
  object-position : center center;
  width : 100%;
  height : 300px;
}
</style>
<div class="widget-pg-product-carousel">
    <div class="widget-pg-product-carousel-slick">
        <?php
        for ($i = 0; $i < 10; $i++) {
            $colors = array("red", "green", "blue", "yellow", "magenta", "cyan", "mint", "gray");
            $k = array_rand($colors);
            $color = $colors[$k];

            ?>
            <div class="slick-carousel-item">
                <div class="slick-slide-img-wrapper">
                    <a href="#">
                        <img src="https://place-hold.it/400x300/<?php echo $color; ?>" />
                    </a>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
