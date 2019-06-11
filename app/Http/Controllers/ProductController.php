<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Product;
use App\Color;
use App\Size;
use App\Category;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order_by_options = ["id","name","short_desc","long_desc","price","thumbnail","color_id","size_id","stock","date_upload","date_update","discount_off","category_id"];
        $order_how_options=["ASC", "DESC"];
        $limit_options=["5", "10", "20", "50", "100", "200", "500"];

        $order_by = "id";     //valores que va a tomar la tabla por defecto
        $order_how = "ASC";
        $limit = "20";
        $page = 1;
        $offset = 0;
        $total_rows = DB::select("SELECT COUNT(*) as cantidad FROM products");
        $pages_qty = ceil($total_rows[0]->cantidad / $limit);

        // if ((isset($_GET["order_by"]) && array_key_exists($_GET["order_by"],$order_by_options))
        //     && (isset($_GET["order_how"]) && in_array($_GET["order_how"],$order_how_options))
        //     && (isset($_GET["limit"]) && in_array($_GET["limit"],$limit_options))
        //     && (isset($_GET["page"]) && is_numeric($_GET["page"])))
        // {
        //     $order_by = $_GET["order_by"];
        //     $order_how = $_GET["order_how"];
        //     $limit = $_GET["limit"];
        //     $page = round($_GET["page"]);
        //
        //     // setea offset de acuerdo al valor de page y limit
        //     if ($page<=1)
        //         $offset = 0;
        //     elseif ($page >= $pages_qty)
        //         $offset = $limit * ($pages_qty - 1);
        //     else
        //         $offset = $limit * ($page - 1);
        // }
        // else {
        //     echo "Hubo un error.";
        //     exit;
        // }

        // Traer todos los productos
        // $stmt = $db->prepare("SELECT * FROM products ORDER BY $order_by $order_how LIMIT $limit OFFSET $offset");
        // $stmt->execute();

        $all_products = Product::orderBy($order_by, $order_how)->paginate($limit);
        $all_colors = Color::all();
        $all_sizes = Size::all();
        $all_categories = Category::where('id_parent', '=', 0);
        $all_sub_categories = Category::where('id_parent', '!=', 0);

        return view("products", compact("order_by","order_how","offset","limit","pages_qty","page","total_rows","all_products","all_colors","all_sizes","all_categories","all_sub_categories","order_by_options","order_how_options","limit_options"));
    }










    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        return view("product_show", compact("product"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
