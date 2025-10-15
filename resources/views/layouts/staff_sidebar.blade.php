@if(Auth::user()->roleType() === 'Staff')
        <li class="menu-item">
            <a
                href="{{ route('home') }}"
                class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-smile"></i>
                <div class="text-truncate" data-i18n="Email">Dashboards</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-envelope"></i>
                <div class="text-truncate" data-i18n="Layouts">Service Order</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('staff.service_order.inprogress') }}" class="menu-link">
                        <div class="text-truncate" data-i18n="Without menu">In-progress</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('staff.service_order.completed') }}" class="menu-link">
                        <div class="text-truncate" data-i18n="Without navbar">Completed </div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('staff.service_order.cancelled') }}" class="menu-link">
                        <div class="text-truncate" data-i18n="Without navbar">Cancelled </div>
                    </a>
                </li>

            </ul>
        </li>
        <li class="menu-item">
            <a
                href="{{ route('staff.tickets.index') }}"
                class="menu-link">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div class="text-truncate" data-i18n="Email">Support Tickets</div>
            </a>
        </li>
        @endif