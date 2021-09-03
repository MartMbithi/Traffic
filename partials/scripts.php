<script src="../public/plugins/jquery/jquery.min.js"></script>
<script src="../public/plugins/popper.js/umd/popper.min.js"></script>
<script src="../public/plugins/bootstrap/js/bootstrap.min.js"></script> <!-- END BASE JS -->
<!-- BEGIN PLUGINS JS -->
<script src="../public/plugins/particles.js/particles.js"></script>
<script>
    $(document).on('theme:init', () => {
        particlesJS.load('auth-header', '../public/js/pages/particles.json');
    })
</script>
<script src="../public/js/theme.js"></script> <!-- END THEME JS -->