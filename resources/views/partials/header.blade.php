  <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
              <img src="{{ asset('/Landscape_Logo.png') }}" width="180px">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#top"><i class="fas fa-home me-1"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#pop-culture-news"><i class="fas fa-newspaper me-1"></i> News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#concerts"><i class="fas fa-music me-1"></i> Concerts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#events"><i class="fas fa-calendar-alt me-1"></i> Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link contest-scroll-link" href="#contest-section">
                            <i class="fas fa-trophy me-1"></i> Contest
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact"><i class="fas fa-envelope me-1"></i> Contact</a>
                    </li>
                </ul>
                <!-- <ul class="navbar-nav">
                    <li class="nav-item ms-3">
                        <a class="btn listen-live-btn" href="#" id="navbar-listen-btn" onclick="toggleLiveAudio()">
                            <i class="fas fa-play me-1" id="navbar-play-icon"></i> Listen Live
                        </a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="btn download-app-btn" href="#" id="downloadAppHeaderBtn" data-bs-toggle="modal" data-bs-target="#appDownloadModal">
                            <i class="fas fa-download me-1"></i> Download App
                        </a>
                    </li>
                </ul> -->
            </div>
        </div>
    </nav>

    <!-- Live Radio Player (Hidden) -->
    <div style="display: none;">
        <audio id="live-audio" preload="none" crossorigin="anonymous">
            <source src="{{ config('app.stream_url') }}" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>
    </div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle navbar link clicks
    document.querySelectorAll('.navbar a[href^="#"]').forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            
            // Skip home link or empty hash
            if (href === '#top' || href === '#') return;
            
            e.preventDefault();
            
            // Remove # from href to get the ID
            const targetId = href.substring(1);
            const targetElement = document.getElementById(targetId);
            
            if (targetElement) {
                // Get navbar height
                const navbar = document.querySelector('.navbar');
                const navbarHeight = navbar.offsetHeight;
                
                // Calculate scroll position with offset
                const elementPosition = targetElement.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - navbarHeight;
                
                // Scroll to position
                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
                
                // Update URL
                history.pushState(null, null, href);
            }
        });
    });
});
</script>
<style>
/* Add scroll margin to all sections that are targeted */
#pop-culture-news,
#concerts,
#events,
#contest-section,
#contact {
    scroll-margin-top: 150px; /* Adjust this value based on your navbar height */
}
@media(max-width: 992px) {
    #pop-culture-news,
    #concerts,
    #events,
    #contest-section,
    #contact {
        scroll-margin-top: 450px; /* Adjust for smaller screens */
    }
    #home {
        scroll-margin-top: 0px; /* Adjust for smaller screens */
    }
}
</style>