<?php

namespace App\Http\Controllers;

use App\Notifications\WelcomeEmailNotification;
use \Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Comment;
use App\Models\User;
use Carbon\Carbon;


use Illuminate\Support\Facades\Validator;

class CustomAuthController extends Controller
{
    public function login()
    {
        return view("auth.login");
    }

    public function registration()
    {
        return view("auth.registration");
    }

    public function registerUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:12'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->password = Hash::make($request->password);
        $res = $user->save();

        if ($res) {
            // email data
            $email_data = array(
                'name' => $user['name'],
                'email' => $user['email'],
            );

            // send email with the template
            Mail::send('welcome_email', $email_data, function ($message) use ($email_data) {
                $message->to($email_data['email'], $email_data['name'])
                    ->subject('Welcome to mForum')
                    ->from('mforuminfo@gmail.com', 'mForum');
            });

            return back()->with('success', 'You have registered successfully');
        } else {
            return back()->with('fail', 'Something wrong');
        }
    }

    public function loginUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5|max:12'
        ]);
        $user = User::where('email', '=', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $request->session()->put('user', $user);
                return redirect('/dashboard');
            } else {
                return back()->with('fail', 'Wrong password');
            }
        } else {
            return back()->with('fail', 'Email not Registered.');
        }
    }

    public function logout()
    {
        if (Session::has('user')) {
            session()->forget('user');
            return redirect('/login')->with('success', 'Logout Successfully');
        } else {
            return redirect('/login')->with('success', 'Logout Successfully');
        }
    }

    public function dashboard(Request $request)
    {
        $topQues = Question::orderBy('views', 'DESC')->take(5)->get();

        // $Questions = Question::where()->sortByDesc('que_id');
        $Questions = DB::select(DB::raw("SELECT * FROM questions inner join answers WHERE ans_Que_id=que_id ORDER BY que_id DESC"));

        // return view('dashboard')->with('Questions', $Question);
        return view('dashboard', compact('Questions', 'topQues'));
    }

    public function search(Request $request)
    {
        $topQues = Question::orderBy('views', 'DESC')->take(5)->get();

        // Get the search value from the request
        $search = $request->input('search');
        // Search in the title and body columns from the add_question table
        $Questions = Question::query()
            ->where('add_question', 'LIKE', "%{$search}%")
            ->get();
        // Return the search view with the resluts compacted
        return view('dashboard', compact('Questions', 'topQues'));
    }

    public function autocompleteSearch(Request $request)
    {
        $query = $request->get('query');
        $filterResult = Question::where('add_question', 'LIKE', '%' . $query . '%')->get();
        $testarr = [];
        foreach ($filterResult as $sata) {
            $testarr[] = array("name" => $sata->add_question);
        }
        return response()->json($testarr);
    }

    public function question($que_id)
    {
        Question::find($que_id)->increment('views');
        $queA = Question::All()
            ->where('que_id', $que_id)
            ->first();


        $Answers = Answer::where('ans_Que_id', $que_id)->get();
        $Que_User_image = User::where('id', $queA->add_User_id)->get()->first();
        $Ans_User_image = User::where('id', $Answers[0]->ans_User_id)->get()->first();
        $aid = Answer::where('ans_Que_id', $que_id)->value('a_id');
        $comments = Comment::where('ans_id', $aid)->orderBy('created_at')->get();
        return view('answer', compact('Answers', 'queA', 'comments', 'Ans_User_image', 'Que_User_image'));
    }

    public function comment(Request $req)
    {
        $validate = Validator::make($req->all(), [
            'comment' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'message' => $validate->errors(),
                'status' => '406',
            ]);
        } else {
            $data = new Comment;
            $data->ans_id = $req->a_id;
            $data->user_id = $req->user_id;
            $data->comment = $req->comment;
            $data->save();
            $username = User::where('id', $req->user_id)->select('name')->get()->first();
            $photo = User::where('id', $req->user_id)->select('photo')->get()->first();
            return response()->json([
                'status' => '200',
                'message' => $data,
                'name' => $username,
                'photo' => $photo,
                'cmtTime' => $data->created_at->diffForHumans(),
            ]);
        }
    }


    public function AddQuestion(Request $req)
    {
        if (Session::has('user')) {
            $data = new Question();
            $data->add_question = $req->des;
            $cat_name = $req->category;
            $cat_id = category::select('category_id')
                ->where('category_name', '=', $cat_name)
                ->get();

            foreach ($cat_id as $temp) {
                $result = $temp->category_id;
            }
            $data->cat_Que_id = $result;
            $data->add_User_id = Session::get('user')['id'];
            $data->save();
            return redirect()->back()->with('status', 'Question added successfully');
        } else {
            return redirect('/login')->with('fail', 'For Add Question You have to login First !!');
        }
    }

    public function AddAnswer(Request $req)
    {
        if (Session::has('user')) {
            $answer = new Answer();
            $answer->ans_Que_id = $req->id;
            $answer->add_answer = $req->Summernote;
            $answer->ans_User_id = Session::get('user')['id'];
            $answer->save();
            return redirect()->back()->with('Astatus', 'Answer added successfully');
        } else {
            return redirect('/login')->with('fail', 'For Add Answer You have to login First !!');
        }
    }

    public function unAnswered()
    {
        // $noAns=Question::all();
        $noAns = DB::select(DB::raw("SELECT * FROM questions WHERE que_id NOT IN (SELECT ans_Que_id FROM answers);"));
        // return $noAns;
        // $photo = User::where('id', $noAns[0]->add_User_id)->first()['photo'];
        // return $photo;
        return view('unAnswered', ['results' => $noAns]);
    }

    public function profile()
    {
        if (Session::has('user')) {
            $user = Session::get('user')['id'];
            $details = User::where('id', '=', $user)->get();
            $data = DB::select(DB::raw("SELECT count(*) as no FROM `questions` as q WHERE q.add_User_id=$user;"));
            $ans = DB::select(DB::raw("SELECT count(*) as no FROM `answers` as a WHERE a.ans_User_id=$user;"));
            $res = $data[0]->no;
            $a = $ans[0]->no;
            $que = Question::where('add_User_id', '=', $user)->get();
            $ans = Answer::where('ans_User_id', '=', $user)->get();
            return view('profile', compact("details", "res", "a", "que", "ans"));
        } else {
            return redirect('/login')->with('fail', 'For Profile you have to login !');
        }
    }
    public function profileUpdate(Request $req)
    {
        if ($req->file('image')) {
            $filename = time() . "." . $req->file('image')->getClientOriginalExtension();

            $affected = DB::table('users')
                ->where('id', $req->id)
                ->update([
                    'name' => $req->name,
                    'email' => $req->email,
                    'contact' => $req->phone,
                    'designation' => $req->designation,
                    'photo' => $filename
                ]);
            $user = User::where('id', Session::get('user')['id'])->first();
            $req->session()->put('user', $user);
        } else {
            $affected = DB::table('users')
                ->where('id', $req->id)
                ->update([
                    'name' => $req->name,
                    'email' => $req->email,
                    'contact' => $req->phone,
                    'designation' => $req->designation
                ]);
            $user = User::where('id', Session::get('user')['id'])->first();
            $req->session()->put('user', $user);
        }
        if ($req->file('image')) {

            $req->file('image')->storeAs('/public/photo', $filename);
        }
        return redirect()->back()->with('status1', 'details updated successfully');
    }

    public function getQuesAccCat(Request $request)
    {
        $getData = Question::where('cat_Que_id', $request['category'])
            ->leftjoin('users as u', 'u.id', 'questions.add_User_id')
            ->select('u.name', 'questions.que_id as tt', 'questions.cat_Que_id', 'questions.add_User_id', 'questions.add_question', 'questions.slug', 'questions.views', 'questions.created_at')
            ->get();

        return response()->json([
            'data' => $getData,
        ]);
    }

    function showUserProfile($id)
    {
        $user = User::where('id', $id)->get();
        $details = User::where('id', '=', $id)->get();
        $data = DB::select(DB::raw("SELECT count(*) as no FROM `questions` as q WHERE q.add_User_id=$id;"));
        $ans = DB::select(DB::raw("SELECT count(*) as no FROM `answers` as a WHERE a.ans_User_id=$id;"));
        $res = $data[0]->no;
        $a = $ans[0]->no;
        $que = Question::where('add_User_id', $id)->get();
        $ans = Answer::where('ans_User_id', $id)->get();
        return view('userDetails', compact("details", "res", "a", "que", "ans"));
    }
}
