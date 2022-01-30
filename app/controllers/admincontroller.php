<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../services/adminservice.php';
require __DIR__ . '/../models/product.php';
require __DIR__ . '/../models/user.php';

class AdminController extends Controller
{
    private $adminService;

    function __construct()
    {
        session_start();
        $this->adminService = new AdminService();
    }

    public function index()
    {
        if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']) {
            $orders = $this->adminService->getOrders();
            $this->displayView($orders);
        } else {
            $this->noPermission();
        }
    }

    public function editOrder()
    {
        if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']) {
            if (!empty($_POST["id"]) && !empty($_POST["status"])) {
                $this->adminService->updateOrder(htmlspecialchars($_POST["id"]), htmlspecialchars($_POST["status"]));
            }
        } else {
            $this->noPermission();
        }
    }

    public function editProduct()
    {
        if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']) {
            require __DIR__ . '/../views/admin/editproduct.php';
        } else {
            $this->noPermission();
        }
    }

    public function updateProduct()
    {
        if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']) {
            if (!empty($_POST["action"])) {
                switch ($_POST["action"]) {
                    case 'update':
                        if (!empty($_POST["id"]) && !empty($_POST["title"]) && !empty($_POST["content"]) && !empty($_POST["rating"]) && !empty($_POST["price"])) {
                            $this->adminService->updateProduct(htmlspecialchars($_POST["id"]), htmlspecialchars($_POST["title"]), htmlspecialchars($_POST["content"]), htmlspecialchars($_POST["rating"]), htmlspecialchars($_POST["price"]));
                        }
                        break;
                    case 'delete':
                        if (!empty($_POST["id"])) {
                            $this->adminService->deleteProduct($_POST["id"]);
                        }
                        break;
                }
            }
        } else {
            $this->noPermission();
        }
    }

    public function addProduct()
    {
        if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']) {
            require __DIR__ . '/../views/admin/addproduct.php';
        } else {
            $this->noPermission();
        }
    }

    public function _addProduct()
    {
        if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']) {
            $title = htmlspecialchars($_POST['title']);
            $description = htmlspecialchars($_POST['description']);
            $rating = htmlspecialchars($_POST['rating']);
            $price = htmlspecialchars($_POST['price']);

            //(Uploading images works on localhost, not on Heroku) Uncomment this to upload images on localhost
            /* Upload image 
            define('SITE_ROOT', realpath(dirname(__FILE__)));
            $output_dir = SITE_ROOT . "/../public/img"; //Path for file upload
            $fileCount = count($_FILES["image"]['name']);
            $RandomNum = time();
            $ImageName = str_replace(' ', '-', strtolower($_FILES['image']['name'][0]));
            $ImageType = $_FILES['image']['type'][0]; //"image/png", image/jpeg etc.
            $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
            $ImageExt = str_replace('.', '', $ImageExt);
            $ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
            $NewImageName = $ImageName . '-' . $RandomNum . '.' . $ImageExt;
            $ret[$NewImageName] = $output_dir . $NewImageName;
            move_uploaded_file($_FILES["image"]["tmp_name"][0], $output_dir . "/" . $NewImageName);
            $data = array(
                'image' => $NewImageName
            );
            $image = "/img/" . $NewImageName;*/

            //comment this line to upload images on localhost
            $image = "https://images.ctfassets.net/gtq5kcq8pjem/65pcZKuHDqSlS76Q90Qw2U/973124efa30fd55090c7d2d65355af78/1_2x.jpg?w=450&h=450";

            require __DIR__ . '/../views/admin/addproduct.php';
            $product = new Product($title, $description, $rating, $price, $image);
            $this->adminService->addProduct($product);
        } else {
            $this->noPermission();
        }
    }

    public function register()
    {
        if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']) {
            require __DIR__ . '/../views/admin/register.php';
        } else {
            $this->noPermission();
        }
    }

    public function _register()
    {
        if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']) {
            if (isset($_POST['register'])) {
                try {
                    $username = htmlspecialchars($_POST['username']);
                    $email = htmlspecialchars($_POST['email']);
                    $password = htmlspecialchars($_POST['password']);
                    $hashed_password = password_hash(htmlspecialchars($password), PASSWORD_DEFAULT);
                    $user = new User($username, $email, $hashed_password);
                    require __DIR__ . '/../views/admin/register.php';
                    $this->adminService->register($user);
                } catch (Exception $e) {
                    echo $e;
                    echo "Er ging iets verkeerd...";
                }
            }
        } else {
            $this->noPermission();
        }
    }

    public function noPermission()
    {
        echo "<h1>Geen toegang tot deze pagina.</h1>";
        echo "<h3>Error code: 403 forbidden</h3>";
        echo "<a href='/home'>Terug naar homepagina</a>";
    }
}
