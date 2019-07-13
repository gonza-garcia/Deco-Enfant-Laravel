<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function admin($table)
    {

        $columns = \Illuminate\Support\Facades\Schema::getColumnListing($table);


        $order_by_options = \Illuminate\Support\Facades\Schema::getColumnListing($table);
                dd($columns,$order_by_options);
        $order_how_options=["ASC", "DESC"];
        $limit_options=["5", "10", "20", "50", "100", "200", "500"];

        $order_by = "id";     //valores que va a tomar la tabla por defecto
        $order_how = "ASC";
        $limit = "20";
        $page = 1;
        $total_rows = DB::select("SELECT COUNT(*) as cantidad FROM products");
        $pages_qty = ceil($total_rows[0]->cantidad / $limit);

        if ((isset($_GET['order_by'])) &&
            (isset($_GET['order_how'])) &&
            (isset($_GET['limit'])) &&
            (isset($_GET['page'])) &&
            (in_array($_GET['order_by'], $order_by_options)) &&
            (in_array($_GET['order_how'], $order_how_options)) &&
            (in_array($_GET['limit'], $limit_options)) &&
            (is_numeric($_GET['page'])))
        {
            $order_by = $_GET["order_by"];
            $order_how = $_GET["order_how"];
            $limit = $_GET["limit"];
            $page = round($_GET["page"]);

            // // setea offset de acuerdo al valor de page y limit
            // if ($page<=1)
            //     $offset = 0;
            // elseif ($page >= $pages_qty)
            //     $offset = $limit * ($pages_qty - 1);
            // else
            //     $offset = $limit * ($page - 1);
        } else {
             echo "Hubo un error.";
             exit;
        }


        // Traer todos los productos
        // $stmt = $db->prepare("SELECT * FROM products ORDER BY $order_by $order_how LIMIT $limit OFFSET $offset");
        // $stmt->execute();

        $all_products = \App\Product::orderBy($order_by, $order_how)->paginate($limit);
        $all_colors = \App\Color::all();
        $all_sizes = \App\Size::all();
        $all_categories = \App\Category::all();
        $all_sub_categories = \App\Subcategory::all();


        $all_products->withPath('?order_by='.$order_by.'&order_how='.$order_how. '&limit='.$limit);

        return view("admin_table", compact("order_by","order_how","offset","limit","pages_qty","page","total_rows","all_products","all_colors","all_sizes","all_categories","all_sub_categories","order_by_options","order_how_options","limit_options"));
    }
}
