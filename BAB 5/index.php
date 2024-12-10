<!DOCTYPE html>
<html lang="en">

<head>
	<link rel="icon" href="assets/icon.png" />
	<title>HarianFakta</title>
	<link rel="stylesheet" href="stylees.css" />
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&family=Roboto:wght@500;700&display=swap" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body>
	<div class="container">
		<header>
			<nav>
				<div class="logo">
					<img src="assets/logoo.png" alt="" />
				</div>
				<input type="checkbox" id="click" />
				<label for="click" class="menu-btn">
					<i class="fas fa-bars"></i>
				</label>
				<ul>
					<li><a href="#">Home</a></li>
					<li><a href="#">Categories</a></li>
					<li><a href="login.php" class="btn_login">Login</a></li>
				</ul>
			</nav>
		</header>
		<main>
			<div class="jumbotron">
				<div class="jumbotron-text">
					<h1>Pusat Berita ter-update</h1>
					<p> Berita terbaru, tips belajar melalui berita
					</p>
					<button type="button" class="btn_getStarted">Get Started</button>
				</div>
				<div class="jumbotron-img">
					<img src="assets/jumbotron.pngg" alt="" />
				</div>
			</div>
			<div class="cards-categories">
				<h2>Berita Terbaru</h2>
				<div class="card-categories">
					<?php
					include 'koneksi.php';
					$sql = "SELECT * FROM tb_categories";
					$result = mysqli_query($koneksi, $sql);
					if (mysqli_num_rows($result) == 0) {
						echo "
						<h3 style='text-align: center; color: red;'>Data Kosong</h3>
				";
					}
					while ($data = mysqli_fetch_assoc($result)) {
						echo "
						<div class='card'>
							<div class='card-image'>
								<img src='uploads/$data[photo]' alt='tidak ada gambar' />
							</div>
							<div class='card-content'>
								<h5>$data[categories]</h5>
								<p class='description'>$data[description]</p>
								<p class='date'> $data[date] </p>
								<button class='btn_belanja' type='button' onclick='bukaModal($data[id])'>Baca</button>
							</div>
						</div>
                  ";
					}
					?>
				</div>
			</div>
			<!-- Modal -->
			<div id="myModal" class="modal-container" onclick="tutupModal()">
				<div class="modal-dialog" onclick="event.stopPropagation()">
					<div class="modal-content">
						<div class="modal-header">
							<h1 class="modal-title " style="color:  #1699eb;">Formulir Pengisian</h1>
							<button type="button" class="btn-close" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<form>
								<input type="hidden" name="category_id" id="category_id" value="">
								<input type="hidden" name="category_name" id="category_name" value="">
								<input type="hidden" name="date" id="date" value="">
								<div class="form-group">
									<label class="labelmodal" for="recipient-name" class="col-form-label">Nama :</label>
									<input class="inputdata" type="text" id="recipient-name">
								</div>
								<div class="form-group">
									<label class="labelmodal" for="handphone" class="col-form-label">No. Hp :</label>
									<input class="inputdata" type="text" id="handphone">
								</div>
								<div class="form-group">
									<label class="labelmodal" for="alamat-text" class="col-form-label">Alamat:</label>
									<textarea class="inputalamat" id="alamat-text"></textarea>
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" onclick="tutupModal()">Keluar</button>
							<button type="button" class="btn btn-yellow" onclick="bukaModal2()">Lanjutkan</button>
						</div>
					</div>
				</div>
			</div>
			<!-- Modal 2 -->
			<div id="myModal2" class="modal-container" onclick="tutupModal2()">
				<div class="modal-dialog" onclick="event.stopPropagation()">
					<div class="modal-content">
						<div class="modal-header">
							<h1 class="modal-title" style="color:  #1688eb;">Data Pembaca</h1>
							<button type="button" class="btn-close" onclick="tutupModal2()"></button>
						</div>
						<form action="transaction-proses.php" method="post">
							<div class="modal-body">
								<h4>Kategori</h4>
								<div class="form-group">
									<label class="labelmodal">Kategori:</label>
									<input class="inputdata" type="text" name="detail-kategori" id="detail-kategori" readonly>
								</div>
								<!-- <div class="form-group">
									<label class="labelmodal">Harga:</label>
									<input class="inputdata" type="text" name="detail-harga" id="detail-harga" readonly>
								</div> -->
								<h4>Pembeli</h4>
								<div class="form-group">
									<label class="labelmodal">Nama:</label>
									<input class="inputdata" name="detail-nama" id="detail-nama" readonly>
								</div>
								<div class="form-group">
									<label class="labelmodal">No. Hp:</label>
									<input class="inputdata" name="detail-nomor" id="detail-nomorhp" readonly>
								</div>
								<div class="form-group">
									<label class="labelmodal">Alamat:</label>
									<textarea class="inputalamat" name="detail-alamat" id="detail-alamat" readonly></textarea>
								</div>
								<input type="hidden" name="detail-status" value="success">
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" onclick="kembaliKeModalPertama()">Kembali</button>
								<button name="simpan" type="submit" class="btn btn-yellow">Lakukan Pembayaran</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</main>
	</div>
	<script>
		var selectedCategoryId;
		function bukaModal(categoryId) {
			console.log('categoryId:', categoryId);
			selectedCategoryId = categoryId;
			var xhr = new XMLHttpRequest();
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4 && xhr.status == 200) {
					var categoryData = JSON.parse(xhr.responseText);
					document.getElementById('category_id').value = categoryId;
					document.getElementById('category_name').value = categoryData.categories;
					document.getElementById('date').value = categoryData.date;
					document.getElementById("myModal").style.display = "flex";
				}
			};
			xhr.open("GET", "get_kategori.php?id=" + categoryId, true);
			xhr.send();
		}

		function tutupModal() {
			document.getElementById("myModal").style.display = "none";
		}
		function bukaModal2() {
			document.getElementById("myModal").style.display = "none";

    // Ambil data dari modal pertama
    const categoryName = document.getElementById("category_name").value;
    const recipientName = document.getElementById("recipient-name").value;
    const handphone = document.getElementById("handphone").value;
    const alamat = document.getElementById("alamat-text").value;

    // Validasi input
    if (!recipientName || !handphone || !alamat) {
        alert("Harap isi semua field sebelum melanjutkan.");
        return;
    }

    // Masukkan data ke modal kedua
    document.getElementById("detail-kategori").value = categoryName;
    document.getElementById("detail-nama").value = recipientName;
    document.getElementById("detail-nomorhp").value = handphone;
    document.getElementById("detail-alamat").value = alamat;

    // Tampilkan modal kedua
    document.getElementById("myModal2").style.display = "flex";
		}
	</script>
</body>

</html>
