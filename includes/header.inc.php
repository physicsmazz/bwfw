<header>
    <nav id="mainNav">
        <ul>
            <!-- items reverse order because floated right -->
            <?php
            if ($page == 'home') {
            echo('<li><a class="current" id="homeLi" href="index.php">HOME</a></li>');
        } else {
            echo('<li><a id="homeLi" href="index.php">HOME</a></li>');
        }
            if ($page == 'product') {
                echo ('<li><a class="current" id="productsLi" href="products.php">PRODUCTS</a></li>');
            } else {
                echo ('<li><a id="productsLi" href="products.php">PRODUCTS</a></li>');
            }
            if ($page == 'contact') {
                echo ('<li><a class="current" id="contactLi" href="contact.php">CONTACT US</a></li>');
            } else {
                echo ('<li><a id="contactLi" href="contact.php">CONTACT US</a></li>');
            }
            ?>

        </ul>
    </nav>
    <section id="shoppingCart">
        <a id="cartIcon" href="cart.php">
            <div id="numItems">2</div>
        </a>
        <a id="cartLink" href="cart.php">shopping cart</a>
    </section>
</header>
