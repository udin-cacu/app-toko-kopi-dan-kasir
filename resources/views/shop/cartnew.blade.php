@include('shop.layout.header2')
<section class="home-slider owl-carousel">

	<div class="slider-item" style="background-image: url(/assets2/images/bg_3.jpg);" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row slider-text justify-content-center align-items-center">

				<div class="col-md-7 col-sm-12 text-center ftco-animate">
					<h1 class="mb-3 mt-5 bread">Our Cart</h1>
					<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Cart</span></p>
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
		<div class="row d-md-flex">
			<div class="col-lg-12 ftco-animate p-md-5">
				<div class="row">
					<div class="card shadow rounded-2xl">
						<div class="card-body p-2" style="overflow-x:auto;">
							@php $cart = $cart ?? []; @endphp
							@if(empty($cart))
							<p>Keranjang kosong. <a href="{{ route('shop.menu2') }}"><span class="badge badge-primary">Belanja sekarang</span></a></p>
							@else
							<div class="table-responsive">
								<table class="table table-bordered table-sm mb-0" style="font-size: 12px; word-break: break-word;">
									<thead class="thead-light">
										<tr>
											<th>Produk</th>
											<th>Harga</th>
											<th>Qty</th>
											<th>Total</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										@php $subtotal=0; @endphp
										@foreach($cart as $it)
										@php $subtotal += $it['price'] * $it['qty']; @endphp
										<tr>
											<td>{{ $it['name'] }}</td>
											<td>Rp {{ number_format($it['price'],0,',','.') }}</td>
											<td style="width: 110px; padding: 2px;">
												<input type="number" 
												value="{{ $it['qty'] }}" 
												min="1" 
												class="form-control form-control-sm text-center" 
												style="min-width: 60px; padding: 2px 4px; height: 28px; font-size: 12px;"
												onchange="updateQty({{ $it['id'] }}, this.value)">
											</td>

											<td id="total-{{ $it['id'] }}">Rp {{ number_format($it['price']*$it['qty'],0,',','.') }}</td>

											<td>
												<button class="btn btn-sm btn-danger" onclick="removeItem({{ $it['id'] }})">
													Hapus
												</button>
											</td>
										</tr>
										@endforeach
									</tbody>
									<tfoot>
										<tr>
											<th colspan="3" class="text-right">Subtotal</th>
											<th colspan="2" id="subtotal">Rp {{ number_format($subtotal,0,',','.') }}</th>
										</tr>
									</tfoot>
								</table>
							</div>
							<div class="text-right mt-2">
								<a href="{{ route('shop.checkout2') }}" class="btn btn-sm btn-success">Checkout</a>
							</div>
							@endif
						</div>
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