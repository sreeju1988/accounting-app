@if(Auth::user()->roleType() === 'Agent')
        <li class="menu-item">
            <a
                href="{{ route('home') }}"
                class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-smile"></i>
                <div class="text-truncate" data-i18n="Email">Dashboards</div>
            </a>
        </li>
        <li class="menu-item">
            <a
                href="{{ route('agent.services.index') }}"
                class="menu-link">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div class="text-truncate" data-i18n="Email">Services</div>
            </a>
        </li>

        <li class="menu-item">
            <a
                href="{{ route('agent.bookings.index') }}"
                class="menu-link">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div class="text-truncate" data-i18n="Email">Services Order</div>
            </a>
        </li>

        <li class="menu-item">
            <a
                href="{{ route('agent.faqs.index') }}"
                class="menu-link">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div class="text-truncate" data-i18n="Email">Faq</div>
            </a>
        </li>

        <li class="menu-item">
            <a
                href="{{ route('agent.blogs.index') }}"
                class="menu-link">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div class="text-truncate" data-i18n="Email">Blog</div>
            </a>
        </li>

        <li class="menu-item">
            <a
                href="{{ route('agent.news.index') }}"
                class="menu-link">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div class="text-truncate" data-i18n="Email">News</div>
            </a>
        </li>

         <li class="menu-item">
            <a
                href="{{ route('agent.tickets.index') }}"
                class="menu-link">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div class="text-truncate" data-i18n="Email">Support Tickets</div>
            </a>
        </li>
        
        @endif