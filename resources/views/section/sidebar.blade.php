<?php
// Function to check if a route is active
function isActiveRoute($routeName)
{
 
    return request()->routeIs($routeName) ? 'active' : '';
}
 
?>
 
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
 
                <li class="{{ isActiveRoute('dashboard') }}">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('assets/img/sidebar/icon-1.png') }}" alt="icon">
                        <span>Dashboard</span>
                    </a>
                </li>
 
                <!-- <li class="submenu">
                    <a href="#">
                        <img src="{{ asset('assets/img/sidebar/icon-18.png') }}" alt="icon">
                        <span> Call History</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="list-unstyled" style="display: none;">
                        <li><a href="{{ route('callhistory.index') }}" class="{{ isActiveRoute('callhistory.index') }}"><span>Add Call History</span></a></li>
                        <li><a href="{{ route('callhistory.show') }}" class="{{ isActiveRoute('callhistory.show') }}" ><span>View Call History</span></a></li>
                    </ul>
                </li> -->
 
 
                <?php
               
                if($user->role == 2 || $user->role == 1){
                ?>
                <!-- Leads Menu -->
                <!-- <li class="submenu">
                    <a href="#"><img src="{{ asset('assets/img/sidebar/icon-7.png') }}" alt="icon"><span> Lead</span>
                        <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled" style="display: none;">
                       
                        <li><a href="{{ route('add.lead') }}" class="{{ request()->routeIs('add.lead') ? 'active' : '' }}"><span>Add Leads</span></a></li>
 
                        <li><a href="{{ route('view.lead') }}" class="{{ request()->routeIs('view.lead') ? 'active' : '' }}"><span>View All Lead</span></a></li>
                        @if(request()->routeIs('leads.edit'))
                            <li><a href="{{ route('leads.edit', $lead->id) }}" class="{{ isActiveRoute('leads.edit') }}"><span>Edit Lead</span></a></li>
                        @endif
                        
                        @if(request()->routeIs('leads.show'))
                            <li><a href="#" class="{{ isActiveRoute('leads.show') }}"><span>Show Lead</span></a></li>
                        @endif
 
                    </ul>
                </li> -->
 
                <!-- Vendors Menu -->
                <!-- <li class="submenu">
                    <a href="#"><img src="{{ asset('assets/img/sidebar/icon-3.png') }}" alt="icon"><span> Vendors</span>
                        <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled" style="display: none;">
                        <li><a href="{{ route('vendors.createVendor') }}" class="{{ request()->routeIs('vendors.createVendor') ? 'active' : '' }}"><span>Add Vendor</span></a></li>
                        @if(request()->routeIs('vendors.edit'))
                            <li><a href="{{ route('vendors.edit', $vendor->id) }}" class="{{ isActiveRoute('vendors.edit') }}"><span>Edit Vendor</span></a></li>
                        @endif
                        <li><a href="{{ route('vendors.index') }}" class="{{ request()->routeIs('vendors.index') ? 'active' : '' }}"><span>View Vendors</span></a></li>
                    </ul>
                </li>

  -->

               
                <!-- Users Menu -->
                <!-- <li class="submenu">
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
                </li> -->



                <li class="submenu">
                    <a href="#"><img src="{{ asset('assets/img/sidebar/icon-2.png') }}" alt="icon"><span> User</span>
                        <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled" style="display: none;">
                        <li><a href="{{ route('add.user') }}" class="{{ isActiveRoute('add.user') }}"><span>Add Users</span></a></li>
                    @if(request()->routeIs('user.edit'))
                        <li><a href="{{ route('user.edit', $user->user_id) }}" class="{{ isActiveRoute('user.edit') }}"><span>Edit Profile</span></a></li>
                    @endif
                        <li><a href="{{ route('view.user') }}" class="{{ isActiveRoute('view.user') }}"><span>View Users</span></a></li>
                    </ul>
                </li>
                
               <!-- Internal Leads Menu -->
                <li class="submenu">
                    <a href="#">
                        <img src="{{ asset('assets/img/sidebar/icon-14.png') }}" alt="icon">
                        <span>Internal Leads</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="list-unstyled" style="display: none;">
                        <li><a href="{{ route('internal-leads.create') }}" class="{{ isActiveRoute('internal-leads.create') }}"><span>Add Internal Lead</span></a></li>
                        <li><a href="{{ route('internal-leads.index') }}" class="{{ isActiveRoute('internal-leads.index') }}"><span>All Internal Leads</span></a></li>
                    </ul>
                </li>
 
              
                  <!-- Configurations Menu -->
                  <li class="submenu">
                    <a href="#">
                        <img src="{{ asset('assets/img/sidebar/icon-14.png') }}" alt="icon">
                        <span> Configurations</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="list-unstyled" style="display: none;">
                        <li><a href="{{ route('add.technology') }}" class="{{ isActiveRoute('add.technology') }}"><span>Add Technology</span></a></li>
                        <li><a href="{{ route('add.role') }}" class="{{ isActiveRoute('add.role') }}"><span>Add Role</span></a></li>
                        <li><a href="{{ route('add.experience') }}" class="{{ isActiveRoute('add.experience') }}"><span>Work Experience</span></a></li>
                        <li><a href="{{ route('add.leadstatus') }}" class="{{ isActiveRoute('add.leadstatus') }}"><span>Add Lead Status</span></a></li>
                    </ul>
                </li>



                    <!-- Configurations Menu -->
                    <!-- <li class="submenu">
                    <a href="#">
                        <img src="{{ asset('assets/img/sidebar/icon-14.png') }}" alt="icon">
                        <span> Configurations</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="list-unstyled" style="display: none;">
                        <li><a href="{{ route('add.company') }}" class="{{ isActiveRoute('add.company') }}"><span>Add Company</span></a></li>
                        <li><a href="{{ route('add.technology') }}" class="{{ isActiveRoute('add.technology') }}"><span>Add Technology</span></a></li>
                        <li><a href="{{ route('add.role') }}" class="{{ isActiveRoute('add.role') }}"><span>Add Role</span></a></li>
                        <li><a href="{{ route('add.leadstatus') }}" class="{{ isActiveRoute('add.leadstatus') }}"><span>Lead Status</span></a></li>
                    </ul>
                </li> -->
                
                   <!-- add interview --> 
                 <!-- <li class="submenu">
                    <a href="#">
                        <img src="{{ asset('assets/img/sidebar/icon-14.png') }}" alt="icon">
                        <span>Add Interviewee</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="list-unstyled" style="display: none;">
                        <li><a href="{{ route('interviewee.createInterviewee') }}" class="{{ isActiveRoute('interviewee.createInterviewee') }}"><span>Add Interviewee</span></a></li>
                        <li><a href="{{ route('interviewee.index') }}" class="{{ isActiveRoute('interviewee.index') }}"><span>View Interviewee</span></a></li>
                      
                    </ul>
                </li> -->

                <?php
                }
                ?>
            </ul>
        </div>
    </div>
</div>

