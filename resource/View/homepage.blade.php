@include('header')
	<form action=".", method="POST">
		@method('put')
		<input type="text" name="name" />
		<button type="submit">Submit</button>
	</form>
@include('footer')
