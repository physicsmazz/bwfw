<header>
    <h3 id="phoneNumber">Toll Free 888.555.5555</h3>
    <nav id="mainNav">
        <ul>
            <!-- items reverse order because floated right -->


            <?php
            if($page == 'contact'){
                echo ('<li class="current"><a id="contactLi" href="contact.php">CONTACT US</a></li>');
            }else{
                echo ('<li><a id="contactLi" href="contact.php">CONTACT US</a></li>');
            }
            if($page == 'about'){
                echo ('<li class="current"><a id="faqLi" href="faq.php">FAQs</a></li>');
            }else{
                echo ('<li><a id="faqLi" href="faq.php">FAQs</a></li>');
            }
            if($page == 'product'){
                echo ('<li class="current"><a id="productsLi" href="categories.php">PRODUCTS</a></li>');
            }else{
                echo ('<li><a id="productsLi" href="categories.php">PRODUCTS</a></li>');
            }
            if($page == 'home'){
                echo('<li class="current"><a id="homeLi" href="index.php">HOME</a></li>');
            }else{
                echo('<li><a id="homeLi" href="index.php">HOME</a></li>');
            }
            ?>

        </ul>
    </nav>
    <section id="shoppingCart">
        <a id="cartIcon" <?php if($numItems) echo 'class="items" '?> href="cart.php"></a>
        <a id="cartTab" href="cart.php">shopping cart</a>
    </section>
    <h3 id="restEase"><img src="imgs/restease.png" alt="Featuring Rest Ease mattress encasements"></h3>
    <h4 id="lockingSystem">Stay Tight Sleep Tight Locking System</h4>
    <h1>BED BUG MATTRESS COVERS</h1>
    <h3 id="buyToday"><img src="imgs/buytoday.png" alt="Buy Today and get 20% off"></h3>
    <h2>Rest with ease, we have you covered</h2>
    <img id="bestPriceLogo" src="imgs/logo.png" alt="Best Price Bed Bug Mattress Covers">
</header>
