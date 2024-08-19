{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<x-backpack::menu-item title="Images" icon="la la-question" :link="backpack_url('image')" />
<x-backpack::menu-item title="Users" icon="la la-question" :link="backpack_url('user')" />
<x-backpack::menu-item title="Coupons" icon="la la-question" :link="backpack_url('coupon')" />
<x-backpack::menu-item title="Locations" icon="la la-question" :link="backpack_url('location')" />
<x-backpack::menu-item title="Pagecontents" icon="la la-question" :link="backpack_url('pagecontent')" />
<x-backpack::menu-item title="Reviews" icon="la la-question" :link="backpack_url('review')" />