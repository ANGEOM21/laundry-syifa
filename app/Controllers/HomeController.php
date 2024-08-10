<?php

namespace App\Laundry\Controllers;

use App\Laundry\Core\BaseController;
use App\Laundry\Core\Message;
use App\Laundry\Models\UserModel;
// PHPMAILER KIRIM EAMIL
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
// PUSHER
use Pusher\Pusher;
// HOME CONTROLLER
class HomeController extends BaseController
{
  // VISIBILTY PRIVATE AUTH 
  private $Auth;
  // VISIBILTY PRIVATE CONSTAN MESSAGE lOGIN
  private const MESSAGE_LOGIN = [
    "email" => [
      "required" => "Email harus diisi!",
    ],
    "username" => [
      "required" => "Username harus diisi!",
    ],
    "password" => [
      "required" => "password harus diisi!",
      "between" => "password harus minimal 8 karakter",
    ]
  ];
  // VISIBILTY PRIVATE CONSTAN MESSAGE FORGOT
  private const MESSAGE_FORGOT = [
    "email_username" => [
      "required" => "Email atau Username harus diisi!",
      "email" => "Email tidak valid",
    ],
    "password" => [
      "required" => "password harus diisi!",
      "secure" => "password harus minimal 8 karakter dan kombinasi huruf kecil, huruf besar, angka dan simbol",
    ],
    "password_confirm" => [
      "required" => "konfirmasi password harus diisi!",
      "secure" => "konfirmasi password harus minimal 8 karakter dan kombinasi huruf kecil, huruf besar, angka dan simbol",
    ]
  ];
  // VISIBILTY PRIVATE CONSTAN MESSAGE REGISTER
  private const MESSAGE_REGISTER = [
    "email" => [
      "required" => "Email harus diisi!",
    ],
    "no_hp" => [
      "required" => "No Hp harus diisi!",
      "numeric" => "No Hp harus angka!",
      "between" => "No Hp harus diantara 10 sampai 13 karakter",
    ],
    "password" => [
      "required" => "password harus diisi!",
      "secure" => "konfirmasi password harus minimal 8 karakter dan kombinasi huruf kecil, huruf besar, angka dan simbol",
    ],
    "re_password" => [
      "required" => "konfirmasi password harus diisi!",
      "secure" => "konfirmasi password harus minimal 8 karakter dan kombinasi huruf kecil, huruf besar, angka dan simbol",
    ]
  ];
  /** CUNSTRUCTOR HOME CONTROLLER */
  public function __construct()
  {
    $this->Auth = $this->model(UserModel::class);
  }
  // HALAMAN HOME VIEW
  public function index()
  {
    $data = [
      'title' => 'Home',
      'owner' => 'Syifa Laundry',
    ];
    // set cookie
    if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
      $id = $_COOKIE['id'];
      $key = $_COOKIE['key'];
      $proc = $this->Auth->getById($id);
      if ($key === hash('sha256', $proc['username'])) {
        if ($proc['id_tmru_ld'] == 1) {
          $_SESSION['login'] = $proc['id_tmuld'];
          $_SESSION['admin'] = true;
          $_SESSION['name'] = $proc['name'];
          $_SESSION['role'] = $proc['id_tmru_ld'];
        } else {
          $_SESSION['login'] = $proc['id_tmuld'];
          $_SESSION['user'] = true;
          $_SESSION['name'] = $proc['name'];
          $_SESSION['role'] = $proc['id_tmru_ld'];
        }
      }
    }
    $this->view('pages/home/index', $data);
  }
  // HALAMAN HOME REGISTER VIEW
  public function register()
  {
    $fields = [
      'email' => 'string | required | email | unique: tbl_m_user_ld,email',
      'no_hp' => 'string | required | unique: tbl_m_user_ld,no_hp',
      'password' => 'string | required | between:8,255',
      're_password' => 'string | required | between:8,255',
      'username' => 'string | required',
      'nama' => 'string',
      'role' => 'string',
      'created_by' => 'string',
      'status_deactive' => 'string',
      'img_default' => 'string',
    ];
    $data_masuk['email'] = $_POST['email'];
    $data_masuk['no_hp'] = $_POST['no_hp'];
    $data_masuk['password'] = $_POST['password'];
    $data_masuk['re_password'] = $_POST['re_password'];
    $username = explode("@", $_POST['email'])[0];
    $data_masuk['username'] = $username;
    $nama = strtolower($username);
    $nama = ucfirst($nama);
    $data_masuk['nama'] = $nama;
    $data_masuk['status_deactive'] = 1;
    $data_masuk['role'] = 2;
    $data_masuk['created_by'] = 2;
    $data_masuk['img_default'] = '2005e27a39fa5f6d97b2e0a95233b2be.jpg';
    [$inputs, $errors] = $this->filter($data_masuk, $fields,  self::MESSAGE_REGISTER);
    if ($errors) {
      $response = [
        'status' => 400,
        'message' => $errors,
        'data' => $errors
      ];
      header('Content-Type: application/json');
      echo json_encode($response);
    } else {
      if ($inputs['password'] == $inputs['re_password']) {
        $inputs['password'] = password_hash($inputs['password'], PASSWORD_DEFAULT);
        $proc = $this->Auth->insert($inputs);
        if ($proc) {
          // RESPONSE SUCCESS REGISTER
          $response = [
            'status' => 200,
            'error' => null,
            'message' => ' register success silahkan login',
            'data' => $inputs
          ];
          header('Content-Type: application/json');
          echo json_encode($response);
          // Pusher Notification to Admin
          $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
          );
          // CREATE OBJEK PUSHER JS
          $pusher = new Pusher(
            'c08467d0f663043d20aa',
            'a3dbc1d4446a2e54cac3',
            '1729160',
            $options
          );
          // DATA NOTIFIKASI
          $data['user'] = $inputs['nama'];
          $pusher->trigger('notifikasi_admin', 'my-event', $data);
        } else {
          $response = [
            'status' => 400,
            'message' => "register failed",
            'data' => $proc
          ];
          header('Content-Type: application/json');
          echo json_encode($response);
        }
      } else {
        $response = [
          'status' => 400,
          'message' => "password tidak sama",
          'data' => $errors
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
      }
    }
  }
  // HALAMAN HOME LOGIN VIEW
  public function login()
  {
    $fields = [
      'email_user' => 'string | required',
      'password' => 'string | required',
    ];
    $data_masuk['email_user'] = $_POST['email_user'];
    $data_masuk['password'] = $_POST['password_user'];
    [$inputs, $errors] = $this->filter($data_masuk, $fields,  self::MESSAGE_LOGIN);
    if ($errors) {
      Message::setFlash('erorr', $errors[0], 'Login');
      $this->redirect('');
    } else {
      $proc = $this->Auth->getByEmailUsername($inputs['email_user']);
      if ($proc) {
        if (password_verify($inputs['password'], $proc['password']) == true) {
          if ($proc['id_tmru_ld'] == 1) {
            $_SESSION['login'] = $proc['id_tmuld'];
            $_SESSION['admin'] = true;
            $_SESSION['name'] = $proc['name'];
            $_SESSION['role'] = $proc['id_tmru_ld'];
            if (isset($_POST['remember'])) {
              // setcookie('id', $proc['id_tmuld'], time() + 60 * 60 * 24 * 7);
              setcookie('id', $proc['id_tmuld'], time() + 604800); // cookie selama 1 minggu
              // setcookie('key', hash('sha256', $proc['username']), time() + 60 * 60 * 24 * 7);
              setcookie('key', hash('sha256', $proc['username']), time() + 604800); // cookie selama 1 minggu
            }
            Message::setFlash('success', 'berhasil', 'Selamat datang ' . $proc['name']);
            $this->redirect('admin');
          } else {
            $_SESSION['login'] = $proc['id_tmuld'];
            $_SESSION['user'] = true;
            $_SESSION['role'] = $proc['id_tmru_ld'];
            $_SESSION['name'] = $proc['name'];
            if (isset($_POST['remember'])) {
              // setcookie('id', $proc['id_tmuld'], time() + 60 * 60 * 24 * 7);
              setcookie('id', $proc['id_tmuld'], time() + 604800); // cookie selama 1 minggu
              // setcookie('key', hash('sha256', $proc['username']), time() + 60 * 60 * 24 * 7);
              setcookie('key', hash('sha256', $proc['username']), time() + 604800); // cookie selama 1 minggu
            }
            Message::setFlash('success', 'berhasil', 'Selamat datang ' . $proc['name']);
            $this->redirect('user');
          }
        } else {
          Message::setFlash('warning', 'Gagal', 'password salah');
          $this->redirect('');
        }
      } else {
        Message::setFlash('warning', 'gagal', 'email atau username tidak ditemukan');
        $this->redirect('');
      }
    }
  }
  // CONF LOGOUT HOME CONTROLLER
  public function logout()
  {
    $_SESSION = [];
    session_destroy();
    session_unset();
    setcookie('id', '', time() - 604800);
    setcookie('key', '', time() - 604800);
    Message::setFlash('success', 'Logout Berhasil', 'Logout Berhasil');
    $this->redirect('');
  }
  // HALAMAN FORGOT PASSWORD VIEW
  public function forgot()
  {
    $data = [
      "title" => "Lupa Password",
      "owner" => "Syifa Laundry"
    ];
    $this->view('pages/home/forgot', $data);
  }
  // CONF FORGOT PASSWORD
  public function forgot_send()
  {
    $fields = [
      'email_username' => 'string | required',
      'password' => 'string | required',
      'password_confirm' => 'string | required',
    ];
    $data_masuk['email_username'] = $_POST['email_user'];
    $data_masuk['password'] = $_POST['password_user'];
    $data_masuk['password_confirm'] = $_POST['re_password_user'];
    [$inputs, $errors] = $this->filter($data_masuk, $fields,  self::MESSAGE_FORGOT);
    if ($errors) {
      Message::setFlash('erorr', $errors[0], 'Lupa Password');
      $this->redirect('');
    } else {
      $procted = $this->Auth->getByEmailUsername($inputs['email_username']);
      if ($procted) {
        if ($inputs['password'] == $inputs['password_confirm']) {;
          $inputs['id'] = $procted['id_tmuld'];
          $inputs['password'] = password_hash($inputs['password'], PASSWORD_DEFAULT);
          $proc = $this->Auth->updatePassword($inputs);
          if ($proc) {
            Message::setFlash('success', 'berhasil', 'Password Berhasil Di Perbaharui');
            $this->redirect('');
          } else {
            Message::setFlash('warning', 'gagal', 'Password Gagal Di Perbaharui');
            $this->redirect('forgot');
          }
        } else {
          Message::setFlash('warning', 'gagal', 'Password Tidak Sesuai');
          $this->redirect('forgot');
        }
      } else {
        Message::setFlash('warning', 'gagal', 'email atau username tidak ditemukan');
        $this->redirect('forgot');
      }
    }
  }
  // SEND EMAIL
  public function sendEmail()
  {
    $nama = $_POST['name_your'];
    $email = $_POST['email_your'];
    $notelp = '+62' . $_POST['nomor_hp_your'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $mail = new PHPMailer(true);
    try {
      //Server settings
      // $mail->SMTPDebug = ;                                         //Enable verbose debug output
      $mail->isSMTP();                                                     //Send using SMTP
      $mail->Host         = 'smtp.gmail.com';                 //Set the SMTP server to send through
      $mail->SMTPAuth       = true;                                 //Enable SMTP authentication
      $mail->Username      = 'syifalaundry0319@gmail.com';   //SMTP username
      $mail->Password       = 'meyzohrnxdwdecdc';           //SMTP password
      $mail->SMTPSecure    = 'tls';                     //Enable implicit TLS encryption
      $mail->Port           = 587;                                       //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
      //Recipients
      $mail->setFrom('syifalaundry0319@gmail.com', 'Syifa Laundry');
      $mail->addAddress('syifalaundry0319@gmail.com', 'Syifa');     //Add a recipient
      //Content
      $mail->isHTML(true);                //Set email format to HTML
      $mail->Subject = $subject;
      $mail->Body    =
        '<strong>Pesan : </strong>' . $message . '<br>' .
        '<strong>Dari : </strong>' . $nama . '<br>' .
        '<strong>Email : </strong>' . $email . '<br>' .
        '<strong>Nomer Wa : </strong>' . '<a href="https://api.whatsapp.com/send?phone=' . $notelp . '&text=Hello ' . $nama . '"> ' . $notelp . '</a>';
      $mail->AltBody = 'Syifa Laundry';
      $mail->send();
      $reponse = [
        'status' => 200,
        'message' => 'Pesan anda berhasil di kirim',
      ];
      header('Content-Type: application/json');
      echo json_encode($reponse);
    } catch (Exception $e) {
      $reponse = [
        'status' => 400,
        'message' => 'Pesan anda gagal di kirim',
      ];
      header('Content-Type: application/json');
      echo json_encode($reponse);
    }
  }
}
