<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8" />
   <link rel="icon" href="assets/icon.png" />
   <link rel="stylesheet" href="admin.css" />
   <!-- Boxicons CDN Link -->
   <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <title>Catshop Admin | Transaction</title>
   <style>
      .btn-cetak {
         position: fixed;
         bottom: 20px;
         right: 20px;
         background-color: green;
         color: white;
         padding: 10px 20px;
         border: none;
         border-radius: 5px;
         cursor: pointer;
         font-size: 16px;
         box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
      }

      .btn-cetak:hover {
         background-color: darkgreen;
      }
   </style>
</head>

<body>
   <div class="sidebar">
      <div class="logo-details">
         <i class="bx bx-category"></i>
         <span class="logo_name">harianFakta</span>
      </div>
      <ul class="nav-links">
         <li>
            <a href="admin.php">
               <i class="bx bx-grid-alt"></i>
               <span class="links_name">Dashboard</span>
            </a>
         </li>
         <li>
            <a href="categories.php">
               <i class="bx bx-box"></i>
               <span class="links_name">Categories</span>
            </a>
         </li>
         <li>
            <a href="transaction.php" class="active">
               <i class="bx bx-list-ul"></i>
               <span class="links_name">Transaction</span>
            </a>
         </li>
         <li>
            <a href="logout.php">
               <i class="bx bx-log-out"></i>
               <span class="links_name">Log out</span>
            </a>
         </li>
      </ul>
   </div>
   <section class="home-section">
      <nav>
         <div class="sidebar-button">
            <i class="bx bx-menu sidebarBtn"></i>
         </div>
         <div class="profile-details">
            <span class="admin_name">HF Admin</span>
         </div>
      </nav>
      <div class="home-content">
         <h3>Transaction</h3>
         <button onclick="printPage()" class="btn-cetak">
            <a href="transaction-cetak.php" style="color: white; text-decoration: none;">Cetak</a>
         </button>
         <table class="table-data">
            <thead>
               <tr>
                  <th>Tanggal</th>
                  <th>Nama</th>
                  <th>Kategori</th>
                  <th>Status</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               <?php
               include 'koneksi.php';
               $sql = "SELECT * FROM tb_transaction";
               $result = mysqli_query($koneksi, $sql);
               if (mysqli_num_rows($result) == 0) {
                  echo "
                  <h3 style='text-align: center; color: red;'>Data Kosong</h3>
                  ";
               } else {
                  while ($data = mysqli_fetch_assoc($result)) {
                     echo "
                     <tr>
                        <td>$data[tanggal]</td>
                        <td>$data[nama]</td>
                        <td>$data[jenis]</td>
                        <td><p class='success'>$data[status]</p></td>
                        <td style='display: none;'>$data[nomorhp]</td>
                        <td>
                           <button class='btn_detail' 
                                   data-nomorhp='$data[nomorhp]' 
                                   onclick='showDetails(\"$data[tanggal]\", \"$data[nama]\", \"$data[jenis]\", \"$data[status]\", event)'>
                              Detail
                           </button>
                        </td>
                     </tr>
                     ";
                  }
               }
               ?>
            </tbody>
         </table>
      </div>
   </section>
   <script>
      // Sidebar toggle
      let sidebar = document.querySelector(".sidebar");
      let sidebarBtn = document.querySelector(".sidebarBtn");
      sidebarBtn.onclick = function () {
         sidebar.classList.toggle("active");
         if (sidebar.classList.contains("active")) {
            sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
         } else {
            sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
         }
      };

      // Detail button functionality
      function showDetails(tanggal, nama, kategori, status, event) {
         // Get nomorhp from the button's data attribute
         let nomorhp = event.target.getAttribute('data-nomorhp');

         // Show details in an alert
         alert(`Tanggal: ${tanggal}\nNama: ${nama}\nKategori: ${kategori}\nNomor HP: ${nomorhp}\nStatus: ${status}`);
      }

      // Print page
      function printPage() {
         window.print();
      }
   </script>
</body>

</html>
