<div id="wrap">
    <header>
        <div class="inner relative">
            <a class="logo" href="https://www.freshdesignweb.com"><img src="images/logo.png" alt="fresh design web"></a>
            <a id="menu-toggle" class="button dark" href="#"><i class="icon-reorder"></i></a>
            <nav id="navigation">
                <ul id="main-menu">
                    <li class="current-menu-item"><a href="https://www.freshdesignweb.com">Home</a></li>
                    <li class="parent">
                        <a href="https://www.freshdesignweb.com/responsive-drop-down-menu-jquery-css3-using-icon-symbol/">Features</a>
                        <ul class="sub-menu">
                            <li><a href="https://www.freshdesignweb.com/responsive-drop-down-menu-jquery-css3-using-icon-symbol/"><i class="icon-wrench"></i> Elements</a></li>
                            <li><a href="https://www.freshdesignweb.com/responsive-drop-down-menu-jquery-css3-using-icon-symbol/"><i class="icon-credit-card"></i>  Pricing Tables</a></li>
                            <li><a href="https://www.freshdesignweb.com/responsive-drop-down-menu-jquery-css3-using-icon-symbol/"><i class="icon-gift"></i> Icons</a></li>
                            <li>
                                <a class="parent" href="#"><i class="icon-file-alt"></i> Pages</a>
                                <ul class="sub-menu">
                                    <li><a href="https://www.freshdesignweb.com/responsive-drop-down-menu-jquery-css3-using-icon-symbol/">Full Width</a></li>
                                    <li><a href="https://www.freshdesignweb.com/responsive-drop-down-menu-jquery-css3-using-icon-symbol/">Left Sidebar</a></li>
                                    <li><a href="https://www.freshdesignweb.com/responsive-drop-down-menu-jquery-css3-using-icon-symbol/">Right Sidebar</a></li>
                                    <li><a href="https://www.freshdesignweb.com/responsive-drop-down-menu-jquery-css3-using-icon-symbol/">Double Sidebar</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="https://www.freshdesignweb.com/responsive-drop-down-menu-jquery-css3-using-icon-symbol/">Portfolio</a></li>
                    <li class="parent">
                        <a href="https://www.freshdesignweb.com/responsive-drop-down-menu-jquery-css3-using-icon-symbol/">Blog</a>
                        <ul class="sub-menu">
                            <li><a href="https://www.freshdesignweb.com/responsive-drop-down-menu-jquery-css3-using-icon-symbol/">Large Image</a></li>
                            <li><a href="https://www.freshdesignweb.com/responsive-drop-down-menu-jquery-css3-using-icon-symbol/">Medium Image</a></li>
                            <li><a href="https://www.freshdesignweb.com/responsive-drop-down-menu-jquery-css3-using-icon-symbol/">Masonry</a></li>
                            <li><a href="https://www.freshdesignweb.com/responsive-drop-down-menu-jquery-css3-using-icon-symbol/">Double Sidebar</a></li>
                            <li><a href="https://www.freshdesignweb.com/responsive-drop-down-menu-jquery-css3-using-icon-symbol/">Single Post</a></li>
                        </ul>
                    </li>
                    <li><a href="https://www.freshdesignweb.com/responsive-drop-down-menu-jquery-css3-using-icon-symbol/">Contact</a></li>
                </ul>
            </nav>
            <div class="clear"></div>
        </div>
    </header> 
</div>
<script type="text/javascript">
    $(document).ready(function () {

        /* MAIN MENU */
        $('#main-menu > li:has(ul.sub-menu)').addClass('parent');
        $('ul.sub-menu > li:has(ul.sub-menu) > a').addClass('parent');

        $('#menu-toggle').click(function () {
            $('#main-menu').slideToggle(300);
            return false;
        });

        $(window).resize(function () {
            if ($(window).width() > 700) {
                $('#main-menu').removeAttr('style');
            }
        });

    });
</script>