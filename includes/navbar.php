<?php
if (!isset($logo) && isset($db)) {
    $stmt = $db->prepare("
        SELECT setting_value
        FROM settings
        WHERE setting_key='logo'
        LIMIT 1
    ");
    $result = $stmt->execute()->fetchArray(SQLITE3_ASSOC);
    $logo = $result['setting_value'] ?? 'default-logo.png';
}
?>

<nav class="navbar">

<div class="container nav-wrap">

<a href="/index.php" class="logo">
    <img src="/assets/images/<?php echo htmlspecialchars($logo ?? 'default-logo.png'); ?>" alt="TRENZYCH VPN">
    <span>TRENZYCH VPN</span>
</a>

<button class="menu-toggle" id="menuToggle">
    ☰
</button>

<ul class="nav-menu" id="navMenu">

    <li><a href="/index.php">🏠 Home</a></li>

    <li><a href="/free.php">🔓 Free VPN Key</a></li>

    <li><a href="/vip.php">💎 VIP Paid Plan</a></li>

    <li><a href="/downloads.php">⬇️ Downloads</a></li>

    <li><a href="/status.php">📊 Status</a></li>

<li><a href="/support.php">💬 Support</a></li>

    <li>
        <button id="themeToggle" class="theme-btn">
            🌙
        </button>
    </li>

</ul>

</div>

</nav>

<style>

.navbar{
    position:sticky;
    top:0;
    z-index:1000;

    backdrop-filter:blur(16px);

    background:rgba(2,6,23,.75);

    border-bottom:1px solid var(--border);
}

.nav-wrap{
    display:flex;
    align-items:center;
    justify-content:space-between;

    height:72px;
}

.logo{
    display:flex;
    align-items:center;
    gap:12px;

    font-size:20px;
    font-weight:800;
}

.logo img{
    width:42px;
    height:42px;
    object-fit:contain;
}.nav-menu{
    display:flex;
    align-items:center;
    gap:22px;
    list-style:none;
}

.nav-menu a{
    color:var(--text);
    font-weight:600;
    transition:color var(--transition);
}

.nav-menu a:hover{
    color:var(--primary);
}

.theme-btn{
    width:42px;
    height:42px;

    border:none;
    border-radius:50%;

    cursor:pointer;

    background:var(--surface);

    color:var(--text);

    font-size:18px;

    transition:all var(--transition);
}

.theme-btn:hover{
    background:var(--primary);
    color:#fff;
}

.menu-toggle{
    display:none;

    border:none;

    background:none;

    color:var(--text);

    font-size:28px;

    cursor:pointer;
}

@media (max-width:900px){

.nav-menu{

    display:none;

    position:absolute;

    top:72px;

    left:0;

    width:100%;

    background:var(--surface);

    flex-direction:column;

    padding:20px;

    gap:18px;

    border-bottom:1px solid var(--border);

}

.nav-menu.active{
    display:flex;
}

.menu-toggle{
    display:block;
}

}</style>

<script>

const menuToggle = document.getElementById("menuToggle");
const navMenu = document.getElementById("navMenu");

if(menuToggle){
    menuToggle.addEventListener("click",()=>{
        navMenu.classList.toggle("active");
    });
}

const themeToggle=document.getElementById("themeToggle");

function applyTheme(theme){

    if(theme==="auto"){

        if(window.matchMedia("(prefers-color-scheme: dark)").matches){
            document.documentElement.removeAttribute("data-theme");
            themeToggle.textContent="🌙";
        }else{
            document.documentElement.setAttribute("data-theme","light");
            themeToggle.textContent="☀️";
        }

    }else if(theme==="light"){

        document.documentElement.setAttribute("data-theme","light");
        themeToggle.textContent="☀️";

    }else{

        document.documentElement.removeAttribute("data-theme");
        themeToggle.textContent="🌙";

    }

    localStorage.setItem("theme",theme);
}

const savedTheme=localStorage.getItem("theme")||"dark";

applyTheme(savedTheme);

themeToggle.addEventListener("click",()=>{

    const current=localStorage.getItem("theme")||"dark";

    if(current==="dark"){
        applyTheme("light");
    }else{
        applyTheme("dark");
    }

});

// Mobile Menu
const menuToggle = document.getElementById("menuToggle");
const navMenu = document.getElementById("navMenu");

if (menuToggle && navMenu) {
    menuToggle.addEventListener("click", () => {
        navMenu.classList.toggle("active");

        if (navMenu.classList.contains("active")) {
            menuToggle.textContent = "✕";
        } else {
            menuToggle.textContent = "☰";
        }
    });
}

</script>
