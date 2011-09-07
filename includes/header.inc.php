<header>
    <nav id="mainNav">
        <ul>
            <!-- items reverse order because floated right -->
            <?php
            if ($page == 'home') {
            echo('<li class="current"><a id="homeLi" href="index.php">HOME</a></li>');
        } else {
            echo('<li><a id="homeLi" href="index.php">HOME</a></li>');
        }
            if ($page == 'product') {
                echo ('<li class="current"><a id="productsLi" href="categories.php">PRODUCTS</a></li>');
            } else {
                echo ('<li><a id="productsLi" href="categories.php">PRODUCTS</a></li>');
            }
            if ($page == 'contact') {
                echo ('<li class="current"><a id="contactLi" href="contact.php">CONTACT US</a></li>');
            } else {
                echo ('<li><a id="contactLi" href="contact.php">CONTACT US</a></li>');
            }
            ?>

        </ul>
    </nav>
    <section id="shoppingCart">
        <a id="cartIcon" <?php if ($numItems) echo 'class="items" '?> href="cart.php"></a>
        <a id="cartTab" href="cart.php">shopping cart</a>
    </section>
</header>
