<section id="contact" data-aos="fade-up">
    <div class="container">
        <h2>Contacto</h2>
        <form id="contact-form" action="/back/envio-formulario.php" method="post">
            <label for="name">Nombre:</label>
            <input type="text" id="name" name="name" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="subject">Asunto:</label>
            <input type="text" id="subject" name="subject" required>
            <label for="message">Mensaje:</label>
            <textarea id="message" name="message" required></textarea>

            <button class="g-recaptcha"
                    data-sitekey="CLAVE DE SITIO"
                    data-callback="onSubmit"
                    data-action="submit">Enviar</button>
        </form>
    </div>
</section>

<script src="https://www.google.com/recaptcha/api.js"></script>
<script>
    function onSubmit(token) {
        document.getElementById("contact-form").submit();
    }
</script>
