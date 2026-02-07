@php
    $footer = App\Models\Footer::getFooter();

    // Check if any contact info link is visible
    $hasAddress = $footer->address !== null && $footer->address !== '' && $footer->address !== '#';
    $hasFrequency = $footer->frequency !== null && $footer->frequency !== '' && $footer->frequency !== '#';
    $hasContactInfo = $hasAddress || $hasFrequency;
@endphp

<!-- Footer -->
<footer>
    <div class="container">
        <div class="row g-5">
            <!-- When Contact Info is visible, show 3 columns normally -->
            @if($hasContactInfo)
                    <div class="col-md-4">
                        <div class="footer-column">
                            <h3 class="brand-font">{{ $footer->brand_name }}</h3>
                            <p>{{ $footer->description }}</p>
                            <div class="social-links">
                                @if($footer->facebook_url && $footer->facebook_url != '#')
                                    <a href="{{ $footer->facebook_url }}" title="Facebook" target="_blank" rel="noopener noreferrer"><i class="fab fa-facebook-f"></i></a>
                                @endif
                                @if($footer->instagram_url && $footer->instagram_url != '#')
                                    <a href="{{ $footer->instagram_url }}" title="Instagram" target="_blank" rel="noopener noreferrer"><i class="fab fa-instagram"></i></a>
                                @endif
                                @if($footer->twitter_url && $footer->twitter_url != '#')
                                    <a href="{{ $footer->twitter_url }}" title="Twitter" target="_blank" rel="noopener noreferrer"><i class="fab fa-twitter"></i></a>
                                @endif
                                @if($footer->youtube_url && $footer->youtube_url != '#')
                                    <a href="{{ $footer->youtube_url }}" title="YouTube" target="_blank" rel="noopener noreferrer"><i class="fab fa-youtube"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="footer-column">
                            <h3>Quick Links</h3>
                            <ul class="list-unstyled footer-links">
                                <!-- Home Link - Scrolls to top -->
                                <li><a href="#" onclick="event.preventDefault(); window.scrollTo({top: 0, behavior: 'smooth'});"><i class="fas fa-chevron-right me-2"></i> {{ $footer->home_link_text }}</a></li>

                                <!-- News Link - Scrolls to pop-culture-news section -->
                                <li><a href="#pop-culture-news"><i class="fas fa-chevron-right me-2"></i> {{ $footer->news_link_text }}</a></li>

                                <!-- Other links remain unchanged -->
                                <li><a href="{{ $footer->concerts_link_url }}"><i class="fas fa-chevron-right me-2"></i> {{ $footer->concerts_link_text }}</a></li>
                                <li><a href="{{ $footer->events_link_url }}"><i class="fas fa-chevron-right me-2"></i> {{ $footer->events_link_text }}</a></li>
                                <li><a href="{{ $footer->contact_link_url }}"><i class="fas fa-chevron-right me-2"></i> {{ $footer->contact_link_text }}</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="footer-column">
                            <h3>Contact Info</h3>
                            <ul class="list-unstyled footer-links">
                                @if($hasAddress)
                                    <li>
                                        <a href="#">
                                            <i class="fas fa-map-marker-alt me-2"></i> {{ $footer->address }}
                                        </a>
                                    </li>
                                @endif

                                @if($hasFrequency)
                                    <li>
                                        <a href="#">
                                            <i class="fas fa-broadcast-tower me-2"></i> Frequency: {{ $footer->frequency }}
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>

                <!-- When Contact Info is NOT visible, center the 2 columns -->
            @else
                <div class="col-md-3"></div> <!-- Left spacer column -->

                <div class="col-md-3">
                    <div class="footer-column">
                        <h3 class="brand-font">{{ $footer->brand_name }}</h3>
                        <p>{{ $footer->description }}</p>
                        <div class="social-links">
                            @if($footer->facebook_url && $footer->facebook_url != '#')
                                <a href="{{ $footer->facebook_url }}" title="Facebook" target="_blank" rel="noopener noreferrer"><i class="fab fa-facebook-f"></i></a>
                            @endif
                            @if($footer->instagram_url && $footer->instagram_url != '#')
                                <a href="{{ $footer->instagram_url }}" title="Instagram" target="_blank" rel="noopener noreferrer"><i class="fab fa-instagram"></i></a>
                            @endif
                            @if($footer->twitter_url && $footer->twitter_url != '#')
                                <a href="{{ $footer->twitter_url }}" title="Twitter" target="_blank" rel="noopener noreferrer"><i class="fab fa-twitter"></i></a>
                            @endif
                            @if($footer->youtube_url && $footer->youtube_url != '#')
                                <a href="{{ $footer->youtube_url }}" title="YouTube" target="_blank" rel="noopener noreferrer"><i class="fab fa-youtube"></i></a>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="footer-column">
                        <h3>Quick Links</h3>
                        <ul class="list-unstyled footer-links">
                            <!-- Home Link - Scrolls to top -->
                            <li><a href="#" onclick="event.preventDefault(); window.scrollTo({top: 0, behavior: 'smooth'});"><i class="fas fa-chevron-right me-2"></i> {{ $footer->home_link_text }}</a></li>

                            <!-- News Link - Scrolls to pop-culture-news section -->
                            <li><a href="#pop-culture-news"><i class="fas fa-chevron-right me-2"></i> {{ $footer->news_link_text }}</a></li>

                            <!-- Other links remain unchanged -->
                            <li><a href="{{ $footer->concerts_link_url }}"><i class="fas fa-chevron-right me-2"></i> {{ $footer->concerts_link_text }}</a></li>
                            <li><a href="{{ $footer->events_link_url }}"><i class="fas fa-chevron-right me-2"></i> {{ $footer->events_link_text }}</a></li>
                            <li><a href="{{ $footer->contact_link_url }}"><i class="fas fa-chevron-right me-2"></i> {{ $footer->contact_link_text }}</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3"></div> <!-- Right spacer column -->
            @endif
        </div>
        
        <div class="copyright">
            &copy; {{ $footer->copyright_text }}
        </div>
    </div>
</footer>