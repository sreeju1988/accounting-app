@if(Auth::user()->roleType() === 'Admin')
        <li class="menu-item">
            <a
                href="{{ route('home') }}"
                class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-smile"></i>
                <div class="text-truncate" data-i18n="Email">Dashboards</div>
            </a>
        </li>

        <!-- Layouts Staff Management -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-envelope"></i>
                <div class="text-truncate" data-i18n="Layouts">Staff Management</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('admin.invitations.index') }}" class="menu-link">
                        <div class="text-truncate" data-i18n="Without menu">Invite Staff</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.staff.index') }}" class="menu-link">
                        <div class="text-truncate" data-i18n="Without navbar">Staff List</div>
                    </a>
                </li>

            </ul>
        </li>
         <!-- Layouts Agent Management -->
          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-envelope"></i>
                <div class="text-truncate" data-i18n="Layouts">Agent Management</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('admin.invitations.agent.index') }}" class="menu-link">
                        <div class="text-truncate" data-i18n="Without menu">Invite Agent</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.agents.index') }}" class="menu-link">
                        <div class="text-truncate" data-i18n="Without navbar">Agent List</div>
                    </a>
                </li>

            </ul>
        </li>

        <li class="menu-item">
            <a
                href="{{ route('admin.document-rules.index') }}"
                class="menu-link">
                <i class="menu-icon tf-icons bx bx-file"></i>
                <div class="text-truncate" data-i18n="Email">Document Management</div>
            </a>
        </li>

        <li class="menu-item">
            <a
                href="{{ route('admin.services.index') }}"
                class="menu-link">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div class="text-truncate" data-i18n="Email">Service List</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-envelope"></i>
                <div class="text-truncate" data-i18n="Layouts">Service Order</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('admin.service_order.inprogress') }}" class="menu-link">
                        <div class="text-truncate" data-i18n="Without menu">In-progress</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.service_order.completed') }}" class="menu-link">
                        <div class="text-truncate" data-i18n="Without navbar">Completed </div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.service_order.cancelled') }}" class="menu-link">
                        <div class="text-truncate" data-i18n="Without navbar">Cancelled </div>
                    </a>
                </li>

            </ul>
        </li>

        <li class="menu-item">
            <a
                href="{{ route('admin.faqs.index') }}"
                class="menu-link">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div class="text-truncate" data-i18n="Email">Faq</div>
            </a>
        </li>

        <li class="menu-item">
            <a
                href="{{ route('admin.blogs.index') }}"
                class="menu-link">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div class="text-truncate" data-i18n="Email">Blog</div>
            </a>
        </li>

        <li class="menu-item">
            <a
                href="{{ route('admin.news.index') }}"
                class="menu-link">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div class="text-truncate" data-i18n="Email">News</div>
            </a>
        </li>

          <li class="menu-item">
            <a
                href="{{ route('tickets.index') }}"
                class="menu-link">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div class="text-truncate" data-i18n="Email">Support Tickets</div>
            </a>
        </li>

        @endif