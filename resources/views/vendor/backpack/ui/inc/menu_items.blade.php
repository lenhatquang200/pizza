{{-- This file is used for menu items by any Backpack v6 theme --}}
{{-- <li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li> --}}
<x-backpack::menu-item title="Banners" icon="la la-bullhorn" :link="backpack_url('banner')" />
<x-backpack::menu-item title="Coupons" icon="la la-tag" :link="backpack_url('coupon')" />
{{--<x-backpack::menu-item title="Menus" icon="la la-list" :link="backpack_url('menu')" />--}}
<x-backpack::menu-item title="Blogs" icon="la la-pencil-alt" :link="backpack_url('blog')" />
<x-backpack::menu-item title="Settings" icon="la la-cogs" :link="backpack_url('setting')" />


<x-backpack::menu-item title="Categories" icon="las la-box-open" :link="backpack_url('category')" />
<x-backpack::menu-item title="Products" icon="las la-hamburger" :link="backpack_url('product')" />
