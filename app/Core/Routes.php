<?php
namespace App\Laundry\Core;
class Routes
{
    public function run()
  {
      // CREATE OBJEK APP
    $router = new App();
    // ************ SET DEFAULT ROUTE (404) ************
    $router->setDefaultController('DefaultApp');
    $router->setDefaultMethod('index');
    $router->setNamespace('App\Laundry\Controllers');
    // ************ END SET DEFAULT ROUTE (404) ************
    // ************ HALAMAN HOME ************
    $router->get('/', ['HomeController', 'index']);
    
    // register dan login dan logout  dan lupa password
    // login
    $router->post('/login', ['HomeController', 'login']);
    // logout
    $router->get('/logout', ['HomeController', 'logout']);
    // registrasi
    $router->post('/register', ['HomeController', 'register']);
    // lupa password
    $router->get('/forgot', ['HomeController', 'forgot']);
    $router->post('/forgot/send', ['HomeController', 'forgot_send']);
    // send email
    $router->post('/send/email', ['HomeController', 'sendEmail']);
    // halaman Pemesanan
    $router->get('/kiloan', ['CategoryController', 'kiloan']);
    $router->get('/satuan', ['CategoryController', 'satuan']);
    $router->get('/express', ['CategoryController', 'express']);
    // ************ END HALAMAN HOME ************
    // ************ HALAMAN USER ************
    if (isset($_SESSION['login'])) {
        if (isset($_SESSION['user'])) {
          $router->get('/user', ['UserController', 'index']);
        $router->get('/user/proses', ['UserController', 'proses']);
        $router->get('/user/proses/(:datelimit)', ['UserController', 'proses']);
        $router->get('/user/logout', ['UserController', 'logout']);
        $router->get('/user/faq', ['UserController', 'faq']);
        $router->get('/user/help', ['UserController', 'help']);
        // user edit 
        $router->post('/user/edit', ['UserController', 'edit']);
        // user edit gambar
        $router->post('/user/edit/img', ['UserController', 'edit_img']);
        // user hapus gambar
        $router->post('/user/edit/hapus_img', ['UserController', 'hapus_img']);
      }
    }
    // ************ END HALAMAN USER ************
    // ************ HALAMAN ADMIN ************
    if (isset($_SESSION['login'])) {
        if (isset($_SESSION['admin'])) {
          $router->get('/admin', ['AdminController', 'index']);
        $router->get('/admin/customer', ['AdminController', 'customer']);
        // PDF DATA CUSTOMER
        $router->get('/admin/pdf', ['AdminController', 'pdf_data_ctm']);

        // CATEGORY PESANAN
        // kategori semua
        $router->get('/admin/all-kategori', ['AdminController', 'categories']);
        $router->get('/admin/all-kategori/(:datelimit)', ['AdminController', 'categories']);
        // kategori kiloan
        $router->get('/admin/kategori/kiloan', ['AdminController', 'kategoriKiloan']);
        $router->get('/admin/kategori/kiloan/(:datelimit)', ['AdminController', 'kategoriKiloan']);
        // kategori satuan
        $router->get('/admin/kategori/satuan', ['AdminController', 'kategoriSatuan']);
        $router->get('/admin/kategori/satuan/(:datelimit)', ['AdminController', 'kategoriSatuan']);
        // kategori express
        $router->get('/admin/kategori/express', ['AdminController', 'kategoriExpress']);
        $router->get('/admin/kategori/express/(:datelimit)', ['AdminController', 'kategoriExpress']);
        
        // PDF DATA STATUS PEMBAYARAN
        $router->get('/admin/pdf-belum-bayar', ['AdminController', 'pdf_data_belum_bayar']);
        $router->get('/admin/pdf-sudah-bayar', ['AdminController', 'pdf_data_sudah_bayar']);
        // aktif dan tidak aktif
        $router->get('/admin/customer/aktif', ['AdminController', 'customer_aktif']);
        $router->get('/admin/customer/tidak-aktif', ['AdminController', 'customer_no_aktif']);
        // customer hapus deleted 
        $router->post('/admin/customer/hapus', ['AdminController', 'customer_hapus']);
        // pemesanan
        $router->get('/admin/pemesanan', ['AdminController', 'pemesanan']);
        // detail pemesanan
        $router->get('/admin/pemesanan/detail/(:id)', ['AdminController', 'detail_pemesanan']);
        // datelimit detail pemesanan
        $router->get('/admin/pemesanan/detail/(:id)/(:datelimit)', ['AdminController', 'detail_pemesanan']);
        // tambah pemesanan
        $router->post('/admin/pemesanan/insert', ['AdminController', 'tambah_pemesanan']);
        // ambil data edit pemesanan
        $router->post("/admin/pemesanan/detail/edit/(:id)", ['AdminController', 'getEditPesanan']);
        // edit prosess pemesanan
        $router->post("/admin/pemesanan/detail/edit-prosess", ['AdminController', 'edit_prosess_pemesanan']);
        // edit pemesanan
        $router->post("/admin/pemesanan/detail/edit-pemesanan", ['AdminController', 'edit_pemesanan']);
        // pembayaran
        // pembayaran belum bayar dan sudah bayar
        $router->get('/admin/belum-bayar', ['AdminController', 'belum_bayar']);
        $router->get('/admin/sudah-bayar', ['AdminController', 'sudah_bayar']);
        // edit Pembyarana
        $router->post('/admin/bayar/edit', ['AdminController', 'edit_pembayaran']);
        // tambah customer
        $router->post('/admin/customer/insert', ['AdminController', 'insert']);
        // ambil data sesuai id customer
        $router->post('/admin/customer/edit/(:id)', ['AdminController', 'getEdit']);
        // edit customer
        $router->post('/admin/customer/edit', ['AdminController', 'edit']);
        // edit status
        $router->post('/admin/customer/edit_status', ['AdminController', 'edit_status']);
      }
    }
    // ************ END HALAMAN ADMIN ************
    // percobaan
    $router->get('/coba', ['CobaController', 'index']);
    $router->run();
  }
}
