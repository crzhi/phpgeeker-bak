@if(Request::server('HTTP_HOST') == 'www' . config('session.domain'))
	<script type="text/javascript">
		window.location.href = "{{ route('www.404') }}"
	</script>
@endif
@if(Request::server('HTTP_HOST') == 'blog' . config('session.domain'))
	<script type="text/javascript">
		window.location.href = "{{ route('blog.404') }}"
	</script>
@endif