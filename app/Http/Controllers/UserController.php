<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function api() {
        return User::all();
    }

    public function single_user_api($id){
        return User::find($id);
    }

    public function update(Request $request, $id)
    {
        $prod = \App\Product::findOrFail($id);

        $newPath = 'public\img\products\\' . $request->thumbnail->getFilename() . '.jpg';
        $success = \File::copy($request->thumbnail->getRealPath(), base_path($newPath));

        $prod->update([ 'name'           => $request->name,
                        'short_desc'     => $request->short_desc,
                        'long_desc'      => $request->long_desc,
                        'price'          => $request->price,
                        'thumbnail'      => '.\img\products\\' . $request->thumbnail->getFileName() . '.jpg',
                        'stock'          => $request->stock,
                        'discount'       => $request->discount,
                        'color_id'       => $request->color_id,
                        'size_id'        => $request->size_id,
                        'subcategory_id' => $request->subcategory_id,
                      ]);

        return redirect('/productos/admin?table=products&order_by=id&order_how=ASC&limit=20&page=1');
    }

    public function add(Request $request)
    {
        $newPath = 'public\img\products\\' . $request->thumbnail->getFilename() . '.jpg';
        $success = \File::copy($request->thumbnail->getRealPath(), base_path($newPath));

        $prod = ['name'           => $request->name,
                 'short_desc'     => $request->short_desc,
                 'long_desc'      => $request->long_desc,
                 'price'          => $request->price,
                 'thumbnail'      => '.\img\products\\' . $request->thumbnail->getFileName() . '.jpg',
                 'stock'          => $request->stock,
                 'discount'       => $request->discount,
                 'color_id'       => $request->color_id,
                 'size_id'        => $request->size_id,
                 'subcategory_id' => $request->subcategory_id,
               ];
         $columns = ['id'             => $request->name,
                     'name'           => $request->name,
                     'first_name'     => $request->name,
                     'last_name'      => $request->name,
                     'email'          => $request->name,
                     'password'       => $request->name,
                     'phone'          => $request->name,
                     'date_of_birth'  => $request->name,
                     'province_id'    => $request->name,
                     'sex_id'         => $request->name,
                     'role_id'        => $request->name,
                     'user_status_id' => $request->name,
                     'created_at'     => $request->name,
                     'updated_at'     => $request->name,
                     'deleted_at'     => $request->name,
                     ];

        \App\Product::create($prod);

        return redirect('/productos/admin?table=products&order_by=id&order_how=ASC&limit=20&page=1');
    }


    public function admin()
    {
        $columns = ['id'             => ['width' => '2.00%', 'name' => 'Id'],
                    'name'           => ['width' => '6.00%', 'name' => 'Nombre'],
                    'first_name'     => ['width' => '6.5%', 'name' => 'Primer Nombre'],
                    'last_name'      => ['width' => '6.5%', 'name' => 'Apellido'],
                    'email'          => ['width' => '6.00%', 'name' => 'Email'],
                    'password'       => ['width' => '6.00%', 'name' => 'Pass'],
                    'phone'          => ['width' => '4.00%', 'name' => 'Telefono'],
                    'date_of_birth'  => ['width' => '4.00%', 'name' => 'Fecha De Nacimiento'],
                    'province_id'    => ['width' => '5.00%', 'name' => 'Provincia'],
                    'sex_id'         => ['width' => '5.00%', 'name' => 'Sexo'],
                    'role_id'        => ['width' => '5.00%', 'name' => 'Role'],
                    'user_status_id' => ['width' => '5.00%', 'name' => 'Estado'],
                    'created_at'     => ['width' => '5.00%', 'name' => 'Creado'],
                    'updated_at'     => ['width' => '5.00%', 'name' => 'Actualizado'],
                    'deleted_at'     => ['width' => '5.00%', 'name' => 'Borrado'],
                    ];

        $order_how_options=["ASC", "DESC"];
        $limit_options=["5", "10", "20", "50", "100", "200", "500"];

        $order_by = "id";     //valores que va a tomar la tabla por defecto
        $order_how = "ASC";
        $limit = "20";
        $page = 1;
        $total_rows = DB::select("SELECT COUNT(*) as cantidad FROM users")[0]->cantidad;

        // dd((isset($_GET['order_by'])),
        //     (isset($_GET['order_how'])),
        //     (isset($_GET['limit'])),
        //     (isset($_GET['page'])),
        //     (array_key_exists($_GET['order_by'], $columns)),
        //     (in_array($_GET['order_how'], $order_how_options)),
        //     (in_array($_GET['limit'], $limit_options)),
        //     (is_numeric($_GET['page'])));

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

        $all_users = \App\Users::orderBy($order_by, $order_how)->paginate($limit);

        $all_provinces = \App\Color::all();
        $all_sexes = \App\Sex::all();
        $all_roles = \App\Role::all();
        $all_user_statuses = \App\User_status::all();

        $all_products->withPath('?table=users&order_by='.$order_by.'&order_how='.$order_how. '&limit='.$limit);

        return view("admin_users", compact("columns","order_by","order_how","limit","order_how_options","limit_options","page","total_rows","all_users","all_provinces","all_roles","all_sexes","all_user_statuses"));
    }
}
