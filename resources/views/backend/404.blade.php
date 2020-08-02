@extends('layouts.scaffold')

@section('content')
<div class="error_page_start">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h2>OOPS! PAGE NOT BE FOUND</h2>
				<p>Sorry but the page you are looking for does not exist, have been removed, name changed or is temporarity unavailable.</p>
				<div class="search__sidbar">
					<div class="input_form">
						<input type="text" class="input_text" value="Search..." name="s" id="search_input">
						<button class="button" type="submit" id="blogsearchsubmit">
							<i class="fa fa-search"></i>
						</button>
					</div>
				</div>
				<div class="hom_btn">
					<a href="javascript:history.back()" class="">
						Kembali ke halaman sebelumnya
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
