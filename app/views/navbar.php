<nav class="navbar">
        <div class="navbar-left">
            <a href="?action=dashboard" class="logo">Moja Strona</a>
        </div>
        <div class="navbar-right">
            <ul>
                <li>
                    <div class="dropdown">
                        <button class="dropdown-btn">
                            <?php echo $_SESSION['username']; ?>
                        </button>
                        <div class="dropdown-content">
                            <a >id: <?php echo $_SESSION['user_id']; ?></a>
                            <a href="?action=dashboard">Twoje hasła</a>
                            <a href="?action=addPassword">Dodaj nowe</a>
                            <a href="#" onclick="document.getElementById('logout-form').submit();return false;">Wyloguj</a>
                            <form id="logout-form" action="?action=logout"method="POST" style="display:none">
                                <input type="hidden" name="logout" value="true">
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>