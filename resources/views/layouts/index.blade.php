<!DOCTYPE html>
<html lang="en">
	<div class="loading d-none">Loading&#8230;</div>

	@include('layouts.header')

	@include('layouts.sidebar')

	@yield('content')

	@include('layouts.footer')
</body>
</html>