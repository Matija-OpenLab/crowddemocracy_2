<?php namespace AhmadFatoni\ApiGenerator\Controllers\API;

use Cms\Classes\Controller;
use BackendMenu;

use Illuminate\Http\Request;
use AhmadFatoni\ApiGenerator\Helpers\Helpers;
use Illuminate\Support\Facades\Validator;
use SebastianHalas\Communities\Models\Communities;
class communitiesController extends Controller
{
	protected $Communities;

    protected $helpers;

    public function __construct(Communities $Communities, Helpers $helpers)
    {
        parent::__construct();
        $this->Communities    = $Communities;
        $this->helpers          = $helpers;
    }

    public function index(){

        $data = $this->Communities->all()->toArray();

        return $this->helpers->apiArrayResponseBuilder(200, 'success', $data);
    }

    public function show($id){

        $data = $this->Communities->where('id',$id)->first();

        //if( !empty($data)){

            return $this->helpers->apiArrayResponseBuilder(200, 'success', $data);

        //}

       // $this->helpers->apiArrayResponseBuilder(400, 'bad request', ['error' => 'invalid key']);

    }

    public function store(Request $request){

    	$arr = $request->all();

        while ( $data = current($arr)) {
            $this->Communities->{key($arr)} = $data;
            next($arr);
        }

        $validation = Validator::make($request->all(), $this->Communities->rules);
        
        if( $validation->passes() ){
            $this->Communities->save();
            return $this->helpers->apiArrayResponseBuilder(201, 'created', ['id' => $this->Communities->id]);
        }else{
            return $this->helpers->apiArrayResponseBuilder(400, 'fail', $validation->errors() );
        }

    }

    public function update($id, Request $request){

        $status = $this->Communities->where('id',$id)->update($data);
    
        if( $status ){
            
            return $this->helpers->apiArrayResponseBuilder(200, 'success', 'Data has been updated successfully.');

        }else{

            return $this->helpers->apiArrayResponseBuilder(400, 'bad request', 'Error, data failed to update.');

        }
    }

    public function delete($id){

        $this->Communities->where('id',$id)->delete();

        return $this->helpers->apiArrayResponseBuilder(200, 'success', 'Data has been deleted successfully.');
    }

    public function destroy($id){

        $this->Communities->where('id',$id)->delete();

        return $this->helpers->apiArrayResponseBuilder(200, 'success', 'Data has been deleted successfully.');
    }


    public static function getAfterFilters() {return [];}
    public static function getBeforeFilters() {return [];}
    public static function getMiddleware() {return [];}
    public function callAction($method, $parameters=false) {
        return call_user_func_array(array($this, $method), $parameters);
    }
    
}