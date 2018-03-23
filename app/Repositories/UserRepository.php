<?php
namespace App\Repositories;

use App\Models\User;
use App\Models\Link;
use Illuminate\Foundation\Auth\RegistersUsers;

class UserRepository
{
    use RegistersUsers;

    public function __construct()
    {
        // $this->middleware('guest');
    }
    public function getAll()
    {
        return User::all();
    }
    public function getUserById($id)
    {
        return User::find($id);
    }

    public function shortUrl(array $data)
    {

        $rules = array(
            'url' => 'required'
        );
        
          //Then we run the form validation
        $validation = \Validator::make($data, $rules);
          //If validation fails, we return to the main page with an error info
        if ($validation->fails()) {
            return array('status' => 422, 'response' => 'Error in Creating Url ');
        }
        if (filter_var($data['url'], FILTER_VALIDATE_URL) === false) {
            return array('status' => 422, 'response' => 'Not a valid Url ');
        } else {

            $results = Link::where('url', $data['url'])->first();

            if (is_null($results)) {
                $link = new Link();
                $data['hash'] = str_random(6);
                $data['created_at'] = date('Y-m-d H:i:s');
               // dd($data);
                $link->fill($data);
                $link->save();
            } else {

                Link::where('url', $data['url'])
                    ->update(['updated_at' => date('Y-m-d H:i:s')]);
            }
            $results = Link::where('url', $data['url'])->first();
            $result = $results->toArray();
            $result['status'] = 200;
            return $result;
        }
    }
}
