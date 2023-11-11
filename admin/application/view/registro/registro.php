<!DOCTYPE html>
<html  lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
    <title>Viabo | Registro</title>

    <meta name="description" content="Pagina para dar de altas tarjetas viabo" />
    <meta name="keywords" content="viabo card" />
    <meta name="author" content="Inbtwn" />

    <meta property="og:url" content="" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="" />
    <meta property="og:description" content="" />
    <meta property="og:image" content="" />
    <meta property="og:image:secure_url" content="" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image:width" content="400" />
    <meta property="og:image:height" content="287" />
    <meta property="og:image:alt" content="" />
    <link href="/admin/favicon.png" rel="icon" type="image/png" />
    <link href="/admin/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/admin/css/register.css?<?php echo time(); ?>" rel="stylesheet" />
</head>

<body>
<!-- ======= Header ======= -->
<header id="header" class="d-flex align-items-center">
    <div class="container d-flex flex-column align-items-center">

        <h1>¡Próximamente!</h1>
        <h2>Estamos trabajando en algo increíble. ¡Vuelve pronto!</h2>
        <h1 style="margin-bottom: 24px">🚀</h1>
        <div class="countdown d-flex justify-content-center" data-count="2023/12/1">
            <div>
                <h3>%d</h3>
                <h4>Dias</h4>
            </div>
            <div>
                <h3>%h</h3>
                <h4>Horas</h4>
            </div>
            <div>
                <h3>%m</h3>
                <h4>Minutos</h4>
            </div>
            <div>
                <h3>%s</h3>
                <h4>Segundos</h4>
            </div>
        </div>



    </div>
</header><!-- End #header -->


<!-- ======= Footer ======= -->
<footer id="footer">
    <div class="container">
        <div class="copyright">
            &copy; Copyright <strong><span>Viabo 2023</span></strong>. Todos los derechos reservados
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/comingsoon-free-html-bootstrap-template/ -->
            Ven y conoce nuestros servicios en: <a href="https://viabo.com/">Viabo.com</a>
        </div>
    </div>
</footer><!-- End #footer -->

<script src="/admin/bower_components/bootstrap/dist/css/bootstrap.min.js" type="text/javascript"></script>

<script>
    /**
     * Easy selector helper function
     */
    const select = (el, all = false) => {
        el = el.trim()
        if (all) {
            return [...document.querySelectorAll(el)]
        } else {
            return document.querySelector(el)
        }
    }

    /**
     * Easy event listener function
     */
    const on = (type, el, listener, all = false) => {
        let selectEl = select(el, all)
        if (selectEl) {
            if (all) {
                selectEl.forEach(e => e.addEventListener(type, listener))
            } else {
                selectEl.addEventListener(type, listener)
            }
        }
    }

    /**
     * Easy on scroll event listener
     */
    const onscroll = (el, listener) => {
        el.addEventListener('scroll', listener)
    }

    /**
     * Back to top button
     */
    let backtotop = select('.back-to-top')
    if (backtotop) {
        const toggleBacktotop = () => {
            if (window.scrollY > 100) {
                backtotop.classList.add('active')
            } else {
                backtotop.classList.remove('active')
            }
        }
        window.addEventListener('load', toggleBacktotop)
        onscroll(document, toggleBacktotop)
    }

    /**
     * Countdown timer
     */
    let countdown = select('.countdown');
    const output = countdown.innerHTML;

    const countDownDate = function() {
        let timeleft = new Date(countdown.getAttribute('data-count')).getTime() - new Date().getTime();

        let days = Math.floor(timeleft / (1000 * 60 * 60 * 24));
        let hours = Math.floor((timeleft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        let minutes = Math.floor((timeleft % (1000 * 60 * 60)) / (1000 * 60));
        let seconds = Math.floor((timeleft % (1000 * 60)) / 1000);

        countdown.innerHTML = output.replace('%d', days).replace('%h', hours).replace('%m', minutes).replace('%s', seconds);
    }
    countDownDate();
    setInterval(countDownDate, 1000);
</script>

</body>
</html>
