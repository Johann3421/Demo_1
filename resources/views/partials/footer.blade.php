<!-- ======= Footer ======= -->
<footer class="footer-container">
    <div class="footer-content">
        <!-- 📞 Sección Contáctanos -->
        <div class="footer-section">
            <h3>Contáctanos</h3>
            <p>📧 ventas@sekaitech.com.pe</p>
            <p>
                <img src="https://img.icons8.com/?size=100&id=13800&format=png&color=000000" 
            alt="WhatsApp Icon" class="whatsapp-icon">
            Ubícanos: JR. SAN MARTIN NRO 1458 - Huánuco</p>
            <p>📱 WhatsApp: 933 573 985</p>
            <p>
                <img src="https://img.icons8.com/?size=100&id=uZWiLUyryScN&format=png&color=000000" 
                     alt="WhatsApp Icon" class="whatsapp-icon">
                <a href="https://wa.me/51933573985?text=Hola,%20quisiera%20comunicarme%20con%20el%20área%20de%20VENTAS%20de%20SEKAI%20TECH"
                   target="_blank" class="whatsapp-link">
                   Soporte: Contactar por WhatsApp
                </a>
            </p>
        </div>

        <!-- 🏢 Sección Información -->
        <div class="footer-section">
            <h3>Información</h3>
            <ul>
                <li><a href="#">Quiénes somos</a></li>
                <li><a href="#">Misión y Visión</a></li>
            </ul>
        </div>

        <!-- 🛠 Sección Atención al Cliente -->
        <div class="footer-section">
            <h3>Atención al Cliente</h3>
            <ul>
                <li><a href="#">Soporte técnico</a></li>
                <li><a href="#">Términos y condiciones de garantía</a></li>
            </ul>
        </div>

        <!-- 🗺️ Google Maps -->
        <div class="footer-section footer-map">
            <h3>Nuestra Ubicación</h3>
            <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d982.5308553163068!2d-76.24104303040171!3d-9.923677878346464!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91a7c31c6a35fa09%3A0x55c23baa894315eb!2sSan%20Martin%201458%2C%20Hu%C3%A1nuco%2010001!5e0!3m2!1ses!2spe!4v1741879555530!5m2!1ses!2spe" 
                width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy">
            </iframe>
        </div>
    </div>

    <!-- 📱 Redes Sociales -->
    <div class="footer-social">
        <span>Síguenos en:</span>
        <a href="#" class="social-icon"><i class="fab fa-facebook"></i></a>
        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
        <a href="#" class="social-icon"><i class="fab fa-tiktok"></i></a>
        <a href="#" class="btn-reclamaciones">📖 Libro de Reclamaciones</a>
    </div>

    <!-- 📝 Copyright -->
    <div class="footer-bottom">
        <p>© Copyright SekaiTech - Todos los derechos reservados</p>
    </div>

    <!-- 🐱 Gato de la Suerte Animado -->
    <div class="maneki-neko">
        <img src="{{ asset('images/gato.png') }}" alt="Gato de la Suerte">
    </div>
</footer>

<style>
/* 🐱 Estilos para el Gato de la Suerte */
.footer-container {
    position: relative; /* Mantiene el gato dentro del footer */
}

.maneki-neko {
    position: absolute;
    top: 22%; /* Mueve el gato hasta el borde superior del footer */
    right: 90px;
    width: 100px;
    z-index: 10;
}

.maneki-neko img {
    width: 110%;
    animation: movePaw 1s infinite alternate ease-in-out;
}

/* 🎭 Animación de la pata */

/* 📱 Responsividad para pantallas pequeñas */
@media (max-width: 768px) {
    .maneki-neko {
        width: 80px; /* Reduce el tamaño del gato */
        right: 10px; /* Ajusta la posición */
    }
}

@media (max-width: 480px) {
    .maneki-neko {
        width: 60px; /* Más pequeño en móviles */
        right: 5px;  /* Se acerca más al borde */
        top: 10px;   /* Baja un poco en móviles */
    }
}

</style>
