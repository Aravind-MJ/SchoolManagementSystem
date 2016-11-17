@include('backend.layouts.header')
@include('backend.layouts.admin')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        @yield('title')
        <small>@yield('small_title')</small>
      </h1>
      <!--ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>
    </section-->

    <!-- Main content -->
    <section class="content">
      @include('flash')
      @yield('body')
    </section>
	
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@include('backend.layouts.footer')
<!--
Read following for reference
1. Use title Section to place title of tab and the title of page.
2. Use small_title section to place a smaller Add on title to the page
3. Use body section to place the content of the page
4. Use page_script section to place the Scripts for specific pages
-->