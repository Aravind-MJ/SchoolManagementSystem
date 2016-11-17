  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.5
    </div>
    <strong>Copyright &copy; 2016 PartyCrooks.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{url('backend/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{url('backend/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{url('backend/plugins/fastclick/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url('backend/dist/js/app.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{url('backend/dist/js/demo.js')}}"></script>
<!-- Bootstrap Filestyle -->
<script src="{{url('backend/dist/js/bootstrap-filestyle.min.js')}}"></script>
<!-- Drop Zone CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
<!-- Custom Drop zone js -->
<script src="{{url('backend/dist/js/imageupload.js')}}"></script>

<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
 
<script src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
<script>
function confirmDelete(href){
	var k = confirm('Are you sure to Delete this?');
	if(k){
		window.location.href=href;
	}
}
            $.ajaxSetup({
               headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
            });
</script>
@yield('page_scripts')
</body>
</html>
