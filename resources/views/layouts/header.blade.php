<header class="header">
    <nav class="header__nav">
        <a href='/'><img src="Images/1.svg" alt="" class="header__nav__logo"></a>

        <ul class="header__nav__navbar">
            <li><a href="#">За коса</a></li>
            <li><a href="#">Шапки</a></li>
            <li><a href="#">Бижута</a></li>
            <li><a href="#">Чанти</a></li>
            <li><a href="#">Уют</a></li>
            <li><a href="#">Дрехи</a></li>
            <li><a href="#">За нас</a></li>
        </ul>

        <ul class="header__nav__navbar__user">
            @if (!Auth::check())<li><a href='/login'><img src="fontawesome-free-5.15.1-web/svgs/solid/sign-in-alt.svg" alt=""></a></li>
            @elseif ($user->is_admin)<li><a href='/admin'><img class="header__nav__navbar__user__adminmenu__img" src="fontawesome-free-5.15.1-web/svgs/solid/hammer.svg" alt=""></a></li>
            @elseif (!$user->is_admin)
            <li><a href="/orders"><img src="fontawesome-free-5.15.1-web/svgs/solid/list.svg" alt=""></a></li>
            <li><a href="/cart"><img src="fontawesome-free-5.15.1-web/svgs/solid/shopping-cart.svg" alt=""></a></li>
            @endif
            @if (Auth::check())<li><a href="#"><img src="fontawesome-free-5.15.1-web/svgs/solid/door-open.svg" alt=""></a></li>
            @endif
        </ul>
    </nav>
</header>