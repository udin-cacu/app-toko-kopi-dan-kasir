@include('shop.layout.header')
<section class="home-slider owl-carousel">

	<div class="slider-item" style="background-image: url(/assets2/images/bg_3.jpg);" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row slider-text justify-content-center align-items-center">

				<div class="col-md-7 col-sm-12 text-center ftco-animate">
					<h1 class="mb-3 mt-5 bread">Our Menu</h1>
					<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Menu</span></p>
				</div>

			</div>
		</div>
	</div>
</section>

<section class="ftco-intro">
	<div class="container-wrap">
		<div class="wrap d-md-flex align-items-xl-end">
			<div class="info">
				<div class="row no-gutters">
					<div class="col-md-4 d-flex ftco-animate">
						<div class="icon"><span class="icon-phone"></span></div>
						<div class="text">
							<h3>000 (123) 456 7890</h3>
							<p>A small river named Duden flows by their place and supplies.</p>
						</div>
					</div>
					<div class="col-md-4 d-flex ftco-animate">
						<div class="icon"><span class="icon-my_location"></span></div>
						<div class="text">
							<h3>198 West 21th Street</h3>
							<p>	203 Fake St. Mountain View, San Francisco, California, USA</p>
						</div>
					</div>
					<div class="col-md-4 d-flex ftco-animate">
						<div class="icon"><span class="icon-clock-o"></span></div>
						<div class="text">
							<h3>Open Monday-Friday</h3>
							<p>8:00am - 9:00pm</p>
						</div>
					</div>
				</div>
			</div>
			<div class="book p-4">
				<h3>Book a Table</h3>
				<form action="#" class="appointment-form">
					<div class="d-md-flex">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="First Name">
						</div>
						<div class="form-group ml-md-4">
							<input type="text" class="form-control" placeholder="Last Name">
						</div>
					</div>
					<div class="d-md-flex">
						<div class="form-group">
							<div class="input-wrap">
								<div class="icon"><span class="ion-md-calendar"></span></div>
								<input type="text" class="form-control appointment_date" placeholder="Date">
							</div>
						</div>
						<div class="form-group ml-md-4">
							<div class="input-wrap">
								<div class="icon"><span class="ion-ios-clock"></span></div>
								<input type="text" class="form-control appointment_time" placeholder="Time">
							</div>
						</div>
						<div class="form-group ml-md-4">
							<input type="text" class="form-control" placeholder="Phone">
						</div>
					</div>
					<div class="d-md-flex">
						<div class="form-group">
							<textarea name="" id="" cols="30" rows="2" class="form-control" placeholder="Message"></textarea>
						</div>
						<div class="form-group ml-md-4">
							<input type="submit" value="Appointment" class="btn btn-white py-3 px-4">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>

<section class="ftco-menu mb-5 pb-5">
	<div class="container">
		<div class="row justify-content-center mb-5">
			<div class="col-md-7 heading-section text-center ftco-animate">
				<span class="subheading">Discover</span>
				<h2 class="mb-4">Our Products</h2>
				<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
			</div>
		</div>
		<div class="row d-md-flex">
			<div class="col-lg-12 ftco-animate p-md-5">
				<div class="row">
					<div class="col-md-12 nav-link-wrap mb-5">
						<div class="nav ftco-animate nav-pills justify-content-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
							<a class="nav-link active" onclick="loadCategory('all');" id="v-pills-1-tab" data-toggle="pill" href="/menu/categories?id={{$coffee->id}}" role="tab" aria-controls="v-pills-1" aria-selected="true">All Menu</a>
							<a class="nav-link" onclick="loadCategory({{$coffee->id}});" id="v-pills-1-tab" data-toggle="pill" href="/menu/categories?id={{$coffee->id}}" role="tab" aria-controls="v-pills-1" aria-selected="true">Coffee</a>

							<a class="nav-link" id="v-pills-2-tab" onclick="loadCategory({{$noncoffee->id}});" data-toggle="pill" href="/menu/categories?id={{$noncoffee->id}}" role="tab" aria-controls="v-pills-2" aria-selected="false">Non-Coffee</a>

							<a class="nav-link" id="v-pills-3-tab" onclick="loadCategory({{$mineralwater->id}});" data-toggle="pill" href="/menu/categories?id={{$mineralwater->id}}" role="tab" aria-controls="v-pills-3" aria-selected="false">Mineral Water</a>

							<a class="nav-link" id="v-pills-3-tab" onclick="loadCategory({{$es->id}});" data-toggle="pill" href="/menu/categories?id={{$mineralwater->id}}" role="tab" aria-controls="v-pills-3" aria-selected="false">Ice</a>
						</div>
					</div>
					<div class="col-md-12 d-flex align-items-center">
						
						<div class="tab-content ftco-animate" id="v-pills-tabContent">

							<div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-1-tab">
								<div id="menu-list" class="row"></div>
								<div class="row allmenu">

									@foreach($products as $data)
									<div class="col-md-4 text-center">
										<div class="menu-wrap">
											<a href="#" class="menu-img img mb-4" style="background-image: url(/assets2/images/{{$data->img}});"></a>
											<div class="text">
												<h3><a href="#">{{$data->name}}</a></h3>
												<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
												<p class="price"><span>{{$data->price}}</span></p>
												<p><a href="#" class="btn btn-primary btn-outline-primary" onclick="addToCart({{ $data->id }})">Add to cart</a></p>
											</div>
										</div>
									</div>
									@endforeach
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@include('shop.layout.footer')
<script>
	function loadCategory(id) {

		if(id === 'all') {
        // tampilkan default allmenu
			$(".allmenu").show();
        $("#menu-list").html(""); // kosongkan ajax list
        return;
    }

    $.ajax({
    	url: "{{ route('shop.categories') }}",
    	type: "GET",
    	data: { id: id },
    	success: function (res) {
    		let html = "";
    		res.forEach(function(item) {
    			html += `
                    <div class="col-md-4 text-center">
						<div class="menu-wrap">
							<a href="#" class="menu-img img mb-4" style="background-image: url(/assets2/images/${item.img});"></a>
								<div class="text">
									<h3><a href="#">${item.name}</a></h3>
									<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
									<p class="price"><span>${item.price}</span></p>
									<p><a href="#" class="btn btn-primary btn-outline-primary" onclick="addToCart(${item.id})">Add to cart</a></p>
								</div>
						</div>                        
                    </div>
    			`;
    		});
    		$("#menu-list").html(html);
    		$(".allmenu").hide();
    	}
    });
}

function addToCart(id) {
	$.post('{{ route('shop.add') }}', {
		_token: '{{ csrf_token() }}',
		product_id: id
	})
	.done(function(res) {
		swal({
			title: "Success",
			text: "Products Transaksi Berhasil Tersimpan",
			icon: "success",
			confirmButtonText: 'OK'
		});

		setTimeout(function(){ window.location.href = '/menu2'; }, 2000);
	})
	.fail(function(xhr) {
		console.error(xhr.responseText);
		alert('Gagal menambahkan ke keranjang');
	});
}

</script>