<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Services\UserService;
use Illuminate\Http\Request;
use Auth;
use Socialite;
use Carbon\Carbon;

/**
 * Class UserController
 *
 * @package App\Http\Controllers
 */


class UserController extends Controller
{
    private $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * All user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getUsers()
    {
        $users = $this->userService->getAll();
      //  $users = json_encode($users);
        if (count($users) > 0) {
            return view('users', ['users' => $users])->withMessage('All Users');
        }

        return view('users')->withMessage('No Record found!');
    }

    public function searchUsers(Request $request)
    {
        $q = (string)($request['q']);
        if (!is_null($q)) {
            $users = $this->userService->searchUsers($q);
            if (count($users) > 0) {
                return view('users', ['users' => $users])->withQuery($q)->withMessage('The Search results for ' . $q . ' :');
            }
        }
        return view('users')->withMessage('No Details found for ' . $q . ' Try to search again !');
    }

    public function urlShort(Request $request)
    {
        $data = array();
        $data = $request->all();
       // $data['userid'] = Auth::user()->id;
        $links = $this->userService->shortUrl($data);
        if ($links['status'] == 200) {
            return view('urlShortner', ['link' => $links])->withMessage('The Shorten Url for ' . $data['url'] . ' is as below:');

        }
        return view('urlShortner')->withMessage($links['response']);

    }

    public function shortnerURL()
    {
        return view(' urlShortner');
    }
}
