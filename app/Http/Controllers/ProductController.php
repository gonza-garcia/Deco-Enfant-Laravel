<?php

namespace App\Http\Controllers;
use App\Http\Requests\SaveProductRequest;
use App\Http\Resources\Product as ProductResource;

use Illuminate\Support\Facades\DB;
use App\Product;
use App\Category;
use App\Subcategory;

use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')       ->except('index','show');
        $this->middleware('checkRole:1')->except('index','show');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $products     = Product::paginate(8);
      $categories   = Category::orderBy('name')->get();

      return view ('products', compact('products','categories'));
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
    public function store(SaveProductRequest $request)
    {
        // $product = Product::create($request->validated());

        // return ProductResource::make($product);

        $newPath = 'public/img/products\\' . $request->thumbnail->getFilename() . '.jpg';
        $success = \File::copy($request->thumbnail->getRealPath(), base_path($newPath));

        $prod = ['name'           => $request->name,
                 'short_desc'     => $request->short_desc,
                 'long_desc'      => $request->long_desc,
                 'price'          => $request->price,
                 'thumbnail'      => './img/products\\' . $request->thumbnail->getFileName() . '.jpg',
                 'stock'          => $request->stock,
                 'discount'       => $request->discount,
                 'color_id'       => $request->color_id,
                 'size_id'        => $request->size_id,
                 'subcategory_id' => $request->subcategory_id,
               ];

        \App\Product::create($prod);

        return redirect('/productos/admin?table=products&order_by=id&order_how=ASC&limit=20&page=1');
    }




    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('product', compact('product'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $prod = \App\Product::findOrFail($id);

        $newPath = 'public/img/products\\' . $request->thumbnail->getFilename() . '.jpg';
        $success = \File::copy($request->thumbnail->getRealPath(), base_path($newPath));

        $prod->update([ 'name'           => $request->name,
                        'short_desc'     => $request->short_desc,
                        'long_desc'      => $request->long_desc,
                        'price'          => $request->price,
                        'thumbnail'      => './img/products\\' . $request->thumbnail->getFileName() . '.jpg',
                        'stock'          => $request->stock,
                        'discount'       => $request->discount,
                        'color_id'       => $request->color_id,
                        'size_id'        => $request->size_id,
                        'subcategory_id' => $request->subcategory_id,
                      ]);

        return redirect('/productos/admin?table=products&order_by=id&order_how=ASC&limit=20&page=1');
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

    public function search($buscado)
    {
        $products = Product::where('name', 'like', '%'.$buscado.'%')->get();
        $categories = Category::orderBy('name')->get();

        return view ('products', compact('products', 'categories'));
    }

    public function destacados()
    {
        $products = Product::orderBy('created_at', 'desc')
        ->limit(8)
        ->get();

        return view ("/index", compact('products'));
    }


    public function sale()
    {
        $products = Product::where('discount', '!=', '0')->paginate(8);
        $categories = Category::orderBy('name')->get();

        foreach($products as $product)
        {
            if($product->discount > 0)
            {
                $discountCalc = $product->price - ($product->discount / 100 * $product->price);
            }
        }

        $vac = compact('products', 'categories', 'product', 'discountCalc');
        return view('/sale', $vac);
    }



    public function admin()
    {
        $columns = ['id'             => ['width' => '2.00%', 'name' => 'Id'],
                    'name'           => ['width' => '5.00%', 'name' => 'Nombre'],
                    'short_desc'     => ['width' => '13.5%', 'name' => 'Descripción Corta'],
                    'long_desc'      => ['width' => '13.5%', 'name' => 'Descripción Larga'],
                    'price'          => ['width' => '4.00%', 'name' => 'Precio'],
                    'thumbnail'      => ['width' => '4.00%', 'name' => 'Imagen'],
                    'stock'          => ['width' => '4.00%', 'name' => 'Stock'],
                    'discount'       => ['width' => '4.00%', 'name' => 'Descuento'],
                    'color_id'       => ['width' => '5.00%', 'name' => 'Color'],
                    'size_id'        => ['width' => '5.00%', 'name' => 'Tamaño'],
                    'category_id'    => ['width' => '5.00%', 'name' => 'Categoría'],
                    'subcategory_id' => ['width' => '5.00%', 'name' => 'Subcategoría'],
                    'created_at'     => ['width' => '10.0%', 'name' => 'Creado'],
                    'updated_at'     => ['width' => '5.00%', 'name' => 'Actualizado'],
                    'deleted_at'     => ['width' => '5.00%', 'name' => 'Borrado'],
                    ];

        $order_how_options=["ASC", "DESC"];
        $limit_options=["5", "10", "20", "50", "100", "200", "500"];

        $order_by = "id";     //valores que va a tomar la tabla por defecto
        $order_how = "ASC";
        $limit = "20";
        $page = 1;
        $total_rows = DB::select("SELECT COUNT(*) as cantidad FROM products")[0]->cantidad;

        if ((isset($_GET['order_by'])) &&
            (isset($_GET['order_how'])) &&
            (isset($_GET['limit'])) &&
            (isset($_GET['page'])) &&
            (array_key_exists($_GET['order_by'], $columns)) &&
            (in_array($_GET['order_how'], $order_how_options)) &&
            (in_array($_GET['limit'], $limit_options)) &&
            (is_numeric($_GET['page'])))
        {
            $order_by = $_GET["order_by"];
            $order_how = $_GET["order_how"];
            $limit = $_GET["limit"];
            $page = round($_GET["page"]);

        } else {
             echo "Hubo un error.";
             exit;
        }

        $all_products = \App\Product::orderBy($order_by, $order_how)->paginate($limit);

        $all_colors = \App\Color::all();
        $all_sizes = \App\Size::all();
        $all_categories = \App\Category::all();
        $all_subcategories = \App\Subcategory::all();

        $all_products->withPath('?table=products&order_by='.$order_by.'&order_how='.$order_how. '&limit='.$limit);

        return view("admin_products", compact("columns","order_by","order_how","limit","order_how_options","limit_options","page","total_rows","all_products","all_colors","all_sizes","all_categories","all_subcategories"));
    }
}
