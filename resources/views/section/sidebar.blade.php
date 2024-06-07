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
 
                <?php
               
                if($user->role == 2 || $user->role == 1){
                ?>
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
                        <img src="{{ asset('assets/img/sidebar/icon-10.png') }}" alt="icon">
                        <span>Candidate</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="list-unstyled" style="display: none;">
                        <li><a href="{{ route('internal-leads.create') }}" class="{{ isActiveRoute('internal-leads.create') }}"><span>Create New Candidate </span></a></li>
                        <li><a href="{{ route('internal-leads.index') }}" class="{{ isActiveRoute('internal-leads.index') }}"><span>All Candidate List</span></a></li>
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
                        <li><a href="{{ route('add.leadstatus') }}" class="{{ isActiveRoute('add.leadstatus') }}"><span>Add Candidate Status</span></a></li>
                    </ul>
                </li>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>
</div>

