<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Product;
use App\Categoria;
use App\Subcategoria;
use File;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\CreateProduct;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Filesystem\Filesystem;
use DB;
use Illuminate\Support\Facades\Crypt;

use Intervention\Image\ImageManager;
use Vanilo\Cart\Facades\Cart;

use Image;
use PDF;
use Redirect;
use App\ProductsImages;

use Carbon\Carbon;

class ProductoController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Product::whereNull('deleted_at')->paginate(12);

        
        foreach ($productos as $producto) {
            $imagen = DB::table('products_images')->where('path_image', $producto->path_image)->first();
            if(isset($imagen)){
                $producto->image =  '/img/products/'.$producto->path_image.'/thumbnails/'.$imagen->name;
            }else{
                $producto->image =  '/img/products/sin-imagen.jpg';
            }       
        }

        return view('productos.index',compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subcategorias = Subcategoria::pluck('descripcion','id')->all();
        $categorias = Categoria::pluck('descripcion','id')->all();

        return view('productos.create', compact('subcategorias', 'categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProduct $request)
    {   
        if ($request->ajax()) {

            $data = $request->all();

            if($data['sku'] == ''){
                 $data['sku'] = $data['categoria_id'].$data['subcategoria_id'].uniqid();
            }

            if(!isset($data['destacado'])){
                $data['destacado'] = 0;
            }

            if(!isset($data['dolar'])){
                $data['dolar'] = 0;
            }

            $product = Product::create([
                'name' => $data['name'],
                'categorie_id' => $data['categoria_id'],
                'subcategorie_id' => $data['subcategoria_id'],
                'sku'  => $data['sku'],
                'stock' => $data['stock'],
                'if_dolar' => $data['dolar'],
                'min' => $data['stock_minimo'],
                'max' => $data['stock_maximo'],
                'destacado' => $data['destacado'],
                'price' => $data['price'],
                'price_real' => $data['price_real'],
                'description' => $data['description'],
                'path_image' => uniqid()
            ]);

             return new JsonResponse([
                'msj' => 'Producto Agregado ;)',
                'type' => 'success',
                'id' => $product->id
            ]);    
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $producto = Product::find(Crypt::decrypt($id));

        $subcategorias = Subcategoria::pluck('descripcion','id')->all();
        $categorias = Categoria::pluck('descripcion','id')->all();

        return view('productos.edit', compact('producto', 'subcategorias', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->ajax()){
            $data = $request->all();
            $producto = Product::findOrFail(Crypt::decrypt($id));

            if(!isset($data['destacado'])){
                $data['destacado'] = 0;
            }

            if(!isset($data['dolar'])){
                $data['dolar'] = 0;
            }

            $producto->name = $data['name'];
            $producto->categorie_id = $data['categoria_id'];
            $producto->subcategorie_id = $data['subcategoria_id'];
            $producto->sku = $data['sku'];
            $producto->stock = $data['stock'];
            $producto->if_dolar = $data['dolar'];
            $producto->min = $data['stock_minimo'];
            $producto->max = $data['stock_maximo'];
            $producto->destacado = $data['destacado'];
            $producto->price = $data['price'];
            $producto->price_real = $data['price_real'];
            $producto->description = $data['description'];

            $producto->save();

            return new JsonResponse([
                'msj' => 'Producto editado exitosamente!!!',
                'type' => 'success'
            ]);
        }
        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function indexUploadImage($id){

        $producto = Product::find($id);
        return view('productos.cargar-imagenes', compact('producto'));

    }

    public function uploadImageProducts(Request $request){
        
        $product = Product::find($request->id);
        $id = $product->path_image;

        $path = public_path('/img/products/'.$id.'/');
        $pathIcon = public_path('/img/products/'.$id.'/thumbnails/');

        if(!is_dir($path)) mkdir($path,0777);
        if(!is_dir($pathIcon)) mkdir($pathIcon,0777);

       
        $files = $request->file('file');

        foreach($files as $file){
            $fileName = $file->getClientOriginalName();
            if (file_exists(public_path('img/products/'.$id.'/'.$fileName))) {
                  //  return new JsonResponse(['error' => 400]);
 
            }else{
                $file->move($path, $fileName); 
                $img = Image::make(public_path('img/products/'.$id.'/'.$fileName))->resize(140, 140);
                $img->save(public_path('img/products/'.$id.'/thumbnails/'.$fileName));

                DB::table('products_images')
                ->insert(['path_image' => $id, 'name' => $fileName, 'destacada' => 0]);
            }     
            
        }

          
    }

    public function removeImageProducts(Request $request){
        
        $product = Product::find($request->id);
        $id = $product->path_image;

        $path = public_path('/img/products/'.$id.'/');
        $pathIcon = public_path('/img/products/'.$id.'/thumbnails/');
        
        if(file_exists($path.$request->name)){
           
            DB::table('products_images')
            ->where('path_image', '=', $id)
            ->where('name', '=', $request->name)
            ->delete();
            File::delete($path.$request->name);
            File::delete($pathIcon.$request->name);
        }
    }

    public function getServerImages($id){
        
        $product = Product::find($id);
        $id = $product->path_image;

        $images = DB::table('products_images')
                    ->select('*')
                    ->where('path_image', '=', $id)
                    ->get();

        $imageAnswer = [];

        foreach ($images as $image) {
            $imageAnswer[] = [
                'name' => $image->name,
                'server' => $image->name,
                'size' => 123
            ];
        }

        return response()->json([
            'images' => $imageAnswer
        ]);
    }


    public function createCargaMasiva(){
        $subcategorias = Subcategoria::pluck('descripcion','id')->all();
        $categorias = Categoria::pluck('descripcion','id')->all();

        return view('productos.fields-massive', compact('subcategorias', 'categorias'));
    }

    public function storeCargaMasiva(Request $request){

        $data = $request->all();

        
        $id = uniqid();

        $path = public_path('/img/products/'.$id.'/');
        $pathIcon = public_path('/img/products/'.$id.'/thumbnails/');

        if(!is_dir($path)) mkdir($path,0777);
        if(!is_dir($pathIcon)) mkdir($pathIcon,0777);

        $files = $request->file('imagenes');

        foreach($files as $file){
            $fileName = $file->getClientOriginalName();
            if (file_exists(public_path('img/products/'.$id.'/'.$fileName))) {
                //  return new JsonResponse(['error' => 400]);
            }else{
                $file->move($path, $fileName); 
                $img = Image::make(public_path('img/products/'.$id.'/'.$fileName))->resize(140, 140);
                $img->save(public_path('img/products/'.$id.'/thumbnails/'.$fileName));

                DB::table('products_images')
                    ->insert(['path_image' => $id, 'name' => $fileName, 'destacada' => 0]);
            }     
        }   

         foreach ($data['producto'] as $p) {

            if($p['sku'] == ''){
                 $p['sku'] = $data['categoria_id'].$data['subcategoria_id'].uniqid();
            }

            if(!isset($data['destacado'])){
                $data['destacado'] = 0;
            }

            if(!isset($data['dolar'])){
                $data['dolar'] = 0;
            }

            $product = Product::create([
                'name' => $p['name'],
                'categorie_id' => $data['categoria_id'],
                'subcategorie_id' => $data['subcategoria_id'],
                'sku'  => $p['sku'],
                'stock' => $p['stock'],
                'if_dolar' => $data['dolar'],
                'min' => $p['min'],
                'max' => $p['max'],
                'destacado' => $data['destacado'],
                'price' => $data['price'],
                'price_real' => $data['price_real'],
                'description' => $p['description'],
                'path_image' => $id
            ]);
            
         }

            
               

        return redirect('/productos');
        
    }

    public function imprimirTikets(Request $request){
        $cantidad = $request->get('cantidad');
        $idProducto = $request->get('idProducto');
        
        $producto = Product::findOrFail($idProducto);

        
        $view =  \View::make('productos.pdf.codigoBarras', compact('producto', 'cantidad'));
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);

        return $pdf->stream('codigos');
    }

    public function indexDevoluciones(){
        $devoluciones = DB::table('devoluciones')
                        ->orderBy('id', 'DESC')->paginate(15);
        return view('productos.devoluciones.index',compact('devoluciones'));
    }

    public function createDevolucion(){
        Cart::clear();
        return view('productos.devoluciones.create');
    }

    public function storeDevolucion(Request $request){
        if($request->ajax()){
           
            $data = $request->all();

            $devolucion = DB::table('devoluciones')->insertGetId(['motivo' => $data['motivo'], 'created_at' => Carbon::now()]);

            foreach(Cart::model()->items->all() as $item){
                    DB::table('devoluciones_items')
                    ->insert([
                        'devolucion_id' =>  $devolucion, 
                        'product_id' => $item->product_id,
                        'quantity' => $item->quantity
                    ]);
            }       
            

            if($data['regresa_stock'] == 1){
                foreach(Cart::model()->items->all() as $item){
                    $s = HelpersController::restaurarStockByProducto($item->product_id, $item->quantity);
                }
            }

            Cart::clear();
        
            
            $urlRedirect = asset('productos');
            
            return new JsonResponse([
                    'type' => 'success',
                    'msj' => 'Devolución generada exitosamente', 
                    'redirect' => $urlRedirect
            ]);

        }
    }

    public function getProductosDevolucion(Request $request){
        $productos = DB::table('devoluciones_items')
                    ->join('products', 'devoluciones_items.product_id', '=', 'products.id')        
                    ->where('devoluciones_items.devolucion_id', $request->get('id'))
                    ->select('*', 'products.name as nombre')
                    ->get();


        return new JsonResponse([
            'productos' => $productos
        ]);
    }

    public function find(Request $request){
        $producto = Product::where('name', 'LIKE', '%' . $request->get('query') . '%')->get();

        if(count($producto)>0){
            $output = '<ul class="dropdown-menu" style="display:block; position:absolute">';

            foreach ($producto as $p) {
               $output .= '<li id="list'.$p->id.'" onClick="seleccionarProducto(\''.$p->sku.'\')"><a>'.$p->name.' ('.$p->sku.')</a></li>';
            }

            $output .= '</ul>';

            echo $output;   
        }
         
    }




    /**
   
    
    public function detalleProducto($slug){
        
        $producto = $this->getProductoDetalle($slug);
        
        $categoria = ProductoCategoria::where('product_id', $producto->id)->get();
        $cat_id = $categoria->last()->category_id;
        
        $relacionados = $this->getProductosRelacionados($cat_id, $slug);
        
        $direccion = "";
        
        if (Auth::check()){
            $customer = Customer::join('customer_users', 'customers.id', 'customer_users.customer_id')
                                ->join('users', 'users.id', 'customer_users.user_id')
                                ->where('users.id', Auth::user()->id)->first();
            
            $direccion = Address::join('customer_addresses', 'addresses.id', 'customer_addresses.address_id')
                                ->where('customer_addresses.customer_id', $customer->customer_id)
                                ->first();
        }
        
        //PROMOCIONES
        $promociones = $this->getProductoPromociones($producto->id);
        
        return view('front.productos.view', [
            'producto' => $producto,
            'relacionados' => $relacionados,
            'direccion' => $direccion,
            'promociones' => $promociones
        ]);
    }
    
     
    public function calcularEnvio(Request $request){

         if ($request->ajax()) {
             
            Log::info('====== Calculo costos de envio desde el detalle del producto ======');
             
           $data = $request->all();
             
           $producto = Product::find($data['productoId']);
           $cantidad = $data['cantidad'];
             
           //operativa : 279255(Envios P a P) 279256 (Envios P a S) 279257 (Envios S a P) 279258 (Envios S a S)
            $oca    = new Oca($cuit = '30-71224182-5', $operativa = 279255);

            $baseCm = $producto->ancho;
            $baseMt = $baseCm / 100;
            $altoCm = $producto->alto;
            $altoMt = $altoCm / 100;
            $profundidadCm = $producto->largo;
            $profundidadMt = $profundidadCm / 100;
             
            $volumenTotal = ($baseMt * $altoMt * $profundidadMt) * $cantidad;
            $volumenTotal = $this->exp_to_dec($volumenTotal);
            $pesoTotal = $producto->peso * $cantidad;
             
            Log::info('Cantidad prod: '.$data['cantidad']);
            Log::info('Volumen desde detalle prod: '.$volumenTotal);
            Log::info('Peso desde detalle prod: '.$pesoTotal);
             
            $codigoPostalOrigen = '1900';
            $codigoPostalDestino = $data['codigoPostal'];
            Log::info('CP desde detalle prod: '.$codigoPostalDestino);
             
            $cantidadPaquetes = '1';

            $respuesta  = $oca->tarifarEnvioCorporativo($pesoTotal, $volumenTotal, $codigoPostalOrigen, $codigoPostalDestino, $cantidadPaquetes, $operativa);
            $precio = number_format($respuesta[0]['Total'], 2);
            $plazo = $respuesta[0]['PlazoEntrega'];
            
            //configuro codigo postales envios gratuitos
            $envios_gratuitos = array("1900", "1923", "1896", "1925", "1894", "1897");
            $montoTotal = $producto->price * $cantidad;
            Log::info('Monto total: '.$montoTotal);
            if(in_array($codigoPostalDestino, $envios_gratuitos ) && $montoTotal >= 450){
                $precio = "<p style='color:#00AE7C;font-size:15px;'><b>Sin Cargo!</b></p>";
            }else{
                $precio = "$ ".number_format($respuesta[0]['Total'], 2);
            }
            //fin envios gratuitos
            //return $respuesta;
            
            Log::info('Costo envio desde detalle prod: '.$precio);
             
            return new JsonResponse([
                'precio'=> $precio,
                'plazo' => $plazo
            ]);
        }else{
            echo "no se envio nada";
        }
    }
    
    private function exp_to_dec($float_str){
        // make sure its a standard php float string (i.e. change 0.2e+2 to 20)
        // php will automatically format floats decimally if they are within a certain range
        $float_str = (string)((float)($float_str));

        // if there is an E in the float string
        if(($pos = strpos(strtolower($float_str), 'e')) !== false)
        {
            // get either side of the E, e.g. 1.6E+6 => exp E+6, num 1.6
            $exp = substr($float_str, $pos+1);
            $num = substr($float_str, 0, $pos);

            // strip off num sign, if there is one, and leave it off if its + (not required)
            if((($num_sign = $num[0]) === '+') || ($num_sign === '-')) $num = substr($num, 1);
            else $num_sign = '';
            if($num_sign === '+') $num_sign = '';

            // strip off exponential sign ('+' or '-' as in 'E+6') if there is one, otherwise throw error, e.g. E+6 => '+'
            if((($exp_sign = $exp[0]) === '+') || ($exp_sign === '-')) $exp = substr($exp, 1);
            else trigger_error("Could not convert exponential notation to decimal notation: invalid float string '$float_str'", E_USER_ERROR);

            // get the number of decimal places to the right of the decimal point (or 0 if there is no dec point), e.g., 1.6 => 1
            $right_dec_places = (($dec_pos = strpos($num, '.')) === false) ? 0 : strlen(substr($num, $dec_pos+1));
            // get the number of decimal places to the left of the decimal point (or the length of the entire num if there is no dec point), e.g. 1.6 => 1
            $left_dec_places = ($dec_pos === false) ? strlen($num) : strlen(substr($num, 0, $dec_pos));

            // work out number of zeros from exp, exp sign and dec places, e.g. exp 6, exp sign +, dec places 1 => num zeros 5
            if($exp_sign === '+') $num_zeros = $exp - $right_dec_places;
            else $num_zeros = $exp - $left_dec_places;

            // build a string with $num_zeros zeros, e.g. '0' 5 times => '00000'
            $zeros = str_pad('', $num_zeros, '0');

            // strip decimal from num, e.g. 1.6 => 16
            if($dec_pos !== false) $num = str_replace('.', '', $num);

            // if positive exponent, return like 1600000
            if($exp_sign === '+') return $num_sign.$num.$zeros;
            // if negative exponent, return like 0.0000016
            else return $num_sign.'0.'.$zeros.$num;
        }
        // otherwise, assume already in decimal notation and return
        else return $float_str;
    }
    
    
    
    private function getProductoPromociones($prod_id){
        $now = new \DateTime();
        
        $promocion = Promotion::join('promotions_conditions', 'promotions.id', 'promotions_conditions.promotion_id')
                              ->join('promotions_rewards', 'promotions.id', 'promotions_rewards.promotion_id')
                              ->where('promotions_conditions.product_id', $prod_id)
                              ->where('promotions.date_from', '<=', $now->format('Y-m-d'))
                              ->where('promotions.date_to', '>=', $now->format('Y-m-d'))
                              ->get();
        
        return $promocion;
    }
    
    

    */
}
