<footer class="footer">

    <div class="container">

        <p>
            © <?php echo date("Y"); ?> TRENZYCH VPN. All Rights Reserved.
        </p>

    </div>

</footer>

<script src="/assets/js/theme.js"></script>
<script src="/assets/js/navbar.js"></script>
<script src="/assets/js/app.js"></script>

</div>

<script>
const observer = new IntersectionObserver((entries)=>{
    entries.forEach(entry=>{
        if(entry.isIntersecting){
            entry.target.classList.add("show");
        }
    });
},{
    threshold:0.15
});

document.querySelectorAll(".animate").forEach((el)=>{
    observer.observe(el);
});
</script>
</body>

</html>
