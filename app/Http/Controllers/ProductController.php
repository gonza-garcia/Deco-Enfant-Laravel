<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Product;
use App\Size;
use App\Color;
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
      $products = Product::paginate(8);

      $vac = compact("products");
      return view ("products",$vac);

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
    public function show(Product $prod)
    {
      $product = Product::find($prod->id);

      $category = Category::select('categories.name')
      ->join('products', 'category_id', '=', 'categories.id')
      ->where('category_id', $prod->category_id)
      ->first();
    //   dd($category->name);

      $vac = compact("product", "category");
      return view("product",$vac);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
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
    public function destroy(Product $product)
    {
        //
    }

    public function search($buscado){
        
    }

    public function admin()
    {
        $order_by_options = ["id","name","short_desc","long_desc","price","thumbnail","stock","discount_off","size_id","color_id","category_id","created_at","updated_at","deleted_at"];
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

        $all_products = Product::orderBy($order_by, $order_how)->paginate($limit);
        $all_colors = Color::all();
        $all_sizes = Size::all();
        $all_categories = Category::where('id_parent', '=', 0);
        $all_sub_categories = Category::where('id_parent', '!=', 0);


        $all_products->withPath('?order_by='.$order_by.'&order_how='.$order_how. '&limit='.$limit);

        return view("table_product", compact("order_by","order_how","offset","limit","pages_qty","page","total_rows","all_products","all_colors","all_sizes","all_categories","all_sub_categories","order_by_options","order_how_options","limit_options"));
    }

    public function destacados()
    {
      $products = Product::orderBy('created_at', 'desc')
      ->limit(8)
      ->get();

      // dd($products);

      $vac = compact("products");
      return view ("/index",$vac);
    }

}
