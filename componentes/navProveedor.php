<?php
$route = base64_decode($_GET['pid']);
?>
<script>
    
</script>
<div class="l-navbar" id="nav-bar">
    <nav class="nav">
        <div>
            <a href=" ?pid=<?=base64_encode("paginas/sesionProveedor.php")?>" class="nav_logo">
                <span class="material-symbols-rounded nav_logo-icon">layers</span>
                <span class="nav_logo-name">BBBootstrap</span>
            </a>
            <div class="nav_list">
                <a href=" ?pid=<?=base64_encode("paginas/sesionProveedor.php")?>" class="nav_link <?= ($route=="paginas/sesionProveedor.php")?"active":"" ?>">
                    <span class="material-symbols-rounded nav_icon">Home</span>
                    <span class="nav_name">Home</span>
                </a>
                <a href=" ?pid=<?=base64_encode("paginas/eventos.php")?>" class="nav_link <?= ($route=="paginas/eventos.php")?"active":"" ?>">
                    <span class="material-symbols-rounded nav_icon">local_activity</span>
                    <span class="nav_name">Users</span>
                </a>
            </div>
        </div>
        <div class="nav_user">
            <button class="nav_link dropdown-toggle" id="userDropdown" onclick="window.location.href='index.php?cerrarSesion=true';">
                <span class="material-symbols-rounded nav_icon">person</span>
                <span class="nav_name">Cuenta</span>
            </button>
        </div>
    </nav>
</div>
<style>
    .nav_user {
        position: relative;
        display: inline-block;
        width: 100%;
        text-align: center;
    }

    .dropdown-toggle {
        background: none;
        border: none;
        cursor: pointer;
        width: 100%;
        text-align: left;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        background: white;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        right: 0;
        min-width: 150px;
        z-index: 1000;
        border-radius: 5px;
    }

</style>

