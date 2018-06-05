<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Cities;
use App\Http\Requests;
use JWTAuth;
use Response;
use App\Repository\Transformers\CitiesTransformer;
use \Illuminate\Http\Response as Res;
use Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Input;

class CitiesController extends ApiController
{
    protected $citiesTransformer;


    public function __construct(CitiesTransformer $citiesTransformer)
    {

        $this->citiesTransformer = $citiesTransformer;

    }

    /**
     * @description: view all cities
     * @author: Adelekan David Aderemi
     * @param: null
     * @return: Json String response
     */
    public function index(){

        $limit = Input::get('limit') ?: 3;

        $cities = Cities::with('user')->paginate($limit);

        return $this->respondWithPagination($cities, [
            'cities' => $this->citiesTransformer->transformCollection($cities->all())
        ], 'Records Found!');

    }

    /**
     * @description: view one cities
     * @author: Adelekan David Aderemi
     * @param: id
     * @return: Json String response
     */
    public function show($id){

        $article = Cities::with('user')->find($id);

        if(!$article){

            $article = Cities::where('slug', $id)->firstOrFail();
        }

        if(count($article) == 0){
            return $this->respondWithError("Cities Not Found!");
        }

        return $this->respond([

            'status' => 'success',
            'status_code' => $this->getStatusCode(),
            'message' => 'Record Found',
            'article' => $this->citiesTransformer->transform($article)
        ]);


    }

    /**
     * @description: create an article
     * @author: Adelekan David Aderemi
     * @param: api form data
     * @return: Json String response
     */
    public function store(Request $request){

        $rules = array (

            'api_token' => 'required',
            'name' => 'required',
            'slug' => 'required|unique:cities',
            'body' => 'required'

        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator-> fails()){

            return $this->respondValidationError('Fields Validation Failed.', $validator->errors());

        }

        $api_token = $request['api_token'];

        try{

            $user = JWTAuth::toUser($api_token);

            $article = new Cities();
            $article->user_id = $user->id;
            $article->name = $request['name'];
            $article->slug = $request['slug'];
            $article->body = $request['body'];
            $article->save();

            return $this->respondCreated('Cities created successfully!', $this->citiesTransformer->transform($article));

        }catch(JWTException $e){

            return $this->respondInternalError("An error occurred while performing an action!");

        }

    }

    /**
     * @description: update an article
     * @author: Adelekan David Aderemi
     * @param: api form data
     * @return: Json String response
     */
    public function update(Request $request){
        $rules = array (
            'id' => 'required|integer',
            'api_token' => 'required',
            'name' => 'required',
            'slug' => 'required|unique:cities',
            'body' => 'required'

        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator-> fails()){

            return $this->respondValidationError('Fields Validation Failed.', $validator->errors());

        }

        $api_token = $request['api_token'];

        try{

            $user = JWTAuth::toUser($api_token);

            $article = Article::find($request['id']);
            $article->user_id = $user->id;
            $article->name = $request['name'];
            $article->slug = $request['slug'];
            $article->body = $request['body'];
            $article->save();

            return $this->respondCreated('Cities updated successfully!', $this->citiesTransformer->transform($article));

        }catch(JWTException $e){

            return $this->respondInternalError("An error occurred while performing an action!");

        }


    }

    /**
     * @description: delete an article
     * @author: Adelekan David Aderemi
     * @param: id
     * @return: Json String response
     */
    public function delete($id, $api_token){

        try{

            $user = JWTAuth::toUser($api_token);

            $article = Cities::where('id', $id)->where('user_id', $user->id);
            $article->delete();

            return $this->respond([

                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Cities deleted successfully!'
            ]);


        }catch(JWTException $e){

            return $this->respondInternalError("An error occurred while performing an action!");

        }

    }
}
