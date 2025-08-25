@include('shop.layout.header2')
<section class="home-slider owl-carousel">

	<div class="slider-item" style="background-image: url(/assets2/images/bg_3.jpg);" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row slider-text justify-content-center align-items-center">

				<div class="col-md-7 col-sm-12 text-center ftco-animate">
					<h1 class="mb-3 mt-5 bread">Our Check Out</h1>
					<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Check Out</span></p>
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
				<h2 class="mb-4">Our Cart</h2>
				<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
			</div>
		</div>
		<!-- <div class="row d-md-flex"> 
			<div class="col-lg-12 ftco-animate p-md-5"> 
				<div class="row"> 
					<div class="card shadow rounded-2xl">
						<div class="card-body"> 
							<h5>Ringkasan</h5> 
							<table class="table table-sm"> 
								<thead>
									<tr>
										<th>Produk</th>
										<th>Qty</th>
										<th>Subtotal</th>
									</tr>
								</thead> 
								<tbody> 
									@php $subtotal=0; @endphp @foreach($cart as $it) @php $subtotal += $it['price']*$it['qty']; @endphp 
									<tr>
										<td>{{ $it['name'] }}</td>
										<td>{{ $it['qty'] }}</td>
										<td>Rp {{ number_format($it['price']*$it['qty'],0,',','.') }}</td>
									</tr> @endforeach </tbody> 
									<tfoot>
										<tr>
											<th colspan="2" class="text-right">Total</th>
											<th>Rp {{ number_format($subtotal,0,',','.') }}</th>
										</tr>
									</tfoot> 
								</table> 
							</div> 
						</div> 
						<div class="card shadow rounded-2xl">
							<div class="card-body"> 
								<form method="post" action="{{ route('shop.process') }}">
									@csrf 
									<div class="form-group">
										<label>Nama</label>
										<input name="name" class="form-control" required>
									</div> 
									<div class="form-group">
										<label>No. HP</label>
										<input name="phone" class="form-control" required></div>
										<div class="form-group">
											<label>Email (opsional)</label>
											<input name="email" type="email" class="form-control"></div> 
											<button class="btn btn-primary btn-block">Buat Pesanan</button> 
										</form> 
									</div> 
								</div> 
							</div> 
						</div>
					</div> -->
					<div class="row "> 
						<div class="col-lg-8 ftco-animate p-md-3"> 
							<div class="card shadow rounded-2xl">
								<div class="card-body"> 
									<h5>Ringkasan</h5> 

									<div class="table-responsive"> <!-- Tambahkan ini -->
										<table class="table table-sm mb-0"> 
											<thead>
												<tr>
													<th>Produk</th>
													<th>Qty</th>
													<th>Subtotal</th>
												</tr>
											</thead> 
											<tbody> 
												@php $subtotal=0; @endphp 
												@foreach($cart as $it) 
												@php $subtotal += $it['price']*$it['qty']; @endphp 
												<tr>
													<td>{{ $it['name'] }}</td>
													<td>{{ $it['qty'] }}</td>
													<td>Rp {{ number_format($it['price']*$it['qty'],0,',','.') }}</td>
												</tr> 
												@endforeach 
											</tbody> 
											<tfoot>
												<tr>
													<th colspan="2" class="text-right">Total</th>
													<th>Rp {{ number_format($subtotal,0,',','.') }}</th>
												</tr>
											</tfoot> 
										</table>
									</div> <!-- Tutup table-responsive -->
								</div> 
							</div>

						</div>

						<div class="col-lg-4 ftco-animate p-md-3"> 
							<div class="card shadow rounded-2xl">
								<div class="card-body"> 
									<form method="post" action="{{ route('shop.process') }}">
										@csrf 
										<div class="form-group">
											<label>Nama</label>
											<input name="name" class="" required>
										</div> 
										<div class="form-group">
											<label>No. HP</label>
											<input name="phone" class="" required>
										</div>
										<div class="form-group">
											<label>Email (opsional)</label>
											<input name="email" type="email" class="">
										</div> 
										<button class="btn btn-primary btn-block">Buat Pesanan</button> 
									</form> 
								</div> 
							</div> 
						</div>
					</div>

				</div>
			</section>
			@include('shop.layout.footer')
			<script>
				function removeItem(id){
					$.post('{{ route('shop.remove') }}',{_token:'{{ csrf_token() }}', product_id:id}).done(()=>location.reload());
				}

				function updateQty(id, qty){
					$.post('{{ route('shop.update') }}', {
						_token:'{{ csrf_token() }}', 
						product_id:id, 
						qty:qty
					}).done(() => location.reload());
				}
			</script>