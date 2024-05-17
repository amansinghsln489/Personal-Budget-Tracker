<style>
.sidebar-menu ul.sidebar-ul {
    max-height: calc(100vh - 100px); /* Adjusted max-height to accommodate padding-bottom */
    overflow-y: auto; /* Only vertical scrollbar */
}

.sidebar {
    overflow: hidden; /* Hide any horizontal overflow */
}
</style>

<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <div class="header-left">
                <a href="{{ route('dashboard') }}" class="logo">
                    <img src="{{ asset('assets/img/logo1.png') }}" width="150" height="40" alt="">
                    <span class="text-uppercase">HRLM</span>
                </a>
            </div>
            <ul class="sidebar-ul">
                <li class="menu-title">Menu</li>
                <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('assets/img/sidebar/icon-1.png') }}" alt="icon">
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- Users Menu -->
                <li class="submenu">
                    <a href="#" class="{{ request()->routeIs('add.user') ||request()->routeIs('view.user') || request()->routeIs('user.edit') ? 'subdrop' : '' }}">
                        <img src="{{ asset('assets/img/sidebar/icon-2.png') }}" alt="icon">
                        <span>User</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="list-unstyled" style="{{ request()->routeIs('add.user') ||request()->routeIs('view.user') || request()->routeIs('user.edit') ? 'display: block;' : 'display: none;' }}">
                        <li class="{{ request()->routeIs('add.user') ? 'active' : '' }}">
                            <a href="{{ route('add.user') }}"><span>Add Users</span></a>
                        </li>
                        @if(request()->routeIs('user.edit'))
                        <li class="active">
                                <a href="{{ route('user.edit', $user->user_id) }}"><span>Edit Profile</span></a>
                            </li>
                        @endif
                        <li class="{{ request()->routeIs('view.user') ? 'active' : '' }}">
                            <a href="{{ route('view.user') }}"><span>View Users</span></a>
                        </li>
                    </ul>
                </li>

                <!-- Internal Leads Menu  -->
                <li class="submenu">
                    <a href="javascript:void(0);" class="noti-dot {{ request()->routeIs('internal-leads.*') ? 'subdrop' : '' }}">
                        <img src="{{ asset('assets/img/sidebar/icon-13.png') }}" alt="icon">
                        <span>Internal Leads</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="list-unstyled" style="{{ request()->routeIs('internal-leads.*') ? 'display: block;' : 'display: none;' }}">
                        <li class="{{ request()->routeIs('internal-leads.index') ? 'active' : '' }}">
                            <a href="{{ route('internal-leads.index') }}"><span>All Internal Leads</span></a>
                        </li>
                        <li class="{{ request()->routeIs('internal-leads.create') ? 'active' : '' }}">
                            <a href="{{ route('internal-leads.create') }}"><span>Add Internal Lead</span></a>
                        </li>
                        <!-- You can add more submenu items as needed -->
                    </ul>
                </li>

                <!-- Configuration Menu -->
                <li class="submenu">
                    <a href="#" class="{{ request()->routeIs('add.technology') || request()->routeIs('add.role') || request()->routeIs('add.leadstatus') ? 'subdrop' : '' }}">
                        <img src="{{ asset('assets/img/sidebar/icon-14.png') }}" alt="icon">
                        <span>Configuration</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="list-unstyled" style="{{ request()->routeIs('add.technology') || request()->routeIs('add.role') || request()->routeIs('add.leadstatus') ? 'display: block;' : 'display: none;' }}">
                        <!-- Technology Menu -->
                        <li class="{{ request()->routeIs('add.technology') ? 'active' : '' }}">
                            <a href="{{ route('add.technology') }}"><span>Add Technology</span></a>
                        </li>
                        <!-- Role Menu -->
                        <li class="{{ request()->routeIs('add.role') ? 'active' : '' }}">
                            <a href="{{ route('add.role') }}"><span>Add Role</span></a>
                        </li>
                        <!-- Lead Status -->
                        <li class="{{ request()->routeIs('add.leadstatus') ? 'active' : '' }}">
                            <a href="{{ route('add.leadstatus') }}"><span>Add Lead Status</span></a>
                        </li>
                    </ul>
                </li>

                <!-- Call History Menu --> 
                <!-- <li class="submenu">
                    <a href="#" class="{{ request()->routeIs('callhistory.*') ? 'subdrop' : '' }}">
                        <img src="{{ asset('assets/img/sidebar/icon-18.png') }}" alt="icon">
                        <span>Call History</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="list-unstyled" style="{{ request()->routeIs('callhistory.*') ? 'display: block;' : 'display: none;' }}">
                        <li class="{{ request()->routeIs('callhistory.show') ? 'active' : '' }}">
                            <a href="{{ route('callhistory.show') }}"><span>View Call History</span></a>
                        </li>
                    
                        <li class="{{ request()->routeIs('callhistory.index') ? 'active' : '' }}">
                            <a href="{{ route('callhistory.index') }}">
                                <span> Add Call History</span>
                            </a>
                        </li>
                    </ul>
                </li> -->
                
                <?php 
                if($user->role == 4 || $user->role == 1){
                ?>

                <!-- Lead Menu --> 
                <!-- <li class="submenu">
                    <a href="#" class="{{ request()->routeIs('add.lead') || request()->routeIs('view.lead') || request()->routeIs('leads.edit') || request()->is('leads/*') ? 'subdrop' : '' }}">
                        <img src="{{ asset('assets/img/sidebar/icon-7.png') }}" alt="icon">
                        <span>Lead</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="list-unstyled" style="{{ request()->routeIs('add.lead') || request()->routeIs('view.lead') || request()->routeIs('leads.edit') || request()->is('leads/*') || request()->routeIs('search.leads') ? 'display: block;' : 'display: none;' }}">
                        <li class="{{ request()->routeIs('add.lead') ? 'active' : '' }}">
                            <a href="{{ route('add.lead') }}"><span>Add Leads</span></a>
                        </li>
                        <li class="{{ request()->routeIs('view.lead') || request()->routeIs('search.leads') ? 'active' : '' }}">
                            <a href="{{ route('view.lead') }}"><span>View All Lead</span></a>
                        </li>
                        @if(request()->routeIs('leads.edit'))
                            <li class="active">
                                <a href="{{ route('leads.edit', $lead->id) }}"><span>Edit Lead</span></a>
                            </li>
                        @endif
                        @if(request()->is('leads/*') && !request()->routeIs('leads.edit'))
                            <li class="active">
                                <a href="{{ url()->current() }}"><span>Show Lead</span></a>
                            </li>
                        @endif
                    </ul>
                </li> -->

                <!-- Vendors Menu -->       
                <!-- <li class="submenu">
                    <a href="#" class="{{ request()->routeIs('vendors.*') ? 'subdrop' : '' }}">
                        <img src="{{ asset('assets/img/sidebar/icon-3.png') }}" alt="icon">
                        <span>Vendors</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="list-unstyled" style="{{ request()->routeIs('vendors.*') ? 'display: block;' : 'display: none;' }}">
                        <li class="{{ request()->routeIs('vendors.index') ? 'active' : '' }}">
                            <a href="{{ route('vendors.index') }}"><span>View Vendors</span></a>
                        </li>
                        @if(Route::currentRouteName() == 'vendors.edit')
                            <li class="active">
                                <a href="{{ route('vendors.edit', $vendor->id) }}"><span>Edit Vendor</span></a>
                            </li>
                        @endif
                        <li class="{{ request()->routeIs('vendors.createVendor') ? 'active' : '' }}">
                            <a href="{{ route('vendors.createVendor') }}"><span>Add Vendor</span></a>
                        </li>
                    </ul>
                </li> -->

                 <!-- add interview -->

                <li class="submenu">
                    <a href="#" class="{{ request()->routeIs('vendors.*') ? 'subdrop' : '' }}">
                        <img src="{{ asset('assets/img/sidebar/icon-3.png') }}" alt="icon">
                        <span>Add Interviewee</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="list-unstyled" style="{{ request()->routeIs('interviewee.*') ? 'display: block;' : 'display: none;' }}">
                        <li class="{{ request()->routeIs('interviewee.index') ? 'active' : '' }}">
                            <a href="{{ route('interviewee.index') }}"><span>View Interviewee</span></a>
                        </li>
                        @if(Route::currentRouteName() == 'vendors.edit')
                            <li class="active">
                                <a href="{{ route('vendors.edit', $vendor->id) }}"><span>Edit Vendor</span></a>
                            </li>
                        @endif
                        <li class="{{ request()->routeIs('interviewee.createInterviewee') ? 'active' : '' }}">
                            <a href="{{ route('interviewee.createInterviewee') }}"><span>Add Interviewee</span></a>
                        </li>
                    </ul>
                </li>


              

                <!-- Company Menu -->
                <!-- <li class="submenu">
                    <a href="#" class="{{ request()->routeIs('add.company') ? 'subdrop' : '' }}">
                        <img src="{{ asset('assets/img/sidebar/icon-19.png') }}" alt="icon">
                        <span>Company</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="list-unstyled" style="{{ request()->routeIs('add.company') ? 'display: block;' : 'display: none;' }}">
                        <li class="{{ request()->routeIs('add.company') ? 'active' : '' }}">
                            <a href="{{ route('add.company') }}"><span>Add Company</span></a>
                        </li>
                    </ul>
                </li> -->




                <!-- Profiles Menu -->
                <!-- <li class="submenu">
                    <a href="#" class="{{ request()->routeIs('profiles.*') ? 'subdrop' : '' }}">
                        <img src="{{ asset('assets/img/sidebar/icon-2.png') }}" alt="icon">
                        <span>Profiles</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="list-unstyled" style="{{ request()->routeIs('profiles.*') ? 'display: block;' : 'display: none;' }}">
                        <li class="{{ request()->routeIs('profiles.index') ? 'active' : '' }}">
                            <a href="{{ route('profiles.index') }}"><span>View Profiles</span></a>
                        </li>
                        @if(Route::currentRouteName() == 'profiles.edit')
                            <li class="active">
                                <a href="{{ route('profiles.edit', $profile->id) }}"><span>Edit Profile</span></a>
                            </li>
                        @endif
                        <li class="{{ request()->routeIs('profiles.create') ? 'active' : '' }}">
                            <a href="{{ route('profiles.create') }}"><span>Add Profile</span></a>
                        </li>
                    </ul>
                </li> -->

                <!-- Old DataBase Menu -->
                <!-- <li class="submenu">
                    <a href="javascript:void(0);" class="noti-dot {{ request()->routeIs('old.records') || request()->routeIs('magento') || request()->routeIs('java') || request()->routeIs('Python') ? 'subdrop' : '' }}">
                        <img src="{{ asset('assets/img/sidebar/icon-13.png') }}" alt="icon">
                        <span>Old DataBase</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="list-unstyled" style="{{ request()->routeIs('old.records') || request()->routeIs('magento') || request()->routeIs('java') || request()->routeIs('Python') ? 'display: block;' : 'display: none;' }}">
                        <li class="{{ request()->routeIs('magento') ? 'active' : '' }}">
                            <a href="{{ route('magento') }}"><span>Magento</span></a>
                        </li>
                        <li class="{{ request()->routeIs('java') ? 'active' : '' }}">
                            <a href="{{ route('java') }}"><span>Java</span></a>
                        </li>
                        <li class="{{ request()->routeIs('Python') ? 'active' : '' }}">
                            <a href="{{ route('Python') }}"><span>Python</span></a>
                        </li>
                    </ul>
                </li> -->

             

                <?php
                }
                ?>
            </ul>
        </div>
    </div>
</div>
